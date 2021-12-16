<?php
//This is the main controller


// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the account model from the model folder
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the reviews model
require_once '../model/reviews-model.php';


// Create or access a Session
session_start();


$classifications = getClassifications();
//var_dump($classifications);
//	exit;
// Build a navigation bar using the $classifications array


$navList = navBar($classifications);

// $navList = '<ul class="it">';
// $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
// foreach ($classifications as $classification) {
//  $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
// }
// $navList .= '</ul>';

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
   // cases for view only: Signin connected to "My Account" URL
    case 'Signin':
      include '../view/signin.php';   
    break;
      // Connected to Sign in page
    case 'Registration':
      include '../view/register.php';
    break;

    case 'updateAccount':
      include '../view/client-update.php';
    break;

    case 'updatedAccount':
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
      $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

      // Check clientEmail to determine if it "looks" like a valid email address
      $clientEmail = checkEmail($clientEmail);

      // Check if clientEmail exists in the database
      $existingEmail = emailCheck($clientEmail);

      // If email is in the database
      if ($existingEmail) {
          // Set condition to check that the new email typed is not the current email of user (Meaning it belongs to another account)
          if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
              $message = '<p class="notice">That email address already exists. Please enter another email address.</p>';
              include '../view/client-update.php';
              exit;
          }
      }

      // Check for missing data
      if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
          $messageEmpty = '<p class="errorFormMessage">Please provide information for all empty form fields.</p>';
          include '../view/client-update.php';
          exit; 
      }

      // Send the updated account data to the model
      $updateResultA = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

      // Store the updated array into the session
      $_SESSION['clientData'] = getClientById($clientId);

      // Check and report the result
      if ($updateResultA) {
          $message = "<p class='notice'>$clientFirstname, your information has been updated.</p>";
          $_SESSION['message'] = $message;
          header('Location: /phpmotors/accounts/?action=admin');
          exit;
      } else {
          $messageEmpty = "<p class='notice'>Sorry $clientFirstname, update failed or no changes have been made. Please try again.</p>";
          include '../view/client-update.php';
          exit;
      }
  break;
    case 'modifyPassword':
      // Filter and store password
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
      $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

      // Check clientPassword if it matches the given pattern. checkPassword() returns either 1 or 0 which is true or false
      $checkPassword  = checkPassword($clientPassword);

      // Check for missing data
      if (empty($checkPassword)) {
          $messagePin = '<p class="errorFormMessage">Error! Please make sure your password matches the desired pattern.</p>';
          include '../view/client-update.php';
          exit; 
      }

      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

      // Send the updated password to the model
      $updateResult = updatePassword($hashedPassword, $clientId);

      // Check and report the result
      if ($updateResult) {
          $message = "<p class='addSuccess'>".$_SESSION['clientData']['clientFirstname'].", your password has been successfully updated.</p>";
          $_SESSION['message'] = $message;
          header('location: /phpmotors/accounts/');
          exit;
      } else {
          $messagePin = "<p class='notice'>Sorry".$_SESSION['clientData']['clientFirstname']." We could not updated your password. Please try again.</p>";
          include '../view/client-update.php';
          exit;
      }
  
      break;


    //Button to register user
      case 'register':

      // Filter and store the data
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);

      //Check for existing emails
      $checkEmail = emailCheck($clientEmail);

      // Check for existing email address in the table
      if($checkEmail){
      $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
      include '../view/signin.php';
      exit;
    }

      // Check for missing data
      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/register.php';
      exit; 
      }

      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

      // Send the data to the model
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

      
      // Check and report the result
      if ($regOutcome === 1) {
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
      header('Location: /phpmotors/accounts/?action=Signin');
      exit;
      } 

      else {
      $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/register.php';
      exit;
      }
      break;
     
    
// Login connected to the signin button
  case 'Login':
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

    //Check data
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    // Check for missing data
    if(empty($clientEmail) || empty($checkPassword)){
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/signin.php';
      exit; 
      }

    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);


    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);


    // If the hashes don't match create an error
    // and return to the login view
    if(!$hashCheck) {
    $message = '<p class="notice">Please check your password and try again.</p>';
    include '../view/signin.php';
    exit;
    }


    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;


    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);


    // Store the array into the session
    $_SESSION['clientData'] = $clientData;

    // Send them to the admin view
    // echo "yay!";
    // exit;
    include '../view/admin.php';
    exit;
    break;

    case 'Logout':
      session_unset();
      session_destroy();
      header('Location: /phpmotors/');
    break;
    default:
    if (isset($_SESSION['clientData'])) {
      $clientId = $_SESSION['clientData']['clientId'];
      $reviewsInfo = getClientReviews($clientId);
      if (count($reviewsInfo)) {
          $clientReviews = buildClientReview($reviewsInfo);
      }
  }
      include '../view/admin.php';
 }

   
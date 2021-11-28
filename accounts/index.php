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
      include '../view/admin.php';
 }

   
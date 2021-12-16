<?php

/* VEHICLE CONTROLLER*/
// Get the database connection file//
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the Vehicle model for use as needed
require_once '../model/vehicles-model.php';
// Functions
require_once '../library/functions.php';
require_once '../model/uploads-model.php';
require_once '../model/reviews-model.php';


// Create or access a Session
session_start();

$classifications = getClassifications();


$navList = navBar($classifications);



// $navList = '<ul class="it">';
// $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
// foreach ($classifications as $classification) {
// $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
// }
// $navList .= '</ul>';

// $classificationlist = '<select navListid="models" name="classificationId">';
// $classificationlist .= "<option value='choose' selected disabled> Choose from car classification</option>";
// foreach ($classifications as $classification) {
// $classificationlist .= "<option value='$classification[classificationId]'> $classification[classificationName]</option>";
// }
// $classificationlist .= '</select>';



$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
}

// control structure
switch ($action){
  case 'vehicle':
    include '../view/add-vehicle.php';
  break;
  case 'classification':
    include '../view/add-classification.php';
  break;



  case 'return':
    $classificationName = filter_input(INPUT_POST, 'classificationName');
    if(empty($classificationName)){
      $message = '<p>Please provide information for the empty form fields.</p>';
      include '../view/add-classification.php';
      exit; 
    }

    //Send data to the model
    $vehOutcome = insertClassifications($classificationName);

    // Check and report the result
    if($vehOutcome === 1){
      header('Location:index.php');
      exit;
    } else {
      $message = "<p>Error Occured. Failed to add new classification. Please try again</p>";
      include '../view/add-classification.php';
      exit;
    }
  break;  
  case 'vehicleprocess':
    $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
    $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
    $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
    $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
    $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
    $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ));
    $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
    $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
    $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));



      if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invPrice) || empty($invThumbnail) || empty($invStock) || empty($invColor)){
        $message = '<p>Please provide information for the empty form fields.</p>';
        include '../view/add-vehicle.php';
        exit; 
      }
  
      //Send data to the model
      $vehOutcome2 = insertVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

      
  
    // Check and report the result
  
      if($vehOutcome2 === 1){
        $message = "<p>Vehicle added succesfully</p>";
        include '../view/add-vehicle.php';
        
        exit;
      } else {
        $message = "<p>Error Occured. Failed to add new vehicle. Please try again</p>";
        include '../view/add-vehicle.php';
        exit;
      }


    break;

    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */ 
    case 'getInventoryItems': 
    // Get the classificationId 
    $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
    // Fetch the vehicles by classificationId from the DB 
    $inventoryArray = getInventoryByClassification($classificationId); 
    // Convert the array to a JSON object and send it back 
    echo json_encode($inventoryArray); 
    break;

    case 'mod':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if(count($invInfo)<1){
        $message = 'Sorry, no vehicle information could be found.';
       }
      include '../view/vehicle-update.php';
       exit;
      break;

    case 'updateVehicle':

      $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
      $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
      $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
      $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
      $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
      $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
      $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
      $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

      
      if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
      $message = '<p>Please complete all information for the new item! Double check the classification of the item.</p>';
      include '../view/vehicle-update.php';
      exit;
      }


        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
        if ($updateResult) {
        $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/vehicles/');
        exit;
       }
       else {
        $message = "<p>Error. The updated vehicle was not added.</p>";
        include '../view/vehicle-update.php';
        exit;
      }    
      break;

    case 'del':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if(count($invInfo)<1){
        $message = 'Sorry, no vehicle information could be found.';
       }
      include '../view/vehicle-delete.php';
       exit;
      break;

    
    case 'deleteVehicle':
      $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
      $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);



      $deleteResult = deleteVehicle($invId);
      if ($deleteResult) {
        $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/vehicles/');
        exit;
      } else {
        $message = "<p class='notice'>Error: $invMake $invModel was not
      deleted.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/vehicles/');
        exit;
      }
      
      break;

      case 'classificationNew':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName, 1);

        if(!count($vehicles)){
          $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
          $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        
        include '../view/classification.php';

        
      break;

      //case to deliver the vehicle details

      case 'vehicleDetails':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        //$invName = $invId;
        $vehicle = getVehicleDetailsById($invId);
        $vehicleThumbs = getThumbnailsById($invId);
        if(!count($vehicle)){
            $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
            $showThumbs = showThumbnails($vehicleThumbs);
            $vehicleInfo = buildVehicleInfo($vehicle);
        }

        if (isset($_SESSION['loggedin'])) {
          if ($_SESSION['loggedin']) {
            $screenName = getScreenName($_SESSION['clientData']['clientFirstname'], $_SESSION['clientData']['clientLastname']);
          }
      }

      $reviewsInfo = getReviewsByInv($invId);
      if (count($reviewsInfo)) {
          $reviewsDisplay = buildReviewsDisplay($reviewsInfo);
      } else {
          if (isset($_SESSION['loggedin'])) {
              $reviewMessage = "Be the first to write a review.";
          } else {
              $reviewMessage = "No review has been made to this vehicle. Log in and be the first.";
          }
      }

        include '../view/vehicle-detail.php';
    break;


    default:
    
    $classificationList = buildClassificationList($classifications);


    include '../view/vehicle-management.php';
}

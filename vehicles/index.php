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
    default:
    include '../view/vehicle-management.php';
}

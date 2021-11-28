<?php

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';

// Create or access a Session
session_start();

//This is the main controller
$classifications = getClassifications();#the getClassification has the data gotten from the database 
#this data is stored in the classifications variable
//var_dump($classifications);
//	exit;


// Build a navigation bar using the $classifications array
// $navList = '<ul class="it">';
// $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
// foreach ($classifications as $classification) { #Takes items from the classifications variable (carclassification DB) and store each individual item in a variable called classification
//  $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
// }

$navList = navBar($classifications);
#for the code above, we have a key called 'action' and the value is the 'classificationName' inside the 'classification' variable
#the function '.urlencode'was just added to take care of any spaces and characters in the process

// $navList .= '</ul>';

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
 }

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
    case 'template':
    include 'view/template.php';
    
    default:
     include 'view/home.php';
   }


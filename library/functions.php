<?php

//This will contain multiple functions

function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
 function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
   }

   //buid a navigation bar
function navBar($classifications){
   $navList = '<ul class="it">';
   $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
   foreach ($classifications as $classification) {
   $navList .= "<li><a href='/phpmotors/vehicles/?action=classificationNew&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
   }
   $navList .= '</ul>';
   return $navList;
}


// Build the classifications select list 
function buildClassificationList($classifications){ 
   $classificationList = '<select name="classificationId" id="classificationList">'; 
   $classificationList .= "<option>Choose a Classification</option>"; 
   foreach ($classifications as $classification) { 
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
   } 
   $classificationList .= '</select>'; 
   return $classificationList; 
  }

  //New function will build a display of vehicles within an unordered list
  function buildVehiclesDisplay($vehicles){
   $dv = '<ul id="inv-display">';
   foreach ($vehicles as $vehicle) {
    $dv .= '<li>';
    $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetails&invId=$vehicle[invId]'><img src='$vehicle[invThumbnail]' alt='Pic of $vehicle[invMake] $vehicle[invModel]></a>";
    $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= '<hr>';
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
    $dv .= "<span>$vehicle[invPrice]</span>";
    $dv .= '</li>';
   }
   $dv .= '</ul>';
   return $dv;
  }


  //This function builds the vehicle information
  function buildVehicleInfo($vehicle) {
   $dv = '<div id="inv-details">';
       $dv .= "<div id='inv-image'>";
           $dv .= "<img id='vehicles' src='$vehicle[invImage]' alt='Pic of $vehicle[invMake] $vehicle[invModel]'>";
           $invPrice = $vehicle['invPrice'];
           $invPrice = number_format($invPrice,2,'.',',');
           $dv .= "<p>Price: &#36;$invPrice</p>";
       $dv .= "</div>";
       $dv .= "<div id='inv-text'>";
           $dv .= "<h2>$vehicle[invMake] $vehicle[invModel] details</h2>";
           $dv .= "<p class='inv-description'>$vehicle[invDescription]</p>";
           $dv .= "<p>Color: $vehicle[invColor]</p>";
           $dv .= "<p class='inv-stock'># in Stock: $vehicle[invStock]</p>";

       $dv .= "</div>";
   $dv .= '</div>';
   return $dv;
} 
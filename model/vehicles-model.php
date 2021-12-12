<?php

// This is the Vehicle model
//this line is used to get new classification
function insertClassifications($classificationName){
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect(); 
    // The SQL statement to be used with the database 
    $sql = 'INSERT INTO carclassification (classificationName) #this line inputs next line into parameters
     VALUES (:classificationName)'; 
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);#sends statement to server and checks for correctness

 // The next line replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR); #replaces name parameter with values recieved from DB variable and tells database type of data


    // The next line runs the prepared statement 

    $stmt->execute(); #sends SQl complete statement to the server
    // The next line gets the data from the database and 
    // stores it as an array in the $classifications variable 

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();# shows the number of rows that were affected by inserted information
    // Close the database interaction

    $stmt->closeCursor(); #closes interaction between function and DB server
    // Return the indication of success (rows changed)

    return $rowsChanged;#sends changed row to the controller
   }


//This function is used to insert a new vehicle to the inventory

function insertVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId ){
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect(); 
    // The SQL statement to be used with the database 
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId) #this line inputs next line into parameters
     VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)'; 
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);#sends statement to server and checks for correctness

 // The next line replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR); #replaces name parameter with values recieved from DB variable and tells database type of data
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    // The next line runs the prepared statement 

    $stmt->execute(); #sends SQl complete statement to the server
    // The next line gets the data from the database and 
    // stores it as an array in the $classifications variable 

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();# shows the number of rows that were affected by inserted information
    // Close the database interaction

    $stmt->closeCursor(); #closes interaction between function and DB server
    // Return the indication of success (rows changed)

    return $rowsChanged;#sends changed row to the controller
   }


   // Get vehicles by classificationId 
   function getInventoryByClassification($classificationId){ 
      $db = phpmotorsConnect(); 
      $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
      $stmt = $db->prepare($sql); 
      $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
      $stmt->execute(); 
      $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
      $stmt->closeCursor(); 
      return $inventory; 
   }

//Selecting a single vehicle based on its ID
// Get vehicle information by invId
function getInvItemInfo($invId){
   $db = phpmotorsConnect();
   $sql = 'SELECT * FROM inventory WHERE invId = :invId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   $stmt->execute();
   $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $invInfo;
  }


  // function will update vehicle
  function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId){
   // Create a connection object from the phpmotors connection function
   $db = phpmotorsConnect(); 
   // The SQL statement to be used with the database 
   $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, 
	invDescription = :invDescription, invImage = :invImage, 
	invThumbnail = :invThumbnail, invPrice = :invPrice, 
	invStock = :invStock, invColor = :invColor, 
	classificationId = :classificationId WHERE invId = :invId';
   // The next line creates the prepared statement using the phpmotors connection      
   $stmt = $db->prepare($sql);#sends statement to server and checks for correctness

// The next line replace the placeholders in the SQL
   // statement with the actual values in the variables
   // and tells the database the type of data it is
   $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR); #replaces name parameter with values recieved from DB variable and tells database type of data
   $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
   $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
   $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
   $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
   $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
   $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
   $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
   $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   // The next line runs the prepared statement 

   $stmt->execute(); #sends SQl complete statement to the server
   // The next line gets the data from the database and 
   // stores it as an array in the $classifications variable 

   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();# shows the number of rows that were affected by inserted information
   // Close the database interaction

   $stmt->closeCursor(); #closes interaction between function and DB server
   // Return the indication of success (rows changed)

   return $rowsChanged;#sends changed row to the controller
  }


  // function will delete vehicle
  function deleteVehicle($invId){
   // Create a connection object from the phpmotors connection function
   $db = phpmotorsConnect(); 
   // The SQL statement to be used with the database 
   $sql =  'DELETE FROM inventory WHERE invId = :invId';
   // The next line creates the prepared statement using the phpmotors connection      
   $stmt = $db->prepare($sql);#sends statement to server and checks for correctness

// The next line replace the placeholders in the SQL
   // statement with the actual values in the variables
   // and tells the database the type of data it is
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   // The next line runs the prepared statement 

   $stmt->execute(); #sends SQl complete statement to the server
   // The next line gets the data from the database and 
   // stores it as an array in the $classifications variable 

   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();# shows the number of rows that were affected by inserted information
   // Close the database interaction

   $stmt->closeCursor(); #closes interaction between function and DB server
   // Return the indication of success (rows changed)

   return $rowsChanged;#sends changed row to the controller
  }


  //New function will get a list of vehicles based on the classification
  function getVehiclesByClassification($classificationName){
   $db = phpmotorsConnect();
   $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
   $stmt->execute();
   $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $vehicles;
}

//This function will add obtain the information about vehicle in the inventory
// Get information for all vehicles
   function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}


   //NOTES

//Lines 5 and 39 creates functions that have the stated parameters  
//lines 7 and 9 SQL insert statement using names parameters instead of actual values as part of prepared statements
//line 12 sends the SQL statement above to the DB server where it is checked for correctness, if it is, a Prepared
//statement is created and stored in the $stmt variable
//lines 17 the bindValue function replaces the name parameter (eg :classificationName) with the actual value from the variable
//$classificationName. It also tells database type of data being recieved (PDO///lSTR) in this case string
//lines 22 sends the now completed SQL statement to the server and the data is inserted to the database
//lines 27 Askes DB server to indicate how may rows changed as a result of the last SQL query/ the number that is returned is stores
//in the $rowsChanged variable. We anticipate number to be one meaning one new record was added
//lines 30 closes the interaction between function and DB server
//lines 33 sends the value of the $rowsChanged variable back to wherever the function was called. The controller
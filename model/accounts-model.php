<?php

// This is the account model


// Handles the registration site
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)#this line inserts next line into parameter
        VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';#This line takes the value for the DB and stores it to line above
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);#sends statement to server and checks for correctness
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR); #replaces name parameter with values recieved from DB variable and tells database type of data
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();#sends SQl complete statement to the server
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();# shows the number of rows that were affected by inserted information
    // Close the database interaction
    $stmt->closeCursor(); #closes interaction between function and DB server
    // Return the indication of success (rows changed)
    return $rowsChanged;#sends changed row to the controller
   }


//Function used to check for existing email addresses
function emailCheck($clientEmail){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    //SQL statement
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if(empty($matchEmail)){
       return 0;
    } else {
    return 1;
    }

}

// Get client data based on an email address
function getClient($clientEmail){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
   }
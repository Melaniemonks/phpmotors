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

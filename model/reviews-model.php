<?php
// PHP Motors Reviews Model

// This function will handle review additions
function addReview($reviewText, $invId, $clientId) {
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();

    // The SQL statement
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
        VALUES (:reviewText, :invId, :clientId)';

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The lines below replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// This function will get all reviews for a specific vehicle
function getReviewsByInv($invId) { 
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();

    // The SQL statement
    $sql = 'SELECT reviews.reviewText, reviews.reviewDate, clients.clientFirstname, clients.clientLastname 
    FROM reviews 
    JOIN clients ON reviews.clientId = clients.clientId 
    WHERE invId = :invId';

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The lines below replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $reviewsInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $reviewsInfo;
}

// This function will get all reviews per client
function getClientReviews($clientId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();

    // The SQL statement
    $sql = 'SELECT inventory.invMake, inventory.invModel, reviews.reviewDate, reviews.reviewId 
    FROM reviews 
    JOIN inventory ON reviews.invId = inventory.invId 
    WHERE clientId = :clientId
    ORDER BY reviews.reviewDate DESC';

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The lines below replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $reviewsInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $reviewsInfo;
}

// This function will retrieve reviews by its ID
function retrieveReview($reviewId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();

    // The SQL statement
    $sql = 'SELECT reviews.reviewDate, reviews.reviewText, inventory.invMake, inventory.invModel 
    FROM reviews 
    JOIN inventory ON reviews.invId = inventory.invId 
    WHERE reviews.reviewId = :reviewId
    ORDER BY reviews.reviewDate DESC';

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The lines below replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $review = $stmt->fetch(PDO::FETCH_ASSOC);

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $review;
}

// This function modifies/makes changes to an already existing review
function updateReview($reviewId, $reviewText)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();

    // The SQL statement
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The lines below replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// This function permanently deletes a review
function deleteReview($reviewId)
{
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
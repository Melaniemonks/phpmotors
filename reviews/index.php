<?php
// This is the Reviews controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the accounts model
require_once '../model/accounts-model.php';

// Get the vehicles model
require_once '../model/vehicles-model.php';

// Get the reviews model
require_once '../model/reviews-model.php';

// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = navbar($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

// Control Structure
switch ($action){
    case 'addReview':
        // Filter and store the data
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

        // Check for missing data
        if(empty($reviewText)){
            $_SESSION['messageReview'] = '<p class="errorFormMessage">*You need to write a review to submit one.</p>';
            //include '../view/vehicle-detail.php';
            header("Location: /phpmotors/vehicles?action=vehicleDetails&invId=" . $invId);
            exit; 
        }

        // Send the review text to the model
        $reviewOutcome = addReview($reviewText, $invId, $clientId);

        // Check and report the result
        if($reviewOutcome === 1){
            $_SESSION['messageReview'] = "<p class='addSuccess'>Review added successfully! It is displayed below.</p>";
            //include '../view/vehicle-detail.php';
            header("Location: /phpmotors/vehicles?action=vehicleDetails&invId=" . $invId);
            exit;
        } else {
            $_SESSION['messageReview'] = "<p class='notice'> Error occured. Failed to add review. Please try again.</p>";
            //include '../view/vehicle-detail.php';
            header("Location: /phpmotors/vehicles?action=vehicleDetails&invId=" . $invId);
            exit;
        }
    break;
    case 'updateReviewView':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);

        $review = retrieveReview($reviewId);

        if(count($review)<1){
            $message = 'Sorry, no review information could be found.';
        }
        include '../view/review-update.php';
        exit;
    break;
    case 'updateReview':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

        if (empty($reviewId) || empty($reviewText)) {
            $_SESSION['message'] = '<p class="notice">Please provide information for the empty field.</p>';
            include '../view/review-update.php';
            exit;
        }

        $rowsChanged = updateReview($reviewId, $reviewText);

        if ($rowsChanged) {
            $_SESSION['message'] = "<p class='addSuccess'>The review was updated successfully.</p>";
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $_SESSION['message'] = "<p class='notice'>Review update failed. Please try again.</p>";
            include '../view/review-update.php';
            exit;
        }
    break;
    case 'deleteReviewView':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);

        $review = retrieveReview($reviewId);

        if(count($review)<1){
            $message = 'Sorry, no review information could be found.';
        }
        include '../view/review-delete.php';
        exit;
    break;
    case 'deleteReview':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $rowsChanged = deleteReview($reviewId);

        if ($rowsChanged === 1) {
            $_SESSION['message'] = "<p class='addSuccess'>The review has been deleted.</p>";
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $_SESSION['message'] = "<p class='notice>Review was NOT deleted. Please try again.</p>";
            header('location: /phpmotors/accounts/');
            exit;
        }
    break;
    default:
    if (isset($_SESSION['loggedin'])) {
        header('location: /phpmotors/accounts/');
    } else {
        header('location: /phpmotors/');
    }
    break;
}
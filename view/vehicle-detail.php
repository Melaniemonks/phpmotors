<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/small.css">
    <link rel="stylesheet" href="../css/medium.css">
    <link rel="stylesheet" href="../css/large.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Iceland&family=Rationale&display=swap" rel="stylesheet">
    <title><?php echo $vehicle['invMake'] . ' ' . $vehicle['invModel']; ?> | PHP Motors, Inc.</title>
</head>

<body>
    <div id=inside>
        <header>
            
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/header.php'; ?>

            <nav class='it'>
            
          
            <?php echo $navList; ?>
                
                
            </nav>
        </header>


        <main>
        <h1><?php echo $vehicle['invMake'] . ' ' . $vehicle['invModel']; ?></h1>
        <?php if(isset($message)){
            echo $message; }
        ?>
        <div class="container-veh">  
            <?php if(isset($vehicleInfo)){
                echo $vehicleInfo;
            } ?>
            <?php if(isset($showThumbs)){
                echo $showThumbs;
            } ?>  
        </div>


        <hr>
        <h2>Customer Reviews</h2>
        <?php
            if (isset($_SESSION['loggedin'])) {
                echo'<h3>Review the ' . $vehicle['invMake'] . ' ' . $vehicle['invModel'] . '</h3>';

                echo "<form method='post' action='/phpmotors/reviews/'>";
                    echo '<label for="screenName">Screen Name:</label><br>';
                    echo '<input class="form" type="text" id="screenName" name="screenName" value ="' . $screenName. '" readonly ?><br>';
                    echo '<label for="reviewText">Review:</label><br>';
                    echo '<textarea class="form" id="reviewText" name="reviewText" placeholder="Write your review..." required></textarea><br>';
                    echo '<div class="submit">';
                        echo '<input class="submitAccount" type="submit" value="SUBMIT REVIEW">';
                        echo '<!-- Add the action name - value pair -->';
                        echo '<input type="hidden" name="action" value="addReview">';
                        echo '<input type="hidden" name="invId" value="' . $vehicle['invId'] . '">';
                        echo '<input type="hidden" name="clientId" value="' . $_SESSION['clientData']['clientId'] . '">';
                        // echo '<input type="hidden" name="invMake" value="' . $vehicle['invMake'] . '">';
                        // echo '<input type="hidden" name="invModel" value="' . $vehicle['invModel'] . '">';
                    echo '</div>';
                echo '</form>';
            }
            else {
                echo '<p>You must <a href="/phpmotors/accounts/index.php?action=login">login</a> to write a review.</p>';
            }
            if (isset($_SESSION['messageReview'])) {
                echo $_SESSION['messageReview'];
            }
            if (isset($reviewsDisplay)){
                echo $reviewsDisplay;
            } else {
                echo $reviewMessage;
            }
        ?>
        </main>
        
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
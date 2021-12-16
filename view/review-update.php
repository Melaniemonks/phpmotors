<?php 
// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
    exit;
}
?><!DOCTYPE html>
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
    <title>Php Motors</title>
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
        <h1><?php if(isset($review['invMake']) && isset($review['invModel'])){ 
	        echo "$review[invMake] $review[invModel] Review";} 
            // elseif(isset($invMake) && isset($invModel)) { 
	        // echo "$invMake $invModel Review"; }
            else {
                echo "Edit Review";
            } ?>
        </h1>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        }
        ?>
        <p class='review'>Reviewed on <?php 
        $date = date_create("$review[reviewDate]");
        echo date_format($date, 'd F, Y') ?></p>
        <form method="post" action="/phpmotors/reviews/">
            <label for="reviewText">Review Text:</label><br>
            <textarea class="form" id="reviewText" name="reviewText" required><?php if(isset($reviewText)){ echo $reviewText; } elseif(isset($review['reviewText'])){ echo $review['reviewText']; } ?></textarea><br>
            <div class="submit">
                <input class="submit" type="submit" value="MODIFY">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updateReview">
                <input type="hidden" name="reviewId" value="<?php echo $reviewId?>">
            </div>
        </form>    
        </main>
        
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
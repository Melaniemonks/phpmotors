<?php

if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
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
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Delete $invMake $invModel"; }?> | PHP MOTORS</title>
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
            <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		    echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	        elseif(isset($invMake) && isset($invModel)) { 
		    echo "Delete $invMake $invModel"; }?></h1>
            <p>Confirm Vehicle Deletion. The delete is permanent.</p>
            <?php
            if (isset($message)) {
             echo $message;
            }
            ?>
            
            <form method="post" action="/phpmotors/vehicles/index.php">
            <label for="classificationId">Choose Car Classification:</label><br>
             
              <label for="invMake"> Make:</label><br>
              <input type="text" id="invMake" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } ?> readonly ><br>
              <label for="invModel">Model:</label><br>
              <input type="text" id="invModel" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } ?> readonly ><br>
              <label for="invDescription"> Description:</label><br>
              <textarea id="invDescription" name="invDescription" ><?php if(isset($invDescription)){echo $invDescription;} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br>
              <input type="submit" value="Delete Vehicle" class="sbmit">


              <input type="hidden" name="action" value="deleteVehicle">
              <input type="hidden" name="invId" value="
              <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?> ">
            </form> 
        </main>
        
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
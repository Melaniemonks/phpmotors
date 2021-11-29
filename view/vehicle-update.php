<?php
//Build the select list 
$classificationlist = '<select id="classificationId" name="classificationId" required>' ;
$classificationlist .= "<option value='' selected disabled> Choose from car classification</option>";
foreach ($classifications as $classification) {
    $classificationlist .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)){
        if ($classification['classificationId'] === $classificationId){
            $classificationlist .= ' selected ';
  }
    }
    elseif(isset($invInfo['classificationId'])){
        if($classification['classificationId'] === $invInfo['classificationId']){
         $classificationlist .= ' selected ';
        }
}
 $classificationlist .= ">$classification[classificationName]</option>";
}
$classificationlist .= '</select>';

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
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP MOTORS</title>
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
		    echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	        elseif(isset($invMake) && isset($invModel)) { 
		    echo "Modify $invMake $invModel"; }?></h1>
            <?php
            if (isset($message)) {
             echo $message;
            }
            ?>
            
            <form method="post" action="/phpmotors/vehicles/index.php">
            <label for="classificationId">Choose Car Classification:</label><br>
              <?php echo $classificationlist ?><br>
              <label for="invMake"> Make:</label><br>
              <input type="text" id="invMake" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } ?> required ><br>
              <label for="invModel">Model:</label><br>
              <input type="text" id="invModel" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } ?>  required><br>
              <label for="invDescription"> Description:</label><br>
              <textarea id="invDescription" name="invDescription" ><?php if(isset($invDescription)){echo $invDescription;} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br>
              <label for="invImage"> Image Path:</label><br>
              <input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png" <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; } ?>  required><br>
              <label for="invThumbnail">Thumbnail Path:</label><br>
              <input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/no-image-tn.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>  required ><br>
              <label for="invPrice"> Price:</label><br>
              <input type="text" id="invPrice" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; } ?>  required><br>
              <label for="invStock"># In Stock:</label><br>
              <input type="text" id="invStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>  required><br>
              <label for="invColor">Color:</label><br>
              <input type="text" id="invColor" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";}  elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>  required ><br>
              <input type="submit" value="Update Vehicle" class="sbmit">


              <input type="hidden" name="action" value="updateVehicle">
              <input type="hidden" name="invId" value="
              <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
              elseif(isset($invId)){ echo $invId; } ?> ">
            </form> 
        </main>
        
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
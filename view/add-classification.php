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
    <title>Add Classification</title>
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
        <h1>Classification</h1>

<?php 
if (isset($message)) {
    echo $message;
    }
    ?>

<form action='/phpmotors/vehicles/index.php' class ="vehicle" method="post">
    <label for="classificationName"> Car Classification:</label><br>
    <input type="text" id="classificationName" name="classificationName" required maxlength="30" ><br>
    
    <input type="submit" value="Submit" class="submit">
    <input type="hidden" name="action" value="return">
  </form>
        </main>
        
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
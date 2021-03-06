<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
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
    <title>Vehicle Management</title>
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
            <ul>
                <li><a href="/phpmotors/vehicles/index.php?action=vehicle">Add a Vehicle</a></li>
                <li><a href="/phpmotors/vehicles/index.php?action=classification">Add a Classification</a></li>
            </ul>




            <?php
                if (isset($message)) { 
                echo $message; 
                } 
                if (isset($classificationList)) { 
                echo '<h2>Vehicles By Classification</h2>'; 
                echo '<p>Choose a classification to see those vehicles</p>'; 
                echo $classificationList; 
                }
                ?>

                <noscript>
                <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>

                <table id="inventoryDisplay"></table>

            
        </main>
        
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>

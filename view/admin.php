<?php
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
        <h1><?php echo $_SESSION['clientData']['clientFirstname'] .' '. $_SESSION['clientData']['clientLastname'] ?></h1>
        <p> You are logged in!</p>

        <ul>
            <li>First name: <?php echo $_SESSION['clientData']['clientFirstname']?></li>
            <li>Last name: <?php echo $_SESSION['clientData']['clientLastname']?></li>
            <li>Email Address: <?php echo $_SESSION['clientData']['clientEmail']?></li>
        </ul>

        <?php
            if ($_SESSION['clientData']['clientLevel'] > 1) {
                echo '<h2>Inventory Management</h2>';
                echo '<p>Use this link to manage the Inventory.</p>';
                echo '<a href="/phpmotors/vehicles/">Vehicle Management</a>';
            }
        ?>
        </main>
        
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
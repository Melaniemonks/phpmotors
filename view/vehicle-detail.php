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
        </main>
        
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
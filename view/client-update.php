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
            <h1>Manange Account</h1>

            <h2>Account Updates </h2>
            <?php
            if (isset($messageEmpty)){
                echo $messageEmpty;
            }
            ?>


            <form action='/phpmotors/accounts/index.php' class='login' method='post'>
            <label for="clientFirstname">First Name:</label><br>
            <input class="form" type="text" id="clientFirstname" name="clientFirstname" placeholder="First Name" required <?php if(isset($_SESSION['clientData']['clientFirstname'])) {echo "value=".$_SESSION['clientData']['clientFirstname']; } ?>><br>
            <label for="clientLastname">Last Name:</label><br>
            <input class="form" type="text" id="clientLastname" name="clientLastname" placeholder="Last Name" required <?php if(isset($_SESSION['clientData']['clientLastname'])) {echo "value=".$_SESSION['clientData']['clientLastname']; } ?>><br>
            <label for="clientEmail">Email Address:</label><br>
            <input class="form" type="email" id="clientEmail" name="clientEmail" placeholder="Enter a valid email address" required <?php if(isset($_SESSION['clientData']['clientEmail'])) {echo "value=".$_SESSION['clientData']['clientEmail']; } ?>><br>
            <div class="submit">
                <input class="submitAccount" type="submit" value="UPDATE INFO">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updatedAccount">
                <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId']; } ?>">
            </div>
              </form>

              <h2>Update Password</h2>
            <?php
            if (isset($messagePin)){
                echo $messagePin;
            }
            ?>
            <form method="post" action="/phpmotors/accounts/index.php">
                <label for="clientPassword">Password:</label><br>
                <span class="pward">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span>
                <p class="pward">*Note! Your original password will be changed.</p>
                <input class="form" type="password" id="clientPassword" name="clientPassword" placeholder="Type New Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                <div class="submit">
                    <input class="submitAccount" type="submit" value="UPDATE PASSWORD">
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="modifyPassword">
                    <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId']; } ?>">
                </div>
            </form> 
        </main>

        
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
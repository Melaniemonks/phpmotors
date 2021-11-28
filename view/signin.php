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
    <title>Sign In</title>
</head>

<body>

    <div id=inside>
        <header>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/header.php'; ?>

            <nav class='it'>              
                   <?php echo $navList; //require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/navigation.php';?>
            </nav>
        </header>

        <main>

            <h1>Sign In</h1>
            <?php if (isset($message)) {echo $message;}?>
            <form action='/phpmotors/accounts/index.php' class='login' method='post'>
                <label for="clientEmail">Email:</label><br>
                <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required><br>
                
                <label for="clientPassword">Password:</label><br>
                <input type="password" id="clientPassword" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br><br>
                <button class="signin" type="submit">Sign In</button>

                
                <input type="hidden" name="action" value="Login">
              </form>
              <ul class="reroute"><li>Don't have an account?<a href='/phpmotors/accounts/index.php?action=Registration'> click here! </a></li></ul>
        </main>
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
<div class="top">
    <img src="/phpmotors/images/site/logo.png" alt="logo Phpmotors">
   


<?php 
    if (isset($_SESSION['loggedin'])) {
        echo "<a href='/phpmotors/accounts' id='welcome'>Welcome " . $_SESSION['clientData']['clientFirstname'] ."</a>";
        echo "<a href='/phpmotors/accounts?action=Logout' title='Log Out from PHP Motors' id='logOut'>Log Out</a>";
    } else {
        echo "<a href='/phpmotors/accounts/index.php?action=Signin' id='MyAccount' title='Log in to your account'>My Account</a>";
    }
?>
</div>
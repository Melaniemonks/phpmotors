<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/small.css" >
    <link rel="stylesheet" href="./css/medium.css">
    <link rel="stylesheet" href="./css/large.css">
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
                  
                   <?php echo $navList;?>
        
            </nav>
        </header>




        <main>
            <h1>Welcome to PHP Motors!</h1>

            <div class="float">
                <section class="content">

                    <div class="car">
                        <img class="motto" src="images/delorean.jpg" alt="delorean">

                        <div class="words">
                            <h2>DMC Delorean</h2>
                            <p>3 Cup holders<br>
                                Superman doors<br>
                                Fuzzy dice!</p>
                        </div>

                        <div class="button">
                            <img src="images/site/own_today.png" alt="own today">
                        </div>

                    </div>
                </section>


            </div>

            <div class="bottom">
                <section class="one">
                    <h2>Delorean Upgrades</h2>
                    <section class="grid">
                        <section class="parts">
                            <section class="blue">
                                <img src="images/upgrades/flux-cap.png" alt="flux">
                            </section>

                            <ul><li><a href="#" title="flux capicitors">flux Capacitors</a></li></ul>

                        </section>

                        <section class="parts">
                            <section class="blue">
                                <img src="images/upgrades/flame.jpg" alt="flame">
                            </section>

                            <ul><li><a href="#" title="flames decals" >flames Decal</a></li></ul>


                        </section>

                        <section class="parts">
                            <section class="blue">
                                <img src="images/upgrades/bumper_sticker.jpg" alt="bumper sticker">
                            </section>

                            <ul><li><a href="#" title="bumper stickers">Bumper stickers</a></li></ul>

                        </section>

                        <section class="parts">
                            <section class="blue">
                                <img src="images/upgrades/hub-cap.jpg" alt="hub cap">
                            </section>

                            <ul><li><a href="#" title="hub cap">Hub Cap</a></li></ul>

                        </section>
                    </section>
                </section>


                <section class="two">
                    <h2>DMC Delorean Reviews</h2>

                    <div class="links">

                        <ul>
                            <li>"So fast its almost like travelling in time." (4/5)</li>
                            <li>"Coolest rode on the road." (4/5)</li>
                            <li>"I'm feeling Marty McFly!." (5/5)</li>
                            <li>"The most futuristic ride of our day." (4.5/5)</li>
                            <li>"80's living and I love it!." (4/5)</li>

                        </ul>
                    </div>

                </section>

            </div>

        </main>
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippet/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
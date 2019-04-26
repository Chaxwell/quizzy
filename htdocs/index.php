<?php
session_start();
include 'includes/connexion-bdd.php';

if (isset($_COOKIE['lastpage'])) {
    $_COOKIE['lastpage'] = "index.php";
} else {
    setcookie('lastpage', 'index.php', time() + 31536000, '/');
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="dependencies/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Raleway|Roboto" rel="stylesheet">
    <link href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css" rel="stylsheet">
    <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli|Open+Sans|Satisfy" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli|Open+Sans|Satisfy" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Courgette|Kalam|Pacifico|Roboto" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <title>Quizzy</title>
</head>

<body>

    <?php include 'includes/navbar.php'; ?>

    <div id="fondfirstpage" class="bg-info pt-5">
        <div class="d-flex justify-content-center">
            <img src="images/quizzyblueok.png" alt="logo" height="200px" width="200px" class="logo">
        </div>
        <div class="d-flex justify-content-center text-center mt-5">
            <div class="slogan-center">
                <span class="h4 text-center slogan"> Testez vos compétences et amusez-vous</span>
            </div>
        </div>
    </div>

    <div class="bg-info truc d-flex justify-content-center pb-5">
        <a class="btn btn-lg btn-outline-dark" href="themes.php">Let's Go</a>
    </div>

    <script src="dependencies/jquery/dist/jquery.min.js"></script>
    <script src="dependencies/popper.js/dist/popper.min.js"></script>
    <script src="dependencies/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
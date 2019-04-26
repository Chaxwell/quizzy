<?php
session_start();

include 'includes/connexion-bdd.php';

if (empty($_SESSION['userId'])) {
    header("Location: index.php");
    die();
}

if (isset($_COOKIE['lastpage'])) {
    $_COOKIE['lastpage'] = "themes.php";
}

if (empty($_GET['theme'])) {
    header("Location: index.php");
    die();
}

$themes = ['cuisine', 'science'];


if (!in_array($_GET['theme'], $themes)) {
    header("Location: index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="dependencies/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Courgette|Kalam|Pacifico|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
    <title><?= ucfirst(htmlspecialchars($_GET['theme'])); ?></title>
</head>

<body>

    <?php include 'includes/navbar.php' ?>

    <div class="align-self-center">
        <div id="fondfirstpage" class="d-flex justify-content-center bg-info pt-5">

            <div class="container text-center">


                <?php

                if (isset($_GET['theme'])) {
                    if (in_array($_GET['theme'], $themes)) {
                        printf(
                            '
                            
                    <span class="h2 slogan">%s</span><br><br>
                    <span class="h4">Testez vos compétences!</span><br><br>
                    <a href="qcm.php?theme=%s">
                        <span class="fa-stack fa-9x">
                        <i class="fa fa-square fa-stack-1x fa-160em icon-bgcolor-lightblue"></i>
                        <i class="fa fa-globe-africa fa-stack-1x fa-inverse icon-color-orange"></i>
                        </span>
                    </a>
                
                    ',
                            ucfirst($_GET['theme']),
                            $_GET['theme']
                        );
                    }
                }

                ?>
            </div>



            <script src="dependencies/jquery/dist/jquery.min.js"></script>
            <script src="dependencies/popper.js/dist/popper.min.js"></script>
            <script src="dependencies/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
            <script src="js/app.js"></script>
</body>

</html>
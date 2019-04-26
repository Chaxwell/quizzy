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
    <title>QCM</title>
</head>

<body>
    <?php include 'includes/navbar.php' ?>

    <div id="fondfirstpage" class="d-flex justify-content-center bg-info pt-5">

        <div class="container">
            <?php

            $jsonFile = file_get_contents('./data/questions.json');
            $dataQuestions = json_decode($jsonFile, true);

            ?>


            <div class="container">
                <div class="formulaire-inscription-cadre">



                    <div id="buttonquestion" class="question mb-5 align-items-center d-flex justify-content-center">

                    </div>


                    <div class="reponses">
                        <div id="buttonlarge" class="reponse m-3 align-items-center d-flex justify-content-center">

                        </div>
                        <div id="buttonlarge" class="reponse m-3 align-items-center d-flex justify-content-center">

                        </div>
                        <div id="buttonlarge" class="reponse m-3 align-items-center d-flex justify-content-center">

                        </div>
                        <div id="buttonlarge" class="reponse valide m-3 align-items-center d-flex justify-content-center">

                        </div>
                    </div>

                    <div class="testo mt-5 d-flex align-items-center justify-content-center">
                        <button id="suivant" class="button" disabled>Suivant</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="dependencies/jquery/dist/jquery.min.js"></script>
    <script src="dependencies/popper.js/dist/popper.min.js"></script>
    <script src="dependencies/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="js/qcm.js"></script>
</body>

</html>
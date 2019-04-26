<?php
session_start();
include 'includes/connexion-bdd.php';

if (empty($_SESSION['userId'])) {
    header("Location: index.php");
    die();
}

$req = $bdd->prepare("SELECT score FROM users WHERE id = ?");
$req->execute(array($_SESSION['userId']));
$score = $req->fetch();
$score = $score['score'];

$req = $bdd->query("SELECT score FROM users ORDER BY score DESC LIMIT 1");
$highestScore = $req->fetch();
$highestScore = $highestScore['score'];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="dependencies/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Mes scores</title>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container d-flex justify-content-center align-items-center">
        <?php

        if ($score == $highestScore) {
            $sizeScore = $sizeHighestScore = 250;
            $ratio = 1;
        } else {
            $ratio = ($score / $highestScore);
            $sizeScore = $ratio * 250;
            if ($sizeScore < 10) {
                $sizeScore = 10;
            }
            $sizeHighestScore = 250;
        }

        printf(
            '<img src="graph.php?score=%s&size=%s&ratio=%s" alt="Votre Score" class="mx-2">
            <img src="graphHighest.php?score=%s&size=%s" alt="Score le plus haut">',
            $score,
            $sizeScore,
            $ratio,
            $highestScore,
            $sizeHighestScore
        );
        ?>
    </div>


    <script src="dependencies/jquery/dist/jquery.min.js"></script>
    <script src="dependencies/popper.js/dist/popper.min.js"></script>
    <script src="dependencies/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
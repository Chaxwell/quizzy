<?php
session_start();

include 'includes/connexion-bdd.php';


if (empty($_SESSION['userId'])) {
    header("Location: index.php");
    die();
}

if (empty($_GET['score'])) {
    header("Location: index.php");
    die();
}

$_GET['score'] = intval($_GET['score'], 10);

if ($_GET['score'] > 50) {
    header("Location: /index.php");
    die();
}

if (isset($_SESSION['battleEye']) && $_SESSION['battleEye'] == 'anticheat') {
    $req = $bdd->prepare("SELECT score FROM users WHERE id = ?");
    $req->execute(array($_SESSION['userId']));
    $score = $req->fetch();
    $score = intval($score['score'], 10);
    $score += $_GET['score'];

    $req = $bdd->prepare("UPDATE users SET score = ? WHERE id = ?");
    $req->execute(array($score, $_SESSION['userId']));

    $_SESSION['battleEye'] = '';

    header("Location: themes.php");
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
    <link rel="stylesheet" href="css/style.css">
    <title>Score final</title>
</head>

<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="container">
        <?php

        printf(
            '
        <span class="h2">Votre score est de : %s</span><br><br>
        <a href="themes.php" class="btn btn-primary">Rejouer</a><br><br>
        <a href="themes.php" class="btn btn-primary">Thèmes</a>
        ',
            htmlspecialchars($_GET['score'])
        );

        ?>
    </div>

    <script src="dependencies/jquery/dist/jquery.min.js"></script>
    <script src="dependencies/popper.js/dist/popper.min.js"></script>
    <script src="dependencies/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
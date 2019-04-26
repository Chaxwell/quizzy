<?php

/* if (empty($_SESSION['userId'])) {
    header("Location: ../index.php");
    die();
} */

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="3; url=<?php
                                                if (isset($_COOKIE['lastpage'])) {
                                                    echo '../' . htmlspecialchars($_COOKIE['lastpage']);
                                                } else {
                                                    echo '../' . 'index.php';
                                                } ?>">
    <link rel="stylesheet" href="../dependencies/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Redirection..</title>
</head>

<body>
    <?php
    // Si on est sur la page connexion.php
    if ($_SERVER['REQUEST_URI'] == '/connexion.php') {
        include 'includes/navbar.php';
    } else {
        include '../includes/navbar.php';
    }
    ?>

    <div class="container">
        <h3>Vous êtes déjà connecté.</h3>
        <h4>Redirection dans quelques secondes..</h4>
    </div>

    <script src="../dependencies/jquery/dist/jquery.min.js"></script>
    <script src="../dependencies/popper.js/dist/popper.min.js"></script>
    <script src="../dependencies/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>
</body>

</html>
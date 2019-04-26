<?php
session_start();
include 'includes/connexion-bdd.php';

if (isset($_SESSION['userId'])) {
    include 'includes/err-connected.php';
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

    <link rel="stylesheet" href="css/style.css">
    <title>Connexion</title>
</head>

<body>

    <?php include 'includes/navbar.php'; ?>
    <!--   //carre bleue de fond// -->
    <div class="align-self-center">
        <div id="fondfirstpage" class="d-flex justify-content-center bg-info pt-5">
            <div class="container">
                <div class="formulaire-inscription-cadre">
                    <form method="POST" action="traitements/traitement-connexion.php" autocomplete="off">
                        <div class="form-group">
                            <label for="nickname">Pseudo</label>
                            <?php

                            if (isset($_COOKIE['nickname'])) {
                                printf(
                                    '<input name="nickname" type="text" class="form-control" id="nickname" value="%s">',
                                    htmlspecialchars($_COOKIE['nickname'])
                                );
                            } else {
                                printf('
                    <input name="nickname" type="text" class="form-control" id="nickname" placeholder="Votre pseudo">
                    ');
                            }

                            // ERRHANDLE:
                            if (isset($_GET['err']) && $_GET['err'] == 'login') {
                                printf('<small>Mauvais pseudo ou mdp</small>');
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Votre mot de passe">
                            <a class="small" href="inscription.php">S'inscrire</a>
                        </div>
                        <div class="form-group form-check">
                            <input type="hidden" name="stayConnected" value="0">
                            <input <?php if (isset($_COOKIE['nickname'])) {
                                        printf('checked=on');
                                    } ?>name="stayConnected" type="checkbox" class="form-check-input" id="stayConnected" value="1">
                            <label class="form-check-label" for="stayConnected">Se souvenir de moi</label>
                        </div>
                        <button type="submit" class="btn btn-outline-dark">Connexion</button>

                        <!--                     <button type="button" class="btn btn-secondary btn-lg">Let's Go</button>
 -->
                    </form>
                </div>
            </div>

        </div>
        <script src="dependencies/jquery/dist/jquery.min.js"></script>
        <script src="dependencies/popper.js/dist/popper.min.js"></script>
        <script src="dependencies/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
        <script src="js/app.js"></script>
</body>

</html>
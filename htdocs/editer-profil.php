<?php
session_start();

include 'includes/connexion-bdd.php';

if (empty($_SESSION['userId'])) {
    header("Location: index.php");
    die();
}
if (isset($_COOKIE['lastpage'])) {
    $_COOKIE['lastpage'] = "profil.php";
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
    <title>Éditer mon profil</title>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>


    <div class="d-flex justify-content-center bg-info py-5">

        <div class="container text-center">
            <?php

            $req = $bdd->prepare("SELECT * FROM users
                          WHERE id = ?");
            $req->execute(array($_SESSION['userId']));
            $userInfo = $req->fetch();

            printf(
                '
                <form method="POST" action="traitements/traitement-edition-profil.php" autocomplete="off" enctype="multipart/form-data">
                    <img class="profile-picture mb-4" src="uploads/%s" alt="Image de profil">
                    <input type="file" name="fileToUpload" accept="image/*" class="form-control-file" id="fileToUpload"><br>
                    <button class="btn btn-outline-dark" type="button" onclick="document.querySelector(\'#fileToUpload\').click();">Parcourir</button><br><br>
                    <span class="h3 slogan">%s</span><br><br>
                    <span class="h4">%s</span><br>
                    <i class="fas fa-star fa-160em icon-color-yellow"></i>
                    <i class="far fa-star fa-160em icon-color-yellow"></i>
                    <i class="far fa-star fa-160em icon-color-yellow"></i><br><br>
                    <label for="email">Email</label>
                    <input id="email" class="form-control text-center" type="email" name="email" value="%s"><br><br>
                    <label for="password">Mot de passe</label>
                    <input id="password" class="form-control text-center" type="password" name="password" placeholder="Laissez vide si pas de changement"><br><br>
                    <button class="btn btn-primary" type="submit" name="submit">Modifier</button>
                </form>
                ',
                $userInfo['profilePicture'],
                $userInfo['nickname'],
                ucfirst($userInfo['rank']),
                $userInfo['email']
            );

            ?>
        </div>
    </div>

    <script src="dependencies/jquery/dist/jquery.min.js"></script>
    <script src="dependencies/popper.js/dist/popper.min.js"></script>
    <script src="dependencies/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
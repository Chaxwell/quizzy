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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Courgette|Kalam|Pacifico|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Mon profil</title>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="align-self-center">

        <div id="fondfirstpage" class="d-flex justify-content-center bg-info pt-5">

            <div class="container text-center">

                <?php
                $req = $bdd->prepare("SELECT * FROM users
                WHERE id = ?");
                $req->execute(array($_SESSION['userId']));
                $userInfo = $req->fetch();

                printf(
                    '
                <img class="profile-picture" src="uploads/%s" alt="Image de profil"><br>
                <br><br>
                <a href="editer-profil.php" class="btn btn-warning p-0 px-1 mt-1">Éditer</a><br><br>
                <span class="h3 slogan">%s</span><br><br>
                <span class="h4">%s</span><br>
                <i class="fas fa-star fa-160em icon-color-yellow"></i>
                <i class="far fa-star fa-160em icon-color-yellow"></i>
                <i class="far fa-star fa-160em icon-color-yellow"></i><br><br>
                <span class="h4">%s</span>
                ',
                    $userInfo['profilePicture'],
                    $userInfo['nickname'],
                    ucfirst($userInfo['rank']),
                    $userInfo['email']
                );

                ?>



            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- /*         <img height="20px" width="20px" style="background: red;">
        <img height="20px" width="20px">
        <img height="20px" width="20px"><br><br> -->




    <script src="dependencies/jquery/dist/jquery.min.js"></script>
    <script src="dependencies/popper.js/dist/popper.min.js"></script>
    <script src="dependencies/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
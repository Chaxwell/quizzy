<?php
include 'connexion-bdd.php';


/* if ($_SERVER['REQUEST_URI'] == '/includes/navbar.php') {
    header("Location: ../index.php");
    die();
} */
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="index.php">
        <img src="images/quizzyjustrondjaune.png" alt="obligatoire" width="50px" height="50px">
    </a>
    <a class="slogan navbar-brand" href="index.php">Quizzy it's crazy</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse bg-dark" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
            if (isset($_SESSION['userId'])) {
                printf(
                    '<li class="nav-item active">
                    <a class="nav-link" href="profil.php" class="nav-item">Mon profil</a>
                    </li>'
                );
                printf(
                    '<li class="nav-item">
                    <a class="nav-link" href="scores.php" class="nav-item">Mes scores</a>
                    </li>'
                );
                printf(
                    '<li class="nav-item">
                    <a href="deconnexion.php" class="nav-link">Déconnexion</a>
                    </li>'
                );
            } else {
                printf(
                    '<li class="nav-item">
                    <a href="connexion.php" class="nav-link">Connexion</a>
                    </li>'
                );
            }
            ?>
        </ul>
    </div>
</nav>
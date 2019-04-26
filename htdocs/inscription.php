<?php
session_start();
include 'includes/connexion-bdd.php';

if (isset($_SESSION['userId'])) {
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

    <link rel="stylesheet" href="css/style.css">
    <title>S'inscrire</title>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>
    <!--   //carre bleue de fond avec carre transparent// -->
    <div class="align-self-center">
        <div id="fondfirstpage" class="d-flex justify-content-center bg-info pt-5">
            <div class="container">
                <div class="formulaire-inscription-cadre">


                    <div class="container">
                        <form method="POST" action="traitements/traitement-inscription.php" autocomplete="off" oninput="passwordConfirmation.setCustomValidity(passwordConfirmation.value != password.value ? 'Mots de passe différents.' : '')">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <?php // ERRHANDLE: Gère (presque) toutes les combinaisons d'erreurs possibles
                                // S'il manque un des champs comportant la mention 'email'
                                if (isset($_GET['err'])) {
                                    if ($_GET['err'] == 'emailnicknamepassword' || $_GET['err'] == 'emailnickname' || $_GET['err'] == 'emailpassword' || $_GET['err'] == 'email') {
                                        printf('<input name="email" type="email" class="form-control" id="email" placeholder="Votre email">');
                                        printf('<small>Renseignez un email</small>');

                                        // Si le champ 'nickname' ou 'password' n'est pas mentionné on garde en mémoire l'email
                                    } elseif ($_GET['err'] == 'nicknamepassword' || $_GET['err'] == 'password' || $_GET['err'] == 'nickname') {
                                        if (isset($_GET['email'])) {
                                            printf(
                                                '<input name="email" type="email" class="form-control" id="email" value="%s">',
                                                htmlspecialchars($_GET['email'])
                                            );
                                        } else {
                                            printf('<input name="email" type="email" class="form-control" id="email" placeholder="Votre email">');
                                        }
                                    } elseif ($_GET['err'] == 'emailalreadytaken') { // TODO: Il manque la conservation en value si un pseudo est déjà rentré
                                        printf('<input name="email" type="email" class="form-control" id="email" placeholder="Votre email">');
                                        printf('<small>Email déjà utilisé</small>');
                                    } else {
                                        printf('<input name="email" type="email" class="form-control" id="email" placeholder="Votre email">');
                                    }
                                } else {
                                    printf('<input name="email" type="email" class="form-control" id="email" placeholder="Votre email">');
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="nickname">Pseudo</label>
                                <?php // ERRHANDLE: Gère toutes les combinaisons d'erreurs possibles
                                // S'il manque un des champs comportant la mention 'nickname'
                                if (isset($_GET['err'])) {
                                    if ($_GET['err'] == 'emailnicknamepassword' || $_GET['err'] == 'emailnickname' || $_GET['err'] == 'nicknamepassword' || $_GET['err'] == 'nickname') {
                                        printf('<input name="nickname" type="text" class="form-control" id="nickname" placeholder="Votre pseudo">');
                                        printf('<small>Renseignez un pseudo</small>');

                                        // Si le champ 'email' ou 'password' n'est pas mentionné on garde en mémoire le pseudo
                                    } elseif ($_GET['err'] == 'emailpassword' || $_GET['err'] == 'password' || $_GET['err'] == 'email') {
                                        if (isset($_GET['nickname'])) {
                                            printf(
                                                '<input name="nickname" type="nickname" class="form-control" id="nickname" value="%s">',
                                                htmlspecialchars($_GET['nickname'])
                                            );
                                        } else {
                                            printf('<input name="nickname" type="text" class="form-control" id="nickname" placeholder="Votre pseudo">');
                                        }
                                    } elseif ($_GET['err'] == 'nicknamealreadytaken') { // TODO: Il manque la conservation en value si un email est déjà rentré
                                        printf('<input name="nickname" type="text" class="form-control" id="nickname" placeholder="Votre pseudo">');
                                        printf('<small>Pseudo déjà utilisé</small>');
                                    } else {
                                        printf('<input name="nickname" type="text" class="form-control" id="nickname" placeholder="Votre pseudo">');
                                    }
                                } else {
                                    printf('<input name="nickname" type="text" class="form-control" id="nickname" placeholder="Votre pseudo">');
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="Votre mot de passe">
                                <?php // ERRHANDLE:
                                if (isset($_GET['err'])) {
                                    if ($_GET['err'] == 'emailnicknamepassword' || $_GET['err'] == 'emailpassword' || $_GET['err'] == 'nicknamepassword' || $_GET['err'] == 'password') {
                                        printf('<small>Renseignez un mot de passe</small>');
                                    }
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <input name="passwordConfirmation" type="password" class="form-control" id="passwordConfirmation" placeholder="Confirmation">
                                <?php // ERRHANDLE:
                                if (isset($_GET['err'])) {
                                    if ($_GET['err'] == 'passwordsnotequal') {
                                        printf('<small>Les mots de passe sont différents</small>');
                                    }
                                }
                                ?>
                            </div>
                            <!-- <div class="form-group form-check">
                <input name="cgu" type="checkbox" class="form-check-input" id="cgu">
                <label class="form-check-label" for="cgu">J'accepte les <a href="#">Conditions Générales d'Utilisation</a> <i>(non fonctionnel)</i></label>
            </div> -->
                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                        </form>
                    </div>
                </div>
                <script src="dependencies/jquery/dist/jquery.min.js"></script>
                <script src="dependencies/popper.js/dist/popper.min.js"></script>
                <script src="dependencies/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
                <script src="js/app.js"></script>
            </div>
        </div>
    </div>

</body>

</html>
<?php
session_start();
include '../includes/connexion-bdd.php';

if (isset($_SESSION['userId'])) { // Si l'utilisateur est connecté, message d'erreur.
    include '../includes/err-connected.php';
    die();
} else {
    // ERRHANDLE: Gestion des erreurs de formulaire
    if (empty($_POST['email']) && empty($_POST['nickname']) && empty($_POST['password'])) {
        header("Location: ../inscription.php?err=emailnicknamepassword");
        die();
    } elseif (empty($_POST['email']) && empty($_POST['nickname'])) {
        header("Location: ../inscription.php?err=emailnickname");
        die();
    } elseif (empty($_POST['email']) && empty($_POST['password'])) {
        header("Location: ../inscription.php?err=emailpassword&nickname=" . htmlspecialchars($_POST['nickname']));
        die();
    } elseif (empty($_POST['nickname']) && empty($_POST['password'])) {
        header("Location: ../inscription.php?err=nicknamepassword&email=" . htmlspecialchars($_POST['email']));
        die();
    } elseif (empty($_POST['email'])) {
        header("Location: ../inscription.php?err=email&nickname=" . htmlspecialchars($_POST['nickname']));
        die();
    } elseif (empty($_POST['nickname'])) {
        header("Location: ../inscription.php?err=nickname&email=" . htmlspecialchars($_POST['email']));
        die();
    } elseif (empty($_POST['password'])) {
        header("Location: ../inscription.php?err=password&email=" . htmlspecialchars($_POST['email']) . "&nickname=" . htmlspecialchars($_POST['nickname']));
        die();
    } elseif ($_POST['password'] != $_POST['passwordConfirmation']) {
        header("Location: ../inscription.php?err=passwordsnotequal");
        die();
    } else { // Pas d'erreur de formulaire
        $nickname = htmlspecialchars($_POST['nickname']);
        $password = htmlspecialchars($_POST['password']);
        $email = htmlspecialchars($_POST['email']);


        $req = $bdd->prepare("SELECT nickname FROM users
                              WHERE nickname = ?");
        $req->execute(array($nickname));
        $userInfoNickname = $req->fetch();

        $req = $bdd->prepare("SELECT email FROM users
                              WHERE email = ?");
        $req->execute(array($email));
        $userInfoEmail = $req->fetch();

        // ERRHANDLE:
        if ($userInfoNickname) { // Si le nickname existe
            header("Location: ../inscription.php?err=nicknamealreadytaken");
            die();
        }
        if ($userInfoEmail) { // Si l'email existe 
            header("Location: ../inscription.php?err=emailalreadytaken");
            die();
        }

        // Chiffrement
        $asciiLowercase = 'abcdefghijklmnopqrstuvwxyz';
        $asciiUppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $asciiNumbers = '0123456789';

        $seed = str_split(str_repeat($asciiLowercase, 10) . str_repeat($asciiUppercase, 10) . str_repeat($asciiNumbers, 10));
        shuffle($seed);
        $salt = '';
        // On génère un salt aléatoire de 64 caractères
        foreach (array_rand($seed, 64) as $n) $salt .= $seed[$n];
        $hashedPassword = hash('sha256', $password . $salt);


        // S'il n'y a pas de doublon de nickname ou d'email, on inscrit l'utilisateur dans la table
        $req = $bdd->prepare("INSERT INTO users(nickname, password, salt, email, profilePicture, rank, score)
                              VALUES(?, ?, ?, ?, ?, ?, ?)");
        $req->execute(array($nickname, $hashedPassword, $salt, $email, 'default.png', 'débutant', '0'));

        // Et on ouvre la session
        $req = $bdd->prepare("SELECT * FROM users
                              WHERE nickname = ?");
        $req->execute(array($nickname));
        $userInfo = $req->fetch();

        $_SESSION['userId'] = $userInfo['id'];
        $_SESSION['nickname'] = $userInfo['nickname'];

        header("Location: ../index.php");
        die();
    }
}

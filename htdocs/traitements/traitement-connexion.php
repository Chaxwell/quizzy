<?php
session_start();
include '../includes/connexion-bdd.php';

if (isset($_SESSION['userId'])) {
    include '../includes/err-connected.php';
    die();
} else {
    if (isset($_POST['nickname']) && isset($_POST['password'])) {
        $nickname = htmlspecialchars($_POST['nickname']);
        $password = htmlspecialchars($_POST['password']);
        $stayConnected = htmlspecialchars($_POST['stayConnected']);


        $req = $bdd->prepare("SELECT * FROM users
                 WHERE nickname = ?");
        $req->execute(array($nickname));
        $userInfo = $req->fetch();

        if (!$userInfo) { // ERRHANDLE: Si l'utilisateur n'existe pas
            header("Location: ../connexion.php?err=login");
            die();
            // Si le mot de passe est correct on crée la session
        } elseif (hash('sha256', $password . $userInfo['salt']) == $userInfo['password']) {
            $_SESSION['userId'] = $userInfo['id'];
            $_SESSION['nickname'] = $userInfo['nickname'];
            if ($stayConnected) {
                setcookie('nickname', $nickname, time() + 31536000, '/');
            }
        } else { // ERRHANDLE: L'utilisateur a rentré un mauvais mdp
            header("Location: ../connexion.php?err=login");
            die();
        }

        header("Location: ../index.php");
        die();
    } else {
        header("Location: ../index.php");
        die();
    }
}

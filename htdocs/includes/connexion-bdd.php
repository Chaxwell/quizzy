<?php

if ($_SERVER['REQUEST_URI'] == '/includes/connexion-bdd.php') {
    header("Location: ../index.php");
    die();
}

try {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=quizzy;charset=utf8', 'root', 'AzertyuioP123');
    $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $err) {
    die('Error : ' . $err->getMessage());
}

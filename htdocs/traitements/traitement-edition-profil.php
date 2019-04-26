<?php
session_start();

include '../includes/connexion-bdd.php';

if (empty($_SESSION['userId'])) {
    header("Location: ../index.php");
    die();
}

if (empty($_POST)) {
    header("Location: ../index.php");
    die();
}

if (!empty($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
}

if (isset($_POST['password'])) {
    $password = htmlspecialchars($_POST['password']);
}

if (!empty($_FILES['fileToUpload']["name"])) {
    // Si une image est envoyée, on l'enregistre
    $target_dir = "../uploads/";
    $filenameWithExtension = str_replace(' ', '', $_SESSION['nickname']) . '.' . strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . basename($filenameWithExtension);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check === false) {
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        unlink($target_file);
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 3000000) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        header("Location: ../editer-profil.php?err=fileerror");
        die();
        // if everything is ok, try to upload file
    } else {
        if (empty($_POST['password'])) {
            $req = $bdd->prepare("SELECT email FROM users
                              WHERE email = ?
                              AND id != ?");
            $req->execute(array($email, $_SESSION['userId']));
            $userInfoEmail = $req->fetch();

            // ERRHANDLE:
            if ($userInfoEmail) { // Si l'email existe 
                header("Location: ../index.php");
                die();
            }

            $req = $bdd->prepare("UPDATE users
                      SET profilePicture = ?, email = ?
                      WHERE id = ?");

            $req->execute(
                array(
                    $filenameWithExtension,
                    $email,
                    $_SESSION['userId']
                )
            );
        } else {
            $req = $bdd->prepare("SELECT email FROM users
                              WHERE email = ?
                              AND id != ?");
            $req->execute(array($email, $_SESSION['userId']));
            $userInfoEmail = $req->fetch();

            // ERRHANDLE:
            if ($userInfoEmail) { // Si l'email existe 
                header("Location: ../index.php");
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

            $req = $bdd->prepare("UPDATE users
                      SET profilePicture = ?, email = ?, password = ?, salt = ?
                      WHERE id = ?");
            $req->execute(
                array(
                    $filenameWithExtension,
                    $email,
                    $hashedPassword,
                    $salt,
                    $_SESSION['userId']
                )
            );
        }
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { // FIXME: Ne pas upload de fichier avant de mettre dans la bdd et inversement
            header("Location: ../profil.php");
            die();
        }
    }
} else { // pas d'image envoyée
    if (empty($_POST['password'])) {
        $req = $bdd->prepare("SELECT email FROM users
                              WHERE email = ?
                              AND id != ?");
        $req->execute(array($email, $_SESSION['userId']));
        $userInfoEmail = $req->fetch();

        // ERRHANDLE:
        if ($userInfoEmail) { // Si l'email existe 
            header("Location: ../index.php");
            die();
        }

        $req = $bdd->prepare("UPDATE users
                      SET email = ?
                      WHERE id = ?");

        $req->execute(
            array(
                $email,
                $_SESSION['userId']
            )
        );

        header("Location: ../profil.php");
        die();
    } else {
        $req = $bdd->prepare("SELECT email FROM users
                              WHERE email = ?
                              AND id != ?");
        $req->execute(array($email, $_SESSION['userId']));
        $userInfoEmail = $req->fetch();

        // ERRHANDLE:
        if ($userInfoEmail) { // Si l'email existe 
            header("Location: ../index.php");
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

        $req = $bdd->prepare("UPDATE users
                      SET email = ?, password = ?, salt = ?
                      WHERE id = ?");

        $req->execute(
            array(
                $email,
                $hashedPassword,
                $salt,
                $_SESSION['userId']
            )
        );

        header("Location: ../profil.php");
        die();
    }
}

<?php

if ($_SERVER['REQUEST_URI'] == 'graphHighest.php') { // FIXME: Ne marche pas pour une quelconque raison
    header("Location: index.php");
    die();
}

if (empty($_GET['score']) || empty($_GET['size'])) {
    $_GET['score'] = 0;
    $_GET['size'] = 10;
}

$score = htmlspecialchars($_GET['score']);
$size = htmlspecialchars($_GET['size']);



header("Content-type: image/png");
$highestScore = imagecreate(144, 250); // Highest score
imagesavealpha($highestScore, true);

$mainColor = imagecolorallocatealpha($highestScore, 0, 0, 0, 127); // On met une couleur transparente
imagefill($highestScore, 0, 0, $mainColor); // On remplit l'image de transparence
$barColor = imagecolorallocate($highestScore, 255, 110, 0); // couleur de la barre
$textColor = imagecolorallocate($highestScore, 255, 0, 0); // couleur du texte
imagestring($highestScore, 2, 25, 0, "> High Score", $textColor); // texte
imagestring($highestScore, 4, 25, 17, ">> " . $score, $textColor); // texte

imagesetthickness($highestScore, 40); // On set la thickness de la barre
imageline($highestScore, 0, 0, 0, $size, $barColor); // On dessine la barre

imagepng($highestScore); // on affiche à l'écran



imagecolordeallocate($highestScore, $textColor);
imagecolordeallocate($highestScore, $mainColor);
imagecolordeallocate($highestScore, $barColor);
imagedestroy($highestScore);

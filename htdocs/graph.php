<?php

if ($_SERVER['REQUEST_URI'] == 'graph.php') { // FIXME: Ne marche pas pour une quelconque raison
    header("Location: index.php");
    die();
}

if (empty($_GET['score']) || empty($_GET['size']) || empty($_GET['ratio'])) {
    $_GET['score'] = 0;
    $_GET['size'] = 10;
    $_GET['ratio'] = 0;
}
$score = intval(htmlspecialchars($_GET['score']), 10);
$size = intval(htmlspecialchars($_GET['size']), 10);
$ratio = intval(htmlspecialchars($_GET['ratio']), 10);

$minStrA = 0;
$maxStrA = 220;

if ($ratio == 1) {
    $strA = $minStrA;
    $strB = $strA + 17;
} else if ($size <= 30) {
    $strA = $maxStrA;
    $strB = $strA + 17;
} else {
    $strA = 250 - $size;
    $strB = $strA + 17;
}

header("Content-type: image/png");
$userScore = imagecreate(144, 250);
imagesavealpha($userScore, true);

$mainColor = imagecolorallocatealpha($userScore, 0, 0, 0, 127); // On met une couleur transparente
imagefill($userScore, 0, 0, $mainColor); // On remplit l'image de transparence
$barColor = imagecolorallocate($userScore, 0, 96, 128); // couleur de la barre
$textColor = imagecolorallocate($userScore, 0, 96, 128); // couleur du texte

imagestring($userScore, 2, 25, $strA, "> Votre Score", $textColor); // texte min(3), max(220), h(11) dif(9)
imagestring($userScore, 4, 25, $strB, ">> " . $score, $textColor); // texte min(20), max(237), h(13) tot(33)

imagesetthickness($userScore, 40); // On set la thickness de la barre
imageline($userScore, 0, 250 - $size, 0, 250, $barColor); // On dessine la barre y2 - y1 = size

imagepng($userScore); // on affiche à l'écran



imagecolordeallocate($userScore, $textColor);
imagecolordeallocate($userScore, $mainColor);
imagecolordeallocate($userScore, $barColor);
imagedestroy($userScore);

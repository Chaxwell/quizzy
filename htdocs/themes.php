<?php
session_start();

if (isset($_COOKIE['lastpage'])) {
    $_COOKIE['lastpage'] = "themes.php";
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
    <title>Thèmes</title>
</head>

<body class="bg-info">
    <?php include 'includes/navbar.php'; ?>



    <div class="align-self-center">
        <!--bloc de fond bleu-->
        <div id="fondfirstpage" class="bg-info pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-4-sm">
                        <a href="theme-choisi.php?theme=cuisine">
                            <span class="fa-stack fa-3x" style="display: inline-block;">
                                <i class="fa fa-square fa-stack-1x fa-160em icon-color-yellow"></i>
                                <i class="fa fa-carrot fa-stack-1x fa-inverse icon-color-orange"></i>
                                <span class="nomtheme text-center">Cuisine</span>
                            </span>
                        </a>
                    </div>

                    <div class="col-4-sm">
                        <a href="theme-choisi-geo.php?theme=cuisine">
                            <span class="fa-stack fa-3x" style="display: inline-block;">
                                <i class="fa fa-square fa-stack-1x fa-160em icon-bgcolor-lightblue"></i>
                                <i class="fa fa-globe-africa fa-stack-1x fa-inverse icon-color-orange"></i>
                                <span class="nomtheme text-center">Géo</span>
                            </span>
                        </a>
                    </div>

                    <div class="col-4-sm">
                        <a href="theme-choisi-sport.php?theme=cuisine">
                            <span class="fa-stack fa-3x" style="display: inline-block;">
                                <i class="fa fa-square fa-stack-1x fa-160em icon-color-yellow"></i>
                                <i class="fa fa-basketball-ball fa-stack-1x fa-inverse icon-color-orange"></i>
                                <span class="nomtheme text-center">Sports</span>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-4-sm">
                        <a href="theme-choisi.php?theme=cuisine">
                            <span class="fa-stack fa-3x">
                                <i class="fa fa-square fa-stack-1x fa-160em icon-bgcolor-lightblue"></i>
                                <i class="fa fa-book fa-stack-1x fa-inverse icon-color-orange"></i>
                                <span class="nomtheme text-center">Histoire</span>
                            </span>
                        </a>
                    </div>
                    <div class="col-4-sm">
                        <a href="theme-choisi.php?theme=cuisine">
                            <span class="fa-stack fa-3x">
                                <i class="fa fa-square fa-stack-1x fa-160em icon-color-yellow"></i>
                                <i class="fa fa-smile-wink fa-stack-1x fa-inverse icon-color-orange"></i>
                                <span class="nomtheme text-center">Blague</span>
                            </span>
                        </a>
                    </div>
                    <div class="col-4-sm">
                        <a href="theme-choisi.php?theme=cuisine">
                            <span class="fa-stack fa-3x">
                                <i class="fa fa-square fa-stack-1x fa-160em icon-bgcolor-lightblue"></i>
                                <i class="fa fa-palette fa-stack-1x fa-inverse icon-color-orange"></i>
                                <span class="nomtheme text-center">Arts</span>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-4-sm">
                        <a href="theme-choisi.php?theme=cuisine">
                            <span class="fa-stack fa-3x">
                                <i class="fa fa-square fa-stack-1x fa-160em icon-color-yellow"></i>
                                <i class="fa fa-music fa-stack-1x fa-inverse icon-color-orange"></i>
                                <span class="nomtheme text-center">Musique</span>
                            </span>
                        </a>
                    </div>
                    <div class="col-4-sm">
                        <a href="theme-choisi.php?theme=cuisine">
                            <span class="fa-stack fa-3x">
                                <i class="fa fa-square fa-stack-1x fa-160em icon-bgcolor-lightblue"></i>
                                <i class="fa fa-brain fa-stack-1x fa-inverse icon-color-orange"></i>
                                <span class="nomtheme text-center">Sciences</span>
                            </span>
                        </a>
                    </div>
                    <div class="col-4-sm">
                        <a href="theme-choisi.php?theme=cuisine">
                            <span class="fa-stack fa-3x">
                                <i class="fa fa-square fa-stack-1x fa-160em icon-color-yellow"></i>
                                <i class="fa fa-film fa-stack-1x fa-inverse icon-color-orange"></i>
                                <span class="nomtheme text-center">Cinéma</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script src="dependencies/jquery/dist/jquery.min.js"></script>
        <script src="dependencies/popper.js/dist/popper.min.js"></script>
        <script src="dependencies/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
        <script src="js/app.js"></script>
</body>

</html>
<script src="dependencies/jquery/dist/jquery.min.js"></script>
<script src="dependencies/popper.js/dist/popper.min.js"></script>
<script src="dependencies/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
</body>

</html>
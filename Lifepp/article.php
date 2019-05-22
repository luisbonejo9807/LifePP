<?php
    require "php/gui.php";
    session_start();
    $GUI = new GUI();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title id="tI">Artículo</title>
    <link rel="icon" href="img/favicon.ico">
    <!-- Hoja de estilos del framework Materialize -->
    <link rel="stylesheet" href="materialize/css/materialize.min.css">
    <!-- Material Icons -->
    <link rel="stylesheet" href="materialize/css/icons.css">
</head>
<style>
    #tit {
        text-shadow: 5px 5px 10px #000;
    }

    body {
        background-image: url("img/world.png");
        background-repeat: no-repeat;
        background-size: cover;
    }

    .bs1 {
        box-shadow: 0 0 10vw #000;
    }

    @media screen and (min-width:720px) {
        .responsive-img {
            height: 5vh;
            width: 3vw;
        }

        .card-image {
            max-height: 40vh;
            overflow: hidden;
        }

        .card-content p {
            padding: 1.5vh;
            padding-right: 5vw;
            padding-left: 5vw;
        }

        .card {
            margin-top: 5vw;
        }
    }

    @media screen and (max-width:720px) {
        .card-content {
            margin-top: 5vh;
        }
    }
</style>

<body id="bod" class="grey darken-3">

    <!-- BARRA DE NAVEGACIÓN -->
    <?php $GUI->nav(); ?>

    <!-- BARRA LATERAL -->
    <?php $GUI->asideNav(); ?>

    <!-- TARJETA DE CONTENIDO -->
    <?php 
        @$id = $_REQUEST['q'];
        $GUI->articulo($id);
    ?>

    <!-- CAJA DE COMENTARIOS -->
    <?php                     
        $GUI->comentarios($id);
        $GUI->newComment($id);
    ?>        

    </div>
    </li>
    </ul>
    <!-- FIN CAJA DE COMENTARIOS -->
    </div>
    </div>

    <!-- FOOTER -->
    <?php $GUI->footer(); ?> 


    <!-- JavaScript de jQuery -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- JavaScript del framework Materialize -->
    <script src="materialize/js/materialize.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/comments.js"></script>
</body>

</html>
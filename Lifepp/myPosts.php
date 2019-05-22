<?php
    require "php/gui.php";
    session_start();
    $GUI = new GUI();
    if(!isset($_SESSION['id'])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mis publicaciones - Life++</title>
    <link rel="icon" href="img/favicon.ico">
    <!-- Hoja de estilos del framework Materialize -->
    <link rel="stylesheet" href="materialize/css/materialize.min.css">
    <!-- Material Icons -->
    <link rel="stylesheet" href="materialize/css/icons.css">
</head>

<body class="grey darken-3">

    <!-- BARRA DE NAVEGACIÓN -->
    <?php $GUI->nav(); ?>

    <!-- BARRA LATERAL -->
    <?php $GUI->asideNav(); ?>   

    <div class="container">
        <div class="col s12 m7">
            <!-- Tarjeta 1-->
            <?php $GUI->myPost($_SESSION['id']); ?>
        </div>
    </div> 

    <!-- FOOTER -->
    <?php $GUI->footer(); ?>  


    <!-- JavaScript de jQuery -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- JavaScript del framework Materialize -->
    <script src="materialize/js/materialize.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
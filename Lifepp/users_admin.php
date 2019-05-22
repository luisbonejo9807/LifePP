<?php
    require "php/gui.php";
    session_start();
    if($_SESSION['rol'] != "Admin"){
      header("Location: index.php");
    }//fin else
    $GUI = new GUI();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrar usuarios - Life++</title>
    <link rel="icon" href="img/favicon.ico">
    <!-- Hoja de estilos del framework Materialize -->
    <link rel="stylesheet" href="materialize/css/materialize.min.css">
    <!-- Material Icons -->
    <link rel="stylesheet" href="materialize/css/icons.css">
    <style>
        #co{
            margin: 5vh auto;
            padding: 5vh;
        }
        @media screen and (min-width:480px) {
            #cont {
                width: 80vw;
                margin: 5vh auto;
            }
        }

        @media screen and (max-width:720px) {
            #cont {
                width: 90vw;
                margin: 5vh auto;
            }
        }
        @media screen and (max-width:480px) {
            #cont {
                width: 100vw;
                margin: 5vh auto;
            }
        }
    </style>
</head>

<body class="grey darken-3">

    <!-- BARRA DE NAVEGACIÓN -->
    <?php $GUI->nav(); ?>

    <!-- BARRA LATERAL -->
    <?php $GUI->asideNav(); ?>

    <!-- TARJETA DE CONTENIDO -->
    <div id="cont" class="col s12 m7">
        <div class="card">
            <div id="ajax"></div>
        </div>

    </div>


    <div id="co" class="white container center">
        <div  class="container">
            <?php
                isset($_GET['e']) ? $err=$_GET['e'] : $err="";                    
                if($err==='f'){
                    echo '<div class="row center red white-text">
                            <p><b>¡Error!</b> No puede haber campos vacíos</p>
                        </div>';                            
                }
                ?>
            <h4>Nuevo usuario</h4>
            <form action="php/newUser.php" method="POST" class="col s12" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-field col s12">
                        <input class="validate" id="new_username" name="new_username" type="text" required>
                        <label for="new_username">Nombre de usuario</label>
                    </div>
                </div>
                <div class="row">
                        <div class="input-field col s12">
                            <input class="validate" id="new_pass" name="new_pass" type="password" required>
                            <label for="new_pass">Contraseña</label>
                        </div>
                    </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="new_nombre" name="new_nombre" type="text" class="validate" required>
                        <label for="new_nombre">Nombre</label>
                    </div>
                </div>
                <div class="row">
                        <div class="input-field col s12">
                            <input id="new_apellido" name="new_apellido" type="text" class="validate" required>
                            <label for="new_apellido">Apellidos</label>
                        </div>
                    </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select id="new_rol" name="new_rol" class="browser-default" required>                            
                            <option value="Admin" selected>Administrador</option>
                            <option value="Edit">Editor de contenido</option>                            
                        </select>                        
                    </div>
                </div>
                <button id="new_us" class="btn waves-effect waves-light" type="submit" name="action">
                    Crear
                </button>
            </form>
        </div>
    </div>

    <!-- FOOTER -->
    <?php $GUI->footer(); ?>


    <!-- JavaScript de jQuery -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- JavaScript del framework Materialize -->
    <script src="materialize/js/materialize.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/users.js"></script>
</body>

</html>
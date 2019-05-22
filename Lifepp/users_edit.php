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
    <title>Editar usuario - Life++</title>
    <link rel="icon" href="img/favicon.ico">
    <!-- Hoja de estilos del framework Materialize -->
    <link rel="stylesheet" href="materialize/css/materialize.min.css">
    <!-- Material Icons -->
    <link rel="stylesheet" href="materialize/css/icons.css">
    <style>
        #co {
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
        <div class="container">
            <?php
                isset($_GET['e']) ? $err=$_GET['e'] : $err="";                    
                if($err==='f'){
                    echo '<div class="row center red white-text">
                            <p><b>¡Error!</b> No puede haber campos vacíos</p>
                        </div>';                            
                }
                require "php/database.php"; 
                $BD = new DB();
                $BD->connect();
                mysqli_set_charset($BD->connect,"utf8");
                $iden = $_REQUEST['q'];
                foreach ($BD->selquery("SELECT * FROM usuarios WHERE id_usuario =".$iden) as $row):                                    
            ?>
            <h4>Editar usuario</h4>
            <form action="php/editUser.php?q=<?php echo $iden?>" method="POST" class="col s12" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-field col s12">
                        <input class="validate" id="edit_username" name="edit_username" type="text" value="<?php echo $row['username']; ?>" required>
                        <label for="edit_username">Nombre de usuario</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input class="validate" id="edit_pass" name="edit_pass" type="password">
                        <label for="edit_pass">Contraseña</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="edit_nombre" name="edit_nombre" type="text" class="validate" value="<?php echo $row['nombre']; ?>" required>
                        <label for="edit_nombre">Nombre</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="edit_apellido" name="edit_apellido" type="text" class="validate" value="<?php echo $row['apellidos']; ?>" required>
                        <label for="edit_apellido">Apellidos</label>
                    </div>
                </div>
                <div class="file-field input-field col s12">
                    <div class="btn red accent-3">
                        <span>Foto de perfil</span>
                        <input type="file" name="edit_foto" accept=".jpg,.png">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select id="edit_rol" name="edit_rol" class="browser-default" required>                            
                            <option value="Admin" <?php if ($row['rol']=='Admin') {
                                echo "selected";
                            }?>>Administrador</option>
                            <option value="Edit" <?php if ($row['rol']=='Edit') {
                                echo "selected";
                            }?>>Editor de contenido</option>
                        </select>
                    </div>
                </div>
                <?php endforeach;?>
                <button id="edit_us" class="btn waves-effect waves-light" type="submit" name="action">
                    Actualizar
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
</body>

</html>
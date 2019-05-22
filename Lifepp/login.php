<?php
    session_start();
    if (isset($_SESSION['nombre'])){
      header("Location: index.php");
    }//fin if
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión - Life++</title>
    <link rel="icon" href="img/favicon.ico">
    <!-- Hoja de estilos del framework Materialize -->
    <link rel="stylesheet" href="materialize/css/materialize.min.css">
    <!-- Material Icons -->
    <link rel="stylesheet" href="materialize/css/icons.css">
    <!-- CSS para esta página -->
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="red">



    <div class="col s12 m7">
        <div class="card horizontal log-card">
            <div class="card-stacked">
                <div class="card-content">
                    <?php
                    isset($_GET['e']) ? $err=$_GET['e'] : $err="";                    
                        if($err==='f'){
                        echo '<div class="">
                                <p><b>¡Error!</b> Datos de autenticación incorrectos</p>
                            </div>';                            
                        }           
                    ?>
                    <div class="input-field col m6">
                        <img class="login-img" src="img/lppRed.png" alt="">
                    </div>
                    <form class="container" action="php/log-auth.php" method="POST">
                        <div class="input-field col m6">
                            <h5>Iniciar sesión</h5>
                        </div>
                        <div class="input-field col m6">
                            <input id="user" type="text" class="validate" name="userF" autofocus>
                            <label for="user">Usuario</label>
                        </div>
                        <div class="input-field col m6">
                            <input id="password" type="password" class="validate" name="passF">
                            <label for="password">Contraseña</label>
                        </div>
                        <div class="input-field col m6">
                            <button class="btn waves-effect waves-light red" type="submit" name="action">
                                Ingresar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Fin de la TARJETA DE INICIO DE SESIÓN -->
    <!-- JavaScript de jQuery -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- JavaScript del framework Materialize -->
    <script src="materialize/js/materialize.min.js"></script>
    <!-- JS persnalizado -->
    <script src="js/main.js"></script>
</body>

</html>
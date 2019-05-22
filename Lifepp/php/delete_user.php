<?php
    require 'database.php';
    $BD = new DB();
    $BD->connect();
    mysqli_set_charset($BD->connect,"utf8");

    session_start();
if($_SESSION['nombre'] == NULL){
  header("Location: ../index.php");
}else{
  $id=$_REQUEST['q'];
  $BD->insquery("DELETE FROM autores WHERE id_pers=$id");
  $BD->insquery("UPDATE comentarios SET id_pers=NULL WHERE id_pers=$id");
  $BD->insquery("DELETE FROM usuarios WHERE id_usuario=$id");
  header("Location: ../users_admin.php");
}//fin else
?>
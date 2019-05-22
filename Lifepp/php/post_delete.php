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
  $BD->insquery("DELETE FROM autores WHERE id_post=$id");
  $BD->insquery("DELETE FROM comentarios WHERE id_post=$id");
  $BD->insquery("DELETE FROM posts WHERE id=$id");
  echo "success";
  header('Location: ../index.php');
}//fin else
?>
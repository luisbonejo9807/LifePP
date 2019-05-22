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
  $post=$_REQUEST['p'];
  $BD->insquery("DELETE FROM comentarios WHERE id_com=$id");
  echo "success";
  header('Location: ../article.php?q='.$post);
}//fin else
?>
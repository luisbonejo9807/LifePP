<?php
header("Content-Type: text/html;charset=utf-8");
require 'database.php';
$BD = new DB();
$BD->connect();
mysqli_set_charset($BD->connect,"utf8");

$uservar = utf8_decode($_POST['userF']);
$passvar = utf8_decode($_POST['passF']);
if(empty($uservar) || empty($passvar)){
header("Location: index.php");
exit();
}//fin if
$user=$uservar;
$pass=hash('sha256', $passvar);

foreach ($BD->selquery("SELECT * FROM usuarios
WHERE username = '$user' AND password = '$pass' ") as $row) {
  session_start();
  if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = $row['id_usuario'];
    }//fin if
  if (!isset($_SESSION['nombre'])) {
  $_SESSION['nombre'] = $row['nombre'];
  }//fin if
  if (!isset($_SESSION['rol'])) {
  $_SESSION['rol'] = $row['rol'];
  }//fin if
  if (!isset($_SESSION['img'])) {
    $_SESSION['img'] = $row['profImg'];
  }//fin if
  header("Location: ../index.php");
  exit();
}
header("Location: ../login.php?e=f");
 ?>

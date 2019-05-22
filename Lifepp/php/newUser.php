<?php
    session_start();
    require 'database.php';
    $BD = new DB();
    $BD->connect();
    mysqli_set_charset($BD->connect,"utf8");

    $user=$_POST['new_username'];
    $nombre=$_POST['new_nombre'];
    $apellido=$_POST['new_apellido'];
    $rol=$_POST['new_rol'];
    $pass=$_POST['new_pass'];
    $pass=hash('sha256', $pass);;

    if($user=="" || $nombre=="" || $apellido=="" || $rol==""){
        header("Location: ../users_admin.php?e=f");
    }else{        
        $BD->insquery("INSERT INTO usuarios (username,password,nombre,apellidos,rol) 
        VALUES ('$user','$pass','$nombre','$apellido','$rol')");
        // header("Location: ../users_admin.php");
    }
?>
<?php
    session_start();
    require 'database.php';
    $BD = new DB();
    $BD->connect();
    mysqli_set_charset($BD->connect,"utf8");

    $user=$_POST['edit_username'];
    $pass=$_POST['edit_pass'];
    $nombre=$_POST['edit_nombre'];
    $apellido=$_POST['edit_apellido'];
    $rol=$_POST['edit_rol'];
    $img=$_FILES['edit_foto']['name'];
    
    $pID=$_REQUEST['q'];

    if($user=="" || $nombre=="" || $apellido=="" || $rol==""){
        header("Location: ../users_edit.php?q=".$pID."&e=f");
    }else if($img==""){         
        updtPass();    
        $BD->insquery("UPDATE usuarios SET username ='$user', nombre='$nombre' , apellidos='$apellido', rol='$rol' WHERE id_usuario='$pID'");
        if($rol!=$_SESSION['rol']){
            $_SESSION['rol']=$rol;
        }
        header("Location: ../users_admin.php");
    }else{
        echo "completo";
        updtPass();
        $directorio = '../users-profile-pic/';
        $arch = $directorio . basename($_FILES['edit_foto']['name']);        

        if (move_uploaded_file($_FILES['edit_foto']['tmp_name'], $arch)) {
            echo "Archivo subido.\n";
            $BD->insquery("UPDATE usuarios SET username ='$user', nombre='$nombre' , apellidos='$apellido', rol='$rol' , profImg='$img' WHERE id_usuario='$pID'");
            echo "Registrado";
            header("Location: ../users_admin.php");
        } else {
            echo "Ha ocurrido un error al intentar subir el archivo";
        }
    }

    function updtPass(){
        $pass=$_POST['edit_pass']; 
        $pID=$_REQUEST['q'];       
        if($pass!=""){
            $BD1 = new DB();
            $BD1->connect();
            mysqli_set_charset($BD1->connect,"utf8");            
            $pass=hash('sha256', $pass);            
            $BD1->insquery("UPDATE usuarios SET password ='$pass' WHERE id_usuario='$pID'");
        }        
    }
        
        
    
?>
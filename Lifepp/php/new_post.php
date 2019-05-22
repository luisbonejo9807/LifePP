<?php
    session_start();
    require 'database.php';
    $BD = new DB();
    $BD->connect();
    mysqli_set_charset($BD->connect,"utf8");

    $titulo=$_POST['new_titulo'];    
    $img=$_FILES['archivo']['name'];
    $desc=$_POST['new_descripcion'];
    $texto=$_POST['new_texto'];

    if($titulo=="" || $img=="" || $desc=="" || $texto==""){
        header("Location: ../index.php?e=f");
    }else{
        $directorio = '../post-images/';
        $arch = $directorio . basename($_FILES['archivo']['name']);        

        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $arch)) {
            echo "Archivo subido.\n";
            $BD->insquery("INSERT INTO posts (titulo,descripcion,texto,imagen) VALUES ('$titulo','$desc','$texto','$img')");
            foreach ($BD->selquery("SELECT id FROM posts ORDER BY id DESC LIMIT 1") as $row){
                echo $row['id'];
                $BD->insquery("INSERT INTO autores (id_post,id_pers) VALUES (".$row['id'].",".$_SESSION['id'].")");
            }
            echo "Registrado";
            header("Location: ../index.php");
        } else {
            echo "Ha ocurrido un error al intentar subir el archivo";
        }
    }
        
        
    
?>
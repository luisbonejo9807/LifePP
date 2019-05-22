<?php
    session_start();
    require 'database.php';
    $BD = new DB();
    $BD->connect();
    mysqli_set_charset($BD->connect,"utf8");

    $titulo=$_POST['edit_titulo'];    
    $img=$_FILES['edit_archivo']['name'];
    $desc=$_POST['edit_desc'];
    $texto=$_POST['edit_text'];
    $pID=$_REQUEST['q'];

    if($titulo=="" || $desc=="" || $texto==""){
        header("Location: ../post_edit.php?q=".$pID."&e=f");
    }else if($img==""){
        echo "img vacia";
        $BD->insquery("UPDATE posts SET titulo ='$titulo', descripcion='$desc' , texto='$texto' WHERE id='$pID'");
        header("Location: ../article.php?q=$pID");
    }else{
        $directorio = '../post-images/';
        $arch = $directorio . basename($_FILES['edit_archivo']['name']);        

        if (move_uploaded_file($_FILES['edit_archivo']['tmp_name'], $arch)) {
            echo "Archivo subido.\n";
            $BD->insquery("UPDATE posts SET titulo ='$titulo', descripcion='$desc' , texto='$texto', imagen='$img' WHERE id='$pID'");            
            echo "Registrado";
            header("Location: ../article.php?q=$pID");
        } else {
            echo "Ha ocurrido un error al intentar subir el archivo";
        }
    }
        
        
    
?>
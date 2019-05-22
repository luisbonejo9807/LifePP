<?php
    session_start();
    require 'database.php';
    $BD = new DB();
    $BD->connect();
    mysqli_set_charset($BD->connect,"utf8");        
    $comm=$_POST['co'];
    if($comm==""){
        echo "valió madres";
        header("Location: ../index.php");
    }
    $post = $_REQUEST['q'];
    if(!isset($_SESSION['id'])){
        $BD->insquery("INSERT INTO comentarios (id_post,text_com) VALUES (".$post.","."'".$comm."'".")");
        echo "listo sin";
    }else{
        $persID=$_SESSION['id'];
        $BD->insquery("INSERT INTO comentarios (id_post,id_pers,text_com) VALUES (".$post.",".$persID.","."'".$comm."'".")");
        echo "listo con";
    }
    header("Location: ../article.php?q=".$post);
    

    
?>
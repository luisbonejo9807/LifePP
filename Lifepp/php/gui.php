<?php 
class GUI{

    function nav(){
        echo '<nav class="red">
        <div class="nav-wrapper">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <a href="index.php" class="brand-logo" data-target="slide-out">
                <i class="material-icons">favorite</i>
                <i class="material-icons">add</i>
                <i class="material-icons">add</i>
            </a>
        </div>
    </nav>';
    }//fin nav

    function asideNav(){
        echo '<ul id="slide-out" class="sidenav">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="img/cualtos.jpg">
                </div>
                <a><img class="circle" src="users-profile-pic/';
                echo isset($_SESSION['img']) ? $_SESSION['img'] : 'anonymus.png';
                echo '"></a>
                <a><span class="white-text name"><b>';
                echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Anónimo';
                echo '</b></span></a>
                <a><span class="white-text email">';
                if(isset($_SESSION['rol'])){                    
                    echo $_SESSION['rol']=='Admin' ? 'Administrador' : 'Editor de contenido';
                }        
        echo '</span></a>
            </div>
        </li>';        
        if(isset($_SESSION['rol']) && $_SESSION['rol']=='Admin'){
            echo '<li><a class="subheader">Usuarios</a></li>
            <li><a href="users_admin.php"><i class="material-icons">assignment_ind</i>Administrar cuentas</a></li>
            <li>
                <div class="divider"></div>
            </li>';
        }
        echo '<li><a class="subheader">Cuenta</a></li>';
        if(isset($_SESSION['rol'])){
            echo '<li><a href="myPosts.php"><i class="material-icons">accessibility</i>Mis publicaciones</a></li>
            <li><a href="php/logout.php"><i class="material-icons">exit_to_app</i>Cerrar sesión</a></li>';      
            
        }else{
            echo '<li><a href="php/../login.php"><i class="material-icons">vpn_key</i>Iniciar sesión</a></li>';
        }      
        echo '</ul>';
    }//fin asideNav

    function newBtn(){
        if(isset($_SESSION['rol'])){
        echo '<div class="fixed-action-btn tooltipped modal-trigger" data-position="left" data-tooltip="Crear nuevo post"
        data-target="modal1">
        <a class="btn-floating btn-large red">
            <i class="large material-icons">mode_edit</i>
        </a>
    </div>

    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Nuevo post</h4>
            <div class="row">
                <form action="php/new_post.php" method="POST" class="col s12"  enctype="multipart/form-data">
                    <div class="row modal-form-row">
                        <div class="input-field col s12">
                            <input class="validate" id="new_titulo" name="new_titulo" type="text" data-length="25" required>
                            <label for="new_titulo">Título</label>
                        </div>
                    </div>
                    <div class="file-field input-field col s12">
                        <div class="btn red accent-3">
                            <span>Imagen</span>
                            <input type="file" name="archivo" accept=".jpg,.png" required>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="new_descripcion" name="new_descripcion" type="text" class="validate" data-length="100" required>
                            <label for="new_descripcion">Descripción</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="new_texto" name="new_texto" type="text" class="materialize-textarea validate" required></textarea>
                            <label for="new_texto">Texto</label>
                        </div>
                    </div>
                    <button id="new_btn" class="btn waves-effect waves-light red" type="submit" name="action">
                        Publicar
                    </button>
                </form>
            </div>
        </div>
    </div>';
        }
    }

    function noticias(){
        require "database.php"; 
        $BD = new DB();
        $BD->connect();
        mysqli_set_charset($BD->connect,"utf8");   
        isset($_GET['e']) ? $err=$_GET['e'] : $err="";                    
                            if($err==='f'){
                                echo '<div class="row center orange white-text" style="padding: 1px;">
                                        <p><b>¡Error!</b> No puede haber campos vacíos</p>
                                    </div>';                            
                            }    
        foreach ($BD->selquery("SELECT * FROM posts ORDER BY id DESC") as $row){
            foreach ($BD->selquery("SELECT * FROM posts
            INNER JOIN autores ON id = id_post
            INNER JOIN usuarios ON id_usuario = id_pers
            WHERE id= ".$row['id']."") as $row1){
            $this->post($row['id'],$row['imagen'],$row['titulo'],$row['descripcion'],$row['fecha'],$row1['nombre'],$row1['profImg']);
            }        
        }                
    }//fin noticias

    function myPost($s_id){        
        require "database.php"; 
        $BD = new DB();
        $BD->connect();
        mysqli_set_charset($BD->connect,"utf8");   
        isset($_GET['e']) ? $err=$_GET['e'] : $err="";                    
                            if($err==='f'){
                                echo '<div class="row center orange white-text" style="padding: 1px;">
                                        <p><b>¡Error!</b> No puede haber campos vacíos</p>
                                    </div>';                            
                            }            
            foreach ($BD->selquery("SELECT * FROM posts
            INNER JOIN autores ON id = id_post
            INNER JOIN usuarios ON id_usuario = id_pers
            WHERE autores.id_pers= ".$s_id."") as $row){
            $this->post($row['id'],$row['imagen'],$row['titulo'],$row['descripcion'],$row['fecha'],$row['nombre'],$row['profImg']);
            }                        
    }//fin noticias

    function post($id,$img,$title,$desc,$fecha,$autor,$profImg){
        echo '<div class="card large">
        <a href="article.php?q='.$id.'">
            <div class="card-image">
                <img src="post-images/'.$img.'">
                <span class="card-title red darken-2">'.$title.'</span>
            </div>
        </a>
        <div class="card-content">
            <div class="row">
                <div class="chip">
                    <img src="users-profile-pic/'.$profImg.'" alt="Autor">'
                    .$autor.
                '</div>
                <span class="grey-text">'.$fecha.'</span>';                
                if(isset($_SESSION['rol'])){
                echo '<a href="php/post_delete.php?q='.$id.'" class="waves-effect waves-light btn right red accent-3"><i
                        class="material-icons left">delete</i>Eliminar</a>';
                }                
            echo '</div>
            <p>'.nl2br($desc).'</p>
        </div>
    </div>';
    }//fin post

    function articulo($iden){
        $band=0;
        require "database.php"; 
        $BD = new DB();
        $BD->connect();
        mysqli_set_charset($BD->connect,"utf8");       
        foreach ($BD->selquery("SELECT * FROM posts WHERE id =".$iden) as $row){
            echo '<div class="container bs1">
            <div class="col s12 m7">            
                <div class="card">
                    <div class="card-image">
                        <img class="materialboxed" src="post-images/'.$row['imagen'].'">                    
                    </div>
                    <div class="card-content">                   
                        <div class="row">
                            <div class="container">
                            <div class="chip">';
                            foreach ($BD->selquery("SELECT * FROM posts
                            INNER JOIN autores ON id = id_post
                            INNER JOIN usuarios ON id_usuario = id_pers
                            WHERE id= ".$iden."") as $row1){
                                echo '<img src="users-profile-pic/'.$row1['profImg'].'" alt="Autor">'.
                                $row1['nombre'];
                            }
                            echo '</div>
                            <span class="grey-text">'.$row['fecha'].'</span>';
                            if(isset($_SESSION['rol'])){
                            echo '<a href="php/post_delete.php?q='.$iden.'" class="waves-effect waves-light btn right red accent-3"><i
                                    class="material-icons left">delete</i>Eliminar</a>
                            <a href="post_edit.php?q='.$iden.'" class="waves-effect waves-light btn right red accent-2"><i
                                    class="material-icons left">mode_edit</i>Editar</a>';
                            }                                                  
                        echo '</div>
                    </div>
                        <h3 class="center">'.$row['titulo'].'</h3>                        

                        <p>'.nl2br($row['texto']).'</p>
                    </div>
                </div>';
                
                echo '<style>
                    body{
                        background-image: url("post-images/'.$row['imagen'].'");
                    }
                </style>';
                echo '<script>
                    document.getElementById("tI").innerHTML = "'.$row['titulo'].'";
                </script>';
                $band=1;
        }
        if($band==0){
            header("Location: index.php");
        }               
    }//fin articulo

    function comentarios($postID){        
        $BD1 = new DB();
        $BD1->connect();
        mysqli_set_charset($BD1->connect,"utf8");
        foreach ($BD1->selquery("SELECT COUNT(*) AS c FROM comentarios            
            WHERE id_post= ".$postID."") as $row0){
                echo '<ul class="collapsible">
                <li>
                    <div class="collapsible-header">
                        <i class="material-icons">comment</i>Comentarios ('.$row0['c'].')
                        <i class="material-icons left">keyboard_arrow_down</i>
                    </div>
                    <div class="collapsible-body white">';
        }//fin foreach
        foreach ($BD1->selquery("SELECT * FROM comentarios            
            WHERE id_post= ".$postID."") as $row){

        echo '<div class="row valign-wrapper test">
            <div class="col s2">
                <img src="users-profile-pic/';
                if(!$row['id_pers']){
                    $row['profImg']='anonymus.png';
                    $row['nombre']='Anónimo';
                }else{
                    foreach ($BD1->selquery("SELECT * FROM usuarios            
                    WHERE id_usuario= ".$row['id_pers']."") as $row3){
                        $row['profImg']=$row3['profImg'];
                        $row['nombre']=$row3['nombre'];
                        $row['rol']=$row3['rol'];                    
                    }//fin foreach
                }//fin else
                echo $row['profImg'];
                echo'" alt="" class="circle responsive-img">
            </div>
            <div class="col s10">';
            if(isset($_SESSION['rol'])){
                echo '<a class="grey-text right tooltipped" data-position="bottom" data-tooltip="Eliminar comentario"
                    href="php/comment_delete.php?q='.$row['id_com'].'&p='.$postID.'"><span class="material-icons">close</span></a>';
            }//fin if
                    echo '<blockquote>
                    '.nl2br($row['text_com']).'
                </blockquote>
                <span class="red-text text-accent-3">'.$row['nombre'].' -</span>';
                if(isset($row['rol'])){
                    echo '<span class="red-text text-accent-4"><b>';
                    if($row['rol']=='Admin'){
                        echo 'Administrador';
                    }else{
                        echo 'Editor de contenido';
                    }//fin else
                    echo '</b></span>';
                }//fin if                
                echo '<span class="grey-text"> '.$row['fecha_com'].'</span>
            </div>
        </div>';
            }//fin foreach
    }//fin comentarios

    function newComment($id){
       echo '<div class="row valign-wrapper test ">
        <div class="col s10 grey lighten-3">
            <form action="php/new_comment.php?q='.$id.'" method="POST">
                <div class="input-field col s10">
                    <input placeholder="Escribir un comentario" id="co" name="co" type="text" class="validate" required>
                    <label for="co">Escribir un comentario</label>
                </div>
                <div class="row input-field col s10">
                    <button id="new_btn" class="btn waves-effect waves-light red accent-3" type="submit" name="action">
                        Comentar
                    </button>
                </div>
            </form>
        </div>
    </div>';
    }

    function editaArticulo($iden){
        $band=0;
        require "database.php"; 
        $BD = new DB();
        $BD->connect();
        mysqli_set_charset($BD->connect,"utf8");
        foreach ($BD->selquery("SELECT * FROM posts WHERE id =".$iden) as $row){
            echo '<form action="php/editUpload.php?q='.$iden.'" method="POST" class="col s12"  enctype="multipart/form-data">
            <div class="container bs1">
            <div class="col s12 m7">            
                <div class="card">
                    <div class="card-image">
                        <img src="post-images/'.$row['imagen'].'">                    
                    </div>
                    <div class="card-content">                   
                        <div class="row">
                            <div class="container">';
                            isset($_GET['e']) ? $err=$_GET['e'] : $err="";                    
                            if($err==='f'){
                                echo '<div class="row center red white-text">
                                        <p><b>¡Error!</b> No puede haber campos vacíos</p>
                                    </div>';                            
                            }  
                            echo'<div class="chip">';
                            foreach ($BD->selquery("SELECT * FROM posts
                            INNER JOIN autores ON id = id_post
                            INNER JOIN usuarios ON id_usuario = id_pers
                            WHERE id= ".$iden."") as $row1){
                                echo '<img src="users-profile-pic/'.$row1['profImg'].'" alt="Autor">'.
                                $row1['nombre'];
                            }
                            echo '</div>
                            <span class="grey-text">'.$row['fecha'].'</span>';
                            if(isset($_SESSION['rol'])){
                            echo '<button id="new_btn" class="btn waves-effect waves-light orange right" type="submit" name="action">
                                    <span class="material-icons">done</span>Terminar edición
                                </button>';
                            }                                                  
                        echo '</div>
                    </div>
                        <div class="center">                            
                            <div class="container input-field col s12">
                                <input class="validate" id="edit_titulo" name="edit_titulo" type="text" data-length="25"
                                value="'.$row['titulo'].'">
                                <label for="new_titulo">Título</label>                            
                            </div>
                            <div class="container input-field col s12">
                                <input class="validate" id="edit_desc" name="edit_desc" type="text" data-length="100"
                                value="'.$row['descripcion'].'">
                                <label for="new_titulo">Descripción</label>                            
                            </div>                            
                            <div class="container file-field input-field col s12">
                                <div class="btn red accent-3">
                                    <span>Imagen</span>
                                    <input type="file" name="edit_archivo" accept=".jpg,.png">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                            <div class="container input-field col s12">
                                <textarea id="edit_text" name="edit_text" class="materialize-textarea">'.$row['texto'].'</textarea>                                
                                <label for="new_titulo">Texto</label>                            
                            </div>
                        </div>
                    </div>
                </div>
                </form>';
                
                echo '<style>
                    body{
                        background-image: url("post-images/'.$row['imagen'].'");
                    }
                </style>';
                echo '<script>
                    document.getElementById("tI").innerHTML = "Edición: '.$row['titulo'].'";
                </script>';
                $band=1;
        }
        if($band==0){
            header("Location: index.php");
        }               
    }//fin editaArticulo

    function footer(){
        echo '<footer class="page-footer red">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Life ++</h5>
                    <p class="grey-text text-lighten-4">
                        "No se trata de cambiar el mundo. Se trata de hacer nuestro mejor esfuerzo antes de partir de
                        éste mundo… tal y como es. Se trata de respetar la voluntad de los demás, y creer en la tuya".
                    </p>
                    <p>
                            -The Boss (Metal Gear Solid III)
                    </p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Desarrolladores:</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3">Luis Eduardo Flores Navarro</a></li>
                        <li><a class="grey-text text-lighten-3">Leonel Adonai Márquez Franco</a></li>
                        <li><a class="grey-text text-lighten-3">Daniela Vanessa García Muñoz</a></li>
                        <li><a class="grey-text text-lighten-3">Luis Velázquez Vázquez</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2019 Life++ Inc. Programación Para Internet 2019-A
                
            </div>
        </div>
    </footer>';
    }//fin footer

}//fin de la clase GUI
?>
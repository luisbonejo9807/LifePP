<?php
    require "database.php"; 
    $BD = new DB();
    $BD->connect();
    mysqli_set_charset($BD->connect,"utf8");
?>
<table id="tab" class=" striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Nombre de usuario</th>
            <th>Apellidos</th>
            <th>Rol</th>
            <th></th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php
        foreach ($BD->selquery("SELECT * FROM usuarios ORDER BY rol ASC") as $row) {
            echo 
        '<tr>
            <td>
                <div class="chip left">
                    <img src="users-profile-pic/'.$row['profImg'].'" alt="Foto de perfil">
                    '.$row['nombre'].'
            </div></td>
            <td>'.$row['username'].'</td>
            <td>'.$row['apellidos'].'</td>
            <td>'.$row['rol'].'</td>
            <td>
                <a href="users_edit.php?q='.$row['id_usuario'].'" class="material-icons orange-text">mode_edit</a>
            </td>
            <td>
                <a href="php/delete_user.php?q='.$row['id_usuario'].'" class="material-icons red-text">delete</a>
            </td>
        </tr>';
        }
    ?>
    </tbody>
</table>
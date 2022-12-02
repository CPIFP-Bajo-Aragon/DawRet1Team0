<?php
    require_once 'Base.php';
    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $email=$_POST['email'];
    $clave=$_POST['clave'];
    
    $hash = sha1($clave);

    //Conexión con la base de datos y actualización de los registros 
    $query="UPDATE USUARIO set idUser='$id', nombreUser='$nombre',email='$email',claveUser='$hash' where idUser = '$id'";
    $resultado=$connection->query($query);
    header('Location:mostrarUsuarios');
?>
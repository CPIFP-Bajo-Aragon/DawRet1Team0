
<?php

    session_start();
    
    if(!isset($_SESSION['login'])){
        header('Location: index.php');
        exit();
    } else {
        // Show users the page
    }  
    
    require_once 'Base.php';

    $nombre = $_POST['usuario'];
    $departamento = $_POST['selectDpto'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $rol = $_POST['rol'];

    echo $departamento;

    //DataBase connection
    $sql="select idDpto from DEPARTAMENTO where nombreDpto = '$departamento'";
    $resultado1=$connection->query($sql);
    if ($resultado1) {
        while ($row = $resultado1->fetch_assoc()) {
            $idDpto = $row['idDpto'];
        }
    }

    echo $idDpto;
    $sql="SELECT idRol from ROL where nombreRol='$rol'";
    $resultado1=$connection->query($sql);
    if ($resultado1) {
        while ($row = $resultado1->fetch_assoc()) {
            $idRol = $row['idRol'];
        }
    }

    //To Encrypt:
    $hash = sha1($clave);

    $query="INSERT into USUARIO (nombreUser, claveUser, idDpto, email, rol) values ('$nombre','$hash','$idDpto','$email','$idRol')";
    $resultado=$connection->query($query);
    if($resultado){
        header("Location: URL");
    }

    if($resultado){
        echo '<script type="text/javascript">alert("Usuario creado")</script>';
        header("Location: mostrarUsuarios");
        exit();
    }else{
        echo "no se pudo crear";
    } 
    
?>

<?php
    session_start();
    
    if(!isset($_SESSION['login'])){
        header('Location: index.php');
        exit();
    } else {
        // Show users the page
    }  
    $rol=$_SESSION['rol'];

    if ($rol=='1'){
        header('Location: index');
        exit();
    }
  
    require_once 'Base.php';

    $nombre = $_POST['nombrepantalla'];
    $ubicacion = $_POST['selectUbi'];
    $mac = $_POST['mac'];
  

   

    $sql="SELECT idUbc from UBICACION where nombreUbc = '$ubicacion'";
    $resultado1=$connection->query($sql);
    if ($resultado1) {
        while ($row = $resultado1->fetch_assoc()) {
            $idUbc = $row['idUbc'];
        }
        
    }

   
    //To Encrypt:
  

    //DataBase connection
    $query="INSERT into PANTALLA (nombrePantalla, MAC, idUbc) values ('$nombre','$mac','$idUbc')";
    $resultado=$connection->query($query);
    if($resultado){
        header("Location: URL");
    }

    if($resultado){
        echo '<script type="text/javascript">alert("Usuario creado")</script>';
        header("Location: gestionarPantallas");
        exit();
    }else{
        echo "No se pudo crear";
    } 

?>
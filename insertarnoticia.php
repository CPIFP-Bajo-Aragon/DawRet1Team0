
<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header('Location: index.php');
        exit();
    } else {
        // Show users the page
    } 
    require_once 'Base.php';
    $login=$_SESSION['login'];
    $archivo = $_FILES['archivo']['name'];

    if (isset($archivo) && $archivo != ""){
        $tipo = $_FILES['archivo']['type'];
        $tamaño = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];

        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
            echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
           - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
        } else {
            //If the image is correct in size and type
            //Trying to upload to the server
            if (move_uploaded_file($temp, 'imagenesNoticias/'.$archivo)) {
                //Change the permissions of the file to 777 to be able to modify it later
                chmod('imagenesNoticias/'.$archivo, 0777);
            }
        }

    }    

    //DataBase connection
    $ruta= $archivo;
    $titulo = $_POST['titulo'];
    $noticia = $_POST['noticia'];
    $fechainicio = $_POST['fechaini'];
    $fechafin = $_POST['fechafin'];

    $query="INSERT into PUBLICACION (tituloPublic,mensajePublic,archivo,fechaInicio,fechaLimite,idUser) values ('$titulo','$noticia','$ruta','$fechainicio','$fechafin','$login')";     
    $resultado=$connection->query($query);
             
    if (!$resultado) {
        echo "No se ha podido realizar la inserción";
    }else{
        echo "Insercción realizada correctamente";
        header("Location: menu");
        exit();            
    }     

?>
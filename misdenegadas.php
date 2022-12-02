<?php
    session_start();
    
    if(!isset($_SESSION['login'])){
        header('Location: index');
        exit();
    } else {
        // Show users the page!
    }
    $nombre=$_SESSION['nombre'];
    $login=$_SESSION['login'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIS DENEGADAS</title>
    <link rel="stylesheet" href="styles/validar.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://cpifpbajoaragon.com/"><img style="width:30px;"src="img/logo1.png"> CPIFP BAJO ARAGON</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="menu" data-bs-toggle="modal" data-open='modal1'>
                                <i class="fa fa-home">
                                </i>
                                </i>
                                Inicio
                            </a>
                        </li>
                    </ul>
                </div>
                <p><?php echo "Hola ".$nombre?> </p>
                <p><a href='logout.php'><i class="fa fa-sign-in"></i> Cerrar sesión</a></p>
            </div>
        </nav> 
    </header>
    
    <main>
        <div class="titulo">
            <h1>MIS DENEGADAS</h1>
        </div>
        <div id="containerValidar">
           
            <br>
            <?php
                require_once 'Base.php';
                //DataBase connection     
                $query="SELECT tituloPublic, mensajePublic,fechaLimite,nombreUser,archivo, fechaAutorizacion, motivoDenegacion from PUBLICACION P, USUARIO U where U.idUser=P.idUser and validada='-1' and nombreUser='$nombre'";
                $resultado=$connection->query($query);
                $num = $resultado->num_rows;
                        


      
                if ($num>0) {
                    while ($row = $resultado->fetch_assoc()) { 
                        $field2name = $row["tituloPublic"];
                        $field3name = $row["mensajePublic"];
                        $field5name = $row['fechaLimite'];
                        $field6name = $row['nombreUser'];
                        $field7name = $row['fechaAutorizacion'];
                        $field8name = $row['archivo'];
                        $motivo = $row['motivoDenegacion'];
                        echo "<div id='noticia'>";
                        echo '<h2 id="titulo2">'.$field2name.'</h2>';
                        echo "<p>".$field3name."</p>";
                        if($field8name!=""){
                            echo "<img id='foto' src='imagenesNoticias/$field8name'>";
                        }
                        echo "<p>Fecha de denegacion: ".$field7name."</p>";
                        echo "<p>Motivo denegación: ".$motivo."</p>";
                            
                        //To view the news individually
                            echo "<form action='editarmis' method='post'><input type='text' name='nombre' value='$field2name' id='invisible'><input id='VALIDAR' type='submit' name='MAS' value='EDITAR'></form>
                            <br>";
                           echo "</div>";
                    }
                    $resultado->free();
                }else{
                    echo "no tienes noticias denegadas";
                }
            ?>
        </div>
    </main>

    <footer class="text-center text-lg-start bg-dark text-muted fixed-bottom">
        <div class="text-center p-2" style="background-color:  white;">
            2022 Copyright: 
            <a class="text-reser fw-bold" target="_blank" href="https://cpifpbajoaragon.com">
                CPIFP Bajo Aragón 
            </a>
            <a class="text-reser fw-bold danger" target="_blank" href="https://alcachofa.com">
                Alcachofas 
            </a>
        </div>
    </footer>
    
</body>
</html>
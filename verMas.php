
<?php
require_once 'Base.php';
    session_start();
    
    if(!isset($_SESSION['login'])){
        header('Location: index');
        exit();
    } else {
        
    }
    $rol=$_SESSION['rol'];

    if ($rol=='1'){
        header('Location: index');
        exit();
    }
    $login=$_SESSION['login'];
    $rol=$_SESSION['rol'];
    $nombre=$_SESSION['nombre'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/historico.css">
    <title>Historico</title>
    <link href="img/alcachofa-less.jpg" rel="icon" type="image/x-icon">
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
<?php
    $titulo=$_POST['titulo'];
?>
    <main>
        <div class="titulo">
            <h1><?php echo $titulo;?></h1>
        </div>
        <div id="containerValidar">

            <?php

             
                
                $query="SELECT tituloPublic, mensajePublic,fechaInicio,fechaLimite,nombreUser, fechaAutorizacion, archivo from PUBLICACION P, USUARIO U where U.idUser=P.idUser and tituloPublic='$titulo'";
                $resultado=$connection->query($query);
                while($datos=$resultado->fetch_array()){
                   $mensaje=$datos['mensajePublic'];
                   $fechaI=$datos['fechaInicio'];
                   $fechaL=$datos['fechaLimite'];
                   $creado=$datos['nombreUser'];
                   $fechaAut=$datos['fechaAutorizacion'];
                   $imagen=$datos['archivo'];
                }

                echo "<div>$mensaje</div> <br>";
                if ($imagen!=""){
                echo "<div><img src='imagenesNoticias/$imagen'</div>";  
            }            
                echo "<div>
                    <p>Noticia realizada por: $creado</p><br>";
                if ($fechaAut!="")
                {
                    echo "<p>Noticia autorizada el $fechaAut</p>";
                }
                    
                  echo  "<p>Tiempo de noticia de $fechaI hasta $fechaL</p>
                </div>";  
            ?>
    
          

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
           
        </div>
</body>
</html>



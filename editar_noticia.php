<?php
    session_start();
    
    if(!isset($_SESSION['login'])){
        header('Location: index');
        exit();
    } else {                    
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
    <title>Editar Noticia</title>
    <link rel="stylesheet" type="text/css" href="styles/editar.css">
    <link href="img/alcachofa-less.jpg" rel="icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i%7CLato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

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
            <h1>PUBLICACIONES DENEGADAS</h1>
        </div>
        <div id="containerValidar">        
            <?php
                require_once 'Base.php';

                $query="select tituloPublic ,mensajePublic,fechaLimite,nombreUser,archivo, fechaAutorizacion from PUBLICACION P, USUARIO U where U.idUser=P.idUser and validada='-1'";
                $resultado=$connection->query($query);
                if ($resultado) {
                    /* fetch associative array */
                    while ($row = $resultado->fetch_assoc()) {
                        $field2name = $row["tituloPublic"];
                        $field3name = $row["mensajePublic"];
                        $field5name = $row['fechaLimite'];
                        $field6name = $row['nombreUser'];
                        $field7name = $row['fechaAutorizacion'];
                        $field8name = $row['archivo'];

                        echo "<div id='noticia'>";
                        echo '<h2 id="titulo">'.$field2name.'</h2>';
                        echo "<p>".$field3name."</p>";

                        if($field8name!=""){
                            echo "<img id='foto' src='imagenesNoticias/$field8name'>";
                        }

                        echo "<p>Escrita por: ".$field6name."</p>";
                        echo "<p>Fecha de denegación: ".$field7name."</p>";
                        echo "</div>";
            
                    }
                    
                    /* free result set */
                    $resultado->free();
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
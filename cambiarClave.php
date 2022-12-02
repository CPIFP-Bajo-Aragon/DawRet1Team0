<?php
    session_start();

    if(!isset($_SESSION['login'])){
        header('Location: index.php');
        exit();
    }

    $login=$_SESSION['login'];
    $rol=$_SESSION['rol'];
    $nombre=$_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
    <link rel="stylesheet" type="text/css" href="styles/menu.css">
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
        <div id="container">
            <h2>CAMBIAR CLAVE</h2>
            <br>
            <br>
            <form action="cambiarClave.php" method="POST">
                Nombre usuario:
                <br><br>
                <input type="text" name="nombre" value="<?php echo $nombre ?>">
                <br><br>
                Nueva contraseña:<br><br>
                <input type="password" name="clave" required>
                <br><br>
                <input type="submit" value="CAMBIAR" name="CAMBIAR">
            </form>

            <?php
                require_once 'Base.php';
                if (isset($_POST['CAMBIAR'])) {
                    $nombre=$_POST['nombre'];
                    $clave=$_POST['clave'];
                    $sql="UPDATE USUARIO SET nombreUser='$nombre',claveUser='$clave' where idUser like '$login'";
                    $resultado1=$connection->query($sql);
                    if($resultado1){
                        header("Location: menu");
                        exit();
                    }
                }
            ?>
                 
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <BR>
            <BR>

            <a href="menu">
                <img src="img/backwards.png" id="backwards">
            </a> 

            <a href="logout.php">
                <img src="img/exit.png" id="exit">
            </a> 
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
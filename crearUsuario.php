<?php
    session_start();
    
    if(!isset($_SESSION['login'])){
        header('Location: index.php');
        exit();
    } 
    else {          
    }
    
    $rol=$_SESSION['rol'];

    if ($rol=='1'){
        header('Location: index.php');
        exit();
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" type="text/css" href="styles/menu.css">
    <link href="img/alcachofa-less.jpg" rel="icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i%7CLato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
</head>
<body>
  
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="menu.php">Home</a>
                        <a class="nav-link" href="#">Features</a>
                        <a class="nav-link" href="#">Pricing</a>
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>   

    <main>
        <div id="container">
            <div class="titulo">
                <h1>CREAR USUARIO</h1>
            </div>
            <form action="insertarUsuario.php" method="post">
                <br>
                Nombre usuario:<br><input name="usuario" type="text" required>
                <br>
                <br>
                Departamento:<br>
                <select id="selectDpto" name="selectDpto" required>
                    <option>Informática</option>
                    <option>Electricidad</option>
                    <option>Sanidad</option>
                    <option>Administrativo</option>
                    <option>Automoción</option>
                    <option>Secretaría</option>            
                </select>
                <br>
                <br>
                Rol:
                <select id="selectDpto" name="rol" required>
                    <option>Crear publicaciones</option>
                    <option>Crear, eliminar, autorizar publicaciones</option>    
                </select>
                <br>
                <br>    
                Correo electronico:<br><input name="email" type="email" required>
                <br>
                <br>
                <input id="VALIDAR" name="crear" type="submit" value="CREAR"> 
            </form>
            <br>
            <p>* Se le mandara un correo con su contraseña por defecto y en su primer inicio de sesión podra cambiarla</p>
            <br> 
            <a href="logout.php">
                <img src="img/exit.png">
            </a> 
            <a href="menu.php">
                <img src="img/backwards.png" id="backwards">
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

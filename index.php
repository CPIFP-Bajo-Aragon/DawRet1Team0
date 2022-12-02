<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pág principal</title>
    <link rel="stylesheet" type="text/css" href="styles/index.css">
    <link href="img/alcachofa-less.jpg" rel="icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i%7CLato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
</head>

<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
?>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://cpifpbajoaragon.com/"><img style="width:30px;"src="img/logo1.png"> CPIFP BAJO ARAGON</a>
            </div>
        </nav>
    </header>

    <main>
        <!-- Login -->
        <form method="post">
            <div class="form_div">
                <label>Login:</label>
                <input class="field_class" name="login" type="text" placeholder="Introduce el usuario" autofocus>
                <label>Password:</label>
                <input id="pass" name="clave" class="field_class" type="password" placeholder="Introduce la contraseña" >
                <input class="submit_class" type="submit" name="enviar" value="Entrar">
            </div>
        </form>
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

    <?php
        include('Base.php');
        session_start();
        if (isset($_POST['enviar'])) {
            $username = $_POST['login'];
            $password = $_POST['clave'];
            
            // Encrypt passwords
            $pass_c=sha1($password);
        
            $sql = "SELECT * FROM USUARIO WHERE nombreUser='$username' and claveUser='$pass_c'" ;
            $result = $connection->query($sql);

            $num = $result->num_rows;
            if($num>0){
                $row = $result->fetch_assoc();
                $password_bd = $row['claveUser'];
                echo '<script type="text/javascript">alert("'.$pass_c.'");</script>';
                if($password_bd == $pass_c){
                    $_SESSION['login'] = $row['idUser'];
                    $_SESSION['rol'] = $row['rol'];
                    $_SESSION['nombre'] = $row['nombreUser'];
                    header("Location: menu");
                }
            } else {
                echo '<script language="javascript">alert("USUARIO O CONTRASEÑA INCORRECTO");</script>';
            }
        }    
    ?>
</body>
</html>



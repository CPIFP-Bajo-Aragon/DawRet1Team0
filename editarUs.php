<?php
    session_start();
    
    if(!isset($_SESSION['login'])){
        header('Location: index.php');
        exit();
    } else {
                    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" type="text/css" href="styles/editar.css">
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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        <a class="nav-link" href="#">Features</a>
                        <a class="nav-link" href="#">Pricing</a>
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div id="containerValidar">
            <h2>EDITAR USUARIO</h2>
            <?php
                require_once 'Base.php';
                $nombreUs=$_POST['nombre'];
                $query="SELECT idUser,nombreUser,email,claveUser,nombreDpto,nombreRol from USUARIO U, DEPARTAMENTO D, ROL R where R.idRol = U.rol and D.idDpto=U.idDpto and nombreUser='$nombreUs'";  
                $resultado=$connection->query($query);

                if ($resultado) {
                    /* fetch associative array */
                    while ($row = $resultado->fetch_assoc()) {
                        $nombre = $row['nombreUser'];
                        $email = $row["email"];
                        $clave = $row["claveUser"];
                        $dpto = $row['nombreDpto'];
                        $rol = $row['nombreRol'];
                        $id=$row['idUser'];
                        
                        echo "<div id='noticia'>";
                        echo "<form ENCTYPE='multipart/form-data'  method='post'>";
                        echo "<p>NOMBRE:</p>";
                        echo "<input type='text' name='nombre' value='$nombre' required>";
                        echo "<p>EMAIL:</p>";
                        echo "<input type='text' name='email' value='$email' required>";
                        echo "<p>Clave:</p>";
                        echo "<input type='text' name='clave' value='$clave' required>";
                        echo "<p>Departamento:</p>";
                        echo "<select id='selectDpto'name='selectDpto' required>
                                <option>informatica</option>
                                <option>electricidad</option>
                                <option>sanidad</option>
                                <option>administrativo</option>
                                <option>automocion</option>
                                <option>secretaria</option> 
                            </select>";
                        echo "<p>Rol:</p>";
                        echo "<select id='selectDpto' name='rol' required>
                                <option>Crear publicaciones</option>
                                <option>Crear, eliminar, autorizar publicaciones</option>
                            </select>";
                        echo "<input type='text' name='idUser' value='$id' style='visibility:collapse; position:fixed;'>";
                        echo "<input type='submit' name='guardar' value='Guardar cambios'></form>";  
                    }
                }
                /* free result set */
                $resultado->free();
  
                if (isset($_POST['guardar'])) {
                    $nombre=$_POST['nombre'];
                    $email=$_POST['email'];
                    $clave=$_POST['clave'];
                    $dpto=$_POST['selectDpto'];
                    $rol=$_POST['rol'];
                    $idUser=$_POST['idUser'];
                    $sql="select idDpto from DEPARTAMENTO where nombreDpto='$dpto'";
                    $resultado1=$connection->query($sql);
                    
                    if ($resultado1) {
                        while ($row = $resultado1->fetch_assoc()) {
                           $idDpto = $row['idDpto'];
                        } 
                    }

                    $sql="select idRol from ROL where nombreRol='$rol'";
                    $resultado1=$connection->query($sql);
            
                    if ($resultado1) {
                        while ($row = $resultado1->fetch_assoc()) {
                            $idRol = $row['idRol'];
                        }
                    }

                    $sql="update USUARIO set nombreUser='$nombre',claveUser='$clave',email='$email',idDpto='$idDpto',rol='$idRol' where idUser='$idUser'";
                    $resultado=$connection->query($sql);
                    
                    if($resultado){
                        echo "usuario editado correctamente";
                    }else{
                        echo "error";
                    }
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
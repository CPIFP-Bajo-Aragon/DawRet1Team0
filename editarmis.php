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
    <link href="img/alcachofa-less.jpg" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="styles/validar.css">
    <!-- <link rel="stylesheet" type="text/css" href="styles/menu.css"> -->   
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
                        <li class="nav-item">
                             <a class="nav-link" aria-current="page" href="misdenegadas" data-bs-toggle="modal" data-open='modal1'>
                             <i class="fa fa-sign-in"></i>
                            
                                </i>
                                Atras
                                                                  
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
            <h1>EDITAR</h1>
        </div>
        <div id="containerValidar">
 
          <br>
          <?php
            require_once 'Base.php';
            $public=$_POST['nombre'];
            $query="select idPublic, tituloPublic, mensajePublic,fechaInicio, fechaLimite, archivo,motivoDenegacion from PUBLICACION P, USUARIO U where U.idUser=P.idUser and tituloPublic='$public'";
            $resultado=$connection->query($query);
            if ($resultado) {
            
              while ($row = $resultado->fetch_assoc()){ 
                $idNoticia = $row['idPublic'];
                $titulo = $row["tituloPublic"];
                $cuerpo = $row["mensajePublic"];
                $fechaini=$row['fechaInicio'];
                $fechaLim = $row['fechaLimite'];
                $motivo=$row['motivoDenegacion'];
              
                echo "<form ENCTYPE='multipart/form-data'  method='post'>";
               echo "<p>Motivo denagacion: $motivo</p>";
                echo "<p>Titulo:</p>";
                echo "<input type='text' name='titulo' value='$titulo' required>";
                echo "<p>Titulo:</p>";
                echo "<textarea name='cuerpo' value='$cuerpo'>$cuerpo</textarea><br>";
                echo "<p>Fecha inicio:</p><br><input type='date' value='$fechaini' name='fechaini'><br>";
                echo "<p>Fecha Limite:</p><br><input type='date' value='$fechaLim' name='fechalim'><br>";
                

               
                echo "<br><input type='text' value='$idNoticia' id='invisible' name='id'><input id='VALIDAR' type='submit' name='guardar' value='GUARDAR'></form>
                <br>";
                echo "</div>";
              }    
            }

            if (isset($_POST['guardar'])) {
              $titulo=$_POST['titulo'];
              $cuerpo=$_POST['cuerpo'];
              $noticia=$_POST['id'];
              $fechai=$_POST['fechaini'];
              $fechal=$_POST['fechalim'];
              $sql="UPDATE PUBLICACION SET tituloPublic='$titulo',mensajePublic='$cuerpo', fechaInicio='$fechai', fechaLimite='$fechal', validada='0' where idPublic = '$noticia'";
              $resultado1=$connection->query($sql);
              if($resultado1){
                  header('Location:misdenegadas');
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
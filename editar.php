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
    <link rel="stylesheet" href="styles/todasN.css">
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
                    </ul>
                </div>
                <p><?php echo "Hola ".$nombre?> </p>    
                <p><a href='logout.php'><i class="fa fa-sign-in"></i> Cerrar sesión</a></p>
            </div>
        </nav>
    </header>

    <main>
        <div id="containerValidar">
          <h1 style="text-align:center;">EDITAR NOTICIA</h1>   
          <br>
          <?php
            require_once 'Base.php';
            $query="select idPublic, tituloPublic, mensajePublic,fechaLimite,nombreUser,archivo, fechaAutorizacion, motivoDenegacion from PUBLICACION P, USUARIO U where U.idUser=P.idUser and validada='-1' and nombreUser='$nombre'";
            $resultado=$connection->query($query);
            if (!$resultado) {
              echo "hola";
            }else{
              while ($row = $resultado->fetch_assoc()){ 
                $idNoticia = $row['idPublic'];
                $field2name = $row["tituloPublic"];
                $field3name = $row["mensajePublic"];
                $field5name = $row['fechaLimite'];
                $field6name = $row['nombreUser'];
                $field7name = $row['fechaAutorizacion'];
                $field8name = $row['archivo'];
                $motivo = $row['motivoDenegacion'];
              
                echo "<div id='noticia'>";
                echo "<form ENCTYPE='multipart/form-data' action='editar' method='post'>";
                echo "<p>Titulo:</p>";
                echo "<input type='text' name='titulo' value='$field2name' required>";
                echo "<p>Cuerpo noticia:</p>";
                echo "<input type='text' name='cuerpoNoticia' value='$field3name' required>";
                echo "<p>Archivo:</p>";
                if($field8name!="imagenesNoticias/"){
                  echo "<img id='foto' src='$field8name'>";
                }
                            
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo "<p>Fecha de denegacion: ".$field7name."</p>";
                echo "<p>Motivo denegación: ".$motivo."</p>";

                //esto de abajo es por si queremos ver las noticias idividualmente
                echo "<select name='select' id='invisible' value='$idNoticia' required></option>
                 <option name='opcion' selected>$idNoticia</option><input id='VALIDAR' type='submit' name='guardar' value='GUARDAR'></form>
                <br>";
                echo "</div>";
              }    
            }

            if (isset($_POST['guardar'])) {
              $titulo=$_POST['titulo'];
              $cuerpo=$_POST['cuerpoNoticia'];
              $noticia=$_POST['select'];
              $sql="UPDATE PUBLICACION SET tituloPublic='$titulo',mensajePublic='$cuerpo',validada='0',motivoDenegacion=null,idUser='$login' where idPublic = '$noticia'";
              $resultado1=$connection->query($sql);
              if($resultado1){
                  echo "noticia editada correctamente";
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
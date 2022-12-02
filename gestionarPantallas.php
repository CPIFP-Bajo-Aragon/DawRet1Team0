<?php
  session_start();

  if(!isset($_SESSION['login'])){
      header('Location: index');
      exit();
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
<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.0/assets/js/docs.min.js" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTIONAR PANTALLAS</title>
    <link rel="stylesheet" type="text/css" href="styles/gestionarPantallas.css">
    <link href="img/alcachofa-less.jpg" rel="icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i%7CLato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
</head>

<body>
  
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="https://cpifpbajoaragon.com/"><img style="width:30px;"src="img/logo1.png"> CPIFP BAJO ARAGON</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarNav">  
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="menu" data-bs-toggle="modal" >
                  <i class="fa fa-home">
                  </i>
                  </i>
                  Inicio
                </a>
              </li>
              
              <?php
                // if you are the administrator, you can add more screens
                if($rol=='2'){
                  echo  '<li class="nav-item">
                          <a class="nav-link" href="#" data-bs-toggle="modal" data-open="modal1" ><i class="fa fa-tv"></i> Añadir pantalla</a>
                        </li>';
                }
              ?>

              </ul>
          </div>
      
          <p><?php echo "Hola ".$nombre?> </p>
          <p><a href='logout.php'><i class="fa fa-sign-in"></i> Cerrar sesión</a></p>

        </div>
      </nav>
    </header>   

    <main>
      <div id="container">
        <div class="titulo">
          <h1>PANTALLAS</h1>
        </div>

        <?php
          // Database connection
          require_once 'Base.php';
          $query="SELECT idPantalla,nombrePantalla,MAC,idUbc from PANTALLA P ";
          $resultado=$connection->query($query);
        ?>
          
        <table>
          <tr>
            <th>idPantalla</th>
            <th>nombrePantalla</th>
            <th>MAC</th>
            <th>idUbc</th>
            <th></th>
            <th></th>
          </tr>

          <?php 
            while($datos=$resultado->fetch_array()){
              $idubicacion=$datos['idUbc'];
          ?>

          <tr>
            <td><span id="id"><?php echo $datos['idPantalla'];?></span></td>
            <td><span id="nombrePantalla"><?php echo $datos["nombrePantalla"]?></span></td>
            <td><span id="mac"><?php echo $datos["MAC"]?></span></td>
            <td><span id="ubicacion"><?php echo $datos["idUbc"]?></span></td>
            <td><form method='post'><input type='text' name='nombre' value='<?php echo $datos['idPantalla'];?>' style='display:none;'><button style='background-color:red; border-color:rgba(0,61,128,255);' type='submit' value='ELIMINAR' name='eliminar'  class="btn btn-success edit"><i class="fas fa-trash-alt"></i></button></form></td>
            <td><button style='background-color:rgba(0,61,128,255); border-color:rgba(0,61,128,255);' data-open="edit" id="btnmodal" type="button" class="btn btn-success edit" value="<?php echo $datos['idUser'];?>"><i  class="fas fa-pencil-alt"></i>  </button></td>
          </tr>

          <?php  
            //Closing the open while in the previous php
            }

            if (isset($_POST['eliminar'])) {
              $nombre=$_POST['nombre'];
              $sql="DELETE from ASIGNAR where idPantalla='$nombre'";
              $delete="DELETE FROM PANTALLA where idPantalla='$nombre'";
              $resultado=$connection->query($sql);
              $result=$connection->query($delete);
              if($resultado&&$result){
                  
              }
            }
          ?>
  
  
          <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar pantalla</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action='editarPantalla.php' method='post'>
                  <div class="mb-3">
                      <label for="message-text" class="col-form-label">ID:</label>
                      <input type="text" class="form-control" id="enombre" name="idPan">
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Nombre:</label>
                      <input type="text" class="form-control" id="enombre" name="nombre">
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">mac:</label>
                      <input type="text" class="form-control" id="mac" name="mac">
                    </div>
                   
                    <input type="submit" name="guardar" value="GUARDAR">
                  </form>
                </div>
                <div class="modal-footer"></div>
              </div>
            </div>
          </div>
        </table>
        <?php
        
        //   ?>

        <div class="modal" id="modal1">
          <div class="modal-dialog" id='modal2'>
            <header class="modal-header">
              <h2>Añadir pantalla</h2>
              <button class="close-modal" aria-label="close modal" data-close>X</button>
            </header>

            <section class="modal-content">
              <form action='insertarPantalla.php' method='post' onsubmit="return validacion()">
              <div id="alert3" class="alert alert-danger" role="alert">No puedes dejar elementos vacios!!</div>
                
                Nombre pantalla:<br><input name="nombrepantalla" id="pantalla" type="text">
                <div id="alert1" class="alert alert-danger" role="alert">No puedes dejar el nombre vacio</div>
                
                <br>
                <br>
                Ubicación:<br>
                <select id="selectUbi" name="selectUbi">
                <?php 
                $ubi="select * from UBICACION";
                $res=$connection->query($ubi);
               while($datos=$res->fetch_array()){
?> 
                <option><?php echo $datos["nombreUbc"];?></option>
          <?php
        }
        ?>
                </select>
               
                <br>
                <br>
                MAC:<br><input name="mac" type="text" id="mac" onkeyup="validarMac( this.value )" >
                <div id="alert2" class="alert alert-danger" role="alert">Esta mac no es valida</div>
              
                <br>
                <br>
                <input id="VALIDAR" name="crear" type="submit" value="CREAR"> 
              </form><br>
            </section>

            <footer class="modal-footer">...</footer>
          </div>
        </div>

        <!--Function validation in a script -->
        <script type="text/javascript">

          function validacion() {
            pantalla = document.getElementById("pantalla").value;
            mac = document.getElementById("mac").value
            const alerta = document.getElementById("alert1");
  const alerta2 = document.getElementById("alert2");
  const alerta3 = document.getElementById("alert3");

if( (mac == null || mac.length == 0 || /^\s+$/.test(mac))&&( pantalla == null || pantalla.length == 0 || /^\s+$/.test(pantalla) ) ) {
  alerta3.classList.add("show");
  return false;
}


        }
//         function validarMac( valor ) {
//         let regex = /^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/;
// if(regex.test(mac)){
 
// }else{
//  alert('mac no correcta');
// }
// }
          const openEls = document.querySelectorAll("[data-open]");
          const closeEls = document.querySelectorAll("[data-close]");
          const isVisible = "is-visible";

          for (const el of openEls) {
            el.addEventListener("click", function() {
              const modalId = this.dataset.open;
              document.getElementById(modalId).classList.add(isVisible);
            });
          }

          for (const el of closeEls) {
            el.addEventListener("click", function() {
              this.parentElement.parentElement.parentElement.classList.remove(isVisible);
            });
          }

          document.addEventListener("click", e => {
            if (e.target == document.querySelector(".modal.is-visible")) {
              document.querySelector(".modal.is-visible").classList.remove(isVisible);
            }
          });

          document.addEventListener("keyup", e => {
            // if we press the ESC
            if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
              document.querySelector(".modal.is-visible").classList.remove(isVisible);
            }
          });

        </script>

        <br> 
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

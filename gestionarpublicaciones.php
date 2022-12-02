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
      // echo '<script language="javascript">alert("sesion iniciada correctamente");</script>';
                    

  $login=$_SESSION['login'];
  $rol=$_SESSION['rol'];
  $nombre=$_SESSION['nombre'];

?> 

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/5.0/assets/js/docs.min.js" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Publicaciones Prueba</title>
    <link rel="stylesheet" type="text/css" href="styles/gestionarPublicaciones.css"> 
    <!-- <link rel="stylesheet" href="styles/historico.css"> -->

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
                        if($rol=='2'){
                            echo  '<li class="nav-item">       
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-open="modal1" ><i class="fa fa-user-plus"></i>Añadir guardias</a>                   
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
                <h1>GESTIONAR PUBLICACIONES</h1>
            </div>

        <?php
            require_once 'Base.php';
            $query="SELECT PA.nombrePantalla,P.idPublic,tituloPublic, mensajePublic,fechaInicio,fechaLimite,nombreUser, fechaAutorizacion from PUBLICACION P, USUARIO U,ASIGNAR A, PANTALLA PA where U.idUser=P.idUser and P.idPublic=A.idPublic and A.idPantalla=PA.idPantalla";
            $resultado=$connection->query($query);
        ?>
       
        <table>
            <tr>
                <th>TITULO</th>
                <th>MENSAJE</th>
                <th>FECHA INICIO
                    <button id='ordenar' type='button' name='ordenar' value='ordenar por fecha' onclick='ordenaras()'><img id='flechas' src='img/flechas.png'></button>
                </th>
                <th>FECHA LIMITE</th>
                <th>PUBLICADOR</th>
                <th>PANTALLA ASIGNADA</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>

            <?php 
                while($datos=$resultado->fetch_array()){
                    $tituloNo=$datos['tituloPublic'];
                    $public=$datos['idPublic'];
                    $nombrePa=$datos['nombrePantalla'];
            ?>

            <tr>
            <td><?php echo $tituloNo?></td>
                    <td><?php echo $datos["mensajePublic"]?></td>
                    <td><?php echo $datos["fechaInicio"]?></td>
                    <td><?php echo $datos["fechaLimite"]?></td>
                    <td><?php echo $datos["nombreUser"]?></td>
                    <td><?php if($nombrePa!=""){ 
                                echo $nombrePa;
                            }else{
                                echo "No esta asignada";
                            };
                        ?>
                    </td>
                    <td><form action='editar' method='post'><input type='text' name='nombre' value='<?php echo $public;?>' style='visibility:collapse; position:fixed;' ><button style='background-color:rgba(0,61,128,255); border-color:rgba(0,61,128,255);' type='submit' name="editar" data-open="edit" id="btnmodal"  class="btn btn-success edit" ><i class="fa fa-pencil"></i></button></td></form>
                    <td><form action="verNot" method="post"><input type='text' name='titulo' value='<?php echo $datos["tituloPublic"]?>' style='visibility:collapse; position:fixed;'><button  style='background-color:rgba(0,61,128,255); border-color:rgba(0,61,128,255);' type="submit" class="btn btn-success edit">VER</button></form></td>
                    <td><form method='post'><input type='text' name='nombre' value='<?php echo $public;?>'  style='visibility:collapse; position:fixed;'><button style='background-color:red; border-color:rgba(0,61,128,255);' type='submit' value='ELIMINAR' name='eliminar'  class="btn btn-success edit"><i class="fas fa-trash-alt"></i></button></form></td>
            </tr>
            
            <?php   
                    }
                    if (isset($_POST['eliminar'])) {
                        $public=$_POST['nombre'];
                        $sql="DELETE from ASIGNAR where idPublic='$public'";
                        $delete="DELETE FROM PUBLICACION where idPublic='$public'";
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
        <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
   
      </div>
      <div class="modal-body">
        <form id="editarUsuario" action='actualizarUs.php' method='post'>
          <?php
           
         $sql="SELECT idUser,nombreUser,email,claveUser,nombreDpto,nombreRol from USUARIO U, DEPARTAMENTO D, ROL R where R.idRol = U.rol and D.idDpto=U.idDpto and nombreUser='$nombre'";
                 $result=$connection->query($sql);
                while($datos=$result->fetch_array()){
                  $nombreUser=$datos['nombreUser'];
                  $idUser=$datos['idUser'];
           }
           
                 
                ?>
          
          <div class="mb-3" >
             <label for="recipient-name" class="col-form-label">ID:</label>
            <input type="text" class="form-control" id="eid" name='id' value=""> 
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="enombre" name="nombre" value="">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">email:</label>
            <input type="text" class="form-control" id="eemail" name="email">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Clave:</label>
            <input type="text" class="form-control" id="eclave" name="clave">
          </div>
      <?php
                 
      ?>
          <input type="submit" name="guardar" value="GUARDAR"> 
        </form>
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>
    


                </table>

       
        <div class="modal" id="modal1">
  <div class="modal-dialog" id='modal2'>
    <header class="modal-header">
    <h2>Añadir nueva guardia</h2>
      <button class="close-modal" aria-label="close modal" data-close>X</button>
 
    </header>

    <section class="modal-content">
        <form action='insertarUsuario.php' method='post' onsubmit="return validacion()">
            <div id="alert4" class="alert alert-danger" role="alert">No puedes dejar elementos vacios</div>   

            Asunto:<br><input type="text" class="form-control" id="asunto" placeholder="Asunto" name='titulo'>                
            <br>
            Cuerpo Publicación:<br>
            <textarea class="form-control" id="cuerpo" rows="3" name='noticia'></textarea>
            <br>
            <input type="file" class="form-control" id="image" name="archivo" multiple> <br> 
            <br>
            Fecha Inicio:<br><input name="fechaini"  id="fechaIni" type="date"><br>         
            <br>
            Fecha Límite:<br><input name="fechafin"  id="fechaLim" type="date">
            <div id="alertfecha" class="alert alert-danger" role="alert">Las fechas nos son correctas</div>
            <br>
            <br>
            <input class='btn btn-success edit' name="crear" type="submit" value="CREAR"> 
        </form>
        <br>
    </section>
    <footer class="modal-footer">...</footer>
  </div>
 
</div>


<script type="text/javascript">


function validacion() {
  valor = document.getElementById("nameuser").value;
  email = document.getElementById("mail").value
  clave = document.getElementById("clave").value
  const alerta = document.getElementById("alert1");
  const alerta2 = document.getElementById("alert2");
  const alerta3 = document.getElementById("alert3");
  const alerta4 = document.getElementById("alert4");
  const alerta5 = document.getElementById("alertclave");
if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  alerta.classList.add("show");
  return false;
 
}
if( clave == null || clave.length == 0 || /^\s+$/.test(clave) ) {
  alerta.classList.add("show");
  return false;
 
}
if( email == null || email.length == 0 || /^\s+$/.test(email) ) {
  alerta2.classList.add("show");
  return false;
 
}
if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(email)){
  alerta3.classList.add("show");
   return false;
  }

}

const openEls = document.querySelectorAll("[data-open]");
const closeEls = document.querySelectorAll("[data-close]");
const isVisible = "is-visible";

for (const el of openEls) {
  
  el.addEventListener("click", function() {
    
    const modalId = this.dataset.open;
    document.getElementById(modalId).classList.add(isVisible);
    event.preventDefault();


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

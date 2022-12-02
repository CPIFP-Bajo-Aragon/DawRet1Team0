<?php
  session_start();

  if(!isset($_SESSION['login'])){
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
    <title>INICIO</title>
    <link rel="stylesheet" type="text/css" href="styles/mostrarUs.css">
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
    if($rol=='2')
    {
      echo  '<li class="nav-item">
       
      <a class="nav-link" href="#" data-bs-toggle="modal" data-open="modal1" ><i class="fa fa-user-plus"></i>Añadir usuario</a>
              
        
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
  <h1>USUARIOS</h1>
 
</div>

    <?php
         require_once 'Base.php';
         $query="SELECT idUser,nombreUser,email,claveUser,nombreDpto,nombreRol from USUARIO U, DEPARTAMENTO D, ROL R where R.idRol = U.rol and D.idDpto=U.idDpto ";
         $resultado=$connection->query($query);
    ?>
       
            <table>
              <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>CORREO</th>
                <th>CLAVE</th>
                <th>ROL</th>
                <th>DEPARTAMENTO</th>
                <th></th>
                <th></th>
              </tr>
<?php 
        while($datos=$resultado->fetch_array()){
       
        ?>
                <tr>
                    <td><span id="id"><?php echo $datos['idUser'];?></span></td>
                    <td><span id="nombreUser"><?php echo $datos["nombreUser"]?></span></td>
                    <td><span id="email"><?php echo $datos["email"]?></span></td>
                    <td><span id="claveUser"><?php echo $datos["claveUser"]?></span></td>
                    <td><span id="nombreRol"><?php echo $datos["nombreRol"]?></span></td>
                    <td><span id="nombreDpto<?php echo$datos['idUser'];?>"><?php echo $datos["nombreDpto"]?></span></td>
                    <td><form method='post'><input type='text' name='nombre' value='<?php echo $datos["nombreUser"]?>' style='visibility:collapse; position:fixed;'><button style='background-color:red; border-color:rgba(0,61,128,255);' type='submit' value='ELIMINAR' name='eliminar'  class="btn btn-success edit"><i class="fas fa-trash-alt"></i></button></form></td>
                    <td><button style='background-color:rgba(0,61,128,255); border-color:rgba(0,61,128,255);' name="editar" data-open="edit" id="btnmodal"  class="btn btn-success edit" ><i class="fa fa-pencil"></i></button></td>
                </tr>
                <?php   
        }
        if (isset($_POST['eliminar'])) {
            $nombre=$_POST['nombre'];
            $sql="delete from USUARIO where nombreUser='$nombre'";
            $resultado=$connection->query($sql);
           if($resultado){
        


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
    <h2>Añadir usuario</h2>
      <button class="close-modal" aria-label="close modal" data-close>X</button>
 
    </header>

    <section class="modal-content">
    <form action='insertarUsuario.php' method='post' onsubmit="return validacion()">
                Nombre usuario:<br><input name="usuario" id="nameuser" type="text">
                <div id="alert1" class="alert alert-danger" role="alert">No puedes dejar el nombre vacio!!!</div>
                <div id="alert4" class="alert alert-danger" role="alert">el nombre tiene que ser de esta forma</div>
                
               <br>
               <br>
                Departamento:<br>
                <select id="selectDpto" name="selectDpto">
                  <option>informatica</option>
                  <option>electricidad</option>
                  <option>sanidad</option>
                  <option>administrativo</option>
                  <option>automocion</option>
                  <option>secretaria</option>    
                </select>
                <br>
                <br>
                <select id="selectDpto" name="rol">
                    <option>Crear publicaciones</option>
                    <option>Crear, eliminar, autorizar publicaciones</option>
                </select>
                <br>
                <br>
                Correo electronico:<br><input name="email" type="email" id="mail">
                <div id="alert2" class="alert alert-danger" role="alert">Se requiere el email</div>
                <div id="alert3" class="alert alert-danger" role="alert">Este email no es valido</div>
               
                <br>
                <br>
                <input id="VALIDAR" name="crear" type="submit" value="CREAR"> 
              </form><br>
        <p>* Se le mandara un correo con su contraseña por defecto y en su primer inicio de sesión podra cambiarla</p>
       
 
    </section>
    <footer class="modal-footer">...</footer>
  </div>
 
</div>


<script type="text/javascript">


function validacion() {
  valor = document.getElementById("nameuser").value;
  email = document.getElementById("mail").value
  
  const alerta = document.getElementById("alert1");
  const alerta2 = document.getElementById("alert2");
  const alerta3 = document.getElementById("alert3");
  const alerta4 = document.getElementById("alert4");
if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
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

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INICIO</title>
    <link rel="stylesheet" type="text/css" href="styles/menu.css">
    <link href="img/alcachofa-less.jpg" rel="icon" type="image/x-icon">
    <!-- <link rel="stylesheet" hrfef="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"> -->
    
    </head>
<body>
  
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">

  <!-- <div>
      <p>
        <?php
                  $ipAddress=$_SERVER['REMOTE_ADDR'];
                  $arp=`arp -n $ipAddress`;
                  $string = str_replace(' ', '', $arp);
                  $lines=explode(":", $string);
                  $first = substr($lines[0], -2).":";
                  $last = substr($lines[5], 0, 2);
                  echo $first;
                  
                  
                  for ($i=1; $i <=4 ; $i++) { 
                    $mid .= $lines[$i].":";
                  }
                  echo $mid;
                  echo $last;
        ?>
      </p>
                                                                                                  
    </div> -->

  <a class="navbar-brand" href="https://cpifpbajoaragon.com/"><img style="width:30px;"src="img/logo1.png"> CPIFP BAJO ARAGON</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
     
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="#" data-bs-toggle="modal" data-open='modal1'>
          <i class="fa fa-solid fa-file-pen">
          </i>
            Añadir publicación
        </a>
      </li>
 
<?php
    if($rol=='2')
    {
      // echo '<li class="nav-item">
      //     <a class="nav-link" aria-current="page" href="eliminar_noticia">
      //       <i class="fa fa-solid fa-file-pen">
      //       </i>
      //       </i>
      //         Eliminar publicación          
      //     </a>  
      //   </li>';
       
      echo  '<li class="nav-item">
       
      <a class="nav-link" href="#" data-bs-toggle="modal" data-open="modal3" ><i class="fa fa-user-plus"></i>Añadir usuario</a>
              
        
      </li>';
      echo  '<li class="nav-item">
       
      <a class="nav-link" href="guardias/Guardias-Recreo-Octubre.pdf" data-bs-toggle="modal"><i class="fa fa-newspaper"></i>
      </i>Consultar guardias</a>
              
        
      </li>';

    }
?>


</ul>

</div>
<p><?php echo "Hola ".$nombre?> </p>
    
    <p> <a href='logout.php'> &nbsp;<i class="fa fa-sign-in"></i> Cerrar sesión</a></p>
</div>
</nav>

    </header>   

    <main>

        <div id="listamovil">
        <a class="nav-link" href="#" data-bs-toggle="modal" data-open="modal3" ><i class="fa fa-user-plus"></i>Añadir usuario</a>
        <a class="nav-link" aria-current="page" href="#" data-bs-toggle="modal" data-open='modal1'>
          <i class="fa fa-solid fa-file-pen">
          </i>
          </i>
            Añadir publicación
        </a>

        </div>
  

        
        <div class="titulo">
          <h1>INICIO</h1>
        </div>
        <div id="container">
        <nav id='menu'>
           <!-- Alineación adaptable de Bootstrap -->
        
            
          <?php
            $login=$_SESSION['login'];
            $rol=$_SESSION['rol'];
            if($rol=='2'){
            
              echo "
              <a id='xxx' href='validar'>
             <div>VALIDAR PUBLICACIÓN<br><i class='fa-solid fa-check'></i> <i class='fa-solid fa-xmark'></i></div>
             </a>
             <a id='xxx' href='editar_noticia'>
              <div>PUBLICACIONES DENEGADAS<br><i  class='fa-solid fa-ban'></i></div>
              </a>
              <a id='xxx' href='carousel'>
              <div>MOSTRAR TODAS<br><i class='fa fa-newspaper'></i></div>
              </a>
              <a  id='xxx' href='gestionarpublicaciones'>
              <div>GESTIONAR PUBLICACIONES<br><i class='fa-solid fa-book'></i></div>
              </a>
              <a id='xxx' href='mostrarUsuarios'>
              <div>USUARIOS<br><i  class='fa fa-user'></i></div>
              </a>
              <a id='xxx' href='gestionarPantallas'>
              <div>GESTIONAR PANTALLAS<br><i  class='fa fa-tv'></i></div>
              </a>
              <a id='xxx' href='historico'>
              <div>HISTÓRICO NOTICIAS<br><i  class='fa-brands fa-dropbox'></i></div>
              </a>

            ";
            // <a id='xxx' href='pantallas_asignadas'>
            // <div>PUBLICACIONES ASIGNADAS<br><i class='fa-solid fa-wifi'></i></div>
            // </a>
            }else{
              echo  '<a id="xxx1" class="open-modal2" data-open="modal4">
                      <div>EDITAR USUARIO<br><i class="fa-solid fa-user-pen"></i></div>
                      
                      </a>
                     
                      <a id="xxx" href="misnoticias">
                      <div> TODAS MIS PUBLICACIONES<br><i class="fa fa-newspaper"></i></div>
                       </a>
                       <a id="xxx" href="misdenegadas">
              <div>MIS NOTICIAS DENEGADAS<br><i  class="fa-solid fa-ban"></i></div>
              </a>
               
                    ';
            }
          ?>   
            
          <br>

                <!-- <li><a href="validar">VALIDAR NOTICIA</li> 
                <br>
               -->
               
            
                <!-- <a href="mostrarTodas"><li>MOSTRAR TODAS NOTICIAS</li></a>
                 -->
          </ul> 
        </nav>

        <br> 

        <div class="modal" id="modal3">
          <div class="modal-dialog" id='modal2'>
            <header class="modal-header">
            <h2>Añadir usuario</h2>
              <button class="close-modal" aria-label="close modal" data-close>X</button>
            </header>

            <section class="modal-content">
              <form action='insertarUsuario.php' method='post' onsubmit="return validacionus()">
                Nombre usuario:<br><input name="usuario" id="nameuser" type="text">
                <div id="alert1" class="alert alert-danger" role="alert">No puedes dejar el nombre vacio!!!</div>
                
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
                Correo electronico:<br><input name="email" type="email" id="mail"><br>
                <div id="alert2" class="alert alert-danger" role="alert">Se requiere el email</div>
                <div id="alert3" class="alert alert-danger" role="alert">Este email no es valido</div>
               Contraseña:<br><input type='password' name='clave' id='clave'>
               <div id="alertclave" class="alert alert-danger" role="alert">Se requiere clave!!</div>
                <br>
                <br>
                <input  class='btn btn-success edit' name="crear" type="submit" value="CREAR"> 
              </form>
              <br>
             
            </section>
      
            <footer class="modal-footer">...</footer>
          </div>
        </div>

        <div class="modal" id="modal1">
          <div class="modal-dialog" id='modal2'>
            <header class="modal-header">


            <h2>Crear publicación</h2>
              <button class="close-modal" aria-label="close modal" data-close>X</button>
            </header>

            <section class="modal-content">
          
              <form ENCTYPE="multipart/form-data" method="post" action="insertarnoticia.php"  onsubmit="return validacion()">     
              <div id="alert4" class="alert alert-danger" role="alert">No puedes dejar elementos vacios</div>   
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Asunto</label>
                  <input type="text" class="form-control" id="asunto" placeholder="Asunto" name='titulo'>
    
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Cuerpo publicación</label>
                  
                  <textarea class="form-control" id="cuerpo" rows="3" name='noticia'></textarea>
                 
                </div>
               
                Fecha inicio:<br><input name="fechaini"  id="fechaIni" type="date"><br>         
                Fecha limite:<br><input name="fechafin"  id="fechaLim" type="date">
              
                <div id="alertfecha" class="alert alert-danger" role="alert">Las fechas nos son correctas</div>
               
               
                <input type="file" class="form-control" id="image" name="archivo" multiple> <br>  
                <input name="publicar" type="submit" value="PUBLICAR"> 
              </form>
            </section>
            <footer class="modal-footer">...</footer>
          </div>
        </div>

        <div class="modal" id="modal4">
          <div class="modal-dialog" id='modal3'>
            <header class="modal-header">
              <h2>EDITAR USUARIO</h2>
              <button class="close-modal" aria-label="close modal" data-close>X</button>       
            </header>

            <section class="modal-content">
            
              <form action="cambiarClave.php" method="POST">
                Nombre usuario:<br><br>
                <input type="text" name="nombre" value="<?php echo $nombre ?>"><br><br>        
                Nueva contraseña:<br><br>
                <input type="password" name="clave" required><br><br>
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
                        $_SESSION['nombre']=$nombre;
                        exit();
                    }
                }
              ?>
            </section>
            
            <footer class="modal-footer">...</footer>
          </div>
        </div>
        
        <script type="text/javascript">
 function ver(n) {
                 document.getElementById("listamovil").style.display="block"
                 }
                 function ocultar(n) {
                 document.getElementById("listamovil").style.display="none"
                 }    
function validacion() {
  fechaIni = document.getElementById("fechaIni").value;
  fechaLim = document.getElementById("fechaLim").value;
  cuerpo = document.getElementById("cuerpo").value;
  asunto = document.getElementById("asunto").value;

  const alerta4 = document.getElementById("alert4");
 
  const alerta6 = document.getElementById("alertfecha");


  if( (fechaIni == null || fechaIni.length == 0 || /^\s+$/.test(fechaIni))||(fechaLim == null || fechaLim.length == 0 || /^\s+$/.test(fechaLim))||(cuerpo == null || cuerpo.length == 0 || /^\s+$/.test(cuerpo))||(asunto == null || asunto.length == 0 || /^\s+$/.test(asunto)) ) {
  alerta4.classList.add("show");
  return false;
 
}  

  if(fechaLim < fechaIni){
    alerta6.classList.add("show");
  return false;
  }

  




}
function validacionus() {
 
  valor = document.getElementById("nameuser").value;
  email = document.getElementById("mail").value
  clave = document.getElementById("clave").value
  const alerta = document.getElementById("alert1");
  const alerta2 = document.getElementById("alert2");
  const alerta3 = document.getElementById("alert3");
  const alerta4 = document.getElementById("alertclave");

if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  alerta.classList.add("show");
  return false;
 
}
if( email == null || email.length == 0 || /^\s+$/.test(email) ) {
  alerta2.classList.add("show");
  return false;
 
}
if( clave == null || clave.length == 0 || /^\s+$/.test(clave) ) {
  alerta4.classList.add("show");
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

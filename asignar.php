<?php
    session_start();
    
    if(!isset($_SESSION['login'])){
        header('Location: index');
        exit();
    } else{
        // Show users the page
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
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VALIDAR</title>
    <link rel="stylesheet" href="styles/validar.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i%7CLato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link href="img/alcachofa-less.jpg" rel="icon" type="image/x-icon">
</head>
<body>

    <script type="text/javascript">
        function toggleBoxVisibility() {
            if (document.getElementById("check").checked == true) {
            document.getElementById("fProgramar").style.visibility = "visible";
            } else {
                document.getElementById("fProgramar").style.visibility = "hidden";
            }
        }
    </script>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://cpifpbajoaragon.com/"><img style="width:30px;"src="img/logo1.png"> CPIFP BAJO ARAGON</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- To go to the menu -->
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

                <!-- To sign out -->
                <p><?php echo "Hola ".$nombre?> </p>
                <p><a href='logout.php'><i class="fa fa-sign-in"></i> Cerrar sesi??n</a></p>
            </div>
        </nav>
    </header>

    <main>
        <div class="titulo">
            <h1>ASIGNAR</h1>
        </div>
        <div id="containerValidar">
            <?php
                require_once 'Base.php';
                //DataBase connect (Select of certain fields)
                //pasar en vezdel titulo la id de la publicacion
                
                $titulo=$_POST['id'];
                $query="SELECT idPublic, tituloPublic, mensajePublic,fechaInicio,fechaLimite,nombreUser,archivo from PUBLICACION P, USUARIO U where U.idUser=P.idUser and idPublic='$titulo'";
                $resultado=$connection->query($query);
                $num = $resultado->num_rows;
                     
                if ($resultado) {
                    /* fetch associative array */
                    while ($row = $resultado->fetch_assoc()) {
                        
                        $field2name = $row["tituloPublic"];
                        $field3name = $row["mensajePublic"];
                  
                    }
                      
                    echo "<h1>".$field2name."</h1><br>";
                      
                    echo "<p>".$field3name."</p><br>";
                }
                          
                      
                       
                


         ?>
         <p>Pantallas a asignar:</p>
         <form method='post'>
            
                <?php
                $idpublic=$_POST['id'];
               
                    $sql="select nombrePantalla from PANTALLA";
                    $result=$connection->query($sql);
                    if($result){
                        while ($row = $result->fetch_assoc()) {
                            $pantallanombre=$row['nombrePantalla'];
                            echo "<input class='form-check-input' name='pantalla' type='checkbox' value='$pantallanombre'>$pantallanombre<br>";
               
                            
                    }

                }
                ?>
                <input type='text' value='<?php echo $idpublic;?>' name='public'  style='visibility:collapse; position:fixed;'>
                <input type='submit' value='ASIGNAR' name='asignar'>


         </form>
         <?php
         if (isset($_POST['asignar'])) {
                    $public=$_POST['public'];
                    $pantalla=$_POST['pantalla'];
                    // echo $pantalla;
                   $sql2="select idPantalla from PANTALLA where nombrePantalla='$pantalla'";
                   $result1=$connection->query($sql2);
                   if($result1){
                    while ($row = $result1->fetch_assoc()) {
                        $idPan=$row['idPantalla'];
                        
                       
                   }
                  
                }
           
                $fecha=date('y-m-d');
               
                // foreach ($pantalla as $pan) {
                    $sql3="INSERT into ASIGNAR (idPantalla, idPublic) values ('$idPan','$public')";
                    $update="UPDATE PUBLICACION SET validada='1',fechaAutorizacion='$fecha', motivoDenegacion=null where idPublic like '$public'";
                    $result2=$connection->query($sql3);
                    $result3=$connection->query($update);
                // }

                
                if($result2&&$result3){
                    header("Location: menu");
                }
               
        }
?>
            <br><br><br> 
        </div>
    </main>

    <footer class="text-center text-lg-start bg-dark text-muted fixed-bottom">
        <div class="text-center p-2" style="background-color:  white;">
            2022 Copyright: 
            <a class="text-reser fw-bold" target="_blank" href="https://cpifpbajoaragon.com">
                    CPIFP Bajo Arag??n 
            </a>
            <a class="text-reser fw-bold danger" target="_blank" href="https://alcachofa.com">
                Alcachofas 
            </a>
        </div>
    </footer>
</body>
</html>
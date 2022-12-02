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
                <p><a href='logout.php'><i class="fa fa-sign-in"></i> Cerrar sesión</a></p>
            </div>
        </nav>
    </header>

    <main>
        <div class="titulo">
            <h1>VALIDAR</h1>
        </div>
       
            <?php
                require_once 'Base.php';
                //DataBase connect (Select of certain fields)  
                $query="SELECT idPublic,tituloPublic, mensajePublic,fechaInicio,fechaLimite,nombreUser,archivo from PUBLICACION P, USUARIO U where U.idUser=P.idUser and validada='0'";
                $resultado=$connection->query($query);
                $num = $resultado->num_rows;
                        


      
                if ($num>0) {
                    /* fetch associative array */
                    while ($row = $resultado->fetch_assoc()) {
                      
                        $idpublic=$row['idPublic'];
                        $field2name = $row["tituloPublic"];
                        $field3name = $row["mensajePublic"];
                        $fechainicio = $row['fechaInicio'];
                        $field5name = $row['fechaLimite'];
                        $field6name = $row['nombreUser'];
                        $field7name = $row['archivo'];
                        echo  '<div id="containerValidar">';
                        echo "<h1>".$field2name."</h1><br>";
                        echo "<span class='underline center'></span>";
                        echo "<p>".$field3name."</p><br>";
                        echo "<p> fecha publicación: ".$fechainicio."</p><br>";
                        echo "<p> fecha limite: ".$field5name."</p><br>";
                        echo "<p> escrita por ".$field6name."</p><br>";
                        
                        if($field7name!=""){
                            echo "<img id='foto' src='imagenesNoticias/$field7name'>";
                        }
                        echo "<div id='botonesV'>";

                        //Button validate news
                        echo "<form action='asignar.php' method='post'><input type='text' value='$idpublic' name='id'  style='visibility:collapse; position:fixed;'><input id='VALIDAR' type='submit' name='VALIDAR' value='ASIGNAR A PANTALLA'></form>
                              <form method='post' action='denegar.php'>
                              <input type='text' value='$idpublic' name='id'  style='visibility:collapse; position:fixed;'>
                                <input type='submit' id='DENEGAR'  value='DENEGAR' name='DENEGAR'>
                              
                            </form>
                        <br>";
                        echo "</div></div>"; 

                    }    
                }else{
                    echo "<script languaje='javascript'>alert('No hay noticias pendientes de validar');</script>";
                    
                }
            

                // if (isset($_POST['VALIDAR'])) {
                //     $titulo=$_POST['select'];
                //     $fecha=date('y-m-d');
                //     //DataBase connect (Update fields)  
                //     $sql="UPDATE PUBLICACION SET validada='1',fechaAutorizacion='$fecha', motivoDenegacion=null where tituloPublic like '$titulo'";
                //     $resultado1=$connection->query($sql);
                //     if($resultado1){
                //     }     
                // }

                // if (isset($_POST['DENEGAR'])) {   
                //     $motivo="motivogenerico";
                //     $titulo=$_POST['select'];
                //     $fecha=date('y-m-d');
                //     //DataBase connect (Update fields when validad=1)  
                //     $sql="UPDATE PUBLICACION SET validada='-1',fechaAutorizacion='$fecha',motivoDenegacion='$motivo' where tituloPublic like '$titulo'";
                //     $resultado1=$connection->query($sql);   
                //     if($resultado1){
                //     }
                // }
            ?>
                    
            <script type='text/javascript'>
                function mostrar(){                
                    var formulario = document.getElementById('DENEGAR');
                    formulario.style.display = "block";  
                    var formulario1 = document.getElementById('motivo');
                    formulario1.style.display = "block";  
                }
                function nomostrar(){
      
                    var formulario = document.getElementById('DENEGAR');
                    formulario.style.display = "none";  
                    var formulario1 = document.getElementById('motivo');
                    formulario1.style.display = "none";  
                } 
            </script> 
            <br><br><br> 
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
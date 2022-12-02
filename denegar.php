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
    require_once 'Base.php';
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
            <h1>DENEGAR</h1>
        </div>
        <div id="containerValidar">
         <form method='post'>
            
                <?php
                $idpublic=$_POST['id'];
     
                ?>
                Motivo denegacion:<br>
                <input type='text' name='motivo'>
                <input type='text' value='<?php echo $idpublic;?>' name='public' style='visibility:collapse; position:fixed;' >
                <input type='submit' value='DENEGAR' name='denegar'>


         </form>
         <?php
         if (isset($_POST['denegar'])) {
                 $public=$_POST['public'];
                 $motivo=$_POST['motivo'];
                   
                $fecha=date('y-m-d');
                   
                   
                   
                   $sql2="UPDATE PUBLICACION set motivoDenegacion='$motivo', validada='-1', fechaDenegacion='$fecha' where idPublic='$public'";
                   $result1=$connection->query($sql2);
                   if($result1){
              header('Location:menu');
        }else{
            echo "echo no se puede denegar";
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
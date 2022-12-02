<?php
    session_start();
    
    if(!isset($_SESSION['login'])){
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
    <link rel="stylesheet" href="styles/historico.css">
    <title>Historico</title>
    <link href="img/alcachofa-less.jpg" rel="icon" type="image/x-icon">
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
        <div class="titulo">
            <h1>HISTÓRICO</h1>
        </div>
        <div id="container">
            <?php
                // DataBase connection
                require_once 'Base.php';
                $query="SELECT idPublic,tituloPublic, mensajePublic,fechaInicio,fechaLimite,nombreUser,fechaAutorizacion,validada from PUBLICACION P, USUARIO U where P.idUser=U.idUser";
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
                    <th>ESTADO</th>
                    <th></th>
                    <th></th>
                </tr>

                <?php 
                    while($datos=$resultado->fetch_array()){
                        $tituloNo=$datos['tituloPublic'];
                        $public=$datos['idPublic'];

                ?>

                <tr>
                    <td><?php echo $tituloNo?></td>
                    <td><?php echo $datos["mensajePublic"]?></td>
                    <td><?php echo $datos["fechaInicio"]?></td>
                    <td><?php echo $datos["fechaLimite"]?></td>
                    <td><?php echo $datos["nombreUser"]?></td>
                    <td><?php echo $datos["validada"]?></td>
                    <td><form action="verNot" method="post"><input type='text' name='titulo' value='<?php echo $datos["tituloPublic"]?>' style='visibility:collapse; position:fixed;'><button  style='background-color:rgba(0,61,128,255); border-color:rgba(0,61,128,255);' type="submit" class="btn btn-success edit">VER</button></form></td>
                    <td><form method='post'><input type='text' name='nombre' value='<?php echo $public;?>'  style='visibility:collapse; position:fixed;'><button style='background-color:red; border-color:rgba(0,61,128,255);' type='submit' value='ELIMINAR' name='eliminar'  class="btn btn-success edit"><i class="fas fa-trash-alt"></i></button></form></td>
            
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
            </table>

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
           
        </div>
</body>
</html>
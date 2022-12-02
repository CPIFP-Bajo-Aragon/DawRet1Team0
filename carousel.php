
<?php
    
    $connect = mysqli_connect("localhost", "reto1", "reto1", "RetoBBDD");

    function make_query($connect){
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $arp=`arp -n $ipAddress`;
        $string = str_replace(' ', '', $arp);
        $lines=explode(":", $string);
        $first = substr($lines[0], -2).":";
        $last = substr($lines[5], 0, 2);
        
        
        for ($i=1; $i <=4 ; $i++) { 
          $mid .= $lines[$i].":";
        }
       
       $mac = $first.$mid.$last;
        
        $query = "SELECT PU.*, PA.idPantalla, PA.MAC FROM PUBLICACION PU, ASIGNAR A, PANTALLA PA where PU.idPublic = A.idPublic and A.idPantalla = PA.idPantalla and PU.validada = 1 and PA.MAC='$mac' ORDER BY PU.idPublic DESC";

        $result = mysqli_query($connect, $query);
        // print_r(mysqli_fetch_array($result));
        return $result;
    }

 
                
            

            function make_slide_indicators($connect){
                $output = ''; 
                $count = 0;
                $result = make_query($connect);
                while($row = mysqli_fetch_array($result)){
                    if($count == 0){
                        $output .= '
                        <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>';
                    }else{
                        $output .= '<li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>';
                    }
                    $count = $count + 1;
                }
                return $output;
            }

            function make_slides($connect){
                $output = '';
                $count = 0;
                $result = make_query($connect);
                while($row = mysqli_fetch_array($result)){
                    if($count == 0){
                        $output .= '<div class="item active">';
                    }else{
                        $output .= '<div class="item">';
                    }
                    if($row[archivo]!=""){
                        $output .= '
                        <div class="message">
                            <h3>'.$row["tituloPublic"].'</h3>
                            <p>'.$row["mensajePublic"].'</p>
                            <img src="imagenesNoticias/'.$row["archivo"].'"/>
                        </div>
                        </div>';
                    } else{
                        $output .= '
                        <div class="message">
                        <h3>'.$row["tituloPublic"].'</h3>
                        <p>'.$row["mensajePublic"].'</p>
                        </div>
                        </div>    ';
                    }
                    $count = $count + 1;
                }
                return $output;
            }

            session_start();
                
            if(!isset($_SESSION['login'])){

            } else{
                // Show users the page!
            }

            $login=$_SESSION['login'];
            $rol=$_SESSION['rol'];
            $nombre=$_SESSION['nombre'];





?>

<!DOCTYPE html>
<html>
    <head>
        <title>Publicaciones</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="styles/carousel.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta http-equiv='refresh' content='60' />
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="https://cpifpbajoaragon.com/"><img src="img/logo1.png"> CPIFP BAJO ARAGON</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">

                    <?php
                 if(isset($_SESSION['login'])){
                    ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="menu" data-bs-toggle="modal" data-open='modal1'>
                                    <i class="fa fa-home"></i></i>
                                        Inicio
                                </a>
                            </li>
                            <?php
                 }
                    ?>
                        </ul>
                    </div>
               
                    <p><?php echo $nombre?> </p>

                    <?php
                        if(!isset($_SESSION['login'])){
                            echo "<p><a href='index'><i class='fa fa-sign-in'></i> Iniciar sesión</a></p>";
                        } else{
                            echo "    <p> <a href='logout.php'> &nbsp;<i class='fa fa-sign-in'></i> Cerrar sesión</a></p>";
                        }
                    
                        $login=$_SESSION['login'];
                        $rol=$_SESSION['rol'];
                        $nombre=$_SESSION['nombre'];
                    ?>
                </div>
            </nav>
            <div>
                <p>
                <?php
                  $ipAddress=$_SERVER['REMOTE_ADDR'];
                  $arp=`arp -n $ipAddress`;
                  $string = str_replace(' ', '', $arp);
                  $lines=explode(":", $string);
                  $first = substr($lines[0], -2).":";
                  $last = substr($lines[5], 0, 2);
                  
                  
                  for ($i=1; $i <=4 ; $i++) { 
                    $mid .= $lines[$i].":";
                  }
                 
                  $mac = $first.$mid.$last;
                  
        ?>
                </p>
            </div>
        </header>

        <main>
        <?php

$numRows=make_query($connect)->num_rows;


if ($numRows>0) {
    echo '<br/>';
    echo '<div class="container">';
        echo '<h2 align="center">Publicaciones</h2>';
        echo '<br />';
        echo '<div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">';
            echo '<div class="carousel-inner">';
                echo make_slides($connect);
            echo '</div>';
            echo '<ol class="carousel-indicators">';
                echo make_slide_indicators($connect);
            echo '</ol>';
        echo '</div>';
    echo '</div>';

} else{
    echo "<p>No se encuentran publicaciones disponibles por el momento.</p>";
    echo "<div id='clock'>".date(" H : i A")."</div>";
}


?>
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
<body>
</html>
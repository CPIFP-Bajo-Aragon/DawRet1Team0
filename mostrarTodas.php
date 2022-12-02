<?php
session_start();
 
if(!isset($_SESSION['login'])){
    header('Location: index.php');
    exit();
} else {
    // Show users the page!
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todas las Noticias</title>
    <link rel="stylesheet" href="styles/todasN.css">
    
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="#">Features</a>
        <a class="nav-link" href="#">Pricing</a>
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </div>
    </div>
  </div>
</nav>

    </header>
    
    <main>
        
        <div id="containerValidar">
 

                <br>
              

                <h1 style="text-align:center;">NOTICIAS VALIDADAS</h1> 

                <br>
                <br>
                <?php

                  require_once 'Base.php';

                    $query="select tituloPublic, mensajePublic,fechaLimite,nombreUser,archivo, fechaAutorizacion from PUBLICACION P, USUARIO U where U.idUser=P.idUser and validada='1'";
                    $resultado=$connection->query($query);
                    if ($resultado) {

                        /* fetch associative array */
                        while ($row = $resultado->fetch_assoc()) {
                            
                            $field2name = $row["tituloPublic"];
                            $field3name = $row["mensajePublic"];
                            $field5name = $row['fechaLimite'];
                            $field6name = $row['nombreUser'];
                            $field7name = $row['fechaAutorizacion'];
                            $field8name = $row['archivo'];
                        
                            echo "<div id='noticia'>";
                            echo '<h2 id="titulo2">'.$field2name.'</h2>';
                            echo "<p>".$field3name."</p>";
                            if($field8name!="imagenesNoticias/"){
                                echo "<img id='foto' src='$field8name'>";
                            }
                            
                            echo "<p>Escrita por: ".$field6name."</p>";
                           
                            echo "<p>Fecha de validacion: ".$field7name."</p>";

                            //esto de abajo es por si queremos ver las noticias idividualmente

                            echo "<form action='verMas.php' method='post'><select id='invisible'name='select' value='seleccione noticia' required></option>
                            <option name='opcion' selected>$field2name</option><input id='VALIDAR' type='submit' name='MAS' value='Ver más'></form>
                            <br>";
    
                            // echo "<p>".$field4name."</p><br><br>";
                            // echo "<p>".$field5name."</p><br><br>";
                           echo "</div>";
                            
                        }
                        /* free result set */
                        $resultado->free();
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
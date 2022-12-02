<?php
session_start();
 
if(!isset($_SESSION['login'])){
    header('Location: index.php');
    exit();
} else {
    // Show users the page
}

?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/noticia.css">
    <title>Noticias</title>
    <link href="img/alcachofa-less.jpg" rel="icon" type="image/x-icon">
</head>
<body>

    <script type="text/javascript">
        function toggleBoxVisibility() {

            if (document.getElementById("check").checked == true) {

                document.getElementById("fProgramar").style.visibility = "visible";

                } 
            else {

                document.getElementById("fProgramar").style.visibility = "hidden";

                }
        }

    </script>

    <!-- <header>
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
    </header> -->
  
    <main>
        <div id="container">
            <div class="titulo">
                    <h1>CREAR NOTICIA</h1>
            </div>

            <br>
            
            <form ENCTYPE="multipart/form-data" method="post" action="insertarnoticia.php">
                
                Titulo noticia:<br><input name="titulo" type="text" required>
                <br>
                <br>
                Noticia:<br><input name="noticia" type="text" required>
                <br>
                <br>
                Fecha limite:<br><input name="date" type="date" required>
                <br>
                <br>
                <input type="file" class="form-control" id="image" name="archivo" multiple> <br>  
                <br>
                Dirigido a:<br>
                <select id="selectDpto" name="selectDpto" required>
                    <option>informatica</option>
                    <option>electricidad</option>
                    <option>sanidad</option>
                    <option>administrativo</option>
                    <option>automocion</option>
                    <option>secretaria</option>
                    <option>TODOS</option>
                    
                </select>
                <br>
                <label for="check">¿Programar la noticia?</label>
                <br>
                <input type="checkbox" id="check" name="check" onclick="toggleBoxVisibility()">
                <br>
                <input name="fProgramar" id="fProgramar" type="date">
                <br>
                <br>
                <input name="publicar" type="submit" value="PUBLICAR"> 
            </form>
    

            <a href="menu.php">
                <img src="img/backwards.png" id="backwards">
            </a> 

            <a href="logout.php">
                <img src="img/exit.png" id="exit">
            </a> 
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
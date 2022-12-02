<?php
require_once 'Base.php';

              $nombre=$_POST['nombre'];
              $mac=$_POST['mac'];
              $idPantalla=$_POST['idPan'];
              $edit="UPDATE PANTALLA set nombrePantalla='$nombre', MAC='$mac' where idPantalla='$idPantalla'";
              $resultado=$connection->query($edit);
              if($resultado){  
                header('Location:gestionarPantallas');
              }
            
<?php
  header("Content-type: application/pdf");
  header("Content-Disposition: inline; filename=Guardias-Recreo-Octubre.pdf");
  readfile("guardias/Guardias-Recreo-Octubre.pdf");
?>
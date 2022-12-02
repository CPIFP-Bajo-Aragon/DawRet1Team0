<?php

require 'vendor/autoload.php';

$pdf = new spatie/PdfToImage/Pdf('/var/www/html/pdf_to_image/prueba.pdf');


 $numberOfpages = $pdf->getNumberOfPages(); //returns an int

for ($i=0; $i <= $numberOfpages ; $i++) { 
    $fileName = time();
    $pdf->setPage($i)->saveImage("images/$fileName.jpg");
}
echo $i-1 ." pages converted.";
?>
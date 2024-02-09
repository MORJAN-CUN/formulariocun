<?php
$nom_file = $_GET['file'];

$archivo = 'files_generated/'.$nom_file;
//$archivo = $nom_file;

//Generar descarga
header('Content-Disposition: attachment;filename='.$nom_file);
header('Content-Type: application/vnd.ms-excel');
header('Content-Length: '.filesize($archivo));
header('Cache-Control: max-age=0');
readfile($archivo);


?>
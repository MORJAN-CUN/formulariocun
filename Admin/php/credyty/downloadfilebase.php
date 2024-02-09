<?php

$consecutivo = $_GET['cons'];
$nom_archivo = $_GET['nom_arc'];

//$archivo = "files_loads/query_result_2021-08-03T13_31_46.980Z.xlsx";
$archivo = $nom_archivo;

// Nos aseguramos que el archivo exista
if (!file_exists($archivo)) {
    echo "El fichero $archivo no existe";
    exit;
}

// Establecemos el nombre del archivo
header('Content-Disposition: attachment;filename="'. 'Excel_'.date('Y-m-d H:i:s').'.xlsx"');
header('Content-Type: application/vnd.ms-excel');

// Indicamos el tamaño del archivo 
header('Content-Length: '.filesize($archivo));

// Evitamos que sea cachedo 
header('Cache-Control: max-age=0');

// Realizamos la salida del fichero
readfile($archivo);

// Fin del cuento
exit;
?>
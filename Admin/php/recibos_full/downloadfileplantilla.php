<?php

$nom_archivo = "files_generated/Plantilla_Cedula.xlsx";
$archivo = $nom_archivo;

// Nos aseguramos que el archivo exista
if (!file_exists($archivo)) {
    echo "El fichero $archivo no existe";
    exit;
}

// Establecemos el nombre del archivo
header('Content-Disposition: attachment;filename="'. 'Plantilla_Cedula_'.date('Y-m-d H:i:s').'.xlsx"');
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
<?php

$id = $_POST['id'];
$nombre_meta = $_POST['nombre_meta'];
$modalidad = $_POST['modalidad'];
$programa = $_POST['programa'];
$nivel = $_POST['nivel'];
$ciclo = $_POST['ciclo'];
$tipo_alumno = $_POST['tipo_alumno'];
$valor_ingresos = $_POST['valor_ingresos'];
$cantidad_estudiantes = $_POST['cantidad_estudiantes'];

//Enviar por cURL

$url = 'http://190.184.202.251:8090/formularioback/Admin/metas/UpdateUnidadNegocio.php';
//$url = 'http://localhost/CUN/formularioback/Admin/metas/UpdateUnidadNegocio.php';

$datos = array(
    'id' => $id,
    'nombre_meta' => $nombre_meta,
    'modalidad' => $modalidad,
    'programa' => $programa,
    'nivel' => $nivel,
    'ciclo' => $ciclo,
    'tipo_alumno' => $tipo_alumno,
    'valor_ingresos' => $valor_ingresos,
    'cantidad_estudiantes' => $cantidad_estudiantes
);

//Iniciar cURL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);

//curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


$result = curl_exec($ch);

curl_close($ch);

echo $result;

?>
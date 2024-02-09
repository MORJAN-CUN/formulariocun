<?php

$nombre_meta = $_POST['nombre_meta'];
$clase_ingreso = $_POST['clase_ingreso'];
$tipo_ingreso = $_POST['tipo_ingreso'];
$regional = $_POST['regional'];
$sede = $_POST['sede'];
$modalidad = $_POST['modalidad'];
$programa = $_POST['programa'];
$nivel = $_POST['nivel'];
$ciclo = $_POST['ciclo'];
$tipo_alumno = $_POST['tipo_alumno'];
$grupo = $_POST['grupo'];
$valor_meta = $_POST['valor_meta'];
$cantidad_meta = $_POST['cantidad_meta'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/metas/CrearTipoMeta.php';
//$url = 'http://localhost/CUN/formularioback/Admin/metas/CrearTipoMeta.php';

$datos = array(
    'nombre_meta' => $nombre_meta,
    'clase_ingreso' => $clase_ingreso,
    'tipo_ingreso' => $tipo_ingreso,
    'regional' => $regional,
    'sede' => $sede,
    'modalidad' => $modalidad,
    'programa' => $programa,
    'nivel' => $nivel,
    'ciclo' => $ciclo,
    'tipo_alumno' => $tipo_alumno,
    'grupo' => $grupo,
    'valor_meta' => $valor_meta,
    'cantidad_meta' => $cantidad_meta
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
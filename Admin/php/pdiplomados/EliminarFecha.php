<?php
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula = $data_empleado['cedula'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/pdiplomados/EliminarFecha.php';
//$url = 'http://localhost/CUN/formularioback/Admin/pdiplomados/EliminarFecha.php';

$id_detalle = $_POST['id_detalle'];
$secuencia_cab = $_POST['secuencia_cab'];

$datos = array(
    'id_detalle' => $id_detalle,
    'secuencia_cab' => $secuencia_cab,
    'id_usu' => $id_usu,
    'cedula' => $cedula
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

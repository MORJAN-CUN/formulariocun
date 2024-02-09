<?php
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula = $data_empleado['cedula'];

$cedula_estudiante = $_POST['cedula'];
$periodo = $_POST['periodo'];
$nota_debito = $_POST['nota_debito'];
$fecha_vencimiento = $_POST['fecha_vencimiento'];


$url = 'http://190.184.202.251:8090/formularioback/Admin/fechas_cartera/UpdateFecha.php';
//$url = 'http://localhost/formularioback/Admin/fechas_cartera/UpdateFecha.php';

$datos = array(
    'cedula_estudiante' => $cedula_estudiante,
    'periodo' => $periodo,
    'nota_debito' => $nota_debito,
    'fecha_vencimiento' => date('d-m-Y', strtotime($fecha_vencimiento)),
    'id_usu' => $id_usu,
    'cedula' => $cedula
);


//Iniciar cURL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);

echo $result;


?>
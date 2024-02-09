<?php
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula_aud = $data_empleado['cedula'];
$valor_orden_act = $_POST['valor_orden_act'];
$valor_idiomas_act = $_POST['valor_idiomas_act'];


$id_orden = $_POST['id_orden'];
$documento = $_POST['documento'];
$cedula = $_POST['cedula'];
$valor_orden = $_POST['valor_orden'];
$valor_idiomas = $_POST['valor_idiomas'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/recibos_full/UpdateValoresOrden.php';
//$url = 'http://localhost/CUN/formularioback/Admin/recibos_full/UpdateValoresOrden.php';

$id_orden = trim($id_orden);

$datos = array(
    'orden' => $id_orden,
    'documento' => $documento,
    'cedula_aud' => $cedula_aud,
    'valor_orden' => $valor_orden,
    'valor_idiomas' => $valor_idiomas,
    'id_usu' => $id_usu,
    'cedula' => $cedula,
    'valor_orden_act' => $valor_orden_act,
    'valor_idiomas_act' => $valor_idiomas_act
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
<?php
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula = $data_empleado['cedula'];
$valor_orden_act = $_POST['valor_orden_act'];

$orden = $_POST['orden'];
$documento = $_POST['documento'];
$valor_orden = $_POST['valor_orden'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/recibos_full/Update_Orden.php';
//$url = 'http://localhost/CUN/formularioback/Admin/recibos_full/Update_Orden.php';

$orden = trim($orden);

$datos = array(
    'orden' => $orden,
    'documento' => $documento,
    'valor_orden' => $valor_orden,
    'id_usu' => $id_usu,
    'cedula' => $cedula,
    'valor_orden_act' => $valor_orden_act
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
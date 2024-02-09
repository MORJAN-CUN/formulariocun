<?php
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula = $data_empleado['cedula'];

//Enviar por cURL
$url = 'http://190.184.202.251:8090/formularioback/Admin/facturacione/CargarMovMes.php';
//$url = 'http://localhost/CUN/formularioback/Admin/facturacione/CargarMovMes.php';

$factura = $_POST['factura'];

$datos = array(
    'factura' => $factura,
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

if($result == 1){

	$data = array(
		'status' => 1,
		'message' => 'Ejecutado correctamente'
	);

}else{

	$data = array(
		'status' => 0,
		'message' => 'Error ejecutando el proceso'
	);

}

echo json_encode($data);

?>
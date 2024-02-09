<?php

$id = $_POST['id'];
$periodo = $_POST['periodo'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/metas/ConsDatosTot.php';
//$url = 'http://localhost/formularioback/Admin/metas/ConsDatosTot.php';

$datos = array(
    'id' => $id,
    'periodo' => $periodo
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

$data = json_decode($result,true);

$res = $data[0];

$cantidad = $res['CANTIDAD'];
$valor = $res['VALOR'];
$val_new = number_format($valor);

$array_new = array(
	'cantidad' => $cantidad,
	'valor' => $val_new
);

echo json_encode($array_new);

?>
<?php

$id_periodo = $_POST['id_periodo'];
$periodo = $_POST['periodo'];
$tipo_financiacion = $_POST['tipo_financiacion'];
$fecha_registro = $_POST['fecha_registro'];
$fecha_final = $_POST['fecha_final'];
$periodo_idiomas = $_POST['periodo_idiomas'];
$numero_cuotas = $_POST['numero_cuotas'];
$porc_a_pagar = $_POST['porc_a_pagar'];
$periodoedit_antes = $_POST['periodoedit_antes'];
$tipofinanciacionedit_antes = $_POST['tipofinanciacionedit_antes'];

$datos = array(
	'id_periodo' => $id_periodo,
	'periodo' => $periodo,
	'tipo_financiacion' => $tipo_financiacion,
	'fecha_registro' => $fecha_registro,
	'fecha_final' => $fecha_final,
	'periodo_idiomas' => $periodo_idiomas,
	'numero_cuotas' => $numero_cuotas,
	'porc_a_pagar' => $porc_a_pagar,
	'periodoedit_antes' => $periodoedit_antes,
	'tipofinanciacionedit_antes' => $tipofinanciacionedit_antes
);

$url = 'http://190.184.202.251:8090/formularioback/Admin/Promociones/UpdatePeriodo.php';
//$url = 'http://localhost/CUN/formularioback/Admin/Promociones/UpdatePeriodo.php';

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

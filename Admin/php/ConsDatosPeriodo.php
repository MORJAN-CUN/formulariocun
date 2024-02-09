<?php
$id_periodo = $_POST['id_periodo'];

//Enviar ID por cURL para consultar datos del empleado

$url = 'http://190.184.202.251:8090/formularioback/Admin/Promociones/DatosPeriodo.php';
//$url = 'http://localhost/CUN/formularioback/Admin/Promociones/DatosPeriodo.php';

$datos = array(
	'id' => $id_periodo
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

$data_empleado = json_decode($result,true);

$datos_periodo = $data_empleado[0];


//Extraer datos

$periodo = $datos_periodo['PERIODO'];
$tipo_promocion = $datos_periodo['TIPO_PROMOCION'];
$periodo_idiomas = $datos_periodo['PERIODO_IDIOMAS'];
$numero_cuotas = $datos_periodo['NUMERO_CUOTAS'];
$porc_a_pagar = $datos_periodo['PORC_A_PAGAR'];
$id = $datos_periodo['ID'];
//$estado = $datos_periodo['ESTADO'];

//Formatear fecha registro
$fecha_registro = $datos_periodo['FECHA_REGISTRO'];
$aniofr = '20'.substr($fecha_registro, -2);
$mesfr =  substr($fecha_registro, 3, 2);
$diafr =  substr($fecha_registro, 0, 2);
$fechafinal_registro = $aniofr.'-'.$mesfr.'-'.$diafr;


//Formatear fecha final
$fecha_final = $datos_periodo['FECHA_FINAL'];
$anioff = '20'.substr($fecha_final, -2);
$mesff =  substr($fecha_final, 3, 2);
$diaff =  substr($fecha_final, 0, 2);
$fechafinal_final = $anioff.'-'.$mesff.'-'.$diaff;

$datos = array(
	'PERIODO' => $periodo,
	'TIPO_PROMOCION' => $tipo_promocion,
	'FECHA_REGISTRO' => $fechafinal_registro,
	'FECHA_FINAL' => $fechafinal_final,
	'PERIODO_IDIOMAS' => $periodo_idiomas,
	'NUMERO_CUOTAS' => $numero_cuotas,
	'PORC_A_PAGAR' => $porc_a_pagar
);


echo json_encode($datos);

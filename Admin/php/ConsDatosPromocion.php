<?php
$id_promocion = $_POST['id_promocion'];
//$id_promocion = '480';
//Enviar ID por cURL para consultar datos del empleado

$url = 'http://190.184.202.251:8090/formularioback/Admin/Promociones/DatosPromocion.php';
//$url = 'http://localhost/CUN/formularioback/Admin/Promociones/DatosPromocion.php';

$datos = array(
	'id_promocion' => $id_promocion
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

$resul_general = json_decode($result,true);

$datos_promocion = $resul_general[0];
//Validacion de que trae los datos
//print_r ($datos_promocion);


//Extraer datos

$secuencia = $datos_promocion['SECUENCIA'];
$estado = $datos_promocion['ESTADO'];
$tipo_promocion = $datos_promocion['TIPO_PROMOCION'];
$periodo = $datos_promocion['PERIODO'];
$periodo_idiomas = $datos_promocion['PERIODO_IDIOMAS'];
$programa = $datos_promocion['PROGRAMA'];
$ciclo = $datos_promocion['CICLO'];
$tipo_inscripcion = $datos_promocion['TIPO_INSCRIPCION'];
$valor_matricula = $datos_promocion['VALOR_MATRICULA'];
$numero_cuotas = $datos_promocion ['NUMERO_CUOTAS'];
$valor_idiomas = $datos_promocion['VALOR_IDIOMAS'];
$valor_servicio = $datos_promocion['VALOR_SERVICIO'];
$cuotas = $dvalor_matriculaatos_promocion['NUMERO_CUOTAS'];
$porc_matricula = $datos_promocion['PORC_MATRICULA'];
$porc_idiomas = $datos_promocion['PORC_IDIOMAS'];
$val_traslado_matricula = $datos_promocion['VAL_TRASLADO_MATRICULA'];
$val_traslado_idioma = $datos_promocion['VAL_TRASLADO_IDIOMAS'];
$val_prom_beneficiario = $datos_promocion['VAL_PROM_BENEFICIARIO'];
$es_cun_vive = $datos_promocion['ES_CUN_VIVE'];
$es_2x1 = $datos_promocion['ES_2X1'];

//Formatear fecha registro
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
$fecha_registro = $datos_promocion ['FECHA_REGISTRO'];
$fechafinal_registro = strftime("%Y/%m/%d", strtotime($fecha_registro));

$datos = array(
	'ESTADO' => $estado,
	'FECHA_REGISTRO' => $fechafinal_registro,
	'TIPO_PROMOCION' => $tipo_promocion,
	'PERIODO' => $periodo,
	'PERIODO_IDIOMAS' => $periodo_idiomas,
	'PROGRAMA' => $programa,
	'CICLO' => $ciclo,
	'TIPO_INSCRIPCION' => $tipo_inscripcion,
	'NUMERO_CUOTAS' => $numero_cuotas,
	'VALOR_MATRICULA' => $valor_matricula,
	'VALOR_IDIOMAS' => $valor_idiomas,
	'VALOR_SERVICIO' => $valor_servicio,
	'ES_CUN_VIVE' => $es_cun_vive,
	'ES_2X1' => $es_2x1,
	'PORC_MATRICULA' => $porc_matricula,
	'PORC_IDIOMAS' => $porc_idiomas
);


echo json_encode($datos);


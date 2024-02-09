<?php

$id_promocion = $_POST['id_promocion'];
$estado = $_POST['estado'];
$fecha_registro = $_POST['fecha_registro'];
$tipo_promocion = $_POST['tipo_promocion'];
$periodo = $_POST['periodo'];
$periodo_idiomas = $_POST['periodo_idiomas'];
$programa = $_POST['programa']; 
$ciclo = $_POST['ciclo'];
$tipo_inscripcion = $_POST['tipo_inscripcion'];
$numero_cuotas = $_POST['numero_cuotas'];
$valor_matricula = $_POST['valor_matricula'];
$valor_idiomas = $_POST['valor_idiomas'];
$valor_servicio = $_POST['valor_servicio'];
$porc_matricula = $_POST['porc_matricula'];
$porc_idiomas = $_POST['porc_idiomas'];
$es_cun_vive = $_POST['es_cun_vive'];
$es_2x1 = $_POST['es_2x1'];
$tipoPromocionedit_antes = $_POST['tipoPromocionedit_antes'];
$periodoedit_antes = $_POST['periodoedit_antes'];
$periodoIdiomasedit_antes = $_POST['periodoIdiomasedit_antes'];
$programaedit_antes = $_POST['programaedit_antes'];
$cicloedit_antes = $_POST['cicloedit_antes'];
$tipoInscripcionedit_antes = $_POST['tipoInscripcionedit_antes'];


$datos = array(
	'id_promocion' => $id_promocion,
	'estado' => $estado,
	'fecha_registro' => $fecha_registro,
	'tipo_promocion' => $tipo_promocion,
	'periodo' => $periodo,
	'periodo_idiomas' => $periodo_idiomas,
	'programa' => $programa,
	'ciclo' => $ciclo,
	'tipo_inscripcion' => $tipo_inscripcion,
	'numero_cuotas' => $numero_cuotas,
	'valor_matricula' => $valor_matricula,
	'valor_idiomas' => $valor_idiomas,
	'valor_servicio' => $valor_servicio,
	'porc_matricula' => $porc_matricula,
	'porc_idiomas' => $porc_idiomas,
	'es_cun_vive' => $es_cun_vive,
	'es_2x1' => $es_2x1,
	'tipoPromocionedit_antes' => $tipoPromocionedit_antes,
	'periodoedit_antes' => $periodoedit_antes,
	'periodoIdiomasedit_antes' => $periodoIdiomasedit_antes,
	'programaedit_antes' => $programaedit_antes,
	'cicloedit_antes' => $cicloedit_antes,
	'tipoInscripcionedit_antes' => $tipoInscripcionedit_antes
);
//print_r ($datos);
//exit;

$url = 'http://190.184.202.251:8090/formularioback/Admin/Promociones/UpdatePromocion.php';
//$url = 'http://localhost/CUN/formularioback/Admin/Promociones/UpdatePromocion.php';

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
//print_r ($result);

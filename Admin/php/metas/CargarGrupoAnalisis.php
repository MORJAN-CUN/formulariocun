<?php
setlocale(LC_ALL, 'es_CO.UTF-8');

//Enviar por cURL
$url = 'http://190.184.202.251:8090/formularioback/Admin/metas/ConsGrupoAnalisis.php';
//$url = 'http://localhost/CUN/formularioback/Admin/metas/ConsGrupoAnalisis.php';

$datos = array(
    'id' => null
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

$data = json_decode($result);

function getMes($monthNum){

	$dateObj   = DateTime::createFromFormat('!m', $monthNum);
	$monthName = strftime('%B', $dateObj->getTimestamp());
	return $monthName;

}



?>

<select class="form-control">
	<option value="">Seleccionar</option>
	<?php

	foreach ($data as $key){
		
		$semana = $key->COMPARA_GRUPO;
		$fecha_inicio = $key->INICIO;
		//obtener dias y mes
		$ini_mes = substr($fecha_inicio, 0, 2);
		$ini_dia = substr($fecha_inicio, 2, 4);
		$fecha_inicio = getMes($ini_mes). ' - '.$ini_dia;

		$fecha_fin = $key->FINAL;
		//obtener dias y mes
		$fin_mes = substr($fecha_fin, 0, 2);
		$fin_dia = substr($fecha_fin, 2, 4);
		$fecha_fin = getMes($fin_mes). ' - '.$fin_dia;

		$rango_fecha = $fecha_inicio.' a '.$fecha_fin;

		?>
		<option value="<?php echo $key->COMPARA_GRUPO; ?>"><?php echo $key->COMPARA_GRUPO.'      '.$rango_fecha; ?></option>
		<?php
	}

	?>
</select>

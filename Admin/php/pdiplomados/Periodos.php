<?php
setlocale(LC_ALL, 'es_CO.UTF-8');

//Enviar por cURL
$url = 'http://190.184.202.251:8090/formularioback/Admin/pdiplomados/PeriodosActivos.php';
//$url = 'http://localhost/CUN/formularioback/Admin/pdiplomados/PeriodosActivos.php';

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


?>

<select class="form-control">
	<option value="">Seleccionar</option>
	<?php

	foreach ($data as $key){

		$periodo = $key->periodo;

		if (strpos($periodo, 'E') !== false) {
		    ?>
			<option value="<?php echo $periodo; ?>"><?php echo $periodo; ?></option>
			<?php
		}
	}

	?>
</select>

<?php

$url = 'http://190.184.202.251:8090/formularioback/Admin/usabilidad_correo/ConsultarEstudiantes.php';
//$url = 'http://localhost/formularioback/Admin/usabilidad_correo/ConsultarEstudiantes.php';

$periodo = $_POST['periodo'];

$datos = array(
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

?>

<table class="table table-vcenter table-mobile-md card-table" id="Tabla">
  <thead>
    <tr>
	    <th>#</th>
	    <th>Correo</th>
	    <th>Nombre</th>
	    <th>Ultimo Acceso</th>
    </tr>
  </thead>
  <tbody>

  	<?PHP
    $cont = 0;
  	foreach ($data as $key){
  	$cont++;

  	$fecha = $key['ULT_ACCESO'];
  
		if(($timestamp = strtotime($fecha)) === false){
		    $ultimo_login = 'Desconocido';
		}else{
		    $fecha_ult = date('Y-m-d', $timestamp);

		    if($fecha_ult == '1970-01-01'){
		    		$ultimo_login = 'No ha ingresado';
		    }else if($fecha_ult == null || $fecha_ult == '' || empty($fecha_ult)){
		    		$ultimo_login = 'Desconocido';
		    }else{
		    		$ultimo_login = $fecha_ult;
		    }

		}
		  		?>

  		<tr>
	  		<td style="font-size:13px;"><?php echo $cont; ?></td>
				<td style="font-size:13px;"><?php echo $key['EMAIL']; ?></td>
				<td style="font-size:13px;"><?php echo $key['NOMBRE_ESTUDIANTE']; ?></td>
				<td style="font-size:13px;"><?php echo $ultimo_login; ?></td>
      </tr> 

  		<?php
  	}

  	?>

  </tbody>
</table>


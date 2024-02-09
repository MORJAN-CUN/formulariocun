<?php
setlocale(LC_ALL, 'es_CO.UTF-8');

$url = 'http://190.184.202.251:8090/formularioback/Admin/metas/ConsGrupoAnalisisTot.php';
//$url = 'http://localhost/formularioback/Admin/metas/ConsGrupoAnalisisTot.php';

$unidad_negocio = $_POST['unidad_negocio'];
$periodo = $_POST['periodo'];

$datos = array(
    'unidad_negocio' => $unidad_negocio,
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

function getMes($monthNum){

	$dateObj   = DateTime::createFromFormat('!m', $monthNum);
	$monthName = strftime('%B', $dateObj->getTimestamp());
	return $monthName;

}

?>


<table class="table table-vcenter table-mobile-md card-table" id="Tabla" style="font-size:12px;">
  <thead>
    <tr>
    	<th>Periodo</th>
	    <th>Grupo Analisis</th>
	    <th>Meta estudiantes</th>
	    <th>Meta Ingreso</th>
	    <th>Buscar</th>
	    <th>Eliminar</th>
    </tr>
  </thead>
  <tbody>

  	<?PHP

  	foreach ($data as $key){
  		
  		if (array_key_exists('GRUPO', $key)) {
			  $grupo_analisis = $key['GRUPO'];
			}else{
				$grupo_analisis = '';
			}

			if (array_key_exists('TOTAL_META', $key)) {
			  $total_meta = $key['TOTAL_META'];
			}else{
				$total_meta = '';
			}

			if (array_key_exists('TOTAL_ESTUDIANTES', $key)) {
			  $total_estudiantes = $key['TOTAL_ESTUDIANTES'];
			}else{
				$total_estudiantes = '';
			}

			$fecha_inicio = $key['INICIO'];
			//obtener dias y mes
			$ini_mes = substr($fecha_inicio, 0, 2);
			$ini_dia = substr($fecha_inicio, 2, 4);
			$fecha_inicio = getMes($ini_mes). ' - '.$ini_dia;

			$fecha_fin = $key['FINAL'];
			//obtener dias y mes
			$fin_mes = substr($fecha_fin, 0, 2);
			$fin_dia = substr($fecha_fin, 2, 4);
			$fecha_fin = getMes($fin_mes). ' - '.$fin_dia;

			$rango_fecha = $fecha_inicio.' a '.$fecha_fin;


  		?>

  			<tr>
  				<td style="font-weight: normal;"><?php echo $key['PERIODO']; ?></td>
  				<td style="font-weight: normal;"><?php echo $grupo_analisis.'      '.$rango_fecha;  ?></td>
  				<td style="font-weight: normal;"><?php echo $total_estudiantes; ?></td>
  				<td style="font-weight: normal;"><?php echo number_format($total_meta); ?></td>
  				<td style="font-weight: normal;">
  					<input type="button" value="Buscar" class="btn btn-info" onclick='ConsultarMetas(<?php echo json_encode($key); ?>)' style="font-size: 12px;">
  				</td>
  				<td>
  					<input type="button" value="Eliminar" class="btn btn-danger" onclick='EliminarGrupoA(<?php echo json_encode($key); ?>)'  style="font-size: 12px;">
  				</td>
        </tr> 

  		<?php
  	}

  	?>

  </tbody>
</table>

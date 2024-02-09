<?php

$registros = $_POST['registros'];
$periodo_new = $_POST['periodo_new'];
$periodo_ant = $_POST['periodo_ant'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/Promociones/InsertFinanciacionMasiva.php';
//$url = 'http://localhost/CUN/formularioback/Admin/Promociones/InsertFinanciacionMasiva.php';

$datos = array(
	'registros' => $registros,
	'periodo' => $periodo_new
);

//Iniciar cURL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);

$data = json_decode($result,true);


//Recorrer array
?>
<table class="table table-vcenter table-mobile-md card-table" id="TablaResultFnMs">
      <thead>
        <tr>
          <th>Secuencia</th>
          <th>Periodo Anterior</th>
          <th>Periodo Nuevo</th>
          <th>Estado</th>
          <th>Mensaje</th>
        </tr>
      </thead>
      <tbody>
<?php

foreach($data as $result){

	$status = $result['status'];

	if($status == 1){
		$estado = 'Exito';
	}else{
		$estado = 'Error';
	}

	?>	
	<tr>
		<td data-label="Secuencia">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium" style="font-size:10px;">
	                	<?php echo $result['secuencia_ant']; ?>
	                </div>
	            </div>
            </div>
	    </td>

	    <td data-label="Secuencia">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium" style="font-size:10px;">
	                	<?php echo $periodo_ant ?>
	                </div>
	            </div>
            </div>
	    </td>

	    <td data-label="Secuencia">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium" style="font-size:10px;">
	                	<?php echo $result['periodo_new']; ?>
	                </div>
	            </div>
            </div>
	    </td>

	    <td data-label="Secuencia">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium" style="font-size:10px;">
	                	<?php echo $estado; ?>
	                </div>
	            </div>
            </div>
	    </td>

	    <td data-label="Secuencia">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium" style="font-size:10px;">
	                	<?php echo $result['message']; ?>
	                </div>
	            </div>
            </div>
	    </td>


    </tr>
    <?php

}

?>
</tbody>
</table>

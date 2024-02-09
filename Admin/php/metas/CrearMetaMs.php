<?php
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula = $data_empleado['cedula'];

$registros = $_POST['registros'];
$registros_selec = $_POST['registros_selec'];

$unidad_negocio = $_POST['unidad_negocio'];
$periodo_destino = $_POST['periodo_destino'];
$grupo_analisis = $_POST['grupo_analisis'];

$reg_array_select = explode(',', $registros_selec);

$reg_array = explode("+", $registros);

$array_melo = array_chunk($reg_array, 14);

$array_full_hd = array();
	
//Recorrer tabla

foreach ($array_melo as $key){
		
		if(in_array($key[1], $reg_array_select)){
				array_push($array_full_hd, $key);
		}

}

$array_json = json_encode($array_full_hd);

$url = 'http://190.184.202.251:8090/formularioback/Admin/metas/CrearMetaMs.php';
//$url = 'http://localhost/formularioback/Admin/metas/CrearMetaMs.php';

$datos = array(
	'registros' => $array_json,
	'unidad_negocio' => $unidad_negocio,
	'periodo' => $periodo_destino,
	'grupo_analisis' => $grupo_analisis,
	'id_usu' => $id_usu,
  'cedula' => $cedula
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
          <th>Id</th>
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
	                	<?php echo $result['id']; ?>
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

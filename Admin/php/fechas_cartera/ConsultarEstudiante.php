<?php

$url = 'http://190.184.202.251:8090/formularioback/Admin/fechas_cartera/DatosEstudiante.php';
//$url = 'http://localhost/formularioback/Admin/fechas_cartera/DatosEstudiante.php';

$cedula = $_POST['cedula'];

$datos = array(
    'cedula' => $cedula
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
	
<div class="table-responsive">
<table class="table table-vcenter table-mobile-md card-table">
  <thead>
    <tr>
      <th>Cedula estudiante</th>
      <th>Periodo</th>
      <th>Nota debito</th>
      <th>Descripcion</th>
      <th>Valor total</th>
      <th>Fecha vencimiento</th>
      <th>Editar</th>
    </tr>
  </thead>
  <tbody>

<?php
foreach($data as $key){

	?>
	<tr>
		<td><?php echo $key['CLIENTE']; ?></td>
		<td><?php echo $key['PERIODO']; ?></td>
		<td><?php echo $key['NOTA_DEBITO']; ?></td>
		<td><?php echo $key['DESCRIPCION']; ?></td>
		<td><?php echo number_format($key['VALOR_TOTAL']); ?></td>
		<td><?php echo $key['FECHA_VENCIMIENTO']; ?></td>
		<td><input type="button" class="btn btn-warning" value="Editar" onclick='EditarFecha(<?php echo json_encode($key); ?>);'></td>
	</tr>
	<?php
}

?>

</tbody>
</table>
</div>

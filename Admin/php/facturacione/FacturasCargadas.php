<?php
include 'DatosFactura.php';
error_reporting(0);

$url = 'http://190.184.202.251:8090/formularioback/Admin/facturacione/FacturasCargadas.php';
//$url = 'http://localhost/CUN/formularioback/Admin/facturacione/FacturasCargadas.php';

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

$data = json_decode($result,true);

?>
<table class="table table-vcenter table-mobile-md card-table" id="Tabla">
      <thead>
        <tr>
        	<th>Factura</th>
        	<th>Periodo</th>
        	<th>Cliente</th>
        	<th>Documento</th>
        	<th>Descripcion</th>
        	<th>Valor total</th>
        	<th>Fecha cargue</th>
        </tr>
      </thead>
      <tbody>

<?php 
	
	foreach ($data as $key){
		
		$num_factura = $key['FACTURA'];

		$datos_fac = getDatos($num_factura);

		$periodo = $datos_fac['PERIODO'];
		$cliente = $datos_fac['CLIENTE'];
		$documento = $datos_fac['DOCUMENTO'];
		$descripcion = $datos_fac['DESCRIPCION'];
		$valor_bruto = $datos_fac['VALOR_BRUTO'];
		$valor_total = $datos_fac['VALOR_TOTAL'];
		$fecha_cargue = $key['FECHA'];

		?>

		<tr>
				<td style="font-size:12px;"><?php echo $num_factura; ?></td>
				<td style="font-size:12px;"><?php echo $periodo; ?></td>
				<td style="font-size:12px;"><?php echo $cliente; ?></td>
				<td style="font-size:12px;"><?php echo $documento; ?></td>
				<td style="font-size:10px;"><?php echo $descripcion; ?></td>
				<td style="font-size:12px;">$<?php echo number_format($valor_total); ?></td>
				<td style="font-size:12px;"><?php echo $fecha_cargue; ?></td>
	    </tr>


		<?php
	}

?>



</tbody>
</table>

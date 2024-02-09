<?php
$user = "iceberg"; 
$password = "t3zsjuvGee";
$connection_strg = "172.16.1.175:1521/sig";
$db_conn = oci_connect($user, $password, $connection_strg,'AL32UTF8');

    if(!$db_conn) {
            die("No se pudo establecer la conexion");
    }


$identificacion = $_POST['identificacion'];

$query = "SELECT 
						 A.FECHA, 
						 A.IDENTIFICACION, 
						 A.REFERENCIA,
						 A.DESCRIPCION,
						 A.CODIGO,
						 B.EMAIL,
						 B.PRODUCTO 
						 FROM
						 ICEBERG.CUNT_VALIDACION_CERTIFICADOS A
						 INNER JOIN ICEBERG.CUNT_CERTIFICADOS_X_PERIODO B ON A.IDENTIFICACION = B.IDENTIFICACION 
						 WHERE A.IDENTIFICACION = '$identificacion'
						 ORDER BY A.FECHA DESC";



$consult = oci_parse($db_conn, $query);

oci_execute($consult);

$respuesta = [];


while($rot = oci_fetch_array($consult, OCI_BOTH)) {
 	$data = [
 				'fecha' => $rot['FECHA'],
 				'identificacion' => $rot['IDENTIFICACION'],
 				'orden' => $rot['REFERENCIA'],
 				'descripcion' => $rot['DESCRIPCION'],
 				'referencia' => $rot['CODIGO'],
 				'email' => $rot['EMAIL'],
 				'producto' => $rot['PRODUCTO']
 			 ];
 	array_push($respuesta,$data);   
}

if(count($respuesta) > 0){


?>
<center>
  <br>
  <h3>Certificados Emitidos</h3>
</center>

<div class="table-responsive">
<table class="table table-vcenter table-mobile-md card-table">
  <thead>
    <tr>
      <th>Fecha de Emisión</th>
      <th>Identificacion</th>
      <th>Nro de Orden</th>
      <th>Descripción</th>
      <th>Código de Referencia</th>
      <th>Enviado</th>
      <th>Archivo</th>

    </tr>
  </thead>
  <tbody>

	<tr>
		<?php 
			for ($i=0; $i < count($respuesta) ; $i++) { 
				$data = explode('-',$respuesta[$i]['orden']);
			?>
		<td><?php echo $respuesta[$i]['fecha'];  ?></td>
		<td><?php echo $respuesta[$i]['identificacion'];  ?></td>
		<td><?php echo $respuesta[$i]['orden'];  ?></td>
		<td><?php echo $respuesta[$i]['descripcion'];  ?></td>
		<td><?php echo $respuesta[$i]['referencia'];  ?></td>
		<td><?php echo $respuesta[$i]['email'];  ?></td>
		<td><a href="<?php echo 'http://plataformas.cun.edu.co:8090/certificados/backend/pdf_output/'.$respuesta[$i]['identificacion'].'_'.$data[0].'_'.$data[1].'.pdf'; ?>" target="_blank">Archivo</a> </td>
	</tr>
	<?php }?>

  </tbody>
</table>
</div>
<?php 
}else{

?>
	<br>
	<center>No hay datos</center>
<?php }?>
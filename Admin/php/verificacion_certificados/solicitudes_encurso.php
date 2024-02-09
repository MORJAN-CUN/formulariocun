<?php

$user = "iceberg"; 
$password = "t3zsjuvGee";
$connection_strg = "172.16.1.175:1521/sig";
$db_conn = oci_connect($user, $password, $connection_strg,'AL32UTF8');

    if(!$db_conn) {
            die("No se pudo establecer la conexion");
    }


$identificacion = $_POST['identificacion'];


$query = "SELECT DISTINCT 
					 A.IDENTIFICACION,
					 A.NOMBRES,
					 A.APELLIDOS,
					 A.EMAIL,
					 A.TELEFONO,
					 A.MOVIL,
					 A.DIRECCION,
					 A.PRODUCTO,
					 A.PERIODO,
					 B.DOCUMENTO,
					 B.ORDEN,
					 B.FECHA_ORDEN,
					 B.DESCRIPCION
				 FROM ICEBERG.CUNT_CERTIFICADOS_X_PERIODO A
				 INNER JOIN ORDEN B ON A.IDENTIFICACION = B.CLIENTE_SOLICITADO
				 WHERE A.IDENTIFICACION ='$identificacion'
				 AND A.CANTIDAD = '0'
				 AND B.DOCUMENTO = 'FTV'";

$consult = oci_parse($db_conn, $query);

oci_execute($consult);

$respuesta = [];

while($rot = oci_fetch_array($consult, OCI_BOTH)) {
 	$data = [
 				'identificacion' => $rot['IDENTIFICACION'],
 				'nombres' => $rot['NOMBRES'],
 				'apellidos' => $rot['APELLIDOS'],
 				'email' => $rot['EMAIL'],
 				'telefono' => $rot['TELEFONO'],
 				'movil' => $rot['MOVIL'],
 				'orden' => $rot['ORDEN'],
 				'fecha_orden' => $rot['FECHA_ORDEN'],
 				'descripcion' => $rot['DESCRIPCION']
 			 ];

 	array_push($respuesta,$data);   
}

if(count($respuesta) > 0){


?>
<center>
  <br>
  <h3>Solicitudes en Curso</h3>
</center>

<div class="table-responsive">
<table class="table table-vcenter table-mobile-md card-table">
  <thead>
    <tr>
      <th>Identificacion</th>
      <th>Nombres</th>
      <th>Apellidos</th>
      <th>Correo</th>
      <th>Telefono</th>
      <th>Movil</th>
      <th>Orden</th>
      <th>Fecha Orden</th>
      <th>Descripcion</th>

    </tr>
  </thead>
  <tbody>

	<tr>
		<?php 
			for ($i=0; $i < count($respuesta) ; $i++) { 
				
			?>
		<td><?php echo $respuesta[$i]['identificacion'];  ?></td>
		<td><?php echo $respuesta[$i]['nombres'];  ?></td>
		<td><?php echo $respuesta[$i]['apellidos'];  ?></td>
		<td><?php echo $respuesta[$i]['email'];  ?></td>
		<td><?php echo $respuesta[$i]['telefono'];  ?></td>
		<td><?php echo $respuesta[$i]['movil'];  ?></td>
		<td><?php echo $respuesta[$i]['orden'];  ?></td>
		<td><?php echo $respuesta[$i]['fecha_orden'];  ?></td>
		<td><?php echo $respuesta[$i]['descripcion'];  ?></td>
		
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
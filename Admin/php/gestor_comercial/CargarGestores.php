<?php
include '../DatosEmpleado.php';
/* $nombre = $_POST['nombre']; */
/* $cedula = $_POST['cedula']; */

$url = 'http://190.184.202.251:8090/formularioback/Admin/gestor_comercial/CargarGestores.php';
//$url = 'http://localhost/CUN/formularioback/Admin/gestor_comercial/CargarGestores.php';

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
$data = json_decode($result, true);
curl_close($ch);


?>
<table class="table table-vcenter table-mobile-md card-table" id="Tabla">
      <thead>
        <tr>
          <th>#</th>
          <th style="font-size:9px;">Nombres</th>
          <th style="font-size:9px;">Cedula</th>
        </tr>
      </thead>
      <tbody>
<?php 
$cont = 0;


foreach ($data as $key){
    $cont++;
    ?>

    <tr>
        <td class="text-muted" data-label="Comerciales" style="font-size:11px;" >
            <?php echo $cont; ?>
        </td>
        <td class="text-muted" data-label="Comerciales" style="font-size:11px;" >
            <?php echo $key['NOMBRE_CLASIFICACION']; ?>
        </td>
        <td class="text-muted" data-label="Comerciales" style="font-size:11px;" >
            <?php echo $key['EMPLEADO']; ?>
        </td>
	    <!-- <td><input type="button" value="Activar" class="btn btn-success" onclick='ActivarGestor(<?php /* echo json_encode($key); */ ?>);'></td> -->
		
    </tr>

    <?php
}


?>

    </tbody>
</table>
<?php
$url = 'http://190.184.202.251:8090/formularioback/Admin/pdiplomados/ConsDetalleEncabezado.php';
//$url = 'http://localhost/CUN/formularioback/Admin/pdiplomados/ConsDetalleEncabezado.php';

$secuencia = $_POST['secuencia'];

$datos = array(
    'secuencia' => $secuencia
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
      <th>Cuota</th>
      <th>Fecha Vencimiento</th>
      <th>Porcentaje cuota</th>
      <th>Editar</th>
      <th>Eliminar</th>
    </tr>
  </thead>
  <tbody>

    <?PHP
    $row2 = '}';
    foreach ($data as $key){
      
      ?>

        <tr>
          <td><?php echo $key['NUMERO']; ?></td>
          <td><?php echo $key['FECHA_VENCIMIENTO']; ?></td>
          <td><?php echo $key['VALOR_USO']; ?></td>
          <td><input type="button" class="btn btn-warning EditarFecha" style="background-color: #FBBA2E;" value="Editar" data-descr="
         <?php 
          echo htmlentities($key['CONSECUTIVO']); echo htmlentities($row2); 
          echo htmlentities($key['FECHA_VENCIMIENTO']); echo htmlentities($row2); 
          ?>"></td>
          <td><input type="button" class="btn btn-danger" value="Eliminar" onclick="EliminarDetalle(<?PHP echo $key['CONSECUTIVO']; ?>);"></td>
        </tr> 

  		<?php
  	}

  	?>

  </tbody>
</table>

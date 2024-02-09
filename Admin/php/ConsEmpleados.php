<?php

//$url = 'http://localhost/CUN/formularioback/Admin/EmpleadosList.php';
$url = 'http://190.184.202.251:8090/formularioback/Admin/EmpleadosList.php';

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

$data_empleado = json_decode($result,true);

?>
<table class="table table-vcenter table-mobile-md card-table" id="Tabla">
      <thead>
        <tr>
          <th>Colaborador</th>
          <th>Email</th>
          <th>Estado</th>
          <th>Perfil</th>
          <th class="w-1"></th>
        </tr>
      </thead>
      <tbody>

<?php foreach($data_empleado as $empleado){

    if (array_key_exists('NOM_PERFIL', $empleado)) {
      $nom_perfil = $empleado['NOM_PERFIL'];
    }else{
      $nom_perfil = 'Ninguno';
    }

 ?>

	<tr>
        <td data-label="Name" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $empleado['NOMBRE']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Title" >
            <div class="text-muted"><?php echo $empleado['EMAIL']; ?></div>
        </td>
        <td data-label="Title" >
            <div class="text-muted">Activo</div>
        </td>
        <td class="text-muted" data-label="Role" >
            <?php echo $nom_perfil; ?>
        </td>
        <td>
            <div class="btn-list flex-nowrap">
            <input type="button" class="btn btn-success" value="Asignar" onclick="AsigPerfilEmpleado(<?php echo $empleado['ID']; ?>);">
            <input class="form-check-input" type="checkbox" style="width:20px;height:20px;" value="<?php echo $empleado['ID']; ?>" name="check_empleado[]">
            </div>
        </td>
        </tr>
	

<?php } ?>
 
</tbody>
</table>
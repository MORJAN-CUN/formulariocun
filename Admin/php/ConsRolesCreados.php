<?php

$url = 'http://190.184.202.251:8090/formularioback/Admin/ConsPerfiles.php';

$datos = array(
	'prueba' => null
);

//Iniciar cURL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);

$data = json_decode($result,true);

?>

<table class="table table-vcenter table-mobile-md card-table" id="Tablaroles">
      <thead>
        <tr>
          <th>Perfil</th>
          <th>Estado</th>
          <th class="w-1"></th>
        </tr>
      </thead>
      <tbody>
<?php
foreach($data as $perfil){

    $id = $perfil['ID_PERFIL'];
    $nombre = $perfil['NOM_PERFIL'];

    ?>
	<tr>
        <td data-label="Name" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $perfil['NOM_PERFIL']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Title" >
            <div class="text-muted">Activo</div>
        </td>
        <td>
            <div class="btn-list flex-nowrap">
                <input type="button" value="Editar" class="btn btn-success" onclick="EditarPerfil(<?php echo $id; ?>);">
            </div>
        </td>
    </tr>
	<?php

}

?>
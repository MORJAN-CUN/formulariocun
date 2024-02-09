<?php

$fecha_desde = $_POST['fecha_desde'];
$fecha_hasta = $_POST['fecha_hasta'];
$centro_costo = $_POST['centro_costo'];
$dispositivos = $_POST['dispositivos'];
$palabra_clave = $_POST['palabra_clave'];

$url = 'https://homologaciones.cun.edu.co/back_inglab_app/ConsultarEmpleados.php';
//$url = 'http://localhost/CUN/back_inglab_app/ConsultarEmpleados.php';

$datos = array(
    'fecha_desde' => $fecha_desde,
    'fecha_hasta' => $fecha_hasta,
    'centro_costo' => $centro_costo,
    'dispositivos' => $dispositivos,
    'palabra_clave' => $palabra_clave
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

$result_arr = json_decode($result, true);

?>
<table class="table table-vcenter table-mobile-md card-table" id="Tabla">
      <thead>
        <tr>
          <th>#</th>
          <th style="font-size:9px;">Cedula</th>
          <th style="font-size:9px;">Nombres</th>
          <th style="font-size:9px;">Apellidos</th>
          <th style="font-size:9px;">Correo</th>
          <th style="font-size:9px;">Centro de costos</th>
          <th style="font-size:9px;">Fecha entrada</th>
          <th style="font-size:9px;">Dispositivo</th>
        </tr>
      </thead>
      <tbody>

<?php 
$cont = 0;
foreach ($result_arr as $key){
    $cont++;
    ?>

    <tr>
        <td class="text-muted" data-label="Role" style="font-size:11px;" >
            <?php echo $cont; ?>
        </td>
        <td class="text-muted" data-label="Role" style="font-size:11px;" >
            <?php echo $key['cedula_usuario']; ?>
        </td>
        <td class="text-muted" data-label="Role" style="font-size:11px;" >
            <?php echo $key['nombres_usuario']; ?>
        </td>
        <td class="text-muted" data-label="Role" style="font-size:11px;" >
            <?php echo $key['apellidos_usuario']; ?>
        </td>
        <td class="text-muted" data-label="Role" style="font-size:11px;" >
            <?php echo $key['correo_usuario']; ?>
        </td>
        <td class="text-muted" data-label="Role" style="font-size:11px;" >
            <?php echo $key['nombre_centro_costos']; ?>
        </td>
        <td class="text-muted" data-label="Role" style="font-size:11px;" >
            <?php echo $key['fecha_entrada']; ?>
        </td>
        <td class="text-muted" data-label="Role" style="font-size:11px;" >
            <?php echo $key['dispositivos']; ?>
        </td>
    </tr>

    <?php
}

?>

    </tbody>
</table>
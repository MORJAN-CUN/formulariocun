<?php
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula = $data_empleado['cedula'];

$registros = $_POST['registros'];
$tipo_valor = $_POST['tipo_valor'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/recibos_full/Update_Orden_MS.php';
//$url = 'http://localhost/CUN/formularioback/Admin/recibos_full/Update_Orden_MS.php';


$datos = array(
    'registros' => $registros,
    'tipo_valor' => $tipo_valor,
    'id_usu' => $id_usu,
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

//Recorrer array
?>
<table class="table table-vcenter table-mobile-md card-table">
      <thead>
        <tr>
          <th>Orden</th>
          <th>Valor nuevo</th>
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
                        <?php echo $result['orden']; ?>
                    </div>
                </div>
            </div>
        </td>

        <td data-label="Secuencia">
            <div class="d-flex py-1 align-items-center">
                <div class="flex-fill">
                    <div class="font-weight-medium" style="font-size:10px;">
                        <?php echo number_format($result['valor_aplicado']); ?>
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

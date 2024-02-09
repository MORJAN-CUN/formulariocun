<?php
include '../DatosEmpleado.php';
error_reporting(0);

$especifica = $_POST['especifica'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/aplicacion_pagos/PagosEsp.php';
//$url = 'http://localhost/CUN/formularioback/Admin/aplicacion_pagos/PagosEsp.php';

$datos = array(
    'especifica' => $especifica,
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
          <th><input type="checkbox" onclick="ChechkMs();" id="check_masivo" style="width:20px;height:20px;"></th>
          <th>#</th>
          <th style="font-size:9px;">IDENTIFICACIÓN</th>
          <?php if (in_array("GAP", $accesos_arr)) { ?>
          <th style="font-size:9px;">GESTION</th>
          <?php } ?>
          <th style="font-size:9px;">NOMBRE COMPLETO</th>
          <th style="font-size:9px;">FECHA</th>
          <th style="font-size:9px;">REFERENCIA</th>
          <th style="font-size:9px;">VALOR APROBADO</th>
          <th style="font-size:9px;">VALOR DETALLE</th>
          <th style="font-size:9px;">VALOR DIFERENCIA</th>
          <th style="font-size:9px;">ESTADO TRANSACCIÓN</th>
          <th style="font-size:9px;">ESTADO RESPUESTA</th>
          <th style="font-size:9px;">CONTADOR RES</th>
          <th style="font-size:9px;">CONTADOR RECIBO</th>
          <th style="font-size:9px;">RECIBO ICEBERG</th>
          <th style="font-size:9px;">METODO DE PAGO</th>
          <th style="font-size:9px;">ID ORDEN</th>
          <th style="font-size:9px;">ID CREDITO</th>
        </tr>
      </thead>
      <tbody>
<?php 
$cont = 0;


foreach ($data as $key){
    $cont++;
    $valor_aprobado = number_format($key['VALOR_APROBADO']);
    $valor_detalle = number_format($key['VALOR_DET_RES']);
    if(empty($valor_detalle)){
        $valor_detalle = 0;
    }
    $valor_diferencia = $valor_aprobado - $valor_detalle;
    ?>

    <tr>
        <td>
			<input type="checkbox" class="check_ms_migrar" style="width:20px;height:20px;" name="check_orden[]" value="<?php echo $key['IDENTIFICACION']; ?>">
		</td>
        <td class="text-muted" style="font-size:11px;" >
            <?php echo $cont; ?>
        </td>
        <td class="text-muted" style="font-size:11px;" >
            <?php echo $key['IDENTIFICACION']; ?>
        </td>

        <?php if (in_array("GAP", $accesos_arr)) { ?>
        <td>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gestion<?php echo $key['IDENTIFICACION']; ?>">
            &curren;
            </button>

            <!-- Modal -->
            <div class="modal fade" id="gestion<?php echo $key['IDENTIFICACION']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gestion</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Estado a Pending</h4>
                            <input type="button" value="✓" class="btn btn-outline-info" onclick='StatePending(<?php echo $key['REFERENCIA'] ?>);'>
                        </div>
                        <div class="col-md-6">
                            <h4>Procesar Respuesta</h4>
                            <input type="button" value="✓" class="btn btn-outline-info" onclick='ProcessResponse(<?php echo $key['REFERENCIA'] ?>);'>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <h4>Borrar Detalle Repuesta</h4>
                            <input type="button" value="✓" class="btn btn-outline-info" onclick='DeleteDetResponse(<?php echo $key['REFERENCIA'] ?>);'>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <h4>Actualizar Valor Orden</h4>
                            <input type="button" value="✓" class="btn btn-outline-info" onclick='UpdateValorOrden(<?php echo $key['REFERENCIA'] ?>);'>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <h4>Borrar Repuesta</h4>
                            <input type="button" value="✓" class="btn btn-outline-info" onclick='DeleteResponse(<?php echo $key['REFERENCIA'] ?>);'>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <h4>Actualizar Valor Credito</h4>
                            <input type="button" value="✓" class="btn btn-outline-info" onclick='UpdateValorCredito(<?php echo $key['REFERENCIA'] ?>, <?php echo $key['VALOR_APROBADO'] ?> )'>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
            </div>
        </td>
        <?php } ?>

        <td class="text-muted" style="font-size:11px;">
            <?php echo $key['NOMBRE_COMPLETO']; ?>
        </td>
        <td class="text-muted" style="font-size:11px;" >
            <?php echo $key['FECHA']; ?>
        </td>
        <td class="text-muted" style="font-size:11px;" >
            <?php echo $key['REFERENCIA']; ?>
        </td>
        <td class="text-muted" style="font-size:11px;" >
            <?php echo $key['VALOR_APROBADO']; ?>
        </td>
        <td class="text-muted" style="font-size:11px;" >
            <?php echo $key['VALOR_DET_RES']; ?>
        </td>
        <td class="text-muted" style="font-size:11px;" >
            <?php echo number_format($valor_diferencia); ?>
        </td>
        <td class="text-muted" style="font-size:11px;" >
            <?php echo $key['ESTADO_TX']; ?>
        </td>
        <td class="text-muted" style="font-size:11px;" >
            <?php echo $key['STATUS_RES']; ?>
        </td>
        <td class="text-muted" style="font-size:11px;" >
            <?php echo $key['CONTADOR_RES']; ?>
        </td>
        <td class="text-muted" style="font-size:11px;" >
            <?php echo $key['CONTADOR_RECIBO']; ?>
        </td>
        <td class="text-muted" style="font-size:11px;" >
            <?php echo $key['RECIBO_ICEBERG']; ?>
        </td>
        <td class="text-muted" style="font-size:11px;">
            <?php echo $key['METODO_PAGO']; ?>
        </td>
        <td class="text-muted" style="font-size:11px;" >
            <?php 
            if(is_null($key['ID_ORDEN'])){
                echo 'Sin identificación de orden';
            } else {
                echo $key['ID_ORDEN']; 
            }
            ?>
        </td>
        <td class="text-muted" style="font-size:11px;" >
        <?php 
            if(is_null($key['ID_CREDITO'])){
                echo 'Sin identificación de credito';
            } else {
                echo $key['ID_CREDITO']; 
            }
            ?>
        </td>
	    
		
    </tr>

    <?php
}



?>

    </tbody>
</table>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
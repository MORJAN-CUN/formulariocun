<?php

$url = 'http://190.184.202.251:8090/formularioback/Admin/Promociones/ConsPeriodosCreados.php';
//$url = 'http://localhost/CUN/formularioback/Admin/Promociones/ConsPeriodosCreados.php';

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
          <th>Periodo</th>
          <th>Tipo financiacion</th>
          <th>Fecha registro</th>
          <th>Fecha final</th>
          <th>Periodo idiomas</th>
          <th>Numero cuotas</th>
          <th>Porcentaje a pagar</th>
          <th class="w-1"></th>
        </tr>
      </thead>
      <tbody>
<?php
foreach($data as $periodo){
    ?>
	<tr>
        <td data-label="Periodo" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $periodo['PERIODO']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Tipo financiacion" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $periodo['TIPO_PROMOCION']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Fecha registro" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $periodo['FECHA_REGISTRO']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Fecha final" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $periodo['FECHA_FINAL']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Periodo idiomas" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $periodo['PERIODO_IDIOMAS']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Numero cuotas" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $periodo['NUMERO_CUOTAS']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Porcentaje a pagar" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $periodo['PORC_A_PAGAR']; ?></div>
            </div>
            </div>
        </td>
        <td>
            <div class="btn-list flex-nowrap">
                <input type="button" value="Editar" class="btn btn-success" onclick="EditarPeriodo(<?php echo $periodo['ID']; ?>);">
            </div>
        </td>
    </tr>
	<?php

}

?>

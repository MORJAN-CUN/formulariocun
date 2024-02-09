<?php

$url = 'http://190.184.202.251:8090/formularioback/Admin/Promociones/ConsPromocionesCreados.php';
//$url = 'http://localhost/Cun/formularios_promosiones/formularioback/Admin/Promociones/ConsPromocionesCreados.php';

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

<table class="table table-vcenter table-mobile-md card-table" id="TablaFinanciaciones">
      <thead>
        <tr>
        <th>ID</th>
          <th>Fecha registro</th>
          <th>Tipo financiacion</th>
          <th>Periodo</th>
          <th>Periodo idiomas</th>
          <th>Programa</th>
          <th>Ciclo</th>
          <th>Tipo Inscripcion</th>
          <th>Valor Matricula</th>
          <th>Valor Idiomas</th>
          <th>Valor Servicio</th>
          <th>Numero de Cuotas</th>
          <th class="w-1"></th>
        </tr>
      </thead>
      <tbody>
<?php
foreach($data as $promociones){
    ?>
	<tr>
    <td data-label="Secuencia" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $promociones['SECUENCIA']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Fecha Registro" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $promociones['FECHA_REGISTRO']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Tipo financiación" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $promociones['TIPO_PROMOCION']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Periodo" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $promociones['PERIODO']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Periodo Idiomas" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $promociones['PERIODO_IDIOMAS']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Programa" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $promociones['PROGRAMA']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Ciclo" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $promociones['CICLO']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Tipo Inscripcion" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $promociones['TIPO_INSCRIPCION']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Valor Matricula" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $promociones['VALOR_MATRICULA']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Valor Idiomas" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $promociones['VALOR_IDIOMAS']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Valor Servicio" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $promociones['VALOR_SERVICIO']; ?></div>
            </div>
            </div>
        </td>
        <td data-label="Cuotas" >
            <div class="d-flex py-1 align-items-center">
            <div class="flex-fill">
                <div class="font-weight-medium" style="font-size:13px;"><?php echo $promociones['NUMERO_CUOTAS']; ?></div>
            </div>
            </div>
        </td>
        
        <td>
            <div class="btn-list flex-nowrap">
                <input type="button" value="Editar" class="btn btn-success" onclick="EditarPromociones(<?php echo $promociones['SECUENCIA']; ?>);">
            </div>
        </td>
    </tr>
	<?php

}

?>

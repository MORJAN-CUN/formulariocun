<?php
$periodo = $_POST['periodo'];
//$periodo = '21V05';

$url = 'http://190.184.202.251:8090/formularioback/Admin/Promociones/ConsPromocionesCreadasPeriodo.php';
//$url = 'http://localhost/CUN/formularioback/Admin/Promociones/ConsPromocionesCreadasPeriodo.php';

$datos = array(
	'periodo' => $periodo
);

//Iniciar cURL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);

$data = json_decode($result,true);

function getIcon(){
	echo '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>';
}


//Recorrer array
?>
<table class="table table-vcenter table-mobile-md card-table" id="TablaRefFP">
      <thead>
        <tr>
          <th><input type="checkbox" checked="on" onclick="ChechkMs();" id="check_masivo" style="width: 20px;height: 20px;"></th>
          <th>Secuencia</th>
          <th onclick="EditMs(1);" style="cursor: pointer;">Tipo financiacion <span><?php getIcon(); ?></span></th>
          <th onclick="EditMs(2);" style="cursor: pointer;">Periodo idiomas <span><?php getIcon(); ?></span></th>
          <th onclick="EditMs(3);" style="cursor: pointer;">Programa<br> <?php getIcon(); ?></th>
          <th onclick="EditMs(4);" style="cursor: pointer;">Ciclo<br> <?php getIcon(); ?></th>
          <th onclick="EditMs(5);" style="cursor: pointer;">Tipo Inscripcion <?php getIcon(); ?></th>
          <th onclick="EditMs(6);" style="cursor: pointer;">V Matricula <?php getIcon(); ?></th>
          <th onclick="EditMs(7);" style="cursor: pointer;">V Idiomas <?php getIcon(); ?></th>
          <th onclick="EditMs(8);" style="cursor: pointer;">V Servicio <?php getIcon(); ?></th>
          <th onclick="EditMs(9);" style="cursor: pointer;">Cuotas <?php getIcon(); ?></th>
        </tr>
      </thead>
      <tbody>
<?php

foreach($data as $registro){

	$id_span_tf = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 
	$id_span_pi = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 
	$id_span_p = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 
	$id_span_c = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 
	$id_span_ti = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 
	$id_span_vm = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 
	$id_span_vi = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 
	$id_span_vs = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 
	$id_span_cu = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 

	?>	
	<tr>
		<td data-label="" class="registro_table_ms">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium" style="font-size:10px;"><input type="checkbox" checked="on" value="<?php echo $registro['SECUENCIA']; ?>" name="check_periodo[]" class="check_ms_migrar" style="width: 20px;height: 20px;"></div>
	            </div>
            </div>
	    </td>

	    <td data-label="Secuencia" class="secuencia_td">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium" style="font-size:10px;"><?php echo $registro['SECUENCIA']; ?></div>
	            </div>
            </div>
	    </td>
	    <td data-label="Tipo financiacion" class="tipo_financiacion_td">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium txt_td_tipo_financiacion" style="font-size:10px;cursor: pointer;"><span onclick="EditUnoxUno(1,'id_span_<?php echo $id_span_tf ?>');" id="id_span_<?php echo $id_span_tf; ?>"><?php echo $registro['TIPO_PROMOCION']; ?></span></div>
	            </div>
            </div>
	    </td>
	    <td data-label="Periodo Idiomas" class="periodo_idiomas_td">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium txt_td_periodo_idiomas" style="font-size:10px;cursor: pointer;"><span onclick="EditUnoxUno(2,'id_span_<?php echo $id_span_pi ?>');" id="id_span_<?php echo $id_span_pi; ?>"><?php echo $registro['PERIODO_IDIOMAS']; ?></span></div>
	            </div>
            </div>
	    </td>
	    <td data-label="Programa" class="programa_td">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium txt_td_programa" style="font-size:10px;cursor: pointer;"><span onclick="EditUnoxUno(3,'id_span_<?php echo $id_span_p ?>');" id="id_span_<?php echo $id_span_p; ?>"><?php echo $registro['PROGRAMA']; ?></span></div>
	            </div>
            </div>
	    </td>
	    <td data-label="Ciclo" class="ciclo_td">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium txt_td_ciclo" style="font-size:10px;cursor: pointer;"><span onclick="EditUnoxUno(4,'id_span_<?php echo $id_span_c ?>');" id="id_span_<?php echo $id_span_c; ?>"><?php echo $registro['CICLO']; ?></span></div>
	            </div>
            </div>
	    </td>
	    <td data-label="Tipo de inscripcion" class="tipo_inscripcion_td">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium txt_td_tipo_inscripcion" style="font-size:10px;cursor: pointer;"><span onclick="EditUnoxUno(5,'id_span_<?php echo $id_span_ti ?>');" id="id_span_<?php echo $id_span_ti; ?>"><?php echo $registro['TIPO_INSCRIPCION']; ?></span></div>
	            </div>
            </div>
	    </td>
	    <td data-label="Valor matricula" class="valor_matricula_td">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium txt_td_valor_matricula" style="font-size:10px;cursor: pointer;"><span onclick="EditUnoxUno(6,'id_span_<?php echo $id_span_vm ?>');" id="id_span_<?php echo $id_span_vm; ?>"><?php echo number_format($registro['VALOR_MATRICULA']); ?></span></div>
	            </div>
            </div>
	    </td>
	    <td data-label="Valor Idiomas" class="valor_idiomas_td">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium txt_td_valor_idiomas" style="font-size:10px;cursor: pointer;"><span onclick="EditUnoxUno(7,'id_span_<?php echo $id_span_vi ?>');" id="id_span_<?php echo $id_span_vi; ?>"><?php echo number_format($registro['VALOR_IDIOMAS']); ?></span></div>
	            </div>
            </div>
	    </td>
	    <td data-label="Valor servicio" class="valor_servicio_td">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium txt_td_valor_servicio" style="font-size:10px;cursor: pointer;"><span onclick="EditUnoxUno(8,'id_span_<?php echo $id_span_vs ?>');" id="id_span_<?php echo $id_span_vs; ?>"><?php echo number_format($registro['VALOR_SERVICIO']); ?></span></div>
	            </div>
            </div>
	    </td>
	    <td data-label="Numero cuotas" class="numero_cuotas_td">
            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium txt_td_cuotas" style="font-size:10px;cursor: pointer;"><span onclick="EditUnoxUno(9,'id_span_<?php echo $id_span_cu ?>');" id="id_span_<?php echo $id_span_cu; ?>"><?php echo $registro['NUMERO_CUOTAS']; ?></span></div>
	            </div>
            </div>
	    </td>



    </tr>
    <?php

}

?>
</tbody>
</table>

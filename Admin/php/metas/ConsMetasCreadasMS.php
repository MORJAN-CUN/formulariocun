<?php
$url = 'http://190.184.202.251:8090/formularioback/Admin/metas/ConsMetasCreadas.php';
//$url = 'http://localhost/CUN/formularioback/Admin/metas/ConsMetasCreadas.php';

$unidad_negocio = $_POST['unidad_negocio'];
$periodo = $_POST['periodo'];
$grupo_analisis = $_POST['grupo_analisis'];

$datos = array(
    'unidad_negocio' => $unidad_negocio,
    'periodo' => $periodo,
    'grupo_analisis' => $grupo_analisis
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

function getIcon(){
	echo '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>';
}

?>

<table class="table table-vcenter table-mobile-md card-table">
  <thead>
    <tr>
    	<th><input type="checkbox" onclick="ChechkMs();" id="check_masivo" style="width:15px;height:15px;"></th>
    	<th style="cursor:pointer;">Id</th>
	    <th style="cursor:pointer;">Regional</th>
	    <th style="cursor:pointer;">Sede</th>
	    <th onclick="EditMs(3);"  style="cursor:pointer;">Tipo alumno <span><?php getIcon(); ?></span></th>
	    <th onclick="EditMs(4);" style="cursor:pointer;">Programa <span><?php getIcon(); ?></span></th>
	    <th onclick="EditMs(5);" style="cursor:pointer;">Modalidad <span><?php getIcon(); ?></span></th>
	    <th onclick="EditMs(6);" style="cursor:pointer;">Ciclo <span><?php getIcon(); ?></span></th>
	    <th onclick="EditMs(7);" style="cursor:pointer;">Meta estudiantes <span><?php getIcon(); ?></span></th>
	    <th onclick="EditMs(8);" style="cursor:pointer;">Meta valor ingresos <span><?php getIcon(); ?></span></th>
    </tr>
  </thead>
  <tbody>

  	<?PHP

  	foreach ($data as $key){
  		
  		$id_span_ta = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 
  		$id_span_pro = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 
  		$id_span_mod = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 
  		$id_span_cic = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 
  		$id_span_cmeta = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 
  		$id_span_vmeta = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 30)), 0, 30); 

			if (array_key_exists('TIPO_ALUMNO', $key)) {
			  $tipo_alumno = $key['TIPO_ALUMNO'];
			}else{
				$tipo_alumno = '';
			}

			if (array_key_exists('NOM_PROGRAMA', $key)) {
			  $nom_programa = $key['NOM_PROGRAMA'];
			}else{
				$nom_programa = '';
			}

			if (array_key_exists('MODALIDAD', $key)) {
			  $modalidad = $key['MODALIDAD'];
			}else{
				$modalidad = '';
			}

			if (array_key_exists('CICLO', $key)) {
			  $ciclo = $key['CICLO'];
			}else{
				$ciclo = '';
			}

  		?>

  			<tr>
  				<td class="registro_table_ms"><input type="checkbox" class="check_ms_migrar" name="check_meta[]" value="<?php echo $key['ID']; ?>" style="width:15px;height:15px;"></td>
  				<td style="font-weight: normal;"><?php echo $key['ID']; ?></td>
  				<td class="regional_td" style="font-weight: normal;"><span class="txt_td_regional"><?php echo $key['REGIONAL']; ?></span></td>
  				<td style="font-weight: normal;"><?php echo $key['SEDE']; ?></td>

  				<td class="tipo_alumno_td" style="font-weight: normal;">
  					<span class="txt_td_tipo_alumno" onclick="EditUnoxUno(1,'id_span_<?php echo $id_span_ta ?>');" id="id_span_<?php echo $id_span_ta; ?>"><?php echo $tipo_alumno; ?></span>
  				</td>

  				<td class="programa_td" style="font-weight: normal;">
  					<span class="txt_td_programa" onclick="EditUnoxUno(2,'id_span_<?php echo $id_span_pro ?>');" id="id_span_<?php echo $id_span_pro; ?>"><?php echo $nom_programa; ?></span>
  				</td>

  				<td class="modalidad_td" style="font-weight: normal;">
  					<span class="txt_td_modalidad" onclick="EditUnoxUno(3,'id_span_<?php echo $id_span_mod ?>');" id="id_span_<?php echo $id_span_mod; ?>"><?php echo $modalidad; ?></span>
  				</td>

  				<td class="ciclo_td" style="font-weight: normal;">
  					<span class="txt_td_ciclo" onclick="EditUnoxUno(4,'id_span_<?php echo $id_span_cic ?>');" id="id_span_<?php echo $id_span_cic; ?>"><?php echo $ciclo; ?></span>
  				</td>

  				<td class="meta_estudiantes_td" style="font-weight: normal;">
  					<span class="txt_td_meta_estudiantes" onclick="EditUnoxUno(5,'id_span_<?php echo $id_span_cmeta ?>');" id="id_span_<?php echo $id_span_cmeta; ?>"><?php echo $key['META_ESTUDIANTES']; ?></span>
  				</td>

  				<td class="meta_valor_ingresos_td" style="font-weight: normal;">
  					<span class="txt_td_meta_valor_ingresos" onclick="EditUnoxUno(6,'id_span_<?php echo $id_span_vmeta ?>');" id="id_span_<?php echo $id_span_vmeta; ?>">$<?php echo number_format($key['META_VALOR_INGRESOS']); ?></span>
  				</td>
        </tr> 

  		<?php
  	}

  	?>

  </tbody>
</table>

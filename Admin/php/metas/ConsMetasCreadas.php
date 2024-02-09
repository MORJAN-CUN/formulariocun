<?php
$url = 'http://190.184.202.251:8090/formularioback/Admin/metas/ConsMetasCreadas.php';
//$url = 'http://localhost/formularioback/Admin/metas/ConsMetasCreadas.php';

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

?>

<table class="table table-vcenter table-mobile-md card-table" id="TablaMetas" style="font-size: 13px;">
  <thead>
    <tr>
    	<th><input type="checkbox" onclick="ChechkMs();" id="check_masivo"  style="width:18px;height:18px;"></th>
    	<th>Id</th>
    	<th>Periodo</th>
    	<th>Grupo</th>
	    <th style="cursor:pointer;">Regional</th>
	    <th style="cursor:pointer;">Sede</th>
	    <th style="cursor:pointer;">Tipo alumno</th>
	    <th style="cursor:pointer;">Programa</th>
	    <th style="cursor:pointer;">Modalidad</th>
	    <th style="cursor:pointer;">Ciclo</th>
	    <th style="cursor:pointer;">Meta estudiantes</th>
	    <th style="cursor:pointer;">Meta valor ingresos</th>
	    <th>Editar</th>
	    <th>Eliminar</th>
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
  				<td><input type="checkbox" class="check_ms_migrar" name="check_meta[]" value="<?php echo $key['ID']; ?>"  style="width:18px;height:18px;"></td>
  				<td style="font-weight: normal;"><?php echo $key['ID']; ?></td>
  				<td style="font-weight: normal;"><?php echo $key['PERIODO']; ?></td>
  				<td style="font-weight: normal;"><?php echo $key['GRUPO']; ?></td>
  				<td style="font-weight: normal;"><?php echo $key['REGIONAL']; ?></td>
  				<td style="font-weight: normal;"><?php echo $key['SEDE']; ?></td>
  				<td style="font-weight: normal;"><?php echo $tipo_alumno; ?></td>
  				<td style="font-weight: normal;"><?php echo $nom_programa; ?></td>
  				<td style="font-weight: normal;"><?php echo $modalidad; ?></td>
  				<td style="font-weight: normal;"><?php echo $ciclo; ?></td>
  				<td style="font-weight: normal;"><?php echo $key['META_ESTUDIANTES']; ?></td>

  				<td style="font-weight: normal;" class="registro_table_ms">
  					<span class="txt_td_meta_valor_ingresos" onclick="EditUnoxUno(6,'id_span_<?php echo $id_span_vmeta ?>');" id="id_span_<?php echo $id_span_vmeta; ?>">$<?php echo number_format($key['META_VALOR_INGRESOS']); ?></span>		
  				</td>



  				<td style="font-weight: normal;"><input type="button" value="Editar" class="btn btn-success" onclick="EditarMeta(<?php echo $key['ID']; ?>);" style="font-size: 13px;"></td>
  				<td><input type="button" value="Eliminar" class="btn btn-danger" style="font-size: 13px;" onclick="EliminarMeta(<?php echo $key['ID']; ?>);"></td>
        </tr> 

  		<?php
  	}

  	?>

  </tbody>
</table>

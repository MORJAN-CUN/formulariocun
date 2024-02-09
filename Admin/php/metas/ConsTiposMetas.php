<?php
$url = 'http://190.184.202.251:8090/formularioback/Admin/metas/ConsTiposMetas.php';
//$url = 'http://localhost/CUN/formularioback/Admin/metas/ConsTiposMetas.php';

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

$data = json_decode($result,true);

?>
<div class="table-responsive">
<table class="table table-vcenter table-mobile-md card-table" id="table_result">
  <thead>
    <tr>
      	<th>Unidad de negocio</th>
	    <th scope="col"><center>Modalidad</center></th>
	    <th scope="col"><center>Programa</center></th>
	    <th scope="col"><center>Ciclo</center></th>
	    <th scope="col"><center>Tipo Alumno</center></th>
	    <th scope="col"><center>Meta valor ingresos</center></th>
	    <th scope="col"><center>Meta estudiantes</center></th>
	    <th scope="col"><center>Editar</center></th>
    </tr>
  </thead>
  <tbody>
<?php
    foreach($data as $registro){

        ?>
        <tr>
        	<th><?php echo $registro['NOMBRE_META']; ?></th>

            <th>
            	<center>
	            	<?php if($registro['CON_MODA'] == 1){
	            		?><img src="img/check.png" style="width:30px;"><?php
	            	}else{
	            		?><img src="img/error.png" style="width:30px;"><?php
	            	} ?>
            	</center>
            </th>

            <th>
            	<center>
	            	<?php if($registro['CON_PROGRAMA'] == 1){
	            		?><img src="img/check.png" style="width:30px;"><?php
	            	}else{
	            		?><img src="img/error.png" style="width:30px;"><?php
	            	} ?>
            	</center>
            </th>

            <th>
            	<center>
	            	<?php if($registro['CON_CICLO'] == 1){
	            		?><img src="img/check.png" style="width:30px;"><?php
	            	}else{
	            		?><img src="img/error.png" style="width:30px;"><?php
	            	} ?>
            	</center>
            </th>

            <th>
            	<center>
	            	<?php if($registro['CON_TALUMNO'] == 1){
	            		?><img src="img/check.png" style="width:30px;"><?php
	            	}else{
	            		?><img src="img/error.png" style="width:30px;"><?php
	            	} ?>
            	</center>
            </th>

            <th>
            	<center>
	            	<?php if($registro['CON_VMETA'] == 1){
	            		?><img src="img/check.png" style="width:30px;"><?php
	            	}else{
	            		?><img src="img/error.png" style="width:30px;"><?php
	            	} ?>
            	</center>
            </th>

            <th>
            	<center>
	            	<?php if($registro['CON_CMETA'] == 1){
	            		?><img src="img/check.png" style="width:30px;"><?php
	            	}else{
	            		?><img src="img/error.png" style="width:30px;"><?php
	            	} ?>
            	</center>
            </th>

            <th>
            	<input type="button" value="Editar" class="btn btn-success" onclick="EditarTipoMeta(<?php echo $registro['SECUENCIA']; ?>);">
            </th>

          </tr>
        <?php
        
    }
?>        
  </tbody>
</table>
</div>


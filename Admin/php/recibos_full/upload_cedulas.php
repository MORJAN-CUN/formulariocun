<?php
date_default_timezone_set('UTC');
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula = $data_empleado['cedula'];

# Cargar librerias y cosas necesarias
require_once "../../vendor/autoload.php";
# Indicar que usaremos el IOFactory
use PhpOffice\PhpSpreadsheet\IOFactory;

$nom_file = $_FILES['file']['name'];

$val_extension = explode('.', $nom_file);

if(in_array("xlsx", $val_extension)){

    $target_path = 'files_generated/';
    $target_path = $target_path . basename( $_FILES['file']['name']); 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)){
        
        # Recomiendo poner la ruta absoluta si no está junto al script
        # Nota: no necesariamente tiene que tener la extensión XLSX
        //$rutaArchivo = "query_result_2021-08-03T13_31_46.980Z.xlsx";
        $rutaArchivo = $target_path;

        //Asignar permisos al archivo
        chmod($target_path,  0666);

        $documento = IOFactory::load($rutaArchivo);
        $totalDeHojas = 1;
        $hojaActual = $documento->getSheet(0);
        $cont = 0;

        $array_general = array();

        # Iterar filas del excel
        foreach ($hojaActual->getRowIterator() as $fila){

            $cont++;

            //Sacar el encabezado
            if($cont != 1){
                //Obtener datos de cada fila y celda

                $cedula_estudiante = $hojaActual->getCell("A".$cont)->getValue();
                $periodo = $hojaActual->getCell("B".$cont)->getValue();
                

                //Crear array con los datos 

                $array_datos = array(
                    'cedula_estudiante' => $cedula_estudiante,
                    'periodo' => $periodo,
                );

                array_push($array_general, $array_datos);

            }
            
        }


        //Enviar array general por cURL 
        //Convertir en JSON

        $array_json = json_encode($array_general);
        
        //$url = 'http://190.184.202.251:8090/formularioback/Admin/recibos_full/upload_cedulas.php';
        $url = 'http://localhost/CUN/formularioback/Admin/recibos_full/upload_cedulas.php';

        $archivo = $target_path;

        $datos = array(
            'registros' => $array_json,
        );

        //Iniciar cURL

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        

        $result = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($result, true);
        print_r($data);

        ?>

      <table class="table table-vcenter table-mobile-md card-table" id="Tabla">
      <thead>
        <tr>
        	<th><input type="checkbox" onclick="ChechkMs();" id="check_masivo" style="width:20px;height:20px;"></th>
          <th style="font-size:9px;">Numero documento</th>
		  <th style="font-size:9px;">Gestión</th>
          <th style="font-size:9px;">Nombre</th>
          <th style="font-size:9px;">Periodo</th>
          <th style="font-size:9px;">Documento</th>
          <th style="font-size:9px;">Orden</th>
          <th style="font-size:9px;">Programa</th>
          <th style="font-size:9px;">Modalidad</th>
          <th style="font-size:9px;">Ciclo</th>
          <th style="font-size:9px;">Marca De Pago</th>
          <th style="font-size:9px;">Liquidada</th>
          <th style="font-size:9px;">Credito</th>
          <th style="font-size:9px;">Cun Vive</th>
          <th style="font-size:9px;">Reversion</th>
          <th style="font-size:9px;">Valor Pagado</th>
          <th style="font-size:9px;">Admitido</th>
          <th style="font-size:9px;">Valor Orden</th>
          <th style="font-size:9px;">Valor Seguro</th>
          <th style="font-size:9px;">Valor Ingles</th>
          <th style="font-size:9px;">Valor Descuento</th>
          <th style="font-size:9px;">Porcentaje Descuento</th>
          <th style="font-size:9px;">Valor Matricula</th>
        </tr>
      </thead>
      <tbody>

        <?php
    
    foreach ($data as $key){
			
		$cod_modalidad = $key['COD_MODALIDAD'];
		$cod_programa = $key['COD_PROGRAMA'];
		$cod_ciclo = $key['COD_CICLO'];

		$valores = getValorFull($periodo,$cod_modalidad,$cod_programa,$cod_ciclo);

		if($valores['nuevo'] == '' || $valores['nuevo'] == null){
			$valor_nuevo = 0;
		}else{
			$valor_nuevo = $valores['nuevo'];
		}

		if($valores['antiguo'] == '' || $valores['antiguo'] == null){
			$valor_antiguo = 0;
		}else{
			$valor_antiguo = $valores['antiguo'];
		}

		if($valores['convenio'] == '' || $valores['convenio'] == null){
			$valor_convenio = 0;
		}else{
			$valor_convenio = $valores['convenio'];
		}


		$row2 = '}';

		$porncetaje_desc = substr($key['PORCENTAJE'], 1);

		?>

		<tr>
				<td>
					<input type="checkbox" class="check_ms_migrar" style="width:20px;height:20px;" name="check_orden[]" value="<?php echo $key['ORDEN']; ?>">
				</td>
	       <td data-label="Name" style="font-size:11px;" >
	            <div class="d-flex py-1 align-items-center">
	            <div class="flex-fill">
	                <div class="font-weight-medium"><?php echo $key['CLIENTE_SOLICITADO']; ?></div>
	            </div>
	            </div>
	        </td>
			<td>
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gestionModal<?php echo $key['CLIENTE_SOLICITADO']; ?>">
					&curren;
				</button>

				<!-- Modal -->
				<div class="modal fade modG" id="gestionModal<?php echo $key['CLIENTE_SOLICITADO']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Gestión de acciones</h5>
						</div>
						<div class="modal-body">
							<div class="row">
								<?php 
								if($key['LIQUIDADA'] == 'NO'){
								?>
								<div class="col-md-6">
									<p><b>Ajustar Orden</b></p>
									<?php if (in_array("AO", $accesos_arr)) { ?>
										<a href="#" class="Update_Orden btn btn-outline-warning"
												data-descr="
												<?php 
													echo htmlentities($key['ORDEN']); echo htmlentities($row2); 
													echo htmlentities($valor_nuevo); echo htmlentities($row2); 
													echo htmlentities($valor_antiguo); echo htmlentities($row2); 
													echo htmlentities($key['DOCUMENTO']); echo htmlentities($row2); 
													echo htmlentities($key['CLIENTE_SOLICITADO']); echo htmlentities($row2); 
													echo htmlentities($key['VALOR_ORDEN']); echo htmlentities($row2); 
													echo htmlentities($valor_convenio); echo htmlentities($row2);
													?>">
													✏️
										</a>
									<?php } ?>
								</div>
								<?php
								}
								?>
								<?php 
								if($key['LIQUIDADA'] == 'NO'){
								?>
								<div class="col-md-6">
									<p><b>Editar Valores Orden</b></p>
									<?php if (in_array("AVO", $accesos_arr)) { ?>
										<a href="#" class="EditarValores btn btn-outline-warning"
												data-descr="
												<?php 
													echo htmlentities($key['ORDEN']); echo htmlentities($row2); 
													echo htmlentities($key['VALOR_ORDEN']); echo htmlentities($row2); 
													echo htmlentities($key['VALOR_SEGURO']); echo htmlentities($row2); 
													echo htmlentities($key['VALOR_INGLES']); echo htmlentities($row2); 
													echo htmlentities($key['VALOR_MATRICULA']); echo htmlentities($row2); 
													echo htmlentities($key['CLIENTE_SOLICITADO']); echo htmlentities($row2); 
													echo htmlentities($key['DOCUMENTO']); echo htmlentities($row2); 
													echo htmlentities($key['VALOR_DESCT']); echo htmlentities($row2); 
													echo htmlentities($porncetaje_desc); echo htmlentities($row2);  
													?>">
											✏️
										</a>
									<?php } ?>
								</div>
								<?php
								}
								?>
							</div>
							<br>
							<div class="row">
								<div class="col-md-4">
									<p><b>Marca De Pago</b></p>
									<?php if (in_array("ACO", $accesos_arr)) { ?>
										<input type="button" value="✓" class="btn btn-outline-info" onclick='MarcaPago(<?php echo json_encode($key); ?>);'>
									<?php } ?>
								</div>
								<div class="col-md-4">
									<p><b>Quitar Marca De Pago</b></p>
									<?php if (in_array("ACO", $accesos_arr)) { ?>
										<input type="button" value="✓" class="btn btn-outline-info" onclick='QuitarMarcaPago(<?php echo json_encode($key); ?>);'>
									<?php } ?>
								</div>
								<?php 
								if($key['LIQUIDADA'] == 'NO'){
								?>
								<div class="col-md-4">
									<p><b>Activar CunVive</b></p>
									<?php if (in_array("CV", $accesos_arr)) { ?>
										<input type="button" value="✓" class="btn btn-outline-info" onclick='CunVive(<?php echo json_encode($key); ?>);'>
									<?php } ?>
								</div>
								<?php
								}
								?>
							</div>
							<br>
							<div class="row">
								<div class="col-md-6">
									<p><b>Horario ZOHO</b></p>
									<?php if (in_array("HZ", $accesos_arr)) { ?>
										<a href="http://190.184.202.251:8090/evaluacion_docente/backend/calendarService.php?token=SGVsbG9Xb3JsZDopK3VaNWVqQjdTSm5BKHp7&periodo=<?php echo $key['PERIODO']?>&identificacion=<?php echo $key['CLIENTE_SOLICITADO']?>&correo=<?php echo $key['DIR_EMAIL']?>" class="btn btn-outline-success">✓</a>
									<?php } ?>
								</div>
								<div class="col-md-6">
									<p><b>Correo Zoho</b></p>
									<?php if (in_array("CZ", $accesos_arr)) { ?>
										<a href="http://190.184.202.251:8090/automatizacion_correos_cun/createUser.php?cedula=<?php echo $key['CLIENTE_SOLICITADO']?>&nombre=<?php echo $key['NOM_TERCERO']?>&apellido=<?php echo $key['PRI_APELLIDO']?>&Programa=<?php echo $key['NOM_PROGRAMA']?>&Correo=<?php echo $key['DIR_EMAIL']?>" class="btn btn-outline-success">✓</a>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" onclick="$('#gestionModal<?php echo $key['CLIENTE_SOLICITADO']; ?>').modal('hide')">Cerrar</button>
						</div>
						</div>
					</div>
				</div>
			</td>
	       <td class="text-muted" data-label="Role"  style="font-size:11px;" >
	            <?php echo $key['NOMBRE_NEGOCIO']; ?>
	        </td>
	        <td class="text-muted" data-label="Role"  style="font-size:11px;" >
	            <?php echo $key['PERIODO']; ?>
	        </td>
	        <td class="text-muted" data-label="Role"  style="font-size:11px;" >
	            <?php echo $key['DOCUMENTO']; ?>
	        </td>
	        <td class="text-muted" data-label="Role" style="font-size:11px;"  >
	            <?php echo $key['ORDEN']; ?>
	        </td>
	        <td class="text-muted" data-label="Role"  style="font-size:11px;" >
	            <?php echo $key['NOM_PROGRAMA']; ?>
	        </td>
	        <td class="text-muted" data-label="Role"  style="font-size:11px;" >
	            <?php echo $key['NOM_MODALIDAD']; ?>
	        </td>
	        <td class="text-muted" data-label="Role" style="font-size:11px;"  >
	            <?php echo $key['CICLO']; ?>
	        </td>
	        <td class="text-muted" data-label="Role" style="font-size:11px;"  >
	            <?php echo $key['MARCA_PAGO']; ?>
	        </td>
	        <td class="text-muted" data-label="Role" style="font-size:11px;"  >
	            <?php echo $key['LIQUIDADA']; ?>
	        </td>
	        <td class="text-muted" data-label="Role" style="font-size:11px;"  >
	            <?php 

					if(is_null($key['CREDITO'])){
						echo 'NO';
					} else {
						echo $key['CREDITO'];
					}
				
				?>
	        </td>
	        <td class="text-muted" data-label="Role" style="font-size:11px;"  >
			<?php 
				if(is_null($key['CUNVIVE'])){
					echo 'NO';
				} else {
					echo $key['CUNVIVE'];
				}

				?>
	        </td>
	        <td class="text-muted" data-label="Role" style="font-size:11px;"  >
	            <?php echo $key['REVERSION']; ?>
	        </td>
	        <td class="text-muted" data-label="Role" style="font-size:11px;"  >
	            <?php 

					if(is_null($key['VAL_PAGO_LIQ'])){
						echo '0';
					} else {
						echo $key['VAL_PAGO_LIQ'];
					}
				
				?>
	        </td>
	        <td class="text-muted" data-label="Role" style="font-size:11px;"  >
	            <?php echo ($key['ADMITIDO']); ?>
	        </td>
	        <td class="text-muted" data-label="Role" style="font-size:11px;"  >
	            <?php echo number_format($key['VALOR_ORDEN']); ?>
	        </td>
	        <td class="text-muted" data-label="Role"  style="font-size:11px;" >
	        	<?php echo number_format($key['VALOR_SEGURO']); ?>
	        </td>
	        <td class="text-muted" data-label="Role"  style="font-size:11px;" >
	        	<?php echo number_format($key['VALOR_INGLES']); ?>
	        </td>
	        <td class="text-muted" data-label="Role" style="font-size:11px;"  >
	        	<?php echo number_format($key['VALOR_DESCT']); ?>
	        </td>
	        <td class="text-muted" data-label="Role" style="font-size:11px;"  >
				<?php echo number_format($key['PORCENTAJE']); ?>
	        </td>
	        <td class="text-muted" data-label="Role" style="font-size:11px;"  >
				<?php echo number_format($key['VALOR_MATRICULA']); ?>
	        </td>
	    </tr>


		<?php
	}

        ?>

            </tbody>
         </table>
        </div>

        <?php

    }
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

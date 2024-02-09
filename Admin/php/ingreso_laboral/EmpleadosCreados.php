<?php

$centro_costo = $_POST['centro_costo'];
$estado = $_POST['estado'];
$existe_ingreso = $_POST['existe_ingreso'];
$palabra_clave = strtoupper($_POST['palabra_clave']);

$url = 'http://190.184.202.251:8090/formularioback/Admin/ingreso_laboral/EmpleadosKactus.php';
//$url = 'http://localhost/CUN/formularioback/Admin/ingreso_laboral/EmpleadosKactus.php';

$datos = array(
    'centro_costo' => $centro_costo,
    'estado' => $estado,
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


$result_kactus = json_decode($result, true);

//Consultar Empleados en MYSQL

$url2 = 'https://homologaciones.cun.edu.co/back_inglab_app/EmpleadosIngresoLaboral.php';
//$url2 = 'http://localhost/CUN/back_inglab_app/EmpleadosIngresoLaboral.php';

$datos2 = array(
    '' => ''
);


//Iniciar cURL

$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, $url2);

//curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $datos2); 
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result2 = curl_exec($ch2);

curl_close($ch2);

$result_mysql = json_decode($result2, true);

//Recorrer consulta kactus

?>

<table class="table table-vcenter table-mobile-md card-table" id="Tabla">
  <thead>
    <tr>
      <th style="font-size:9px;">#</th>
      <th style="font-size:9px;">Cedula</th>
      <th style="font-size:9px;">Nombres</th>
      <th style="font-size:9px;">Apellidos</th>
      <th style="font-size:9px;">Centro de costos</th>
      <th style="font-size:9px;">Correo Kactus</th>
      <th style="font-size:9px;">Correo Iceberg</th>
      <th style="font-size:9px;">Correo Ldap</th>
      <th style="font-size:9px;">Correo Ingreso</th>
      <th style="font-size:9px;">Existe en ingreso laboral?</th>
      <th style="font-size:9px;">Crear en ingreso laboral?</th>
      <th style="font-size:9px;">Actualizar en ingreso laboral?</th>
    </tr>
  </thead>
  <tbody>

<?php
$cont = 0;
foreach ($result_kactus as $empleado_kactus){

	$cedula_empleado_kactus = $empleado_kactus['COD_EMPL'];

	//Validar si la cedula existe en ingreso laboral

	$existe = ExisteMysql($cedula_empleado_kactus,$result_mysql);
	$correo_ingreso = CorreoIngreso($cedula_empleado_kactus,$result_mysql);
	
	if($existe_ingreso == 'SI'){

		//Mostrar solo los que si existen en ingreso laboral

		if($existe == 1){
			$cont++;
			//Mostrar en la tabla

			?>

		    <tr>
		    	<td style="font-size:11px;"><?php echo $cont; ?></td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $cedula_empleado_kactus; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['NOM_EMPL']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['APE_EMPL']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['NOMBRE_CENTRO_COSTO']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['CORREO_KACTUS']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['CORREO_ICEBERG']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['CORREO_IDAP']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $correo_ingreso; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php 

						if($existe == 1){
							echo "SI";
						}else{
							echo "NO";
						}

		            ?>
		        </td>
		        <td><input type="button" value="Crear" class="btn btn-success" style="font-size:11px;" 
		        	onclick='CrearIngreso(<?php echo json_encode($empleado_kactus, true); ?>);'></td>
		        <td><input type="button" value="Actualizar" class="btn btn-warning" style="font-size:11px;" 
		        	onclick='EditarEmpleado(<?php echo json_encode($empleado_kactus, true); ?>);'></td>

		    </tr>

		    <?php

		}	

	}else if($existe_ingreso == 'NO'){

		//Mostrar solo los que NO existen en ingreso laboral

		if($existe != 1){
			$cont++;
			//Mostrar en la tabla

			?>

		    <tr>
		    	<td style="font-size:11px;"><?php echo $cont; ?></td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $cedula_empleado_kactus; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['NOM_EMPL']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['APE_EMPL']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['NOMBRE_CENTRO_COSTO']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['CORREO_KACTUS']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['CORREO_ICEBERG']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['CORREO_IDAP']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $correo_ingreso; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php 

						if($existe == 1){
							echo "SI";
						}else{
							echo "NO";
						}

		            ?>
		        </td>
		        <td><input type="button" value="Crear" class="btn btn-success" style="font-size:11px;" 
		        	onclick='CrearIngreso(<?php echo json_encode($empleado_kactus, true); ?>);'></td>
		        <td><input type="button" value="Actualizar" class="btn btn-warning" style="font-size:11px;" 
		        	onclick='EditarEmpleado(<?php echo json_encode($empleado_kactus, true); ?>);'></td>

		    </tr>

		    <?php

		}

	}else{
		$cont++;
		//Mostrar todos

		?>

		    <tr>
		    	<td style="font-size:11px;"><?php echo $cont; ?></td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $cedula_empleado_kactus; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['NOM_EMPL']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['APE_EMPL']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['NOMBRE_CENTRO_COSTO']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['CORREO_KACTUS']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['CORREO_ICEBERG']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $empleado_kactus['CORREO_IDAP']; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php echo $correo_ingreso; ?>
		        </td>
		        <td class="text-muted" data-label="Role" style="font-size:11px;">
		            <?php 

						if($existe == 1){
							echo "SI";
						}else{
							echo "NO";
						}

		            ?>
		        </td>
		        <td><input type="button" value="Crear" class="btn btn-success" style="font-size:11px;" 
		        	onclick='CrearIngreso(<?php echo json_encode($empleado_kactus, true); ?>);'></td>
		        <td><input type="button" value="Actualizar" class="btn btn-warning" style="font-size:11px;" 
		        	onclick='EditarEmpleado(<?php echo json_encode($empleado_kactus, true); ?>);'></td>

		    </tr>

		<?php

	}

}	

?>

	</tbody>
</table>

<?php


function ExisteMysql($cedula_kactus,$result_mysql){
	
	//Validar si esa cedula existe

	//Recorrer array de mysql

	foreach ($result_mysql as $key){
		
		$cedula_mysql = $key['cedula_usuario'];

		if($cedula_mysql == $cedula_kactus){
			$result = 1;
			break;
		}

	}	

	return $result;

}


function CorreoIngreso($cedula_kactus,$result_mysql){

	foreach ($result_mysql as $key){
		
		$cedula_mysql = $key['cedula_usuario'];

		if($cedula_mysql == $cedula_kactus){
			$result = $key['correo_usuario'];
			break;
		}

	}	

	return $result;

}


?>


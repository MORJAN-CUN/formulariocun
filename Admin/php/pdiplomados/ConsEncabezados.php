<?php
date_default_timezone_set('America/Bogota');
include 'FechaMaxEncabezado.php';

$url = 'http://190.184.202.251:8090/formularioback/Admin/pdiplomados/ConsEncabezados.php';
// $url = 'http://localhost/formularioback/Admin/pdiplomados/ConsEncabezados.php';

$periodo = $_POST['periodo'];
$grupo = $_POST['grupo'];
$centro_costos = $_POST['centro_costos'];
$programa = $_POST['programa'];

$datos = array(
    'periodo' => $periodo,
    'grupo' => $grupo,
    'centro_costos' => $centro_costos,
    'programa' => $programa
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

<table class="table table-vcenter table-mobile-md card-table" id="Tabla">
  <thead>
    <tr>
	    <th>Secuencia</th>
	    <th>Periodo</th>
	    <th>Grupo</th>
	    <th>Centro costos</th>
	    <th>Programa</th>
      <th>Fecha Vencimiento</th>
	    <th>Agregar Fecha</th>
      <th>Editar</th>
    </tr>
  </thead>
  <tbody>

  	<?PHP
    $row2 = '}';
  	foreach ($data as $key){
  		
  		if(array_key_exists('SECUENCIA', $key)){$SECUENCIA = $key['SECUENCIA'];}else{$SECUENCIA = '';}
  		if(array_key_exists('PERIODO', $key)){$PERIODO = $key['PERIODO'];}else{$PERIODO = '';}
  		if(array_key_exists('NUM_GRUPO', $key)){$NUM_GRUPO = $key['NUM_GRUPO'];}else{$NUM_GRUPO = '';}
  		if(array_key_exists('CENTRO_COSTO', $key)){$CENTRO_COSTO = $key['CENTRO_COSTO'];}else{$CENTRO_COSTO = '';}
  		if(array_key_exists('NOM_UNIDAD', $key)){$NOM_UNIDAD = $key['NOM_UNIDAD'];}else{$NOM_UNIDAD = '';}

      $fecha_max = getFechaMax($SECUENCIA);

      if($fecha_max == 'Ninguna'){
        $fecha_max = 'Ninguna';
        $edit_f = 1;
      }else{
        $fecha_max = $fecha_max;
        $fecha_max_f = new DateTime($fecha_max);
        $fecha_max_f = $fecha_max_f->format('Y-m-d');
        $fecha_act = date('Y-m-d');

        if($fecha_max_f >= $fecha_act){
          $edit_f = 1;
        }else{
          $edit_f = 0;
        }

      }

  		?>

  			<tr>
  				<td><?php echo $SECUENCIA; ?></td>
  				<td><?php echo $PERIODO; ?></td>
  				<td><?php echo $NUM_GRUPO; ?></td>
  				<td><?php echo $CENTRO_COSTO; ?></td>
  				<td><?php echo $NOM_UNIDAD; ?></td>
          <td>
            <?php 
              echo $fecha_max = getFechaMax($SECUENCIA); 
            ?>
          </td>

  				<td>
            <?php 
            if($edit_f == 1){
              ?><input type="button" class="btn btn-success" value="Agregar Fecha" onclick="AgregarFecha(<?php echo $key['SECUENCIA']; ?>);"><?php
            }
            ?>
          </td>

          <td><input type="button" class="btn btn-warning EditarEncabezado" value="Editar" style="background-color: #FBBA2E;" data-descr="
           <?php 
            echo htmlentities($key['SECUENCIA']); echo htmlentities($row2); 
            echo htmlentities($key['PERIODO']); echo htmlentities($row2); 
            echo htmlentities($key['NUM_GRUPO']); echo htmlentities($row2); 
            echo htmlentities($key['CENTRO_COSTO']); echo htmlentities($row2); 
            echo htmlentities($key['COD_UNIDAD']); echo htmlentities($row2); 
            ?>"></td>
        </tr> 

  		<?php
  	}

  	?>

  </tbody>
</table>


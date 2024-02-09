<?php
$consecutivo = $_POST['consecutivo'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/credyty/ConsDetalleCredyty.php';
//$url = 'http://localhost/CUN/formularioback/Admin/credyty/ConsDetalleCredyty.php';

$datos = array(
    'consecutivo' => $consecutivo
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

$data_loads = json_decode($result,true);

?>
<div class="table-responsive">
<table class="table table-vcenter table-mobile-md card-table">
  <thead>
    <tr>
      <th style="font-size:9px !important;">Item</th>
      <th style="font-size:9px !important;">Identificacion</th>
      <th style="font-size:9px !important;">Nombre</th>
      <th style="font-size:9px !important;">Programa</th>
      <th style="font-size:9px !important;">Sede</th>
      <th style="font-size:9px !important;">Valor financiado</th>
      <th style="font-size:9px !important;">F. a. credito</th>
      <th style="font-size:9px !important;">Cuotas</th>
      <th style="font-size:9px !important;">Primer pago</th>
      <th style="font-size:9px !important;">F. primer pago</th>
      <th style="font-size:9px !important;">Valor pago U</th>
      <th style="font-size:9px !important;">Orden</th>
      <th style="font-size:9px !important;display: none;">F. de pago</th>
      <th style="font-size:9px !important;">F. de legalizacion</th>
      <th style="font-size:9px !important;">Modalidad</th>
      <th style="font-size:9px !important;">Ciudad</th>
      <th style="font-size:9px !important;">Semestre</th>
      <th style="font-size:9px !important;">Interes</th>
      <th style="font-size:9px !important;">Periodo</th>
      <th style="font-size:9px !important;">Avalador</th>
      <th style="font-size:9px !important;">Nota credito</th>
    </tr>
  </thead>
  <tbody>
<?php
    foreach($data_loads as $registro){

      if(array_key_exists('ITEM', $registro)){$ITEM = $registro['ITEM'];}else{$ITEM = '';}
      if(array_key_exists('IDENTIFICACION', $registro)){$IDENTIFICACION = $registro['IDENTIFICACION'];}else{$IDENTIFICACION = '';}
      if(array_key_exists('NOMBRE', $registro)){$NOMBRE = $registro['NOMBRE'];}else{$NOMBRE = '';}
      if(array_key_exists('PROGRAMA', $registro)){$PROGRAMA = $registro['PROGRAMA'];}else{$PROGRAMA = '';} 
      if(array_key_exists('SEDE', $registro)){$SEDE = $registro['SEDE'];}else{$SEDE = '';} 
      if(array_key_exists('VALOR_FINANCIADO', $registro)){$VALOR_FINANCIADO = $registro['VALOR_FINANCIADO'];}else{$VALOR_FINANCIADO = '';} 
      if(array_key_exists('F_APROVACION', $registro)){$F_APROVACION = $registro['F_APROVACION'];}else{$F_APROVACION = '';} 
      if(array_key_exists('CUOTAS', $registro)){$CUOTAS = $registro['CUOTAS'];}else{$CUOTAS = '';} 
      if(array_key_exists('P_PAGO', $registro)){$P_PAGO = $registro['P_PAGO'];}else{$P_PAGO = '';} 
      if(array_key_exists('FP_PAGO', $registro)){$FP_PAGO = $registro['FP_PAGO'];}else{$FP_PAGO = '';} 
      if(array_key_exists('V_PAGO', $registro)){$V_PAGO = $registro['V_PAGO'];}else{$V_PAGO = '';}
      if(array_key_exists('N_ORDEN', $registro)){$N_ORDEN = $registro['N_ORDEN'];}else{$N_ORDEN = '';}
      if(array_key_exists('F_PAGO', $registro)){$F_PAGO = $registro['F_PAGO'];}else{$F_PAGO = '';}
      if(array_key_exists('F_LEGALIZACION', $registro)){$F_LEGALIZACION = $registro['F_LEGALIZACION'];}else{$F_LEGALIZACION = '';}
      if(array_key_exists('MODALIDAD', $registro)){$MODALIDAD = $registro['MODALIDAD'];}else{$MODALIDAD = '';}
      if(array_key_exists('CIUDAD', $registro)){$CIUDAD = $registro['CIUDAD'];}else{$CIUDAD = '';}
      if(array_key_exists('SEMESTRE', $registro)){$SEMESTRE = $registro['SEMESTRE'];}else{$SEMESTRE = '';}
      if(array_key_exists('INTERES', $registro)){$INTERES = $registro['INTERES'];}else{$INTERES = '';}
      if(array_key_exists('PERIODO', $registro)){$PERIODO = $registro['PERIODO'];}else{$PERIODO = '';}
      if(array_key_exists('AVALADOR', $registro)){$AVALADOR = $registro['AVALADOR'];}else{$AVALADOR = '';}
      if(array_key_exists('NOTA_CRE', $registro)){$NOTA_CRE = $registro['NOTA_CRE'];}else{$NOTA_CRE = '';}
      
        ?>
        <tr style="font-size:9px !important;">    
            <td data-label="Name">
               <?php echo $ITEM; ?>
            </td>
             <td data-label="Name">
               <?php echo $IDENTIFICACION; ?>
            </td>
             <td data-label="Name">
               <?php echo $NOMBRE; ?>
            </td>
             <td data-label="Name">
               <?php echo $PROGRAMA; ?>
            </td>
             <td data-label="Name">
               <?php echo $SEDE; ?>
            </td>
             <td data-label="Name">
               <?php echo $VALOR_FINANCIADO; ?>
            </td>
             <td data-label="Name">
               <?php echo $F_APROVACION; ?>
            </td>
             <td data-label="Name">
               <?php echo $CUOTAS; ?>
            </td>
             <td data-label="Name">
               <?php echo $P_PAGO; ?>
            </td>
             <td data-label="Name">
               <?php echo $FP_PAGO; ?>
            </td>
             <td data-label="Name">
               <?php echo $V_PAGO; ?>
            </td>
             <td data-label="Name">
               <?php echo $N_ORDEN; ?>
            </td>
             <td data-label="Name" style="display:none;">
               <?php echo $F_PAGO; ?>
            </td>
             <td data-label="Name">
               <?php echo $F_LEGALIZACION; ?>
            </td>
             <td data-label="Name">
               <?php echo $MODALIDAD; ?>
            </td>
             <td data-label="Name">
               <?php echo $CIUDAD; ?>
            </td>
             <td data-label="Name">
               <?php echo $SEMESTRE; ?>
            </td>
             <td data-label="Name">
               <?php echo $INTERES; ?>
            </td>
             <td data-label="Name">
               <?php echo $PERIODO; ?>
            </td>
             <td data-label="Name">
               <?php echo $AVALADOR; ?>
            </td>
             <td data-label="Name">
               <?php echo $NOTA_CRE; ?>
            </td>
        </tr>
        <?php
    }
?>        
  </tbody>
</table>
</div>


<?php

$consecutivo = $_GET['cons'];

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

$data_credyty = json_decode($result,true);

# Cargar librerias y cosas necesarias
require_once "../../vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

# Encabezado de la hoja
$encabezado = array ('ITEM','Nro. de Identificación  del Estudiante','Nombres y Apellidos del Estudiante','PROGRAMA','sede','Valor Financiado por la Entidad','Fecha de Aprobación del Crédito','No. Cuotas','PRIMER PAGO','Fecha PRIMER PAGO','Valor Pago a la Universidad','Numero Orden de Matricula','Fechas de pago','Fechas de legalización','Modalidad de estudio','Ciudad residencia del Estudiante','Semestre','Interes total estimado','Periodo Académico','Avalador','Nota credito','Descripcion');


$sheet->setCellValue('A1', $encabezado[0]);
$sheet->setCellValue('B1', $encabezado[1]);
$sheet->setCellValue('C1', $encabezado[2]);
$sheet->setCellValue('D1', $encabezado[3]);
$sheet->setCellValue('E1', $encabezado[4]);
$sheet->setCellValue('F1', $encabezado[5]);
$sheet->setCellValue('G1', $encabezado[6]);
$sheet->setCellValue('H1', $encabezado[7]);
$sheet->setCellValue('I1', $encabezado[8]);
$sheet->setCellValue('J1', $encabezado[9]);
$sheet->setCellValue('K1', $encabezado[10]);
$sheet->setCellValue('L1', $encabezado[11]);
$sheet->setCellValue('M1', $encabezado[12]);
$sheet->setCellValue('N1', $encabezado[13]);
$sheet->setCellValue('O1', $encabezado[14]);
$sheet->setCellValue('P1', $encabezado[15]);
$sheet->setCellValue('Q1', $encabezado[16]);
$sheet->setCellValue('R1', $encabezado[17]);
$sheet->setCellValue('S1', $encabezado[18]);
$sheet->setCellValue('T1', $encabezado[19]);
$sheet->setCellValue('U1', $encabezado[20]);
$sheet->setCellValue('V1', $encabezado[20]);

//Meter la data en las celdas

$fila = 1;

foreach($data_credyty as $data){
    $fila++;

      if(array_key_exists('ITEM', $data)){$ITEM = $data['ITEM'];}else{$ITEM = '';}
      if(array_key_exists('IDENTIFICACION', $data)){$IDENTIFICACION = $data['IDENTIFICACION'];}else{$IDENTIFICACION = '';}
      if(array_key_exists('NOMBRE', $data)){$NOMBRE = $data['NOMBRE'];}else{$NOMBRE = '';}
      if(array_key_exists('PROGRAMA', $data)){$PROGRAMA = $data['PROGRAMA'];}else{$PROGRAMA = '';} 
      if(array_key_exists('SEDE', $data)){$SEDE = $data['SEDE'];}else{$SEDE = '';} 
      if(array_key_exists('VALOR_FINANCIADO', $data)){$VALOR_FINANCIADO = $data['VALOR_FINANCIADO'];}else{$VALOR_FINANCIADO = '';} 
      if(array_key_exists('F_APROVACION', $data)){$F_APROVACION = $data['F_APROVACION'];}else{$F_APROVACION = '';} 
      if(array_key_exists('CUOTAS', $data)){$CUOTAS = $data['CUOTAS'];}else{$CUOTAS = '';} 
      if(array_key_exists('P_PAGO', $data)){$P_PAGO = $data['P_PAGO'];}else{$P_PAGO = '';} 
      if(array_key_exists('FP_PAGO', $data)){$FP_PAGO = $data['FP_PAGO'];}else{$FP_PAGO = '';} 
      if(array_key_exists('V_PAGO', $data)){$V_PAGO = $data['V_PAGO'];}else{$V_PAGO = '';}
      if(array_key_exists('F_PAGO', $data)){$F_PAGO = $data['F_PAGO'];}else{$F_PAGO = '';}
      if(array_key_exists('F_LEGALIZACION', $data)){$F_LEGALIZACION = $data['F_LEGALIZACION'];}else{$F_LEGALIZACION = '';}
      if(array_key_exists('MODALIDAD', $data)){$MODALIDAD = $data['MODALIDAD'];}else{$MODALIDAD = '';}
      if(array_key_exists('CIUDAD', $data)){$CIUDAD = $data['CIUDAD'];}else{$CIUDAD = '';}
      if(array_key_exists('SEMESTRE', $data)){$SEMESTRE = $data['SEMESTRE'];}else{$SEMESTRE = '';}
      if(array_key_exists('INTERES', $data)){$INTERES = $data['INTERES'];}else{$INTERES = '';}
      if(array_key_exists('PERIODO', $data)){$PERIODO = $data['PERIODO'];}else{$PERIODO = '';}
      if(array_key_exists('AVALADOR', $data)){$AVALADOR = $data['AVALADOR'];}else{$AVALADOR = '';}
      if(array_key_exists('NOTA_CRE', $data)){$NOTA_CRE = $data['NOTA_CRE'];}else{$NOTA_CRE = '';}
      if(array_key_exists('DESCRIPCION', $data)){$DESCRIPCION = $data['DESCRIPCION'];}else{$DESCRIPCION = '';}

    $sheet->setCellValue('A'.$fila, $ITEM);
    $sheet->setCellValue('B'.$fila, $IDENTIFICACION);
    $sheet->setCellValue('C'.$fila, $NOMBRE);
    $sheet->setCellValue('D'.$fila, $PROGRAMA);
    $sheet->setCellValue('E'.$fila, $SEDE);
    $sheet->setCellValue('F'.$fila, $VALOR_FINANCIADO);
    $sheet->setCellValue('G'.$fila, $F_APROVACION);
    $sheet->setCellValue('H'.$fila, $CUOTAS);
    $sheet->setCellValue('I'.$fila, $P_PAGO);
    $sheet->setCellValue('J'.$fila, $FP_PAGO);
    $sheet->setCellValue('K'.$fila, $V_PAGO);
    $sheet->setCellValue('L'.$fila, '');
    $sheet->setCellValue('M'.$fila, $F_PAGO);
    $sheet->setCellValue('N'.$fila, $F_LEGALIZACION);
    $sheet->setCellValue('O'.$fila, $MODALIDAD);
    $sheet->setCellValue('P'.$fila, $CIUDAD);
    $sheet->setCellValue('Q'.$fila, $SEMESTRE);
    $sheet->setCellValue('R'.$fila, $INTERES);
    $sheet->setCellValue('S'.$fila, $PERIODO);
    $sheet->setCellValue('T'.$fila, $AVALADOR);
    $sheet->setCellValue('U'.$fila, $NOTA_CRE);
    $sheet->setCellValue('V'.$fila, $DESCRIPCION);

}


$writer = new Xlsx($spreadsheet);

$nom_file = 'Reporte_Credyty_'.date('Y-m-d H:i:s').'.xlsx';
//Guardar archivo
$writer->save('files_generated/'.$nom_file);

//Descargar archivo generado
//Dar permisos
chmod('files_generated/'.$nom_file,  0666);

$archivo = 'files_generated/'.$nom_file;

//Generar descarga
header('Content-Disposition: attachment;filename='.$nom_file);
header('Content-Type: application/vnd.ms-excel');
header('Content-Length: '.filesize($archivo));
header('Cache-Control: max-age=0');
readfile($archivo);


?>

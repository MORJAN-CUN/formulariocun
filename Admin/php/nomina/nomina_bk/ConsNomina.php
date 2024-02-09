<?php

$periodo = $_POST['periodo'];
$cedula = $_POST['cedula'];
//$cedula = '1070626283';

$url = 'http://190.184.202.251:8090/formularioback/Admin/nomina/ConsultarNomina.php';
//$url = 'http://localhost/CUN/formularioback/Admin/nomina/ConsultarNomina.php';

$datos = array(
    'periodo' => $periodo,
    'cedula' => $cedula
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

$data_empleados = json_decode($result,true);


//Crear excel con el resultado del cURL

# Cargar librerias y cosas necesarias
require_once "../../vendor/autoload.php";
require_once "json_devengados.php";
require_once "json_deducidos.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

# Encabezado de la hoja
$encabezado = array (
	'CODIGO_SUCURSAL_EMPLEADOR',
	'NE_PREFIJO',
	'NE_CONSECUTIVO',
	'NE_DEVENGADO_TOTAL',
	'NE_DEDUCCION_TOTAL',
	'NE_TIPO_DOCUMENTO',
	'NE_PERIODO_NOMINA',
	'NE_FECHA_LIQUIDACION_INICIO',
	'NE_FECHA_LIQUIDACION_FIN',
	'NE_TIEMPO_LABORADO',
	'NE_TIPO_MONEDA',
	'NE_TRM',
	'NE_NOTAS',
	'NE_FECHA_PAGO',
	'NE_CUNE_NOVEDAD',
	'NAE_TIPO_NOTA',
	'NAE_CUNE',
	'TR_TIPO_IDENTIFICACION',
	'TR_NUMERO_IDENTIFICACION',
	'TR_CODIGO',
	'TR_PRIMER_APELLIDO',
	'TR_SEGUNDO_APELLIDO',
	'TR_PRIMER_NOMBRE',
	'TR_SEGUNDO_NOMBRE',
	'TR_CORREO_ELECTRONICO',
	'TR_TIPO_TRABAJADOR',
	'TR_SUBTIPO_TRABAJADOR',
	'TR_ALTO_RIESGO_PENSION',
	'TR_LUGAR_TRABAJO_PAIS',
	'TR_LUGAR_TRABAJO_DEPARTAMENTO',
	'TR_LUGAR_TRABAJO_MUNICIPIO',
	'TR_LUGAR_TRABAJO_DIRECCION',
	'TR_SALARIO_INTEGRAL',
	'TR_TIPO_CONTRATO',
	'TR_SUELDO',
	'TR_FECHA_INGRESO',
	'TR_FECHA_RETIRO',
	'TR_FORMA_PAGO',
	'TR_METODO_PAGO',
	'TR_BANCO',
	'TR_TIPO_CUENTA',
	'TR_NUMERO_CUENTA',
	'DyD_devengados',
	'DyD_deducciones'
);


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
$sheet->setCellValue('V1', $encabezado[21]);
$sheet->setCellValue('W1', $encabezado[22]);
$sheet->setCellValue('X1', $encabezado[23]);
$sheet->setCellValue('Y1', $encabezado[24]);
$sheet->setCellValue('Z1', $encabezado[25]);
$sheet->setCellValue('AA1', $encabezado[26]);
$sheet->setCellValue('AB1', $encabezado[27]);
$sheet->setCellValue('AC1', $encabezado[28]);
$sheet->setCellValue('AD1', $encabezado[29]);
$sheet->setCellValue('AE1', $encabezado[30]);
$sheet->setCellValue('AF1', $encabezado[31]);
$sheet->setCellValue('AG1', $encabezado[32]);
$sheet->setCellValue('AH1', $encabezado[33]);
$sheet->setCellValue('AI1', $encabezado[34]);
$sheet->setCellValue('AJ1', $encabezado[35]);
$sheet->setCellValue('AK1', $encabezado[36]);
$sheet->setCellValue('AL1', $encabezado[37]);
$sheet->setCellValue('AM1', $encabezado[38]);
$sheet->setCellValue('AN1', $encabezado[39]);
$sheet->setCellValue('AO1', $encabezado[40]);
$sheet->setCellValue('AP1', $encabezado[41]);
$sheet->setCellValue('AQ1', $encabezado[42]);
$sheet->setCellValue('AR1', $encabezado[43]);
$sheet->setCellValue('AS1', $encabezado[44]);

$fila = 1;

foreach($data_empleados as $data){
	$fila++;

	$nmro_identificacion = $data['TR_NUMERO_IDENTIFICACION'];
	$tr_codigo = $data['TR_CODIGO'];
	$contrato = explode('-', $tr_codigo);
	$nmro_cuenta = $contrato[1];

	$sheet->setCellValue('A'.$fila, $data['CODIGO_SUCURSAL_EMPLEADOR']);
	$sheet->setCellValue('B'.$fila, $data['NE_PREFIJO']);
	$sheet->setCellValue('C'.$fila, $data['NE_CONSECUTIVO']);
	$sheet->setCellValue('D'.$fila, $data['NE_DEVENGADO_TOTAL']);
	$sheet->setCellValue('E'.$fila, $data['NE_DEDUCCION_TOTAL']);
	$sheet->setCellValue('F'.$fila, $data['NE_TIPO_DOCUMENTO']);
	$sheet->setCellValue('G'.$fila, $data['NE_PERIODO_NOMINA']);
	$sheet->setCellValue('H'.$fila, $data['NE_FECHA_LIQUIDACION_INICIO']);
	$sheet->setCellValue('I'.$fila, $data['NE_FECHA_LIQUIDACION_FIN']);
	$sheet->setCellValue('J'.$fila, $data['NE_TIEMPO_LABORADO']);
	$sheet->setCellValue('K'.$fila, $data['NE_TIPO_MONEDA']);
	$sheet->setCellValue('L'.$fila, $data['NE_TRM']);
	$sheet->setCellValue('M'.$fila, $data['NE_NOTAS']);
	$sheet->setCellValue('N'.$fila, $data['NE_FECHA_PAGO']);
	$sheet->setCellValue('O'.$fila, $data['NE_CUNE_NOVEDAD']);
	$sheet->setCellValue('P'.$fila, $data['NAE_TIPO_NOTA']);
	$sheet->setCellValue('Q'.$fila, $data['NAE_CUNE']);
	$sheet->setCellValue('R'.$fila, $data['TR_TIPO_IDENTIFICACION']);
	$sheet->setCellValue('S'.$fila, $data['TR_NUMERO_IDENTIFICACION']);
	$sheet->setCellValue('T'.$fila, $data['TR_CODIGO']);
	$sheet->setCellValue('U'.$fila, $data['TR_PRIMER_APELLIDO']);
	$sheet->setCellValue('V'.$fila, $data['TR_SEGUNDO_APELLIDO']);
	$sheet->setCellValue('W'.$fila, $data['TR_PRIMER_NOMBRE']);
	$sheet->setCellValue('X'.$fila, $data['TR_SEGUNDO_NOMBRE']);
	$sheet->setCellValue('Y'.$fila, $data['TR_CORREO_ELECTRONICO']);
	$sheet->setCellValue('Z'.$fila, $data['TR_TIPO_TRABAJADOR']);
	$sheet->setCellValue('AA'.$fila, $data['TR_SUBTIPO_TRABAJADOR']);
	$sheet->setCellValue('AB'.$fila, $data['TR_ALTO_RIESGO_PENSION']);
	$sheet->setCellValue('AC'.$fila, $data['TR_LUGAR_TRABAJO_PAIS']);
	$sheet->setCellValue('AD'.$fila, $data['TR_LUGAR_TRABAJO_DEPARTAMENTO']);
	$sheet->setCellValue('AE'.$fila, $data['TR_LUGAR_TRABAJO_MUNICIPIO']);
	$sheet->setCellValue('AF'.$fila, $data['TR_LUGAR_TRABAJO_DIRECCION']);
	$sheet->setCellValue('AG'.$fila, $data['TR_SALARIO_INTEGRAL']);
	$sheet->setCellValue('AH'.$fila, $data['TR_TIPO_CONTRATO']);
	$sheet->setCellValue('AI'.$fila, $data['TR_SUELDO']);
	$sheet->setCellValue('AJ'.$fila, $data['TR_FECHA_INGRESO']);
	$sheet->setCellValue('AK'.$fila, $data['TR_FECHA_RETIRO']);
	$sheet->setCellValue('AL'.$fila, $data['TR_FORMA_PAGO']);
	$sheet->setCellValue('AM'.$fila, $data['TR_METODO_PAGO']);
	$sheet->setCellValue('AN'.$fila, $data['TR_BANCO']);	
	$sheet->setCellValue('AO'.$fila, $data['TR_TIPO_CUENTA']);
	$sheet->setCellValue('AP'.$fila, $data['TR_NUMERO_CUENTA']);


	//Invocar JSON

	$DyD_devengados = DyD_devengados($periodo,$nmro_identificacion,$nmro_cuenta);
	$DyD_deducciones = DyD_deducciones($periodo,$nmro_identificacion,$nmro_cuenta);

	$DyD_devengados_JSON = json_encode($DyD_devengados);
	$DyD_deducciones_JSON = json_encode($DyD_deducciones);

	$sheet->setCellValue('AQ'.$fila, $DyD_devengados_JSON);
	$sheet->setCellValue('AR'.$fila, $DyD_deducciones_JSON);


}

$writer = new Xlsx($spreadsheet);


$nom_file = 'Reporte_Nomina_'.date('Y-m-d H:i:s').'.xlsx';
//Guardar archivo
$writer->save('files_generated/'.$nom_file);
$status = 1;

//Descargar archivo generado
//Dar permisos
chmod('files_generated/'.$nom_file,  0666);

$link_descarga = 'php/nomina/donwloadfile.php?file='.$nom_file;

$datos_r = array(
	'status' => $status,
	'link' => $link_descarga
);

echo json_encode($datos_r);
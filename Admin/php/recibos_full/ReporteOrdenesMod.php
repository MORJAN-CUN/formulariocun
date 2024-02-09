<?php
date_default_timezone_set('America/Bogota');
session_start();
include '../DatosEmpleado.php';
require '../../vendor/autoload.php';

$id_usu = $data_empleado['id_usu'];
$cedula = $data_empleado['cedula'];

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$fecha_desde = $_POST['fecha_desde'];
$fecha_hasta = $_POST['fecha_hasta'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/recibos_full/ReporteOrdenesMod.php';
//$url = 'http://localhost/CUN/formularioback/Admin/recibos_full/ReporteOrdenesMod.php';

$datos = array(
    'fecha_desde' => $fecha_desde,
    'fecha_hasta' => $fecha_hasta,
    'id_usu' => $id_usu
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

$data_ordenes = json_decode($result,true);
	
# Encabezado de la hoja
$encabezado = array (
	'FECHA MODIFICACION',
	'USUARIO QUE MODIFICO',
	'ORDEN',
	'DESCRIPCION',
	'CEDULA ESTUDIANTE',
	'NOMBRE ESTUDIANTE',
	'PERIODO',
	'PROGRAMA'
);

$sheet->setCellValue('A1', $encabezado[0]);
$sheet->setCellValue('B1', $encabezado[1]);
$sheet->setCellValue('C1', $encabezado[2]);
$sheet->setCellValue('D1', $encabezado[3]);
$sheet->setCellValue('E1', $encabezado[4]);
$sheet->setCellValue('F1', $encabezado[5]);
$sheet->setCellValue('G1', $encabezado[6]);
$sheet->setCellValue('H1', $encabezado[7]);

$fila = 1;

foreach($data_ordenes as $data){
	$fila++;

	$descripcion = $data['DESCRIPCION'];
	$descripcion = preg_replace("/[\r\n|\n|\r]+/", " ", $descripcion);

	$sheet->setCellValue('A'.$fila, $data['FECHA']);
	$sheet->setCellValue('B'.$fila, $data['NOMBRE']);
	$sheet->setCellValue('C'.$fila, $data['ORDEN']);
	$sheet->setCellValue('D'.$fila, $descripcion);
	$sheet->setCellValue('E'.$fila, $data['CLIENTE_SOLICITADO']);
	$sheet->setCellValue('F'.$fila, $data['NOM_LARGO']);
	$sheet->setCellValue('G'.$fila, $data['PERIODO']);
	$sheet->setCellValue('H'.$fila, $data['NOMBRE_CENTRO_COSTO']);
	
}

$writer = new Xlsx($spreadsheet);


$nom_file = 'Reporte_Ordenes_Modificadas_'.date('Y-m-d H:i:s').'.xlsx';
//Guardar archivo
$writer->save('reportes/'.$nom_file);
$status = 1;

//Descargar archivo generado
//Dar permisos
chmod('reportes/'.$nom_file,  0666);

$link_descarga = 'php/recibos_full/donwloadfile.php?file='.$nom_file;

$datos_r = array(
	'status' => $status,
	'link' => $link_descarga
);

echo json_encode($datos_r);

?>
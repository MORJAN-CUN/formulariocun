<?php
date_default_timezone_set('America/Bogota');
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$fecha_desde = $_POST['fecha_desde'];
$fecha_hasta = $_POST['fecha_hasta'];
$centro_costo = $_POST['centro_costo'];
$dispositivos = $_POST['dispositivos'];
$palabra_clave = $_POST['palabra_clave'];

$url = 'https://homologaciones.cun.edu.co/back_inglab_app/ConsultarEmpleados.php';
//$url = 'http://localhost/CUN/back_inglab_app/ConsultarEmpleados.php';

$datos = array(
    'fecha_desde' => $fecha_desde,
    'fecha_hasta' => $fecha_hasta,
    'centro_costo' => $centro_costo,
    'dispositivos' => $dispositivos,
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

$result_arr = json_decode($result, true);

# Encabezado de la hoja
$encabezado = array (
	'CEDULA',
	'NOMBRES',
	'APELLIDOS',
	'CORREO',
	'CENTRO DE COSTOS',
	'FECHA DE ENTRADA',
	'DISPOSITIVO'
);

$sheet->setCellValue('A1', $encabezado[0]);
$sheet->setCellValue('B1', $encabezado[1]);
$sheet->setCellValue('C1', $encabezado[2]);
$sheet->setCellValue('D1', $encabezado[3]);
$sheet->setCellValue('E1', $encabezado[4]);
$sheet->setCellValue('F1', $encabezado[5]);
$sheet->setCellValue('G1', $encabezado[6]);

$fila = 1;

foreach($result_arr as $data){
	$fila++;

	$sheet->setCellValue('A'.$fila, $data['cedula_usuario']);
	$sheet->setCellValue('B'.$fila, $data['nombres_usuario']);
	$sheet->setCellValue('C'.$fila, $data['apellidos_usuario']);
	$sheet->setCellValue('D'.$fila, $data['correo_usuario']);
	$sheet->setCellValue('E'.$fila, $data['nombre_centro_costos']);
	$sheet->setCellValue('F'.$fila, $data['fecha_entrada']);
	$sheet->setCellValue('G'.$fila, $data['dispositivos']);
	
}

$writer = new Xlsx($spreadsheet);


$nom_file = 'Reporte_Ingreso_Laboral_'.date('Y-m-d H:i:s').'.xlsx';
//Guardar archivo
$writer->save('files_generated/'.$nom_file);
$status = 1;

//Descargar archivo generado
//Dar permisos
chmod('files_generated/'.$nom_file,  0666);

$link_descarga = 'php/ingreso_laboral/donwloadfile.php?file='.$nom_file;

$datos_r = array(
	'status' => $status,
	'link' => $link_descarga
);

echo json_encode($datos_r);


?>
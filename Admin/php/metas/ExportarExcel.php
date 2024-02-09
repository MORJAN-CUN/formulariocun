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

$data_rest = json_decode($result,true);

//Crear excel con el resultado del cURL

# Cargar librerias y cosas necesarias
require_once "../../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

# Encabezado de la hoja
$encabezado = array (
	'PERIODO',
	'UNIDAD_NEGOCIO',
	'GRUPO_ANALISIS',
	'REGIONAL',
	'SEDE',
	'TIPO_ALUMNO',
	'PROGRAMA',
	'MODALIDAD',
	'CICLO',
	'META_ESTUDIANTES',
	'META_VALOR_INGRESOS'
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


$fila = 1;

foreach($data_rest as $data){
	$fila++;

	if (array_key_exists('TIPO_ALUMNO', $data)) {
	  $tipo_alumno = $data['TIPO_ALUMNO'];
	}else{
		$tipo_alumno = '';
	}

	if (array_key_exists('NOM_PROGRAMA', $data)) {
	  $nom_programa = $data['NOM_PROGRAMA'];
	}else{
		$nom_programa = '';
	}

	if (array_key_exists('MODALIDAD', $data)) {
	  $modalidad = $data['MODALIDAD'];
	}else{
		$modalidad = '';
	}

	if (array_key_exists('CICLO', $data)) {
	  $ciclo = $data['CICLO'];
	}else{
		$ciclo = '';
	}

	$sheet->setCellValue('A'.$fila, $data['PERIODO']);
	$sheet->setCellValue('B'.$fila, $unidad_negocio);
	$sheet->setCellValue('C'.$fila, $data['GRUPO']);
	$sheet->setCellValue('D'.$fila, $data['REGIONAL']);
	$sheet->setCellValue('E'.$fila, $data['SEDE']);
	$sheet->setCellValue('F'.$fila, $tipo_alumno);
	$sheet->setCellValue('G'.$fila, $nom_programa);
	$sheet->setCellValue('H'.$fila, $modalidad);
	$sheet->setCellValue('I'.$fila, $ciclo);
	$sheet->setCellValue('J'.$fila, $data['META_ESTUDIANTES']);
	$sheet->setCellValue('K'.$fila, $data['META_VALOR_INGRESOS']);

}

$writer = new Xlsx($spreadsheet);


$nom_file = 'Reporte_Metas_'.date('Y-m-d H:i:s').'.xlsx';
$writer->save('files_generated/'.$nom_file);
$status = 1;

chmod('files_generated/'.$nom_file,  0666);

$link_descarga = 'php/metas/donwloadfile.php?file='.$nom_file;

$datos_r = array(
	'status' => $status,
	'link' => $link_descarga
);

echo json_encode($datos_r);

?>
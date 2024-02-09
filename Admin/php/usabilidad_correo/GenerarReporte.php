<?php

$url = 'http://190.184.202.251:8090/formularioback/Admin/usabilidad_correo/ConsultarEstudiantes.php';
//$url = 'http://localhost/formularioback/Admin/usabilidad_correo/ConsultarEstudiantes.php';

$periodo = $_POST['periodo'];

$datos = array(
    'periodo' => $periodo
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
    'CORREO',
    'NOMBRE',
    'ULTIMO ACCESO'
);

$sheet->setCellValue('A1', $encabezado[0]);
$sheet->setCellValue('B1', $encabezado[1]);
$sheet->setCellValue('C1', $encabezado[2]);
$sheet->setCellValue('D1', $encabezado[3]);

$fila = 1;

foreach($data as $key){
    $fila++;

    $fecha = $key['ULT_ACCESO'];
  
    if(($timestamp = strtotime($fecha)) === false){
        $ultimo_login = 'Desconocido';
    }else{
        $fecha_ult = date('Y-m-d', $timestamp);

        if($fecha_ult == '1970-01-01'){
                $ultimo_login = 'No ha ingresado';
        }else if($fecha_ult == null || $fecha_ult == '' || empty($fecha_ult)){
                $ultimo_login = 'Desconocido';
        }else{
                $ultimo_login = $fecha_ult;
        }

    }

    $sheet->setCellValue('A'.$fila, $periodo);
    $sheet->setCellValue('B'.$fila, $key['EMAIL']);
    $sheet->setCellValue('C'.$fila, $key['NOMBRE_ESTUDIANTE']);
    $sheet->setCellValue('D'.$fila, $ultimo_login);

}

$writer = new Xlsx($spreadsheet);


$nom_file = 'Reporte_Usabilidad_'.date('Y-m-d H:i:s').'.xlsx';
$writer->save('files_generated/'.$nom_file);
$status = 1;

chmod('files_generated/'.$nom_file,  0666);

$link_descarga = 'php/usabilidad_correo/donwloadfile.php?file='.$nom_file;

$datos_r = array(
    'status' => $status,
    'link' => $link_descarga
);

echo json_encode($datos_r);

?>
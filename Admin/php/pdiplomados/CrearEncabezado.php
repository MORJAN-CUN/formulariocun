<?php
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula = $data_empleado['cedula'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/pdiplomados/CrearEncabezado.php';
//$url = 'http://localhost/CUN/formularioback/Admin/pdiplomados/CrearEncabezado.php';

$periodo = $_POST['periodo'];
$grupo = $_POST['grupo'];
$centro_costos = $_POST['centro_costos'];
$programa = $_POST['programa'];
$valor_uso = $_POST['valor_uso'];
$linea_credito = $_POST['linea_credito'];

$datos = array(
    'periodo' => $periodo,
    'grupo' => $grupo,
    'centro_costos' => $centro_costos,
    'programa' => $programa,
    'id_usu' => $id_usu,
    'cedula' => $cedula,
    'valor_uso' => $valor_uso,
    'linea_credito' => $linea_credito
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

echo $result;

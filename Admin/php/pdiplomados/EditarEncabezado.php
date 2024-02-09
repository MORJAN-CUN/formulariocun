<?php
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula = $data_empleado['cedula'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/pdiplomados/EditarEncabezado.php';
//$url = 'http://localhost/CUN/formularioback/Admin/pdiplomados/EditarEncabezado.php';

$secuencia = trim($_POST['secuencia']);
$periodo = $_POST['periodo'];
$grupo = $_POST['grupo'];
$centro_costos = $_POST['centro_costos'];
$programa = $_POST['programa'];

$periodo_edit_audi = $_POST['periodo_edit_audi'];
$grupo_edit_audi = $_POST['grupo_edit_audi'];
$programa_edit_audi = $_POST['programa_edit_audi'];
$centro_costos_edit_audi = $_POST['centro_costos_edit_audi'];

$datos = array(
    'secuencia' => $secuencia,
    'periodo' => $periodo,
    'grupo' => $grupo,
    'centro_costos' => $centro_costos,
    'programa' => $programa,
    'id_usu' => $id_usu,
    'cedula' => $cedula,
    'periodo_edit_audi' => $periodo_edit_audi,
    'grupo_edit_audi' => $grupo_edit_audi,
    'programa_edit_audi' => $programa_edit_audi,
    'centro_costos_edit_audi' => $centro_costos_edit_audi
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

?>
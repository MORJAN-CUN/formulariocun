<?php
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula = $data_empleado['cedula'];

$unidad_negocio = $_POST['unidad_negocio'];
$periodo = $_POST['periodo'];
$tipo_ingreso = $_POST['tipo_ingreso'];
$clase_ingreso = $_POST['clase_ingreso'];
$regional = $_POST['regional_input'];
$sede = $_POST['sede_input'];
$programa = $_POST['programa_input'];
$modalidad = $_POST['modalidad_input'];
$ciclo = $_POST['ciclo_input'];
$nivel_formacion = $_POST['nivel_formacion'];
$tipo_alumno = $_POST['tipo_alumno_input'];
$grupo = $_POST['grupo'];
$valor_ingresos = $_POST['valor_ingresos_input'];
$meta_estudiantes = $_POST['meta_estudiantes_input'];

//Enviar por cURL

$url = 'http://190.184.202.251:8090/formularioback/Admin/metas/CrearMeta.php';
//$url = 'http://localhost/CUN/formularioback/Admin/metas/CrearMeta.php';

$datos = array(
    'unidad_negocio' => $unidad_negocio,
    'periodo' => $periodo,
    'tipo_ingreso' => $tipo_ingreso,
    'clase_ingreso' => $clase_ingreso,
    'regional' => $regional,
    'sede' => $sede,
    'programa' => $programa,
    'modalidad' => $modalidad,
    'ciclo' => $ciclo,
    'nivel_formacion' => $nivel_formacion,
    'tipo_alumno' => $tipo_alumno,
    'grupo' => $grupo,
    'valor_ingresos' => $valor_ingresos,
    'meta_estudiantes' => $meta_estudiantes,
    'id_usu' => $id_usu,
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

echo $result;

?>
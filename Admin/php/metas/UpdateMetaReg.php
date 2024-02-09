<?php
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula = $data_empleado['cedula'];

$id_meta = $_POST['id_meta'];
$regional = $_POST['regional_input'];
$sede = $_POST['sede_input'];
$programa = $_POST['programa_input'];
$modalidad = $_POST['modalidad_input'];
$ciclo = $_POST['ciclo_input'];
$tipo_alumno = $_POST['tipo_alumno_input'];
$valor_ingresos = $_POST['valor_ingresos_input'];
$meta_estudiantes = $_POST['meta_estudiantes_input'];

$regional_edit_audi = $_POST['regional_edit_audi'];
$sede_edit_audi = $_POST['sede_edit_audi'];
$tipo_alumno_edit_audi = $_POST['tipo_alumno_edit_audi'];
$programa_edit_audi = $_POST['programa_edit_audi'];
$modalidad_edit_audi = $_POST['modalidad_edit_audi'];
$ciclo_edit_audi = $_POST['ciclo_edit_audi'];
$meta_estudiantes_edit_audi = $_POST['meta_estudiantes_edit_audi'];
$valor_ingresos_edit_audi = $_POST['valor_ingresos_edit_audi'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/metas/UpdateMetaReg.php';
//$url = 'http://localhost/CUN/formularioback/Admin/metas/UpdateMetaReg.php';

$datos = array(
    'id' => $id_meta,
    'regional' => $regional,
    'sede' => $sede,
    'programa' => $programa,
    'modalidad' => $modalidad,
    'ciclo' => $ciclo,
    'tipo_alumno' => $tipo_alumno,
    'valor_ingresos' => $valor_ingresos,
    'meta_estudiantes' => $meta_estudiantes,
    'id_usu' => $id_usu,
    'cedula' => $cedula,
    'regional_edit_audi' => $regional_edit_audi,
    'sede_edit_audi' => $sede_edit_audi,
    'tipo_alumno_edit_audi' => $tipo_alumno_edit_audi,
    'programa_edit_audi' => $programa_edit_audi,
    'modalidad_edit_audi' => $modalidad_edit_audi,
    'ciclo_edit_audi' => $ciclo_edit_audi,
    'meta_estudiantes_edit_audi' => $meta_estudiantes_edit_audi,
    'valor_ingresos_edit_audi' => $valor_ingresos_edit_audi
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

//$data = json_decode($result,true);

echo $result;



?>
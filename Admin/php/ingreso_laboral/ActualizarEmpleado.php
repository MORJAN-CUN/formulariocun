<?php

$cedula_empleado = $_POST['cedula_empleado'];
$nombres_empleado = $_POST['nombres_empleado'];
$apellidos_empleado = $_POST['apellidos_empleado'];
$correo_empleado = $_POST['correo_empleado'];

$url = 'https://homologaciones.cun.edu.co/back_inglab_app/ActualizarEmpleadoIngreso.php';
//$url = 'http://localhost/CUN/back_inglab_app/ActualizarEmpleadoIngreso.php';

$datos = array(
    'cedula_empleado' => $cedula_empleado,
    'nombres_empleado' => $nombres_empleado,
    'apellidos_empleado' => $apellidos_empleado,
    'correo_empleado' => $correo_empleado
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
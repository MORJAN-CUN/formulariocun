<?PHP
session_start();
include '../DatosEmpleado.php';

$referencia = $_POST['referencia'];


$url = 'http://190.184.202.251:8090/formularioback/Admin/aplicacion_pagos/StatePending.php';
//$url = 'http://localhost/CUN/formularioback/Admin/aplicacion_pagos/StatePending.php';

$datos = array(
    'referencia' => $referencia,
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
<?php

$datos = $_POST;

$url = 'https://homologaciones.cun.edu.co/back_inglab_app/CrearIngreso.php';
//$url = 'http://localhost/CUN/back_inglab_app/CrearIngreso.php';


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
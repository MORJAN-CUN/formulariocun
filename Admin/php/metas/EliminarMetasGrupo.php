<?php

$unidad_negocio = $_POST['unidad_negocio'];
$grupo_analisis = $_POST['grupo_analisis'];
$periodo = $_POST['periodo'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/metas/EliminarMetasGrupo.php';
//$url = 'http://localhost/formularioback/Admin/metas/EliminarMetasGrupo.php';

$datos = array(
    'unidad_negocio' => $unidad_negocio,
    'grupo_analisis' => $grupo_analisis,
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

//$data = json_decode($result,true);

echo $result;


?>

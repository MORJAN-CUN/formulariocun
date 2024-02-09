<?php
$id_meta = $_POST['id_meta'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/metas/EliminarMeta.php';
//$url = 'http://localhost/formularioback/Admin/metas/EliminarMeta.php';

$datos = array(
    'id' => $id_meta
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

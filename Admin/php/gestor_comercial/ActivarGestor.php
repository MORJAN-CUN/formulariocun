<?PHP
session_start();
include '../DatosEmpleado.php';

$cedula = $_POST['cedula'];


$url = 'http://190.184.202.251:8090/formularioback/Admin/gestor_comercial/ActivarGestor.php';
//$url = 'http://localhost/CUN/formularioback/Admin/gestor_comercial/ActivarGestor.php';

$datos = array(
    'cedula' => $cedula,
);

//Iniciar cURL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);


//curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


$result = curl_exec($ch);
print_r($result);
curl_close($ch);

echo $result;

?>
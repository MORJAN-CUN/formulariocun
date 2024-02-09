<?PHP
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula_audi = $data_empleado['cedula'];

$periodo = $_POST['periodo'];
$cedula = $_POST['cedula'];
$orden = $_POST['orden'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/recibos_full/QuitarMarcaPago.php';
//$url = 'http://localhost/CUN/formularioback/Admin/recibos_full/QuitarMarcaPago.php';

$datos = array(
    'periodo' => $periodo,
    'cedula' => $cedula,
    'orden' => $orden,
    'id_usu' => $id_usu,
    'cedula_audi' => $cedula_audi
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
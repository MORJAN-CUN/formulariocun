<?php
include '../DatosEmpleado.php';
/* $nombre = $_POST['nombre']; */
/* $cedula = $_POST['cedula']; */

$cedula = $_POST['cedula'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/gestor_comercial/dataName.php';
//$url = 'http://localhost/CUN/formularioback/Admin/gestor_comercial/dataName.php';

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
$data = json_decode($result, true);
curl_close($ch);


?>

<?php 
foreach ($data as $key){
    ?>
    <span class="badge bg-warning" id="nom_act"><?php echo $key['NOM_LARGO']; ?></span>
    <?php
}

?>
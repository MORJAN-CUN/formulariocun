<?php
include '../DatosEmpleado.php';
/* $nombre = $_POST['nombre']; */
/* $cedula = $_POST['cedula']; */


$num_factura = $_POST['num_factura'];

$url = 'http://190.184.202.251:8090/formularioback/Admin/facturacione/dataInfo.php';
//$url = 'http://localhost/CUN/formularioback/Admin/facturacione/dataInfo.php';

$datos = array(
    'num_factura' => $num_factura,
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
    <br>
    <p>Secuencia: <b><?php echo $key['SECUENCIA_PERSONA']; ?></b></p>
    <p>Identificació: <b><?php echo $key['IDENTIFICACION']; ?></b></p>
    <p>Razón Social: <b><?php echo $key['NOMBRE_RAZON_SOCIAL']; ?></b></p>
    <p>Correo Electrónico: <b><?php echo $key['DIRECCION_ELECTRONICA']; ?></b></p>
    <p>Valor Total: <b><?php echo number_format($key['VALOR_TOTAL']); ?></b></p>
    <?php
}

?>
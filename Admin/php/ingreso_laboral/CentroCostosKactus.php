<?php

$url = 'http://190.184.202.251:8090/formularioback/Admin/ingreso_laboral/CentroCostos.php';
//$url = 'http://localhost/CUN/formularioback/Admin/ingreso_laboral/CentroCostos.php';

$datos = array(
    '1' => ''
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

$result_arr = json_decode($result, true);

?>

<select class="form-control">
<option value="">TODOS</option>

<?php
foreach ($result_arr as $key) {

    $codigo_centro_costos = $key['CENTRO_COSTO'];
    $programa = $key['NOMBRE_CENTRO_COSTO'];

    ?>
    <option value="<?php echo $codigo_centro_costos; ?>"><?php echo $programa; ?></option>
    <?php

}
?>
</select>

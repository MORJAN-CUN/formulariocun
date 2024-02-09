<?php

$url = 'https://homologaciones.cun.edu.co/back_inglab_app/Dispositivos.php';
//$url = 'http://localhost/CUN/back_inglab_app/Dispositivos.php';

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

    $dispositivos = $key['dispositivos'];

    ?>
    <option value="<?php echo $dispositivos; ?>"><?php echo $dispositivos; ?></option>
    <?php

}
?>
</select>

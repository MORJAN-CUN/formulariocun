<?php

$url = 'http://190.184.202.251:8090/formularioback/Admin/ConsPerfiles.php';

$datos = array(
	'prueba' => null
);

//Iniciar cURL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);

$data = json_decode($result,true);


?>

<select class="form-control" id="select_perfil">
    <option value="">Seleccionar</option>
<?php

foreach($data as $perfil){
    ?>
    <option value="<?php echo $perfil['ID_PERFIL']; ?>"><?php echo $perfil['NOM_PERFIL']; ?></option>
    <?php
} ?>

</select>
<?php
$url = 'http://190.184.202.251:8090/formularioback/Admin/credyty/ConsArchivosCargados.php';
//$url = 'http://localhost/formularioback/Admin/credyty/ConsArchivosCargados.php';

$datos = array(
    'id' => null
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

$data_loads = json_decode($result,true);

?>
<div class="table-responsive">
<table class="table table-vcenter table-mobile-md card-table">
  <thead>
    <tr>
      <th>Colaborador</th>
      <th>Descripcion</th>
      <th>Fecha</th>
      <th>Archivo base</th>
      <th class="w-1"></th>
    </tr>
  </thead>
  <tbody>
<?php
    foreach($data_loads as $registro){

        $nom_arr = explode(' ', $registro['NOMBRE']);
        $nombre = $nom_arr[0];
        $apellido = $nom_arr[2];
        $colaborador = $nombre.' '.$apellido;

        $nom_archivo = $registro['ARCHIVO'];

        if($nom_archivo == '' || $nom_archivo == null || empty($nom_archivo)){
            $nom_archivo = 'Desconocido';
        }

        $consecutivo = $registro['CONSECUTIVO'];

        ?>
        <tr>    
            <td data-label="Name" >
                <div class="d-flex py-1 align-items-center">
                <div class="flex-fill">
                    <div class="font-weight-medium"><?php echo $colaborador; ?></div>
                    <div class="text-muted"><a href="#" class="text-reset"><?php echo $registro['EMAIL']; ?></a></div>
                </div>
                </div>
            </td>
            <td data-label="Title" >
                <div class="text-muted"><?php echo $registro['DESCRIPCION']; ?></div>
            </td>
            <td class="text-muted" data-label="Role" >
            <?php echo $registro['FECHA']; ?>
            </td>
            <td class="text-muted" data-label="Role">
                <?php if($nom_archivo == 'Desconocido'){
                    ?><span><?php echo $nom_archivo; ?></span><?php
                }else{
                    ?><span style="color:blue;cursor: pointer;"><a href="php/credyty/downloadfilebase.php?cons=<?php echo $consecutivo; ?>&nom_arc=<?php echo $nom_archivo; ?>"><?php echo $nom_archivo; ?></a></span><?php
                } ?>
               
            </td>
            <td>
                <div class="btn-list flex-nowrap">
                <a href="javascript:VerDetallleCredyty(<?php echo $consecutivo; ?>);" class="btn btn-white">
                    Ver
                </a>
                <a href="php/credyty/downloadfile.php?cons=<?php echo $consecutivo; ?>" class="btn btn-success">
                    Descargar
                </a>
                </div>
            </td>
        </tr>
        <?php
    }
?>        
  </tbody>
</table>
</div>


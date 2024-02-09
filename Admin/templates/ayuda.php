<?php
$ruta = ruta;

/*
LC = Legalizados credyty
CN = Consulta nomina
*/

if($ruta == 'LC'){
    $archivo = 'http://190.184.202.251:8090/formulariocun/Admin/templates/manuals/Manual de Usuario CREDYTY (Vicerrectoria de Servicios Digitales).pdf';
    //$archivo = 'http://localhost/CUN/formulariocun/Admin/templates/manuals/Manual de Usuario CREDYTY (Vicerrectoria de Servicios Digitales).pdf';
}else if($ruta == 'CN'){
    $archivo = 'http://190.184.202.251:8090/formulariocun/Admin/templates/manuals/Manual de Usuario Archivo Nomina Electronica (Vicerrectoria de Servicios Digitales).pdf';
    //$archivo = 'http://localhost/CUN/formulariocun/Admin/templates/manuals/Manual de Usuario Archivo Nomina Electronica (Vicerrectoria de Servicios Digitales).pdf';
}else{
    $archivo = null;
}

?>
<style type="text/css">
        
.cmn-divfloat {
    position: fixed !important;
    bottom:10px;
    right: 15px;
}
.cmn-btncircle {
    width: 40px !important;
    height: 40px !important;
    padding: 6px 0px;
    border-radius: 15px;
    font-size: 18px;
    text-align: center;
}

</style>

<?php

if($archivo != null){

    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="div-totop" class="cmn-divfloat" style="cursor: pointer;z-index: 999999 !important;">
                    <label style="font-weight: bold;font-size: 10px;">¿Necesitas Ayuda?</label>
                    <br>
                    <center>
                        <a href="<?php echo $archivo; ?>" target="_blank">
                            <img src="img/informacion.png" style="width:50px;" id="img_bot_flotante" class="chat_on">
                        </a>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <?php
}

?>

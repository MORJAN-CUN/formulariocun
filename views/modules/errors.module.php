<?php 

$tileErr = '404';
$contentErr = 'Contenido no encontrado';

$err = $_GET['err'];
$messageErr = $_GET['messageErr'];

if(isset($err) && isset($messageErr)){
    $tileErr = $err;
    $contentErr = $messageErr;
}

?>
<div class="page-wrap d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block" id="titleErr"><?php echo $tileErr;?></span>
                <div class="mb-4 lead" id="contentErr"><?php echo $contentErr;?></div>
                <a href="/formulariocun" class="btn btn-link"><i class="fas fa-heart-broken fa-3x icon"></i></a>
            </div>
        </div>
    </div>
</div>
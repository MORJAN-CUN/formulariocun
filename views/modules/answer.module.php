<?php 

$message = $_GET['message'];

if(isset($message)){
    
    $contentMessage = $message;
}

?>
<div class="page-wrap d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block">Gracias!</span>
                <div class="mb-4 lead"><?php echo $contentMessage;?></div>
                <a href="/formulariocun" class="btn btn-link"><i class="fas fa-heart fa-3x icon"></i></a>
                <br><br>
                <a href="https://botondepago.cun.edu.co:8443/BotonPago/faces/index.xhtml" target="_blank"><button type="button" class="btn btn-success">Generar recibo de pago!</button></a>
            </div>
        </div>
    </div>
</div>
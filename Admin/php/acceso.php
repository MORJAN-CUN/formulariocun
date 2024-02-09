<?php

session_start();
$ruta_pa = ruta;

if (!isset($_SESSION['id_user'])) {
    if($ruta_pa == 'FF'){
        header('location: Admin/index.php');
    }else{
        header('location: index.php');
    }
    
}else{
 
    //Validar si tiene acceso a la pagina actual

    if($ruta_pa != 'dashboard.php'){

        //Validar acceso a paginas diferentes a la dashboard

        $id_empleado = $_SESSION['id_user'];
        //Enviar ID por cURL para consultar datos del empleado
        $url = 'http://190.184.202.251:8090/formularioback/Admin/DatosEmpleado.php';

        $datos = array(
            'id' => $id_empleado
        );

        //Iniciar cURL

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        //curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($datos));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


        $result = curl_exec($ch);

        curl_close($ch);

        $data_empleado = json_decode($result,true);

        $NOMBRE = $data_empleado['nombre'];
        $NOM_ARR = explode(' ', $NOMBRE);
        $nombre_corto = $NOM_ARR[0];

        $ACCESOS = $data_empleado['accesos'];
        $accesos = explode(",", $ACCESOS);

        if (in_array($ruta_pa, $accesos)){
            
        }else{
           
            if($ruta_pa == 'FF'){
                header('location: Admin/templates/Error_Acceso.html');
            }else{
                header('location: templates/Error_Acceso.html');
            }

            
        }


    }

}

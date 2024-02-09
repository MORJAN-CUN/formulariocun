<?php

session_start();
# Cargar librerias y cosas necesarias
require_once "../../vendor/autoload.php";

# Indicar que usaremos el IOFactory
use PhpOffice\PhpSpreadsheet\IOFactory;


$nom_file = $_FILES['file']['name'];

$val_extension = explode('.', $nom_file);

if(in_array("xlsx", $val_extension)){

    $target_path = 'files_loads/';
    $target_path = $target_path . basename( $_FILES['file']['name']); 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)){
        
        # Recomiendo poner la ruta absoluta si no está junto al script
        # Nota: no necesariamente tiene que tener la extensión XLSX
        //$rutaArchivo = "query_result_2021-08-03T13_31_46.980Z.xlsx";
        $rutaArchivo = $target_path;

        //Asignar permisos al archivo
        chmod($target_path,  0666);

        $documento = IOFactory::load($rutaArchivo);
        $totalDeHojas = 1;
        $hojaActual = $documento->getSheet(0);
        $cont = 0;

        $array_general = array();

        # Iterar filas del excel
        foreach ($hojaActual->getRowIterator() as $fila){

            $cont++;

            //Sacar el encabezado
            if($cont != 1){
                //Obtener datos de cada fila y celda

                $item = $hojaActual->getCell("A".$cont)->getValue();
                $nmro_identificacion = $hojaActual->getCell("B".$cont)->getValue();
                $nombres = $hojaActual->getCell("C".$cont)->getValue();
                $programa = $hojaActual->getCell("D".$cont)->getValue();
                $sede = $hojaActual->getCell("E".$cont)->getValue();
                $val_financiado = $hojaActual->getCell("F".$cont)->getValue();
                $fecha_aprobacion_credito = $hojaActual->getCell("G".$cont)->getValue();
                $numero_cuotas = $hojaActual->getCell("H".$cont)->getValue();
                $primer_pago = $hojaActual->getCell("I".$cont)->getValue();
                $fecha_primer_pago = $hojaActual->getCell("J".$cont)->getValue();
                $valor_pago_a_universidad = $hojaActual->getCell("K".$cont)->getValue();
                $numero_orden_matricula = $hojaActual->getCell("L".$cont)->getValue();
                $fechas_de_pago = $hojaActual->getCell("M".$cont)->getValue();
                $fechas_de_legalizacion = $hojaActual->getCell("N".$cont)->getValue();
                $modalidad_estudio = $hojaActual->getCell("O".$cont)->getValue();
                $ciudad_residencia = $hojaActual->getCell("P".$cont)->getValue();
                $semestre = $hojaActual->getCell("Q".$cont)->getValue();
                $interes_tot_estimado = $hojaActual->getCell("R".$cont)->getValue();
                $periodo_academico = $hojaActual->getCell("S".$cont)->getValue();
                $avalador = $hojaActual->getCell("T".$cont)->getValue();
                
                //Crear array con los datos 

                $array_datos = array(
                    'item' => $item,
                    'nmro_identificacion' => $nmro_identificacion,
                    'nombres' => $nombres,
                    'programa' => $programa,
                    'sede' => $sede,
                    'val_financiado' => $val_financiado,
                    'fecha_aprobacion_credito' => $fecha_aprobacion_credito,
                    'numero_cuotas' => $numero_cuotas,
                    'primer_pago' => $primer_pago,
                    'fecha_primer_pago' => $fecha_primer_pago,
                    'valor_pago_a_universidad' => $valor_pago_a_universidad,
                    'numero_orden_matricula' => $numero_orden_matricula,
                    'fechas_de_pago' => $fechas_de_pago,
                    'fechas_de_legalizacion' => $fechas_de_legalizacion,
                    'modalidad_estudio' => $modalidad_estudio,
                    'ciudad_residencia' => $ciudad_residencia,
                    'semestre' => $semestre,
                    'interes_tot_estimado' => $interes_tot_estimado,
                    'periodo_academico' => $periodo_academico,
                    'avalador' => $avalador
                );

                array_push($array_general, $array_datos);

            }
            
        }

        //Enviar array general por cURL 
        //Convertir en JSON

        $array_json = json_encode($array_general);

        $url = 'http://190.184.202.251:8090/formularioback/Admin/credyty/Insert_credyty.php';
        //$url = 'http://localhost/formularioback/Admin/credyty/Insert_credyty.php';

        $descripcion = $_POST['descrip'];
        $usuario = $_SESSION['id_user'];
        $archivo = $target_path;

        $datos = array(
            'registros' => $array_json,
            'usuario' => $usuario,
            'descripcion' => $descripcion,
            'archivo' => $archivo
        );

        //Iniciar cURL

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        echo $result;


    }else{

        $result = array(
            'consecutivo' => null,
            'status' => 0
        );

        echo json_encode($result);
    }


}else{

    $result = array(
        'consecutivo' => null,
        'status' => 3
    );

    echo json_encode($result);
}

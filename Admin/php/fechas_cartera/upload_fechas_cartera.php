<?php
date_default_timezone_set('UTC');
session_start();
include '../DatosEmpleado.php';

$id_usu = $data_empleado['id_usu'];
$cedula = $data_empleado['cedula'];

# Cargar librerias y cosas necesarias
require_once "../../vendor/autoload.php";

# Indicar que usaremos el IOFactory
use PhpOffice\PhpSpreadsheet\IOFactory;

$nom_file = $_FILES['file']['name'];

$val_extension = explode('.', $nom_file);

if(in_array("xlsx", $val_extension)){

    $target_path = 'files_generated/';
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

                $cedula_estudiante = $hojaActual->getCell("A".$cont)->getValue();
                $periodo = $hojaActual->getCell("B".$cont)->getValue();
                $nota_debito = $hojaActual->getCell("C".$cont)->getValue();
                $fecha_vencimiento = $hojaActual->getCell("D".$cont)->getValue();
                $objetoDateTime = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecha_vencimiento);
                $arr_json_uno = json_encode($objetoDateTime);
                $arr_json_dos = json_decode($arr_json_uno, true);
                $fecha_new = $arr_json_dos['date'];
                $fecha_vencimiento_full_hd = date("d-m-Y", strtotime($fecha_new));

                //Crear array con los datos 

                $array_datos = array(
                    'cedula_estudiante' => $cedula_estudiante,
                    'periodo' => $periodo,
                    'nota_debito' => $nota_debito,
                    'fecha_vencimiento' => $fecha_vencimiento_full_hd
                );

                array_push($array_general, $array_datos);

            }
            
        }


        //Enviar array general por cURL 
        //Convertir en JSON

        $array_json = json_encode($array_general);

        $url = 'http://190.184.202.251:8090/formularioback/Admin/fechas_cartera/upload_fechas_cartera.php';
        //$url = 'http://localhost/formularioback/Admin/fechas_cartera/upload_fechas_cartera.php';

        $descripcion = $_POST['descrip'];
        $archivo = $target_path;

        $datos = array(
            'registros' => $array_json,
            'archivo' => $archivo,
            'id_usu' => $id_usu,
            'cedula' => $cedula
        );

        //Iniciar cURL

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datos); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        $resultado = json_decode($result);

        ?>

        <div class="table-responsive">
        <table class="table table-vcenter table-mobile-md card-table">
          <thead>
            <tr>
              <th>Cedula estudiante</th>
              <th>Periodo</th>
              <th>Nota debito</th>
              <th>Fecha vencimiento</th>
              <th>Estado</th>
              <th>Mensaje</th>
            </tr>
          </thead>
          <tbody>

        <?php

        foreach($resultado as $key_result){

           $cedula_estudiante_result = $key_result->cedula_estudiante;
           $periodo_result = $key_result->periodo;
           $nota_debito_result = $key_result->nota_debito;
           $fecha_vencimiento_result = $key_result->fecha_vencimiento;
           $status_result = $key_result->status;
           $message_result = $key_result->message;

           ?>

           <tr>
               <td><?php echo $cedula_estudiante_result; ?></td>
               <td><?php echo $periodo_result; ?></td>
               <td><?php echo $nota_debito_result; ?></td>
               <td><?php echo $fecha_vencimiento_result; ?></td>
               <td><?php if($status_result){echo "OK";}else{echo "ERROR";} ?></td>
               <td><?php echo $message_result; ?></td>
           </tr>

           <?php

        }   

        ?>

            </tbody>
         </table>
        </div>

        <?php

        unlink($archivo);

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

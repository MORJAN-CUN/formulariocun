<?php
//Zona horaria
date_default_timezone_set('America/Bogota');

//Borrar cache
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

//ini_set('memory_limit', '2048M');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once '/var/www/html/formulariocun/Admin/vendor/autoload.php';
/*
if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}
*/
function getClient(){

    $client = new Google_Client();
    $client->setApplicationName('G Suite Directory API PHP Quickstart');
    $client->setScopes(Google_Service_Directory::ADMIN_DIRECTORY_USER_READONLY);
    $client->setAuthConfig('/var/www/html/formulariocun/Admin/php/usabilidad_correo/credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = '/var/www/html/formulariocun/Admin/php/usabilidad_correo/token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;

}


function getAcceso($email){

    // Get the API client and construct the service object.
    $client = getClient();
    $service = new Google_Service_Directory($client);

    // Print the first 10 users in the domain.
    $optParams = array(
      'customer' => 'my_customer',
      'maxResults' => 1,
      'orderBy' => 'email',
      'query' => 'email='.$email,
    );

    $results = $service->users->listUsers($optParams);

    $nextPageToken = $results->nextPageToken;


    if (count($results->getUsers()) == 0) {
      
        return "No existe";

    }else{
      foreach ($results->getUsers() as $user) {


        $email = $user->getPrimaryEmail();
        $ultimo_login = $user->lastLoginTime;
        $nombre = $user->name->fullName;

        $datos_estudiante = array(
            'email' => $email,
            'ultimo_login' => $ultimo_login,
            'nombre' => $nombre
        );


        return $datos_estudiante;

      }
    }

}


//Conexion a la base de datos

$user = "iceberg"; 
$password = "t3zsjuvGee";
$connection_strg = "172.16.1.175:1521/sig";
$db_conn = oci_connect($user, $password, $connection_strg,'AL32UTF8');

if(!$db_conn) {
    die("No se pudo establecer la conexion");
}


//Consultar de a 500 registros

$query = "SELECT
DISTINCT
    ROWNUM AS SECUENCIA,
    ord.PERIODO as Periodo
    ,ord.cliente_solicitado as Identificacion
    ,est.nom_largo as Nombre_Estudiante
    ,est.DIR_EMAIL as Email
FROM
                orden ord
                , liquidacion_orden liq
                , ordenes_academico oac
                , src_enc_liquidacion enc
                , src_alum_programa alu
                , bas_tercero est
                , CUNT_ALUMNOS_ORDENES_X_PERIODO cun
                , cunv_control_periodos per

            WHERE
            ord.estado= 'V'
            AND    liq.documento_originado =  ord.documento
            AND    liq.organizacion_originado = ord.organizacion
            AND    liq.orden = ord.orden
            AND    oac.orden (+)= liq.orden
            AND    oac.documento (+)= liq.documento_originado
            AND    oac.organizacion (+)= liq.organizacion_originado
            AND    enc.num_documento (+)= oac.referencia
            AND    enc.cod_periodo (+)= oac.periodo
            AND    alu.id_alum_programa (+)= enc.id_alum_programa
            AND    est.num_identificacion (+)= to_char(ord.cliente_solicitado)
            AND    to_char(cun.orden) = to_char(ord.orden)
            AND    cun.documento = ord.documento
AND    per.periodo= ord.periodo
            AND    per.defecto ='S'
AND ord.documento like 'F%'
AND ord.organizacion =1
AND cun.VAL_PAGADO>0
AND ord.periodo NOT LIKE '%I%'
AND est.DIR_EMAIL IS NOT NULL
AND ROWNUM <=500
AND NOT EXISTS(
    SELECT NULL FROM CUNT_HIS_GSUITE WHERE CUNT_HIS_GSUITE.IDENTIFICACION = ord.cliente_solicitado
    AND TO_DATE(FECHA_REGISTRO, 'YYYY-MM-DD') = TO_DATE(SYSDATE, 'YYYY-MM-DD')
    )
ORDER BY ord.PERIODO DESC";


$select = oci_parse($db_conn, $query);

oci_execute($select);

$cont = 0;

while ($row = oci_fetch_array($select, OCI_ASSOC)){
	$cont++;

    $row['PERIODO'];

	$email = strtolower($row['EMAIL']);
    $email = trim($email);
    $cedula = $row['IDENTIFICACION'];    

    $acceso = getAcceso($email);
        
    //print_r($acceso);

    if($acceso == 'No existe'){

        //Insertarlo con fecha de como si nunca hubiera ingresado

        echo $insert = InsertData($db_conn,'1970-01-01',$email,$cedula);

    }else{

        $ultimo_login = $acceso['ultimo_login'];

        $date = date_create($ultimo_login);
        $ultimo_acceso = date_format($date,"Y-m-d H:i:s");
        $ultimo_acceso_fecha = date_format($date,"Y-m-d");

        $result = 0;

        if($result == 0){

            //Insertar en la tabla de historico
            
            echo $insert = InsertData($db_conn,$ultimo_acceso_fecha,$email,$cedula);

            echo "<br>";

        }else{
            echo "ya existe con el mismo inicio de sesion";
        }

    }

    $commit = commit($db_conn);

}


function commit($db){

    $query = "COMMIT";

    $select = oci_parse($db, $query);
    
    if(oci_execute($select)){
        return 1;
    }else{
        return 0;
    }

}

function InsertData($db,$ultimo_acceso,$email,$cedula){


    $query_insert = "INSERT INTO CUNT_HIS_GSUITE (ULT_ACCESO,CORREO,FECHA_REGISTRO,IDENTIFICACION)
    VALUES (TO_DATE('$ultimo_acceso', 'YYYY-MM-DD'),'$email',SYSDATE,'$cedula')";

    $select_insert = oci_parse($db, $query_insert);
            
    if(oci_execute($select_insert)){
        return "insertado";
    }else{

        $e = oci_error($select_insert);
        print_r($e);
    }

}




?>
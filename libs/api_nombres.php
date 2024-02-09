<?php
	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$tipo_doc = 'CC';
			$cedula = $_POST['documento'];
			
			$url = 'https://api.misdatos.com.co/api/co/consultarNombres';
		    $header = array('Authorization: e0pi8fj384uynyfvqcqhhh86yjgm4bqrvdrijx56qcyhhu33','Content-Type: application/x-www-form-urlencoded');
		    
		    $postfields = ['documentType' => $tipo_doc, 'documentNumber' => $cedula];

		    $ch = curl_init();
		    
		    curl_setopt($ch,CURLOPT_URL,$url);
		    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		    curl_setopt($ch,CURLOPT_TIMEOUT, 20);
		    curl_setopt($ch,CURLOPT_HTTPHEADER, $header);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
		    $response = curl_exec($ch);
		    
		    curl_close ($ch);
		    
		    $data = json_decode($response,true);
		    
		    echo json_encode($data);

	}else {
		echo json_encode($error = ['error' => 'bad request']);
	}
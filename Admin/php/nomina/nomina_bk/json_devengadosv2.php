<?php 

function DyD_devengados($periodo,$nmro_identificacion,$nmro_cuenta,$conceptos_DyD){

	//Sacar del array de conceptos, solo lo que pertenece al empleado

	$conceptos_empleado = ExtraerConceptosDyD($nmro_identificacion,$nmro_cuenta,$conceptos_DyD);

	//Sacar el nivel1 de los conceptos

	$conceptos_nivel1 = ExtraerNivel1DyD($conceptos_empleado);

	//Recorrer nivel 1 para crear el JSON

	$array_devengados = array();

	foreach($conceptos_nivel1 as $key1){

		if (array_key_exists('NIVEL1', $key1)){$nombre_nivel1 = $key1['NIVEL1'];}else{$nombre_nivel1 = '';}

		//$nombre_nivel1 = $key1['NIVEL1'];
		$valor1 = $key1['VALOR1'];

		//Consultar nivel2

		$array_nivel2 = ExtraerNivel2DyD($conceptos_empleado,$nombre_nivel1);
		$valor_nivel1 = array();
		//Recorrer array nivel1

		foreach($array_nivel2 as $key2){

			if (array_key_exists('NIVEL2', $key2)){$nombre_nivel2 = $key2['NIVEL2'];}else{$nombre_nivel2 = '';}

			//$nombre_nivel2 = $key2['NIVEL2'];
			$valor2 = $key2['VALOR2'];

			//Consultar nivel 3
			$array_nivel3 = ExtraerNivel3DyD($conceptos_empleado,$nombre_nivel1,$nombre_nivel2);
			$valor_nivel2 = array();
			//recorrer array nivel2

			foreach ($array_nivel3 as $key3){
				
				if (array_key_exists('NIVEL3', $key3)){$nombre_nivel3 = $key3['NIVEL3'];}else{$nombre_nivel3 = '';}

				//$nombre_nivel3 = $key3['NIVEL3'];
				$valor3 = $key3['VALOR3'];

				if($nombre_nivel3 == '' || $nombre_nivel3 == null || empty($nombre_nivel3)){

				}else{
					$valor_nivel2[$nombre_nivel3] = $valor3;
				}

			}


			if($valor_nivel2 == '' || $valor_nivel2 == null || empty($valor_nivel2)){
				$valor_nivel2 = $valor2;
			}

			$valor_nivel1[$nombre_nivel2] = $valor_nivel2;

		}

		if($valor_nivel1 == '' || $valor_nivel1 == null || empty($valor_nivel1)){
			$valor_nivel1 = $valor1;
		}

		$array_devengados[$nombre_nivel1] = $valor_nivel1;

	}

	return $array_devengados;

}

function ExtraerConceptosDyD($nmro_identificacion,$nmro_cuenta,$conceptos_DyD){

	//Recorrer array de conceptos para sacar lo del empleado nada mas

	$result_conceptos = array();

	foreach ($conceptos_DyD as $key){
		
		$cod_empl = $key['COD_EMPL'];
		$numero_cuenta = $key['NRO_CONT'];

		//Validar si el codigo del array es igual al numero de cedula que estamos solicitando

		if($cod_empl == $nmro_identificacion && $nmro_cuenta == $numero_cuenta){

			//Almacenar KEY en el array de resultados

			array_push($result_conceptos, $key);

		}

	}

	//Retornar el array de conceptos del empleado

	return $result_conceptos;

}

function ExtraerNivel1DyD($conceptos_DyD){

	//Recorrer array de conceptos del empleado, para sacar solo el nivel1

	$result_nivel1 = array();

	foreach ($conceptos_DyD as $key){
		
		if (array_key_exists('NIVEL1', $key)){$nivel1 = $key['NIVEL1'];}else{$nivel1 = '';}

		//$nivel1 = $key['NIVEL1'];
		$valor1 = $key['VALOR1'];

		$data = array(
			'NIVEL1' => $nivel1,
			'VALOR1' => $valor1
		);

		if (in_array($data, $result_nivel1)){
		}else{
			array_push($result_nivel1, $data);
		}

	}

	//$result_nivel1 = array_unique($result_nivel1);
	return $result_nivel1;

}

function ExtraerNivel2DyD($conceptos_DyD,$nivel1_txt){

	//Recorrer array de conceptos del empleado, para sacar solo el nivel2

	$result_nivel2 = array();

	foreach ($conceptos_DyD as $key){

		if (array_key_exists('NIVEL1', $key)){$nivel1 = $key['NIVEL1'];}else{$nivel1 = '';}
		//$nivel1 = $key['NIVEL1'];
			
		if($nivel1 == $nivel1_txt){

			$data = array(
				'NIVEL2' => $key['NIVEL2'],
				'VALOR2' => $key['VALOR2']
			);

			array_push($result_nivel2, $data);

		}

	}

	return $result_nivel2;

}


function ExtraerNivel3DyD($conceptos_DyD,$nivel1_txt,$nivel2_txt){

	//Recorrer array de conceptos del empleado, para sacar solo el nivel2

	$result_nivel3 = array();

	foreach ($conceptos_DyD as $key){

		if (array_key_exists('NIVEL1', $key)){$nivel1 = $key['NIVEL1'];}else{$nivel1 = '';}
		if (array_key_exists('NIVEL2', $key)){$nivel2 = $key['NIVEL2'];}else{$nivel2 = '';}

		//$nivel1 = $key['NIVEL1'];
		//$nivel2 = $key['NIVEL2'];

		if($nivel1 == $nivel1_txt && $nivel2 == $nivel2_txt){

			if (array_key_exists('NIVEL3', $key)){$nivel3 = $key['NIVEL3'];}else{$nivel3 = '';}

			$data = array(
				'NIVEL3' => $nivel3,
				'VALOR3' => $key['VALOR3']
			);

			array_push($result_nivel3, $data);

		}

	}

	return $result_nivel3;

}


?>
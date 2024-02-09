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

		$cont2 = 0;
		foreach($array_nivel2 as $key2){

			if (array_key_exists('NIVEL2', $key2)){$nombre_nivel2 = $key2['NIVEL2'];}else{$nombre_nivel2 = '';}

			//$nombre_nivel2 = $key2['NIVEL2'];
			$valor2 = $key2['VALOR2'];

			//Consultar nivel 3
			$array_nivel3 = ExtraerNivel3DyD($conceptos_empleado,$nombre_nivel1,$nombre_nivel2);
			$valor_nivel2 = array();
			//recorrer array nivel2

			$cont3 = 0;
			$grupo_save_arr = array();

			foreach ($array_nivel3 as $key3){
			
				if (array_key_exists('NIVEL3', $key3)){$nombre_nivel3 = $key3['NIVEL3'];}else{$nombre_nivel3 = '';}

				//$nombre_nivel3 = $key3['NIVEL3'];
				$valor3 = $key3['VALOR3'];

				if($nombre_nivel3 == 'FechaFin' || $nombre_nivel3 == 'FechaInicio'){
					$valor3 = formatFecha($valor3);
				}

				if($nombre_nivel3 == '' || $nombre_nivel3 == null || empty($nombre_nivel3)){

				}else{

					$corchete3 = $key3['CORCHETE'];
					//$corchete3 = 0;

					if($corchete3 == 1){

					$grupo = $key3['GRUPO'];
					$grupo_sav = $grupo_save_arr[0];

						if($grupo != 0 ){

							//Consultar el ultimo grupo guardado
							$grupo_sav = $grupo_save_arr[0];

								if($grupo_sav == $grupo){

									$cont3 = $cont3 - 1;
									$grupo_save_arr[0] = $grupo;

									if(is_numeric($valor3)){
										$valor_nivel2[$cont3][$nombre_nivel3] = intval($valor3);
									}else{
										$valor_nivel2[$cont3][$nombre_nivel3] = $valor3;
									}

									$cont3++;
								
								}else{

									$grupo_save_arr[0] = $grupo;

									if(is_numeric($valor3)){
										$valor_nivel2[$cont3][$nombre_nivel3] = intval($valor3);
									}else{
										$valor_nivel2[$cont3][$nombre_nivel3] = $valor3;
									}

									$cont3++;
								}


						}else{
							
							if($nombre_nivel3 == 'CONCEPTO1NIVEL'){

								$grupo_save_arr[0] = $grupo;

								if(is_numeric($valor3)){
									$valor_nivel2[$cont3] = intval($valor3);
								}else{
									$valor_nivel2[$cont3] = $valor3;
								}

								$cont3++;
							}else{

								$grupo_save_arr[0] = $grupo;

								if(is_numeric($valor3)){
									$valor_nivel2[$cont3][$nombre_nivel3] = intval($valor3);
								}else{
									$valor_nivel2[$cont3][$nombre_nivel3] = $valor3;
								}

								$cont3++;
							}

						}

				
					}else{
						if(is_numeric($valor3)){
							$valor_nivel2[$nombre_nivel3] = intval($valor3);
						}else{
							$valor_nivel2[$nombre_nivel3] = $valor3;
						}
					}

				}

			}

			if($valor_nivel2 == '' || $valor_nivel2 == null || empty($valor_nivel2)){
				if($nombre_nivel2 == 'Porcentaje'){
					$valor_nivel2 = $valor2;
					//$valor_nivel2 = intval($valor2);
				}else{
					$valor_nivel2 = intval($valor2);
				}
			}


			$corchete2 = $key2['CORCHETE'];

			if($corchete2 == 1){
				$valor_nivel1[$cont2][$nombre_nivel2] = $valor_nivel2;
				$cont2++;
			}else{
				$valor_nivel1[$nombre_nivel2] = $valor_nivel2;
			}

			
		}

		if($valor_nivel1 == '' || $valor_nivel1 == null || empty($valor_nivel1) || array_key_exists('', $valor_nivel1)){
			if(is_numeric($valor1)){
				$valor_nivel1 = intval($valor1);
			}else{
				$valor_nivel1 = $valor1;
			}
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
				'VALOR2' => $key['VALOR2'],
				'CORCHETE' => $key['CORCHETE1']
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
				'VALOR3' => $key['VALOR3'],
				'CORCHETE' => $key['CORCHETE2'],
				'GRUPO' => $key['GRUPO']
			);

			array_push($result_nivel3, $data);

		}

	}

	return $result_nivel3;

}


function formatFecha($fecha){


	if($fecha == '' || $fecha == null || empty($fecha)){
		$fecha_new = '';
	}else{
		$fecha_new = new DateTime($fecha);
		$fecha_new = $fecha_new->format('Y-m-d');
	}

	return $fecha_new;

}


?>
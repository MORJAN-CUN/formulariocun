<?php
require_once 'controllers/errors.controller.php';
require_once 'controllers/form.controller.php';

/**
 * 
 */
class App
{
	function __construct()
	{
	
		if(!isset($_GET['url'])){
			$controller = new Form();
		}else{
		
		$url= $_GET['url'];
			$url = rtrim($url,'/');
			$url = explode('/', $url);

			$archivoController = 'controllers/'.$url[0].'.controller.php';

			if(file_exists($archivoController))
			{
				require_once $archivoController;
				$controller = new $url[0];

				if(isset($url[1]))
				{
					$controller->{$url[1]}();
				}

			}else{
				
				$controller = new Errors();
			}
		}

	}
}


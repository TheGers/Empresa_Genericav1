<?php 
	
	class Views
	{
		function getView($controller, $view, $data="")
		{
			if (is_object($controller)) {
				$controllerName = get_class($controller);
			} else {
				$controllerName = $controller;
			}
			
			if($controllerName == "Home"){
				$view = "Views/".$view.".php";
			} else {
				$view = "Views/".$controllerName."/".$view.".php";
			}
			
			require_once($view);
		}
	}

 ?>
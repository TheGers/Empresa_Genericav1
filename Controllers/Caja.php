<?php 
 class Caja extends Controllers{

    public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(18);
		}
    
        public function caja()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/caja');
			}
			$data['page_tag'] = "Caja";
			$data['page_title'] = "CAJA";
			$data['page_name'] = "caja";
			$data['page_functions_js'] = "functions_caja.js";
			$this->views->getView($this,"caja",$data);
		}   

  



 }
?>

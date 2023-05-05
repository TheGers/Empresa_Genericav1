<?php 

	class Recuperacion extends Controllers{
		public function __construct()
		{
			parent::__construct();
			getPermisos(16);
		}

		public function Recuperacion()
		{
			
			$data['page_tag'] = "Recuperacion";
		$data['page_title'] = "Empresa generica";
			$data['page_name'] = "recuperacion";
			$data['page_functions_js'] = "functions_recuperacion.js";
			$this->views->getView($this,"recuperacion",$data);
		}
		public function Reseteo(){
			//dep($_POST);
			if($_POST){
				if(empty($_POST['txtUsername']) || empty($_POST['listPregunta']) || empty($_POST['txtRespuesta'])){
					$arrResponse = array('status' => false, 'msg' => 'Error de datos' );
				}else{
					$intCOD_USUARIO  =  strClean(($_POST['txtUsername']));
					$strPREGUNTA = intval($_POST['listPregunta']);
					$strRESPUESTA = strClean($_POST['txtRespuesta']);
					$requestUser = $this->model->Reseteo($intCOD_USUARIO, $strPREGUNTA, $strRESPUESTA);
					if (empty($requestUser)) {
						$arrResponse = array('status' => true, 'msg' => 'El usuario es incorrecto.' ); 
					} else {
						$arrData = $requestUser;
						if ($arrData['status'] == 1) {
						
							return array('status' => true, 'msg' => 'Recuperación exitosa.');
						} else {
							return array('status' => false, 'msg' => 'El usuario está inactivo.');
						}
					}
					
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		

	}
 ?>
<?php
class Preguntas extends Controllers
{
	
	public function __construct()
	{
		parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(16);
	}

	public function Preguntas()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/preguntas');
		}
		$data['page_tag'] = "PREGUNTAS DE SEGURIDAD";
		$data['page_title'] = "Preguntas de Seguridad";
		$data['page_name'] = "Preguntas de Seguridad";
		$data['page_functions_js'] = "function_preguntas.js";
		$this->views->getView($this,"preguntas", $data);
	}

	public function setPregunta(){
		if($_POST){
			if(empty($_POST['listUsuario']) || empty($_POST['txtPregunta'])  || empty($_POST['txtRespuesta']) ||  empty($_POST['listStatus']) )
			{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			}else{
				$IntidPregunta = intval($_POST['idPregunta']);
				$listUsuario =  strClean($_POST['listUsuario']);
				$strPregunta = strClean($_POST['txtPregunta']);
				$strRespuesta = strClean($_POST['txtRespuesta']);
				$intstatus = intval($_POST['listStatus']);
				$request_pregunta ="";

				
				if($IntidPregunta == 0)
				{
					//Crear
					if($_SESSION['permisosMod']['w']){
						$request_pregunta = $this->model->inserPregunta($listUsuario, $strPregunta,$strRespuesta,$intstatus);
						$option = 1;
					}
				}else{
					//Actualizar
					if($_SESSION['permisosMod']['u']){
						
						$request_pregunta = $this->model->updatePregunta($IntidPregunta,$listUsuario, $strPregunta,$strRespuesta,$intstatus);
						$option = 2;
					}
				}
				if($request_pregunta > 0 )
				{
					if($option == 1)
					{
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}
				}else if($request_pregunta == 'exist'){
					$arrResponse = array('status' => false, 'msg' => '¡Atención! La Pregunta ya existe.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}


	//retorno de datos en la base de datos para mostrar todo
	public function getPreguntas()
	{
		if($_SESSION['permisosMod']['r']){
			$arrData = $this->model->selectPreguntas();
			for ($i=0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				if($arrData[$i]['status'] == 1)
				{
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				}else{

					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				if($_SESSION['permisosMod']['r']){
				//	$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['COD_PRREGUNTA'].')" title="Ver "><i class="far fa-eye"></i></button>';
				}
				if($_SESSION['permisosMod']['u']){
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['COD_PRREGUNTA'].')" title="Editar "><i class="fas fa-pencil-alt"></i></button>';
				}
				if($_SESSION['permisosMod']['d']){	
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['COD_PRREGUNTA'].')" title="Eliminar "><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdit.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}
		die();
    }



	public function getPregunta($COD_PRREGUNTA)
	{
		if($_SESSION['permisosMod']['r']){
			$intIdPregunta = intval($COD_PRREGUNTA);
			if($intIdPregunta > 0)
			{
				$arrData = $this->model->selectPregunta($intIdPregunta);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function delPregunta()
	{
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intIdPregunta = intval($_POST['idPregunta']);
				$requestDelete = $this->model->deletePregunta($intIdPregunta);
				if($requestDelete == 'ok')
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Pregunta');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Pregunta.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	

}

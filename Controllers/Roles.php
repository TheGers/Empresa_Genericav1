<?php 
/*
	Universidad Nacional Autonoma de Honduras (UNAH)
		    Facultad de Ciencias Economicas
		Departamento de Informatica administrativa
         Analisis, Programacion y Evaluacion de Sistemas
                    Primer Periodo 2023
Equipo:
Gerson David Garcia Calderon ........( gerson.garcia@unah.hn)
Elsy Yohana Maradiaga Lazo...........( elsy.maradiaga@unah.hn)
Miguel Alejandro Cardenas Amaya......(mcardenasa@unah.hn)
Edwin Jahir Juanez Ayala.............(edinjuanez@unah.hn)
Bayron Alberto Meraz Dubon...........(bayronmeraz@unah.hn)

Catedratico:
Lic. Karla Melisa Garcia Pineda 

---------------------------------------------------------------------

Programa:         Modulo de Roles
Fecha:             23-febrero-2023
Programador:       Miguel Cardenas 
descripcion:       Modulo que asigna los roles de usuarios
*/

//Controlador del Modulo roles
	class Roles extends Controllers{

		//constructor del controlador con funciones de validacion de login de usuario y permiso ortogado
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(13); //Funcion para asigar permiso del modulo
		}

		//Funcion para retornar la vista y encabezados del modulo
		public function Roles()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 3;
			$data['page_tag'] = "Roles";
			$data['page_name'] = "rol_usuario";
			$data['page_title'] = "ROLES";
			$data['page_functions_js'] = "functions_roles.js";
			$this->views->getView($this,"roles",$data);
		}

		//Obtiene los registros de los roles en la base de datos
		public function getRoles()
		{
			if($_SESSION['permisosMod']['r']){
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				$arrData = $this->model->selectRoles();

				for ($i=0; $i < count($arrData); $i++) {

					//Arreglos para mostar el estado de cada registro
					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					if($_SESSION['permisosMod']['u']){
						$btnView = '<button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['idrol'].')" title="Permisos"><i class="fas fa-key"></i></button>';
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditRol" onClick="fntEditRol('.$arrData[$i]['idrol'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['idrol'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>
					</div>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
 
		public function getSelectRoles()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectRoles();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['idrol'].'">'.$arrData[$i]['nombrerol'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

		//Funcion que selecciona un rol segun su id de registro
		public function getRol(int $idrol)
		{
			if($_SESSION['permisosMod']['r']){
				$intIdrol = intval(strClean($idrol));
				if($intIdrol > 0)
				{
					$arrData = $this->model->selectRol($intIdrol);
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

		public function setRol(){
				$intIdrol = intval($_POST['idRol']);
				$strRol =  strClean($_POST['txtNombre']);
				$strDescipcion = strClean($_POST['txtDescripcion']);
				$intStatus = intval($_POST['listStatus']);
				$request_rol = "";
				if($intIdrol == 0)
				{
					//Crear
					if($_SESSION['permisosMod']['w']){
						$request_rol = $this->model->insertRol($strRol, $strDescipcion,$intStatus);
						$option = 1;
					}
				}else{
					//Actualizar
					if($_SESSION['permisosMod']['u']){
						$request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescipcion, $intStatus);
						$option = 2;
					}		
				}

				if($request_rol > 0 )
				{
					if($option == 1)
					{
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}
				}else if($request_rol == 'exist'){
					
					$arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		//Funcion para eliminar roles segun el id de registro 
		public function delRol()
		{
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdrol = intval($_POST['idrol']);
					$requestDelete = $this->model->deleteRol($intIdrol);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

	}
 ?>
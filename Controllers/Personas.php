<?php
// -----------------------------------------------------------------------
// 	Universidad Nacional Autonoma de Honduras (UNAH)
// 		Facultad de Ciencias Economicas
// 	Departamento de Informatica administrativa
//          Analisis, Programacion y Evaluacion de Sistemas
//                     Primer Periodo 2023
// Equipo:
// Gerson David Garcia Calderon ........( gerson.garcia@unah.hn)
// Elsy Yohana Maradiaga Lazo...........( elsy.maradiaga@unah.hn)
// Miguel Alejandro Cardenas Amaya......(mcardenasa@unah.hn)
// Edwin Jahir Juanez Ayala.............(edinjuanez@unah.hn)
// Bayron Alberto Meraz Dubon...........(bayronmeraz@unah.hn)
// Catedratico:
// Lic. Karla Melisa Garcia Pineda 
// ---------------------------------------------------------------------
// Programa:         Modulo de Personas
// Fecha:             23-febrero-2023
// Programador:       Elsy Maradiaga 
// descripcion:      Modulo que registra los datos de las personas(Cliente y Proveedor) 
////MODULO PERSONAS--------ELSY YOHANA MARADIAGA 
class Personas extends Controllers
{
	
	public function __construct()
	{
		parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(3);
	}

	public function Personas()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Personas";
		$data['page_title'] = "Personas";
		$data['page_name'] = "personas";
		$data['page_functions_js'] = "functions_personas.js";
		$this->views->getView($this, "personas", $data);
	}
	
	//OPCION PARA VER TODOS LOS REGISTROS EN UNA TABLA DE INICIO 
	//vista principal para el registro de personas
	public function getPersonas()
	{
		if($_SESSION['permisosMod']['r']){
			$arrData = $this->model->selectPersonas();
			
			for ($i=0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				if($arrData[$i]['GENERO'] == 1)
				{
					$arrData[$i]['GENERO'] = '<span >FEMENINO</span>';
				}else{
					$arrData[$i]['GENERO'] = '<span>MASCULINO</span>';
				}
				if($arrData[$i]['status'] == 1)
				{
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}
				//funciones para los botones que estan en el json
				if($_SESSION['permisosMod']['r']){
					$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['COD_PERSONA'].')" title="Ver "><i class="far fa-eye"></i></button>';
				}
				if($_SESSION['permisosMod']['u']){
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['COD_PERSONA'].')" title="Editar "><i class="fas fa-pencil-alt"></i></button>';
				}
				if($_SESSION['permisosMod']['d']){	
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['COD_PERSONA'].')" title="Eliminar "><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	public function getDirecciones()
	{
		if($_SESSION['permisosMod']['r']){
			$arrData = $this->model->selectDirecciones();
			
			for ($i=0; $i < count($arrData); $i++) {
			
				$btnEdit = '';
				$btnDelete = '';
				if($arrData[$i]['status'] == 1)
				{
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}
				
				if($_SESSION['permisosMod']['u']){
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['COD_DIRECCION'].')" title="Editar "><i class="fas fa-pencil-alt"></i></button>';
				}
				if($_SESSION['permisosMod']['d']){	
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['COD_DIRECCION'].')" title="Eliminar "><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdit.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	public function getTelefonos()
	{
		if($_SESSION['permisosMod']['r']){
			$arrData = $this->model->selectTelefonos();
			
			for ($i=0; $i < count($arrData); $i++) {
			
				$btnEdit = '';
				$btnDelete = '';
				if($arrData[$i]['status'] == 1)
				{
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}
				
				if($_SESSION['permisosMod']['u']){
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['COD_DIRECCION'].')" title="Editar "><i class="fas fa-pencil-alt"></i></button>';
				}
				if($_SESSION['permisosMod']['d']){	
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['COD_DIRECCION'].')" title="Eliminar "><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdit.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
//OPCION DE INSERTAR EN LA VISTA PRINCIPAL
	public function setPersona(){
		if($_POST){
			
			if( empty($_POST['txtNombre']) || empty($_POST['listgenero']) || empty($_POST['datefecha']) || empty($_POST['listTipoPersona']) 
			|| empty($_POST['txtIdentificacion'])|| empty($_POST['listTipoPersona']) || empty($_POST['listStatus'])  )
			{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			}else{
				$idPersona = intval($_POST['idPersona']);
					$strNOMBRE = strClean($_POST['txtNombre']);
					$intGENERO = strClean($_POST['listgenero']);
					$intFECHA_NACIMIENTO = date('Y-m-d', strtotime($_POST['datefecha']));
					$intCOD_TIPO_IDENTIFICACION = intval($_POST['listTipoIdentificacion']);
					$intIDENTIFICACION = strClean($_POST['txtIdentificacion']);
					$intCOD_TIPO_PERSONA = intval($_POST['listTipoPersona']);
					$intESTADO = intval($_POST['listStatus']);
					$request_persona = "";
					
					if($idPersona == 0)
					{
						$option = 1;
						if($_SESSION['permisosMod']['w']){
							$request_persona = $this->model->insertPersona(
																		$strNOMBRE, 
																		$intGENERO,
																		$intFECHA_NACIMIENTO, 
																		$intCOD_TIPO_IDENTIFICACION,
																		$intIDENTIFICACION, 
																		$intCOD_TIPO_PERSONA, 
																		$intESTADO );
																		
						}
					}else{
						$option = 2;
							if($_SESSION['permisosMod']['u']){
								$request_persona = $this->model->updatePersona($idPersona,
								$strNOMBRE, 
								$intGENERO,
								$intFECHA_NACIMIENTO, 
								$intCOD_TIPO_IDENTIFICACION,
								$intIDENTIFICACION, 
								$intCOD_TIPO_PERSONA, 
								$intESTADO );
						}
					}
					if($request_persona > 0 )
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'COD_PERSONA' => $request_persona, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('status' => true, 'COD_PERSONA' => $idPersona, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_persona == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe el Registro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();

	}
	public function setDireccion(){
		if($_POST){
			
			if(empty($_POST['listTipoDireccion']) || empty($_POST['txtCiudad']) || empty($_POST['txtCalle']) || empty($_POST['txtCasa']) || empty($_POST['txtColonia']) 
			|| empty($_POST['txtAvenida'])||  empty($_POST['txtDireccion1'])||  empty($_POST['txtDireccion2'])||  empty($_POST['listStatus'])  )
			{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			}else{
				$idPersona = intval($_POST['idPersona']);
				$intCOD_TIPO_DIRECCION = intval($_POST['listTipoDireccion']);
					$strCIUDAD = strClean($_POST['txtCiudad']);
					$strCALLE = strClean($_POST['txtCalle']);
					$strCASA = strClean($_POST['txtCasa']);
					$strCOLONIA = strClean($_POST['txtColonia']);
					$strAVENIDA = strClean($_POST['txtAvenida']);
					$strDIRECCION1 = strClean($_POST['txtDireccion1']);
					$strDIRECCION2 = strClean($_POST['txtDireccion2']);
					$intESTADO = intval($_POST['listStatus']);
					$request_direccion = "";
				
					if($idPersona == 0)
					{
						$option = 1;
						if($_SESSION['permisosMod']['w']){
							$request_direccion = $this->model->insertDireccion($intCOD_TIPO_DIRECCION, 
																	$strCIUDAD, 
																		$strCALLE,
																		$strCASA, 
																		$strCOLONIA,
																		$strAVENIDA, 
																		$strDIRECCION1, 
																		$strDIRECCION2, 
																		$intESTADO );
																	
																		
						}
					}else{
						$option = 2;
							if($_SESSION['permisosMod']['u']){
								$request_direccion = $this->model->updateDireccion($idPersona,
								$intCOD_TIPO_DIRECCION, 
																		$strCIUDAD, 
																		$strCALLE,
																		$strCASA, 
																		$strCOLONIA,
																		$strAVENIDA, 
																		$strDIRECCION1, 
																		$strDIRECCION2, 
																		$intESTADO );
						}
					}
					if($request_direccion > 0 )
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'COD_DIRECCION' => $request_direccion, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('status' => true, 'COD_DIRECCION' => $idPersona, 'msg' => 'Datos Actualizados correctamente.');
						}
						
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();

	}
	
	public function setTelefono(){
		if($_POST){
			
			if( empty($_POST['listTipoTelefono']) || empty($_POST['txtTelefono']) || empty($_POST['txtCodigo'])||  empty($_POST['listStatus'])  )
			{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			}else{
				$idPersona = intval($_POST['idPersona']);
				$intCOD_TIPO_TELEFONO = intval($_POST['listTipoTelefono']);
					$intTELEFONO = strClean($_POST['txtTelefono']);
					$intCODIGO_AREA = strClean($_POST['txtCodigo']);
					$intESTADO = intval($_POST['listStatus']);
					$request_telefono = "";
				
					if($idPersona == 0)
					{
						$option = 1;
						if($_SESSION['permisosMod']['w']){
							$request_telefono = $this->model->insertTelefono(
							$intCOD_TIPO_TELEFONO, 
							$intTELEFONO,
							$intCODIGO_AREA,
							$intESTADO  );
																	
																		
						}
					}else{
						$option = 2;
							if($_SESSION['permisosMod']['u']){
								$request_telefono = $this->model->updateTelefono($idPersona,
							$intCOD_TIPO_TELEFONO, 
							$intTELEFONO,
							$intCODIGO_AREA,
							$intESTADO  );
						}
					}
					if($request_telefono > 0 )
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'COD_TELEFONO' => $request_telefono, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('status' => true, 'COD_TELEFONO' => $idPersona, 'msg' => 'Datos Actualizados correctamente.');
						}
						
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();

	}
	//OPCION PARA EL BOTON DE VER EL DE UN REGISTRO Y ACTUALIZAR
	public function getPersona($COD_PERSONA){
		if($_SESSION['permisosMod']['r']){
			$COD_PERSONA = intval($COD_PERSONA);
			if($COD_PERSONA > 0){
				$arrData = $this->model->selectPersona($COD_PERSONA);
				if(empty($arrData)){
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			
		}
		die();
		
	}
	public function getDireccion($COD_DIRECCION){
		if($_SESSION['permisosMod']['r']){
			$COD_DIRECCION = intval($COD_DIRECCION);
			if($COD_DIRECCION > 0){
				$arrData = $this->model->selectDireccion($COD_DIRECCION);
				if(empty($arrData)){
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}
	public function getTelefono($COD_TELEFONO){
		if($_SESSION['permisosMod']['r']){
			$COD_TELEFONO = intval($COD_TELEFONO);
			if($COD_TELEFONO > 0){
				$arrData = $this->model->selectTelefono($COD_TELEFONO);
				if(empty($arrData)){
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			
		}
		die();
		
	}
	//OPCION DE ELIMINAR 
	public function delPersona(){
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intCOD_PERSONA = intval($_POST['idPersona']);
				$requestDelete = $this->model->deletePersona($intCOD_PERSONA);
				if($requestDelete)
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Registro.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function delDireccion(){
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intCOD_DIRECCION = intval($_POST['idPersona']);
				$requestDelete = $this->model->deleteDireccion($intCOD_DIRECCION);
				if($requestDelete)
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado ');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}
	
	
	public function delTelefono(){
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intCOD_TELEFONO= intval($_POST['idPersona']);
				$requestDelete = $this->model->deleteTelefono($intCOD_TELEFONO);
				if($requestDelete)
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado ');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}
	

//BUSCADOR PARA LA COMPRA 
public function buscarPorNombre()
{
	$array = array();
	$valor = $_GET['term'];
	$data = $this->model->buscarPorNombre($valor);
	foreach ($data as $row) {
		$result['COD_PERSONA'] = $row['COD_PERSONA'];
		$result['label'] = $row['NOMBRE'];
		$result['TELEFONO'] = $row['TELEFONO'];
		$result['DIRECCION1'] = $row['DIRECCION1'];
		array_push($array, $result);
	}
	echo json_encode($array, JSON_UNESCAPED_UNICODE);
	die();
}

//BUSCADOR PARA LA Venta
public function buscarCliente()
{
	$array = array();
	$valor = $_GET['term'];
	$data = $this->model->buscarCliente($valor);
	foreach ($data as $row) {
		$result['COD_PERSONA'] = $row['COD_PERSONA'];
		$result['label'] = $row['NOMBRE'];
		$result['TELEFONO'] = $row['TELEFONO'];
		$result['DIRECCION1'] = $row['DIRECCION1'];
		array_push($array, $result);
	}
	echo json_encode($array, JSON_UNESCAPED_UNICODE);
	die();
}


}



?>
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
// Programa:         Modulo de Login
// Fecha:             23-febrero-2023
// Programador:       Elsy Maradiaga Y Gerson Garcia
// descripcion:      Modulo para iniciar sesion y recuperar contraseña


	class Login extends Controllers{
		public function __construct()
		{
			session_start();
			if(isset($_SESSION['login']))
			{
				header('Location: '.base_url().'/dashboard');
			}
			parent::__construct();
		}
//funcion general
		public function login()
		{
			$data['page_tag'] = "Login ";
			$data['page_title'] = "Empresa Generica";
			$data['page_name'] = "login";
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this,"login",$data);
		
		}
// funcion para Login
		public function loginUser(){
			//dep($_POST);
			if($_POST){
				if(empty($_POST['txtUsername']) || empty($_POST['txtPassword'])){
					$arrResponse = array('status' => false, 'msg' => 'Error de datos' );
				}else{
					$strUsuario  =  strtolower(strClean($_POST['txtUsername']));
					$strPassword = hash("SHA256",$_POST['txtPassword']);
					$requestUser = $this->model->loginUser($strUsuario, $strPassword); //llamado del model con parametros
					if(empty($requestUser)){
						$arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto.' ); 
					}else{
						$arrData = $requestUser;
						if($arrData['status'] == 1){
							$_SESSION['idUser'] = $arrData['idpersona'];
							$_SESSION['login'] = true;
							$evento = 'Inicio de Sesión'; 
							$ip = $_SERVER['REMOTE_ADDR'];
							$detalle = $_SERVER['HTTP_USER_AGENT'];
							$acceso = $this->model->registrarAcceso($evento, $ip, $detalle); //registro del dispositivo por el cual se registra
							if ($acceso > 0) {
								$arrResponse = array('msg' => 'DATOS CORRECTO', 'type' => 'success');
							} else {
								$arrResponse = array('msg' => 'ERROR AL CAPTURAR LOS DATOS DEL INICIO', 'type' => 'error');
							}  
							$arrData = $this->model->sessionLogin($_SESSION['idUser']); //validacion de inicio de sesion
							sessionUser($_SESSION['idUser']);							
							$arrResponse = array('status' => true, 'msg' => 'ok');
						}else{
							$arrResponse = array('status' => false, 'msg' => 'Usuario inactivo.');
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
//Funcion de seguridad para la recuperacion por correo
		public function resetPass(){
	            if($_POST){
				
					if(empty($_POST['txtEmailReset'])){
						$arrResponse = array('status' => false, 'msg' => 'Error de datos' );
					}else{
						$token = token();
						$strEmail  =  strtolower(strClean($_POST['txtEmailReset']));
						$arrData = $this->model->getUserEmail($strEmail);
//validacion por si el registro no existe en el sistema
						if(empty($arrData)){
							$arrResponse = array('status' => false, 'msg' => 'Usuario no existente.' ); 
						}else{
							$idpersona = $arrData['idpersona'];
						    $nombreUsuario = $arrData['nombres'].' '.$arrData['apellidos'];
						
						    $url_recovery = base_url().'/login/confirmUser/'.$strEmail.'/'.$token;
						    $requestUpdate = $this->model->setTokenUser($idpersona,$token); //llamado del model para el token
							$dataUsuario = array('nombreUsuario' => $nombreUsuario,
											 'email' => $strEmail,
											 'asunto' => 'Recuperar cuenta - '.NOMBRE_REMITENTE,
											 'url_recovery' => $url_recovery);
							$sendEmail = sendEmail($dataUsuario,'email_cambioPassword');

							if($requestUpdate){
								$sendEmail = sendEmail($dataUsuario,'email_cambioPassword');
	
								if($sendEmail){
									$arrResponse = array('status' => true, 
													 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña.');
								}else{
									$arrResponse = array('status' => false, 
													 'msg' => 'No es posible realizar el proceso, intenta más tarde.' );
								}
							}else{
								$arrResponse = array('status' => false, 
													 'msg' => 'No es posible realizar el proceso, intenta más tarde.' );
							}
							
						}
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	             }
		
			die();
		}
//funcion para validar el usuario
		public function confirmUser(string $params){

			if(empty($params)){
				header('Location: '.base_url());
			}else{
				$arrParams = explode(',',$params);
				$strEmail = strClean($arrParams[0]);//limpieza de los parametros del usuario al ser confirmado
				$strToken = strClean($arrParams[1]);
	
				$arrResponse = $this->model->getUsuario($strEmail,$strToken);
				if(empty($arrResponse)){
					header("Location: ".base_url());
				}else{
					$data['page_tag'] = "Cambiar contraseña";
					$data['page_name'] = "cambiar_contrasenia";  //funcion de titualres y funciones de ajax y vista al usar
					$data['page_title'] = "Cambiar Contraseña";
					$data['email'] = $strEmail;
					$data['token'] = $strToken;
					$data['idpersona'] = $arrResponse['idpersona'];
					$data['page_functions_js'] = "functions_login.js";
					$this->views->getView($this,"cambiar_password",$data);
				}
			}
					
				die();
		}

		public function setPassword(){ //funcion de cambio de contraseña

			if(empty($_POST['idUsuario']) || empty($_POST['txtEmail']) || empty($_POST['txtToken']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm'])){

					$arrResponse = array('status' => false, 
										 'msg' => 'Error de datos' );
				}
			else{
					$intIdpersona = intval($_POST['idUsuario']);
					$strPassword = $_POST['txtPassword'];
					$strPasswordConfirm = $_POST['txtPasswordConfirm']; //equivalencia de datos globales al formulario 
					$strEmail = strClean($_POST['txtEmail']);
					$strToken = strClean($_POST['txtToken']);

					if($strPassword != $strPasswordConfirm){
						$arrResponse = array('status' => false, 
											 'msg' => 'Las contraseñas no son iguales.' );
					}else{
						$arrResponseUser = $this->model->getUsuario($strEmail,$strToken);//llamado del modelo 
						if(empty($arrResponseUser)){
							$arrResponse = array('status' => false, 
											 'msg' => 'Erro de datos.' );
						}
						else{
							$strPassword = hash("SHA256",$strPassword);
							$requestPass = $this->model->insertPassword($intIdpersona,$strPassword); //llamado del modelo

							if($requestPass){
								$arrResponse = array('status' => true, 
													 'msg' => 'Contraseña actualizada con éxito.');
							}else{
								$arrResponse = array('status' => false, 
													 'msg' => 'No es posible realizar el proceso, intente más tarde.');
							}
						}
					}
				}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}
	}
 ?>
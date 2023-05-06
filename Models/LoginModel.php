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

	class LoginModel extends Mysql
	{
		private $intIdUsuario;
		private $strUsuario;//variables globales
		private $strPassword;
		private $strToken;

		public function __construct() //constructor del modelo del login
		{
			parent::__construct();
		}	

		public function registrarAcceso($evento, $ip, $detalle)//funcion de localizacion de acceso del login de cada uno de los usuarios
		{
			$sql = "INSERT INTO tbl_acceso (evento, ip, detalle) VALUES (?,?,?)";
			$array = array($evento, $ip, $detalle);
			return $this->insert($sql, $array);
		}

		public function loginUser(string $usuario, string $password) //funcion que hace la validacion de inicio de sesion del usuario
		{
			$this->strUsuario = $usuario; //equivalencia para la validacion de sesion del usuario con el formulario de html
			$this->strPassword = $password;
			$sql = "SELECT idpersona,status FROM tbl_ms_usuarios WHERE 
					username = '$this->strUsuario' and 
					password = '$this->strPassword' and 
					status != 0 "; //sentencia sql para ver si el usuario existe en la bdd
			$request = $this->select($sql);//ejecuoion del sql
			return $request;
		}

		public function sessionLogin(int $iduser){//funcion de que manda la sesion del usuario
			$this->intIdUsuario = $iduser;
			//BUSCAR ROLE 
			$sql = "SELECT p.idpersona,
							p.identificacion,
							p.nombres,
							p.apellidos,
							p.telefono,
							p.email_user,
							p.username,
							p.nit,
							p.nombrefiscal,
							p.direccionfiscal,
							r.idrol,r.nombrerol,
							p.status 
					FROM tbl_ms_usuarios p
					INNER JOIN tbl_ms_rol r
					ON p.rolid = r.idrol
					WHERE p.idpersona = $this->intIdUsuario"; //sentencia sql que carga la sesion del usuario al sistema
			$request = $this->select($sql);
			$_SESSION['userData'] = $request;
			return $request;
		}

		public function getUserEmail(string $strEmail){ //funcion de obtencion del correo electronico del usuario
			$this->strUsuario = $strEmail;
			$sql = "SELECT idpersona,nombres,apellidos,status FROM tbl_ms_usuarios WHERE 
					email_user = '$this->strUsuario' and  
					status = 1 ";
			$request = $this->select($sql);
			return $request;
		}

		public function setTokenUser(int $idpersona, string $token){
			$this->intIdUsuario = $idpersona; //funcion de creacion y manipulacion del usuario con el token unico
			$this->strToken = $token;
			$sql = "UPDATE tbl_ms_usuarios SET token = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array($this->strToken);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function getUsuario(string $email, string $token){//funcion de obtener la informacion del usuario
			$this->strUsuario = $email;
			$this->strToken = $token;
			$sql = "SELECT idpersona FROM tbl_ms_usuarios WHERE 
					email_user = '$this->strUsuario' and 
					token = '$this->strToken' and 					
					status = 1 ";
			$request = $this->select($sql);
			return $request;
		}

		public function insertPassword(int $idPersona, string $password){ //funcion de insercion de contraseña 
			$this->intIdUsuario = $idPersona;
			$this->strPassword = $password;
			$sql = "UPDATE tbl_ms_usuarios SET password = ?, token = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array($this->strPassword,"");
			$request = $this->update($sql,$arrData);
			return $request;
		}
	}
 ?>
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
		private $strUsuario;
		private $strPassword;
		private $strToken;

		public function __construct()
		{
			parent::__construct();
		}	

		public function registrarAcceso($evento, $ip, $detalle)
		{
			$sql = "INSERT INTO tbl_acceso (evento, ip, detalle) VALUES (?,?,?)";
			$array = array($evento, $ip, $detalle);
			return $this->insert($sql, $array);
		}

		public function loginUser(string $usuario, string $password)
		{
			$this->strUsuario = $usuario;
			$this->strPassword = $password;
			$sql = "SELECT idpersona,status FROM tbl_ms_usuarios WHERE 
					username = '$this->strUsuario' and 
					password = '$this->strPassword' and 
					status != 0 ";
			$request = $this->select($sql);
			return $request;
		}

		public function sessionLogin(int $iduser){
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
					WHERE p.idpersona = $this->intIdUsuario";
			$request = $this->select($sql);
			$_SESSION['userData'] = $request;
			return $request;
		}

		public function getUserEmail(string $strEmail){
			$this->strUsuario = $strEmail;
			$sql = "SELECT idpersona,nombres,apellidos,status FROM tbl_ms_usuarios WHERE 
					email_user = '$this->strUsuario' and  
					status = 1 ";
			$request = $this->select($sql);
			return $request;
		}

		public function setTokenUser(int $idpersona, string $token){
			$this->intIdUsuario = $idpersona;
			$this->strToken = $token;
			$sql = "UPDATE tbl_ms_usuarios SET token = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array($this->strToken);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function getUsuario(string $email, string $token){
			$this->strUsuario = $email;
			$this->strToken = $token;
			$sql = "SELECT idpersona FROM tbl_ms_usuarios WHERE 
					email_user = '$this->strUsuario' and 
					token = '$this->strToken' and 					
					status = 1 ";
			$request = $this->select($sql);
			return $request;
		}

		public function insertPassword(int $idPersona, string $password){
			$this->intIdUsuario = $idPersona;
			$this->strPassword = $password;
			$sql = "UPDATE tbl_ms_usuarios SET password = ?, token = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array($this->strPassword,"");
			$request = $this->update($sql,$arrData);
			return $request;
		}
	}
 ?>
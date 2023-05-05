<?php 

	class UsuariosModel extends Mysql
	{
		private $intIdUsuario;
		private $strIdentificacion;
		private $strNombre;
		private $strApellido;
		private $intTelefono; //variables global variable para realizar las ejecuciones
		private $strEmail;
		private $strUsername;
		private $strPassword;
		private $strToken;
		private $intTipoId;
		private $intStatus;
		private $strNit;
		private $strNomFiscal;
		private $strDirFiscal;
		private $strCREADO_POR;
		private $strMODIFICADO_POR;
		private $dateFECHA_MODIFICADO;

		public function __construct()
		{
			parent::__construct();
		}	

		public function insertUsuario(string $identificacion, string $nombre, string $apellido, int $telefono, 
		string $email, string $username , string $password, int $tipoid,STRING $CREADO_POR, int $status){ //instancia de inserccion de usuario por medio de parametros

			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email; //equivalencia de variables globales con los parametros
			$this->strUsername = $username;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;
			$this->strCREADO_POR = $CREADO_POR;
			$return = 0;

			$sql = "SELECT * FROM tbl_ms_usuarios WHERE 
					email_user = '{$this->strEmail}' or identificacion = '{$this->strIdentificacion}' "; //sentencia sql 
			$request = $this->select_all($sql);//ejecucion de sql

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tbl_ms_usuarios(identificacion,nombres,apellidos,telefono,email_user,username,password,rolid,CREADO_POR,status) 
								  VALUES(?,?,?,?,?,?,?,?,?,?)"; //sentencia sql de insertaer usuarios
	        	$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
        						$this->intTelefono,
        						$this->strEmail,
								$this->strUsername,  //orden de como seran insertadas las variables 
        						$this->strPassword,
        						$this->intTipoId,
								$this->strCREADO_POR,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData); //ejecucion de sql
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function selectUsuarios() //funcion de mostrar datos
		{
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1 ){
				$whereAdmin = " and p.idpersona != 1 ";
			}
			$sql = "SELECT p.idpersona,p.identificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.username,p.status,r.idrol,r.nombrerol 
					FROM tbl_ms_usuarios p 
					INNER JOIN tbl_ms_rol r 
					ON p.rolid = r.idrol
					WHERE p.status != 0 ".$whereAdmin; //instancia de sql con el inner join de relacion  
					$request = $this->select_all($sql);//ejecucion de sql
					return $request;
		}
		public function selectUsuario(int $idpersona){ //funcion de mostrar usuario por selector
			$this->intIdUsuario = $idpersona;
			$sql = "SELECT p.idpersona,p.identificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.username,p.nit,p.nombrefiscal,p.direccionfiscal,r.idrol,r.nombrerol,p.status, DATE_FORMAT(p.FECHA_CREACION, '%d-%m-%Y') as fechaRegistro 
					FROM tbl_ms_usuarios p
					INNER JOIN tbl_ms_rol r
					ON p.rolid = r.idrol
					WHERE p.idpersona = $this->intIdUsuario"; //instancia de sql con el inner join de relacion  
			$request = $this->select($sql);
			return $request;
		}

		public function updateUsuario(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono,
		 string $email, string $username, string $password, int $tipoid, String $MODIFICADO_POR, string $FECHA_MODIFICADO  ,int $status){ //funcion de actualziar usuarios por medio de parametros 

			$this->intIdUsuario = $idUsuario;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email; //equivalencia de datos con las variables globales
			$this->strUsername = $username;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;
			$this->strMODIFICADO_POR = $MODIFICADO_POR;
			$this->dateFECHA_MODIFICADO =$FECHA_MODIFICADO;
			

			$sql = "SELECT * FROM tbl_ms_usuarios WHERE (email_user = '{$this->strEmail}' AND idpersona != $this->intIdUsuario)
										  OR (identificacion = '{$this->strIdentificacion}' AND idpersona != $this->intIdUsuario) "; //instancia sql que valida la actualización de datos
			$request = $this->select_all($sql);//ejecucion de sql

			if(empty($request))
			{
				if($this->strPassword  != "")
				{
					$sql = "UPDATE tbl_ms_usuarios SET identificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?,username=?, password=?, rolid=?, MODIFICADO_POR=?, FECHA_MODIFICADO=?,status=? 
							WHERE idpersona = $this->intIdUsuario "; //instancia sql que valida la actualización de datos
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
									$this->strUsername,
	        						$this->strPassword,
	        						$this->intTipoId,
									$this->strMODIFICADO_POR,
									$this->dateFECHA_MODIFICADO,
	        						$this->intStatus); //instancia de sql ejecutada segun el orden de datos establecidos en la instancia de arriba
				}else{
					$sql = "UPDATE tbl_ms_usuarios SET identificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?, username=?, rolid=?, MODIFICADO_POR=?, FECHA_MODIFICADO=?, status=? 
							WHERE idpersona = $this->intIdUsuario "; //instancia sql que valida la actualización de datos
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
									$this->strUsername,
	        						$this->intTipoId,
									$this->strMODIFICADO_POR,
									$this->dateFECHA_MODIFICADO,
	        						$this->intStatus);  //instancia de sql ejecutada segun el orden de datos establecidos en la instancia de arriba
				}
				$request = $this->update($sql,$arrData); //ejecucion de sql
			}else{
				$request = "exist";
			}
			return $request;
		
		}
		public function deleteUsuario(int $intIdpersona) //funcion de eliminar usuarios
		{
			$this->intIdUsuario = $intIdpersona;
			$sql = "UPDATE tbl_ms_usuarios SET status = ? WHERE idpersona = $this->intIdUsuario "; //instancia sql de eliminar usuarios
			$arrData = array(0);
			$request = $this->update($sql,$arrData);//ejecuciones de sql
			return $request;
		}

		public function updatePerfil(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $password){ //funcion de actualizar datos 
			$this->intIdUsuario = $idUsuario;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre; //equivalencia de datos con variable generales
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strPassword = $password;

			if($this->strPassword != "")
			{
				$sql = "UPDATE tbl_ms_usuarios SET identificacion=?, nombres=?, apellidos=?, telefono=?, password=? 
						WHERE idpersona = $this->intIdUsuario ";
				$arrData = array($this->strIdentificacion,
								$this->strNombre,
								$this->strApellido,
								$this->intTelefono,
								$this->strPassword); //instancia sql y ejecucion de variables en ella
			}else{
				$sql = "UPDATE tbl_ms_usuarios SET identificacion=?, nombres=?, apellidos=?, telefono=? 
						WHERE idpersona = $this->intIdUsuario ";
				$arrData = array($this->strIdentificacion,
								$this->strNombre,
								$this->strApellido,
								$this->intTelefono); //instancia sql y ejecucion de variables en ella
			}
			$request = $this->update($sql,$arrData); //ejecucion de instancia sql
		    return $request;
		}

		public function updateDataFiscal(int $idUsuario, string $strNit, string $strNomFiscal, string $strDirFiscal){
			$this->intIdUsuario = $idUsuario;
			$this->strNit = $strNit;
			$this->strNomFiscal = $strNomFiscal;
			$this->strDirFiscal = $strDirFiscal;
			$sql = "UPDATE tbl_ms_usuarios SET nit=?, nombrefiscal=?, direccionfiscal=? 
						WHERE idpersona = $this->intIdUsuario ";
			$arrData = array($this->strNit,
							$this->strNomFiscal,
							$this->strDirFiscal);
			$request = $this->update($sql,$arrData);
		    return $request;
		}

	}
 ?>
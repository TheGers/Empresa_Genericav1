<?php 

	class UsuariosModel extends Mysql
	{
		private $intIdUsuario;
		private $strIdentificacion;
		private $strNombre;
		private $strApellido;
		private $intTelefono;
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

		public function insertUsuario(string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $username , string $password, int $tipoid,STRING $CREADO_POR, int $status){

			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strUsername = $username;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;
			$this->strCREADO_POR = $CREADO_POR;
			$return = 0;

			$sql = "SELECT * FROM tbl_ms_usuarios WHERE 
					email_user = '{$this->strEmail}' or identificacion = '{$this->strIdentificacion}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tbl_ms_usuarios(identificacion,nombres,apellidos,telefono,email_user,username,password,rolid,CREADO_POR,status) 
								  VALUES(?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
        						$this->intTelefono,
        						$this->strEmail,
								$this->strUsername, 
        						$this->strPassword,
        						$this->intTipoId,
								$this->strCREADO_POR,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function selectUsuarios()
		{
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1 ){
				$whereAdmin = " and p.idpersona != 1 ";
			}
			$sql = "SELECT p.idpersona,p.identificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.username,p.status,r.idrol,r.nombrerol 
					FROM tbl_ms_usuarios p 
					INNER JOIN tbl_ms_rol r
					ON p.rolid = r.idrol
					WHERE p.status != 0 ".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}
		public function selectUsuario(int $idpersona){
			$this->intIdUsuario = $idpersona;
			$sql = "SELECT p.idpersona,p.identificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.username,p.nit,p.nombrefiscal,p.direccionfiscal,r.idrol,r.nombrerol,p.status, DATE_FORMAT(p.FECHA_CREACION, '%d-%m-%Y') as fechaRegistro 
					FROM tbl_ms_usuarios p
					INNER JOIN tbl_ms_rol r
					ON p.rolid = r.idrol
					WHERE p.idpersona = $this->intIdUsuario";
			$request = $this->select($sql);
			return $request;
		}

		public function updateUsuario(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $username, string $password, int $tipoid, String $MODIFICADO_POR, string $FECHA_MODIFICADO  ,int $status){

			$this->intIdUsuario = $idUsuario;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strUsername = $username;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;
			$this->strMODIFICADO_POR = $MODIFICADO_POR;
			$this->dateFECHA_MODIFICADO =$FECHA_MODIFICADO;
			

			$sql = "SELECT * FROM tbl_ms_usuarios WHERE (email_user = '{$this->strEmail}' AND idpersona != $this->intIdUsuario)
										  OR (identificacion = '{$this->strIdentificacion}' AND idpersona != $this->intIdUsuario) ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				if($this->strPassword  != "")
				{
					$sql = "UPDATE tbl_ms_usuarios SET identificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?,username=?, password=?, rolid=?, MODIFICADO_POR=?, FECHA_MODIFICADO=?,status=? 
							WHERE idpersona = $this->intIdUsuario ";
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
	        						$this->intStatus);
				}else{
					$sql = "UPDATE tbl_ms_usuarios SET identificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?, username=?, rolid=?, MODIFICADO_POR=?, FECHA_MODIFICADO=?, status=? 
							WHERE idpersona = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
									$this->strUsername,
	        						$this->intTipoId,
									$this->strMODIFICADO_POR,
									$this->dateFECHA_MODIFICADO,
	        						$this->intStatus);
				}
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		
		}
		public function deleteUsuario(int $intIdpersona)
		{
			$this->intIdUsuario = $intIdpersona;
			$sql = "UPDATE tbl_ms_usuarios SET status = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function updatePerfil(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $password){
			$this->intIdUsuario = $idUsuario;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
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
								$this->strPassword);
			}else{
				$sql = "UPDATE tbl_ms_usuarios SET identificacion=?, nombres=?, apellidos=?, telefono=? 
						WHERE idpersona = $this->intIdUsuario ";
				$arrData = array($this->strIdentificacion,
								$this->strNombre,
								$this->strApellido,
								$this->intTelefono);
			}
			$request = $this->update($sql,$arrData);
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
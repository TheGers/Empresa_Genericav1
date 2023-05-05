<?php

class EmpresasModel extends Mysql
{

	private $intid;
	private $strNombre_Empresa;
	private $strDESCRIPCION;
	private $strCORREO;
	private $strDIRECCION;
	private $strmensaje;
	private $strRTN;
	private $intStatus;



	public function __construct()
	{
		parent::__construct();
	}


	public function getEmpresas()
	{
		$sql = "SELECT * FROM tbl_empresa ";
		return $this->select($sql);
	}

	public function UptadeEmpresas($id,$RTN, $nombre,$telefono,$correo, $direccion,$descripcion,$mensaje)
    {
        $sql = "UPDATE tbl_empresa SET RTN=?, NOMBRE_EMPRESA=?, telefono=?, CORREO=?,
        DIRECCION=?, DESCRIPCION=?, mensaje=? WHERE id=?";
        $array = array($id,$RTN, $nombre,$telefono,$correo, $direccion,$descripcion,$mensaje);
        return $this->save($sql, $array);
    }

	



















}
?>
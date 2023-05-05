<?php

class ProductosModel extends Mysql
{
	private $intCOD_PRODUCTO;
	private $strNOMBRE_PRODUCTO;
	private $intCOD_CATEGORIA;
	private $strDESCRIPCION;
	private $intPRECIO;
	private $intPRECIOVENTA;
	private $intEXISTENCIA;
	private $intESTADO;
	private $strBarcodigo;
	private $strCREADO_POR;
	private $strMODIFICADO_POR;
	private $dateFECHA_MODIFICADO;

	public function __construct()
	{
		parent::__construct();
	}

	public function selectProductos() //funcion de seleccion de datos
	{
		$sql = "SELECT p.COD_PRODUCTO,
		                    p.BARCODIGO,
							p.NOMBRE_PRODUCTO,
							p.COD_CATEGORIA,
							c.NOMBRE as tbl_categoria,
                            p.DESCRIPCION,
							p.PRECIO,
							p.PrecioVenta,
                            p.EXISTENCIA,
							p.status 
					FROM tbl_producto p 
					INNER JOIN tbl_categoria c
					ON p.COD_CATEGORIA = c.idcategoria
					WHERE p.status != 0 ";
		$request = $this->select_all($sql);
		return $request;
	}

	public function insertProducto(string $NOMBRE_PRODUCTO, int $BARCODIGO, int $COD_CATEGORIA, string $DESCRIPCION, 
	int $PRECIO, int $PrecioVenta,int $EXISTENCIA,STRING $CREADO_POR, int $status )//inserccion de datos por parametros
	{
		$this->strNOMBRE_PRODUCTO = $NOMBRE_PRODUCTO;
		$this->strBarcodigo = $BARCODIGO;
		$this->intCOD_CATEGORIA = $COD_CATEGORIA; //equivalencia con variable globales con los parametros
		$this->strDESCRIPCION = $DESCRIPCION;
		$this->intPRECIO = $PRECIO;
		$this->intPRECIOVENTA =$PrecioVenta;
		$this->intEXISTENCIA = $EXISTENCIA;
		$this->intESTADO = $status;
		$this->strCREADO_POR = $CREADO_POR;
		$return = 0;
		$sql = "SELECT * FROM tbl_producto WHERE NOMBRE_PRODUCTO = '{$this->strNOMBRE_PRODUCTO}'";
		$request = $this->select_all($sql);
		if (empty($request)) {
			$query_insert = "INSERT INTO tbl_producto (NOMBRE_PRODUCTO,
			                                        	BARCODIGO,
														COD_CATEGORIA,
														DESCRIPCION,
														PRECIO,
														PrecioVenta,
														EXISTENCIA,
														CREADO_POR,
														status
														) 
								  VALUES(?,?,?,?,?,?,?,?,?)"; //instancia sql para insertar datoos
			$arrData = array(
				$this->strNOMBRE_PRODUCTO,
				$this->strBarcodigo,
				$this->intCOD_CATEGORIA,
				$this->strDESCRIPCION,
				$this->intPRECIO,
				$this->intPRECIOVENTA, //datos que sera usados para insertar en la tabla de la BDD
				$this->intEXISTENCIA,
				$this->strCREADO_POR,
				$this->intESTADO
			);
			$request_insert = $this->insert($query_insert, $arrData); //ejecucion del sql
			$return = $request_insert;
		} else {
			$return = "exist";
		}
		return $return;
	}

	public function selectProducto(int $COD_PRODUCTO)//funcion que trae los datos para luego sder mostrados
	{
		$this->intCOD_PRODUCTO = $COD_PRODUCTO;
		$sql = "SELECT p.COD_PRODUCTO,
		                    p.BARCODIGO,
							p.NOMBRE_PRODUCTO,
							p.COD_CATEGORIA,
							c.NOMBRE as tbl_categoria,
							p.DESCRIPCION,
							p.PRECIO,
							p.PrecioVenta,
							p.EXISTENCIA,
							p.status
					FROM tbl_producto p
					INNER JOIN tbl_categoria c
					ON p.COD_CATEGORIA = c.idcategoria
					WHERE COD_PRODUCTO = $this->intCOD_PRODUCTO"; //instancia de sql que tgrae todos los datos
		$request = $this->select($sql); //ejecucion de sql
		return $request;

	}
 	public function updateProducto(//funcion que actualiza los datos 
		int $COD_PRODUCTO, string $BARCODIGO ,string $NOMBRE_PRODUCTO, int $COD_CATEGORIA,
		string $DESCRIPCION, int $PRECIO, int $PrecioVenta,int $EXISTENCIA, String $MODIFICADO_POR, string $FECHA_MODIFICACION,int $status
	) {
		$this->intCOD_PRODUCTO = $COD_PRODUCTO;
		$this->strBarcodigo = $BARCODIGO;
		$this->strNOMBRE_PRODUCTO = $NOMBRE_PRODUCTO;
		$this->intCOD_CATEGORIA = $COD_CATEGORIA;
		$this->strDESCRIPCION = $DESCRIPCION; //equivalencia de datos con variables globales
		$this->intPRECIO = $PRECIO;
		$this->intPRECIOVENTA = $PrecioVenta;
		$this->intEXISTENCIA = $EXISTENCIA;
		$this->intESTADO = $status;
		$this->strMODIFICADO_POR = $MODIFICADO_POR;
		$this->dateFECHA_MODIFICADO =$FECHA_MODIFICACION;
		$return = 0;
		$sql = "SELECT * FROM tbl_producto WHERE NOMBRE_PRODUCTO = '{$this->strNOMBRE_PRODUCTO}' AND 
			COD_PRODUCTO != $this->intCOD_PRODUCTO ";
		$request = $this->select_all($sql);
		if (empty($request)) {
			$sql = "UPDATE tbl_producto 
						SET 
						BARCODIGO=?,
						NOMBRE_PRODUCTO=?,
						COD_CATEGORIA=?,
						DESCRIPCION=?,
						PRECIO=?,
						PrecioVenta=?,
						EXISTENCIA=?,
						MODIFICADO_POR=?, 
						FECHA_MODIFICACION=?,
						status=?
							
						WHERE COD_PRODUCTO = $this->intCOD_PRODUCTO "; //instancia sql 
			$arrData = array(
				$this->strBarcodigo,
				$this->strNOMBRE_PRODUCTO,
				$this->intCOD_CATEGORIA,
				$this->strDESCRIPCION,
				$this->intPRECIO,
				$this->intPRECIOVENTA,
				$this->intEXISTENCIA, //orden que seran actualizados los datos
				$this->strMODIFICADO_POR,
				$this->dateFECHA_MODIFICADO,
				$this->intESTADO,

			);

			$request = $this->update($sql, $arrData);
			$return = $request;
		} else {
			$return = "exist";
		}
		return $return;
	}

	public function deleteProducto(int $COD_PRODUCTO) //funcion de eliminar el producto
	{
		$this->intCOD_PRODUCTO = $COD_PRODUCTO;
		$sql = "UPDATE tbl_producto SET status = ? WHERE COD_PRODUCTO = $this->intCOD_PRODUCTO ";
		$arrData = array(0);
		$request = $this->update($sql, $arrData);
		return $request;
	}


	// ----------------------------------------EDITAR - ADAPTADO - JAHIR-------------------------------------------------

	public function editar($COD_PRODUCTO)
	{
		$sql = "SELECT * FROM tbl_producto WHERE COD_PRODUCTO= '$COD_PRODUCTO'";
		return $this->select($sql);
	}
	// ---------------------------------------BUSCAR PRODUCTO POR CODIGO - JAHIR----------------------------------------

	public function buscarPorCodigo($valor)
	{
		$sql = "SELECT COD_PRODUCTO FROM tbl_producto WHERE BARCODIGO = '$valor'";
		return $this->select($sql);
	}

	// ---------------------------------------BUSCAR PRODUCTO POR NOMBRE - JAHIR----------------------------------------

	public function buscarPorNombre($valor)
	{
		$sql = "SELECT COD_PRODUCTO, NOMBRE_PRODUCTO FROM tbl_producto WHERE NOMBRE_PRODUCTO LIKE '%" . $valor . "%' LIMIT 10";
		return $this->select_all($sql);
	}

}
?>
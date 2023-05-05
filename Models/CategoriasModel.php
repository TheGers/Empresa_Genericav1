<?php 

	class CategoriasModel extends Mysql
	{
		public $intIdcategoria;
		public $strCategoria;
		public $strDescripcion; //variables globales para ejecutarbfunciones con ellas
		public $intStatus;
		public $strPortada;

		public function __construct()
		{
			parent::__construct();
		}

		public function inserCategoria(string $nombre, string $descripcion, string $portada, int $status){ //funcion de inserccion de datos por parametros

			$return = 0;
			$this->strCategoria = $nombre;
			$this->strDescripcion = $descripcion;
			$this->strPortada = $portada;
			$this->intStatus = $status;

			$sql = "SELECT * FROM tbl_categoria WHERE nombre = '{$this->strCategoria}' ";
			$request = $this->select_all($sql);

			

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tbl_categoria(nombre,descripcion,portada,status) VALUES(?,?,?,?)"; //funcion sql para insertar datos 
	        	$arrData = array($this->strCategoria, 
								 $this->strDescripcion, 
								 $this->strPortada, 
								 $this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData); //funcion de ejectucion de sql
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}

		public function selectCategorias() //funcion de mostrar datos 
		{
			$sql = "SELECT  idcategoria,
							nombre,
							descripcion,
							status
				FROM tbl_categoria WHERE status!=0 ";
				$request = $this->select_all($sql); //ejecucion de sql
			return $request;
		}

 		public function selectCategoria(int $idcategoria){ //funcion de mostrar datos de manera general
			$this->intIdcategoria = $idcategoria;
			$sql = "SELECT * FROM tbl_categoria
					WHERE idcategoria = $this->intIdcategoria";
			$request = $this->select($sql);
			return $request;
		}

		public function updateCategoria(int $idcategoria, string $categoria, string $descripcion, string $portada, int $status){ //funcion  de actualizar datos 
			$this->intIdcategoria = $idcategoria;
			$this->strCategoria = $categoria;
			$this->strDescripcion = $descripcion;
			$this->strPortada = $portada;
			$this->intStatus = $status;

			$sql = "SELECT * FROM tbl_categoria WHERE nombre = '{$this->strCategoria}' AND idcategoria != $this->intIdcategoria"; //sentencia sql
			$request = $this->select_all($sql); //ejecucion del sql

			if(empty($request))
			{
				$sql = "UPDATE tbl_categoria SET nombre = ?, descripcion = ?, portada = ?, status = ? WHERE idcategoria = $this->intIdcategoria ";
				$arrData = array($this->strCategoria, 
								 $this->strDescripcion, 
								 $this->strPortada, 
								 $this->intStatus);  //sentencia sql
				$request = $this->update($sql,$arrData); //ejecucion del sql
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteCategoria(int $idcategoria) //funcion de eliminar 
		{
			$this->intIdcategoria = $idcategoria;
			$sql = "SELECT * FROM tbl_producto WHERE COD_CATEGORIA  = $this->intIdcategoria"; //selector de id para su elimacion
			$request = $this->select_all($sql);  //ejecucion del sql
			if(empty($request))
			{
				$sql = "UPDATE tbl_categoria SET status = ? WHERE idcategoria = $this->intIdcategoria "; //sentencia sql 
				$arrData = array(0);
				$request = $this->update($sql,$arrData);//ejecucion del sql
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}	


	}
 ?>
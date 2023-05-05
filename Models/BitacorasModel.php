<?php 

	class BitacorasModel extends Mysql
	{
		public $intid;
		public $straccion;
		public $datefecha;
		

		public function __construct()
		{
			parent::__construct();
		}



        public function selectBitacoras()
		{
			$sql = "SELECT  id,
							accion,
							FECHA_CREACION,
							CREADO_POR,
							MODIFICADO_POR,
							FECHA_MODIFICADO,
							status
				FROM tbl_bitacora WHERE status!=0 ";
				$request = $this->select_all($sql);
			return $request;
		}


    }
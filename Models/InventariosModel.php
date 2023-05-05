<?php

class InventariosModel extends Mysql
{

   

    public function __construct()
    {
        parent::__construct();
    }

    public function selectInventario()
    {
        $sql = "SELECT  COD_INVENTARIO ,
							accion,
							Nom_factura,
                            ISV,
                            TOTAL,
                            CREADO_POR,
                            FECHA_CREACION,
							status
				FROM tbl_inventario WHERE status!=0 ";
        $request = $this->select_all($sql);
        return $request;
    }


 
}
?>
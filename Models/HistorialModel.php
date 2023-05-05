<?php

class HistorialModel extends Mysql
{
    // ---------------------------------- CONSTRUCTOR ---------------------------------

    public function __construct()
    {
        parent::__construct();
    }

    public function selectHistorial()
    {
        $sql = "SELECT  id,
							accion,
							username,
                            CONTRASENA,
                            CREADO_POR,
                            FECHA_CREACION,
                            MODIFICADO_POR,
                            FECHA_MODIFICACION,
							status
				FROM tbl_historial_contrasena WHERE status!=0 ";
        $request = $this->select_all($sql);
        return $request;
    }




}
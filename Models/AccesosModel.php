<?php

class AccesosModel extends Mysql
{

    public function __construct()
    {
        parent::__construct();
    }


    public function MostrarAccesos()
    {
        $sql = "SELECT  id,
            evento,
            ip,
            detalle,
            fecha,
            status
            FROM tbl_acceso WHERE status!=0 ";
        $request = $this->select_all($sql);
        return $request;

    }






}
<?php

class AccesosModel extends Mysql
{

    public function __construct()
    {
        parent::__construct();
    }


    public function MostrarAccesos() //funcion que traer los datos de la base de datos para mostrarlo en data table
    {
        $sql = "SELECT  id,
            evento,
            ip,
            detalle, 
            fecha,
            status
            FROM tbl_acceso WHERE status!=0 "; //datos que sera traidos para luego mostrarlos
        $request = $this->select_all($sql);
        return $request;

    }






}
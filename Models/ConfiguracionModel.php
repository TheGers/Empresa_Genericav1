<?php

class ConfiguracionModel extends Mysql
{
    public $intCOD_REGIMEN;
    public $intFECHA_INICIO;
    public $intFECHA_LIMITE;
    public $strRANGO_DESDE;
    public $strRANGO_HASTA;
    public $strCAI;
    private $intStatus;
    public $intIdConfiguracion;

    // ---------------------------------- CREADO POR EDWIN JUANEZ ---------------------------------
    // ---------------------------------- CONSTRUCTOR ---------------------------------

    public function __construct()
    {
        parent::__construct();
    }

    // ---------------------------------- MUESTRA LOS DATOS DE LA BASE DE DATOS ---------------------------------

    public function selectConfiguracions()
    {
        $sql = "SELECT  COD_REGIMEN,
                        FECHA_INICIO,
                        FECHA_LIMITE,
                        RANGO_DESDE,
                        RANGO_HASTA,
                        CAI,
                        status
                        FROM tbl_regimen_facturacion WHERE status!=0 ";
        $request = $this->select_all($sql);
        return $request;
    }

    // ---------------------------------- PARA INSERTAR - BUENO  ---------------------------------

    public function insertConfiguracion(int $FECHA_INICIO, int $FECHA_LIMITE, string $RANGO_DESDE, string $RANGO_HASTA, string $CAI,  int $Status)
    {

        $this->intFECHA_INICIO = $FECHA_INICIO;
        $this->intFECHA_LIMITE = $FECHA_LIMITE;
        $this->strRANGO_DESDE = $RANGO_DESDE;
        $this->strRANGO_HASTA = $RANGO_HASTA;
        $this->strCAI = $CAI;
        $this->intStatus = $Status;
        $return = 0;

        $sql = "SELECT * FROM tbl_regimen_facturacion WHERE CAI = '{$this->strCAI}' ";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $query_insert  = "INSERT INTO tbl_regimen_facturacion(FECHA_INICIO,FECHA_LIMITE,RANGO_DESDE,RANGO_HASTA,CAI,status) VALUES(?,?,?,?,?,?)";
            $arrData = array(
                $this->intFECHA_INICIO,
                $this->intFECHA_LIMITE,
                $this->strRANGO_DESDE,
                $this->strRANGO_HASTA,
                $this->strCAI,
                $this->intStatus
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }

    // ----------------------SELECCIONAR DATOS DE LA TABLA DE CONFIGURACION ---------------------------------

    public function selectConfiguracion(int $idConfiguracion)
    {
        $this->intIdConfiguracion = $idConfiguracion;
        $sql = "SELECT * FROM tbl_regimen_facturacion
                WHERE COD_REGIMEN = $this->intIdConfiguracion";
        $request = $this->select($sql);
        return $request;
    }

    // ---------------------------------- PARA ELIMINAR ---------------------------------

    public function deleteConfiguracion(int $idConfiguracion)
    {
        $this->intIdConfiguracion = $idConfiguracion;
        $sql = "SELECT * FROM tbl_regimen_facturacion WHERE CAI  = $this->intIdConfiguracion";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE tbl_regimen_facturacion SET status = ? WHERE COD_REGIMEN = $this->intIdConfiguracion ";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);
            if ($request) {
                $request = 'ok';
            } else {
                $request = 'error';
            }
        } else {
            $request = 'exist';
        }
        return $request;
    }
}

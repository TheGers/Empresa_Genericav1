
<?php

class CotizacionesModel extends Mysql
{


    private $intCOD_COTIZACION;
    private $intCOD_PERSONA;
    private $strNUMERO_COTIZACION;
    private $strDESCRIPCION;
    private $intTOTAL;
    private $intstatus;

    // ---------------------------------- CREADO POR EDWIN JUANEZ ---------------------------------
    // -----------------------------------------------------CONSTRUCTOR-------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
    }

    // ----------------------------------Funcion para seleccionar los productos de las Cotizaciones------------------------------------

    public function getProducto($COD_PRODUCTO)
    {
        $sql = "SELECT * FROM tbl_producto WHERE COD_PRODUCTO = $COD_PRODUCTO";
        return $this->select($sql);
    }

    // ------------------------------------------Registra  en la tabla Cotizaciones--------------------------------------------

    public function
    registraCotizacion($idCliente, $serie, $datosProductos, $total, $idPersona, $fecha)
    {
        $sql = "INSERT INTO tbl_cotizaciones (COD_PERSONA, NUMERO_COTIZACION, DESCRIPCION, TOTAL, CREADO_POR, FECHA_CREACION) VALUES (?,?,?,?,?,?)";
        $array = array($idCliente, $serie, $datosProductos, $total, $idPersona, $fecha);
        return $this->insert($sql, $array);
    }

    // ---------------------------------------------SELECCIONAR DATOS DE LA TABLA COTIZACIONES-------------------------------------------

    public function selectCotizaciones()
    {
        $sql = "SELECT c.COD_COTIZACION,
             c.COD_PERSONA,
             p.NOMBRE as tbl_personas,
            c.NUMERO_COTIZACION,
            c.FECHA_CREACION,
            c.TOTAL,
            c.status 
    FROM tbl_cotizaciones c 
    INNER JOIN tbl_personas p
    ON c.COD_PERSONA = p.COD_PERSONA
    WHERE c.status = 1 or c.status = 0 ";
        $request = $this->select_all($sql);
        return $request;
    }

    // --------------------------------------------------PARA INSERTAR DATOS EN LA TABLA---------------------------------------------------

    public function insertCotizaciones(
        int $intCOD_COTIZACION,
        int $COD_PERSONA,
        string $NUMERO_COTIZACION,
        string $DESCRIPCION,
        int $TOTAL,
        int $status
    ) {
        $return = 0;
        $this->intCOD_COTIZACION = $intCOD_COTIZACION;
        $this->intCOD_PERSONA = $COD_PERSONA;
        $this->strNUMERO_COTIZACION = $NUMERO_COTIZACION;
        $this->strDESCRIPCION = $DESCRIPCION;
        $this->intTOTAL = $TOTAL;
        $this->intstatus = $status;

        $sql = "SELECT * FROM tbl_cotizaciones WHERE COD_COTIZACION = '{$this->intCOD_COTIZACION}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert  = "INSERT INTO tbl_cotizaciones (COD_COTIZACION,
                                                       COD_PERSONA,
                                                        NUMERO_COTIZACION,
														DESCRIPCION,
                                                        TOTAL,
														status) 
								  VALUES(?,?,?,?,?,?)";
            $arrData = array(
                $this->intCOD_COTIZACION,
                $this->intCOD_PERSONA,
                $this->strNUMERO_COTIZACION,
                $this->strDESCRIPCION,
                $this->intTOTAL,
                $this->intstatus
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }

    // -----------------------------------------------------------------------------------------------------------------------------

    public function selectCotizacion(int $intCOD_COTIZACION)
    {
        $sql = "SELECT c.COD_COTIZACION,
             c.COD_PERSONA,
             p.NOMBRE as tbl_personas,
            c.NUMERO_COTIZACION,
            c.DESCRIPCION,
            c.TOTAL,
            c.status 
    FROM tbl_cotizaciones c 
    INNER JOIN tbl_personas p
    ON c.COD_PERSONA = p.COD_PERSONA
    WHERE COD_COTIZACION = $this->intCOD_COTIZACION";
        $request = $this->select($sql);
        return $request;
    }


    // -------------------------------------------MODELO PARA TRABAHAR EL PDF - EDWIN JUANEZ --------------------------------------------------

    public function getEmpresa()
    {
        $sql = "SELECT * FROM tbl_empresa";
        return $this->select($sql);
    }

    // -------------------------------------------MODELO PARA TRABAHAR EL PDF - EDWIN JUANEZ --------------------------------------------------
    public function getCotizacion($COD_COTIZACION)
    {
        $sql = "SELECT c.*, p.NOMBRE, p.IDENTIFICACION FROM tbl_cotizaciones c INNER JOIN tbl_personas p ON c.COD_PERSONA = p.COD_PERSONA WHERE c.COD_COTIZACION = $COD_COTIZACION";
        return $this->select($sql);
    }


    public function anular($COD_COTIZACION)
    {
        $sql = "UPDATE tbl_cotizaciones SET status = ? WHERE COD_COTIZACION = ? ";
        $array = array(0, $COD_COTIZACION);
        return $this->update($sql, $array);
    }
}

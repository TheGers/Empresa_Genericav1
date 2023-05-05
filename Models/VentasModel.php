<!-- -----------------------Modelo para las ventas--------------------------->
<!-- -----------------------Creado por Edwin Juanez--------------------------->

<?php

class VentasModel extends Mysql
{

 
    private $intCOD_VENTA;
    private $intCOD_PERSONA;
    private $strNUMERO_FACTURA;
    private $strDESCRIPCION;
    private $intTOTAL;
    private $intstatus;

    // -----------------------------------------------------CONSTRUCTOR-------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
    }

    // ----------------------------------Funcion para seleccionar los productos de las ventas------------------------------------

    public function getProducto($COD_PRODUCTO)
    {
        $sql = "SELECT * FROM tbl_producto WHERE COD_PRODUCTO = $COD_PRODUCTO";
        return $this->select($sql);
    }

    // ------------------------------------------Registra compra en la tabla VENTAS--------------------------------------------

    public function
    registraVenta($idCliente, $serie, $datosProductos, $isv, $total, $idPersona, $fecha)
    {
        $sql = "INSERT INTO tbl_ventas (COD_PERSONA, NUMERO_FACTURA, DESCRIPCION, ISV, TOTAL, CREADO_POR, FECHA_CREACION) VALUES (?,?,?,?,?,?,?)";
        $array = array($idCliente, $serie, $datosProductos, $isv, $total, $idPersona, $fecha);
        return $this->insert($sql, $array);
    }

    // -----------------------------------Selecionar las ventas------------------------------------------------------------

    public function selectVentas()
    {
        $sql = "SELECT c.COD_VENTA,
             c.COD_PERSONA,
             p.NOMBRE as tbl_personas,
            c.NUMERO_FACTURA,
            c.FECHA_CREACION,
            c.TOTAL,
            c.status 
    FROM tbl_ventas c 
    INNER JOIN tbl_personas p
    ON c.COD_PERSONA = p.COD_PERSONA
    WHERE c.status = 1 or c.status = 0 ";
        $request = $this->select_all($sql);
        return $request;
    }

    // ----------------------------------Incsertar ventas---------------------------------------------------------------------

    public function insertVentas(
        int $intCOD_VENTA,
        int $COD_PERSONA,
        string $NUMERO_FACTURA,
        string $DESCRIPCION,
        int $TOTAL,
        int $status
    ) {
        $return = 0;
        $this->intCOD_VENTA = $intCOD_VENTA;
        $this->intCOD_PERSONA = $COD_PERSONA;
        $this->strNUMERO_FACTURA = $NUMERO_FACTURA;
        $this->strDESCRIPCION = $DESCRIPCION;
        $this->intTOTAL = $TOTAL;
        $this->intstatus = $status;

        $sql = "SELECT * FROM tbl_ventas WHERE COD_VENTA = '{$this->intCOD_VENTA}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert  = "INSERT INTO tbl_ventas (COD_VENTA,
                                                       COD_PERSONA,
                                                        NUMERO_FACTURA,
														DESCRIPCION,
                                                        TOTAL,
														status) 
								  VALUES(?,?,?,?,?,?)";
            $arrData = array(
                $this->intCOD_VENTA,
                $this->intCOD_PERSONA,
                $this->strNUMERO_FACTURA,
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

    // -----------------------------Seleccionar una sola venta-----------------------------------------------------------------------
    public function selectVenta(int $intCOD_VENTA)
    {
        $sql = "SELECT c.COD_VENTA,
             c.COD_PERSONA,
             p.NOMBRE as tbl_personas,
            c.NUMERO_FACTURA,
            c.DESCRIPCION,
            c.TOTAL,
            c.status 
    FROM tbl_ventas c 
    INNER JOIN tbl_personas p
    ON c.COD_PERSONA = p.COD_PERSONA
    WHERE COD_VENTA = $this->intCOD_VENTA";
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
    public function getVenta($COD_VENTA)
    {
        $sql = "SELECT c.*, p.NOMBRE, p.IDENTIFICACION FROM tbl_ventas c INNER JOIN tbl_personas p ON c.COD_PERSONA = p.COD_PERSONA WHERE c.COD_VENTA = $COD_VENTA";
        return $this->select($sql);
    }

    // -------------------------------------------MODELO PARA RESTAR STOCK - EDWIN JUANEZ --------------------------------------------------

    public function actualizarStock($EXISTENCIA, $COD_PRODUCTO)
    {
        $sql = "UPDATE tbl_producto SET EXISTENCIA = ? WHERE COD_PRODUCTO = ?";
        $array = array($EXISTENCIA, $COD_PRODUCTO);
        return $this->update($sql, $array);
    }

    public function getRegimen()
     {
        $sql = "SELECT * FROM tbl_regimen_facturacion WHERE status = 1";
         return $this->select($sql);
     }

// -------------------------------------------MODELO PARA ANULAR STOCK - EDWIN JUANEZ --------------------------------------------------
public function anular($COD_VENTA){
    $sql = "UPDATE tbl_ventas SET status = ? WHERE COD_VENTA = ? ";
    $array = array(0,$COD_VENTA);
    return $this->update($sql,$array);
  

}

    // -------------------------------------------Modelo para las ventas--------------------------------------------------
    // -------------------------------------------Creado por Edwin Juanez --------------------------------------------------

}
<!-- -----------------------Modelo para las compras--------------------------->
<!-- -----------------------Creado por Bayron Meraz--------------------------->

<?php

class ComprasModel extends Mysql
{

    private $intCOD_COMPRA;
    private $intCOD_PERSONA;
    private $strCAI;
    private $strNUMERO_FACTURA;
    private $strDESCRIPCION;
    private $intSUBTOTAL;
    private $intIMPUESTO;
    private $intDESCUENTO;
    private $intTOTAL;
    private $intstatus;
    private $FECHA_CREACION;
   

    public function __construct()
    {
        parent::__construct();
    }


    //Funcion para seleccionar los productos de las compras
    public function getProducto($COD_PRODUCTO)
    {
        $sql = "SELECT * FROM tbl_producto WHERE COD_PRODUCTO = $COD_PRODUCTO";
        return $this->select($sql);
    }

    //Registra compra en la tabla compras
    public function
    registraCompra($idProveedor, $serie, $datosProductos, $isv, $total, $cai, $idPersona, $fecha)
    {
        $sql = "INSERT INTO tbl_compras (COD_PERSONA, NUMERO_FACTURA, DESCRIPCION, ISV, TOTAL, CAI, CREADO_POR, FECHA_CREACION) VALUES (?,?,?,?,?,?,?,?)";
        $array = array($idProveedor, $serie, $datosProductos, $isv, $total, $cai, $idPersona, $fecha);
        return $this->insert($sql, $array);
    }
    // -----------------------------------------------------------------------------------------------------------------------------

    public function selectCompras()
    {
        $sql = "SELECT c.COD_COMPRA,
             c.COD_PERSONA,
             p.NOMBRE as tbl_personas,
            c.NUMERO_FACTURA,
            c.CAI,
            c.FECHA_CREACION,
            c.TOTAL,
            c.status 
    FROM tbl_compras c 
    INNER JOIN tbl_personas p
    ON c.COD_PERSONA = p.COD_PERSONA
    WHERE c.status = 1 OR c.status = 0 ";
        $request = $this->select_all($sql);
        return $request;
    }


    // -----------------------------------------------------------------------------------------------------------------------------

    public function insertCompras(
        int $intCOD_COMPRA,
        int $COD_PERSONA,
        string $CAI,
        string $NUMERO_FACTURA,
        string $DESCRIPCION,
        int $SUBTOTAL,
        int $IMPUESTO,
        int $DESCUENTO,
        int $TOTAL,
        int $status
    ) {
        $return = 0;
        $this->intCOD_COMPRA = $intCOD_COMPRA;
        $this->intCOD_PERSONA = $COD_PERSONA;
        $this->strCAI = $CAI;
        $this->strNUMERO_FACTURA = $NUMERO_FACTURA;
        $this->strDESCRIPCION = $DESCRIPCION;
        $this->intSUBTOTAL = $SUBTOTAL;
        $this->intIMPUESTO = $IMPUESTO;
        $this->intDESCUENTO = $DESCUENTO;
        $this->intTOTAL = $TOTAL;
        $this->intstatus = $status;

        $sql = "SELECT * FROM tbl_compras WHERE COD_COMPRA = '{$this->intCOD_COMPRA}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert  = "INSERT INTO tbl_compras (COD_COMPRA,
                                                       COD_PERSONA,
														CAI,
                                                        NUMERO_FACTURA,
														DESCRIPCION,
														SUBTOTAL,
														IMPUESTO,
                                                        DESCUENTO,
                                                        TOTAL,
														status) 
								  VALUES(?,?,?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->intCOD_COMPRA,
                $this->intCOD_PERSONA,
                $this->strCAI,
                $this->strNUMERO_FACTURA,
                $this->strDESCRIPCION,
                $this->intSUBTOTAL,
                $this->intIMPUESTO,
                $this->intDESCUENTO,
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
    public function selectCompra(int $intCOD_COMPRA)
    {
        $sql = "SELECT c.COD_COMPRA,
             c.COD_PERSONA,
             p.NOMBRE as tbl_personas,
            c.CAI,
            c.NUMERO_FACTURA,
            c.DESCRIPCION,
            c.SUBTOTAL,
            c.IMPUESTO,
            c.DESCUENTO,
            c.TOTAL,
            c.status 
    FROM tbl_compras c 
    INNER JOIN tbl_personas p
    ON c.COD_PERSONA = p.COD_PERSONA
    WHERE COD_COMPRA = $this->intCOD_COMPRA";
        $request = $this->select($sql);
        return $request;
    }

    // -------------------------------------------MODELO PARA TRABAHAR EL PDF - BAYRON --------------------------------------------------

    public function getEmpresa()
    {
        $sql = "SELECT * FROM tbl_empresa";
        return $this->select($sql);
    }

    // -------------------------------------------MODELO PARA TRABAHAR EL PDF - BAYRON --------------------------------------------------
    public function getCompra($COD_COMPRA)
    {
        //$sql = "SELECT c.*, p.NOMBRE, p.IDENTIFICACION FROM tbl_compras c INNER JOIN tbl_personas p ON c.COD_PERSONA WHERE c.COD_COMPRA = $COD_COMPRA";
        $sql = "SELECT c.*, p.NOMBRE, p.IDENTIFICACION FROM tbl_compras c INNER JOIN tbl_personas p ON c.COD_PERSONA = p.COD_PERSONA WHERE c.COD_COMPRA = $COD_COMPRA";
        return $this->select($sql);
    }

    // -------------------------------------------MODELO PARA SUMAR STOCK - BAYRON --------------------------------------------------

      public function actualizarStock($EXISTENCIA, $COD_PRODUCTO)
      {
          $sql = "UPDATE tbl_producto SET EXISTENCIA = ? WHERE COD_PRODUCTO = ?";
          $array = array($EXISTENCIA, $COD_PRODUCTO);
          return $this->insert($sql, $array);
      }

 // -------------------------------------------MODELO PARA ANULAR STOCK - BAYRON --------------------------------------------------
      public function anular($COD_COMPRA){
        $sql = "UPDATE tbl_compras SET status = ? WHERE COD_COMPRA = ? ";
        $array = array(0,$COD_COMPRA);
        return $this->update($sql,$array);
      }
// -------------------------------------------REGISTRA LOS MOVIMIENTOS EN INVENTARIO - BAYRON --------------------------------------------------
      public function registrarMovimiento($COD_PRODUCTO, $movimiento, $EXISTENCIA, $fecha, $idPersona)
    {
        $sql = "INSERT INTO tbl_inventario (COD_PRODUCTO, movimiento, EXISTENCIA, FECHA, COD_PERSONA) VALUES (?,?,?,?,?)";
        $array = array($COD_PRODUCTO, $movimiento, $EXISTENCIA, $fecha, $idPersona);
        return $this->insert($sql, $array);
    }

    // -------------------------------------------Modelo para las compras--------------------------------------------------
    // -------------------------------------------Creado por Bayron Meraz --------------------------------------------------

 }

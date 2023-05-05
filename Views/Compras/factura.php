<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?> </title>
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/factura.css'; ?>">
</head>
<!-- -----------------------Tabla que muestra los datos que se extraen de la tabla empresa--------------------------->
<body>
    <table id="datos-empresa">
        <tr>
            <td class="logo"><img src="<?php echo BASE_URL . '/assets/images/logo.png'; ?> " alt=""></td>
            <td class="info-empresa">
                <p><?php echo $data['empresa']['NOMBRE_EMPRESA']; ?></p>
                <p>RTN: <?php echo $data['empresa']['RTN']; ?></p>
                <p>Correo: <?php echo $data['empresa']['CORREO']; ?></p>
                <p>Direccion: <?php echo $data['empresa']['DIRECCION']; ?></p>
            </td>
            <td class="info-compra">
                <div class="container-factura">
                    <span class="factura">Comprobante de Compra</span>
                    <p>N°: <strong><?php echo $data['compra']['NUMERO_FACTURA']; ?></strong></p>
                    <p>Fecha: <?php echo $data['compra']['FECHA_CREACION']; ?></p>
                </div>
            </td>
        </tr>
    </table>
<!-- -----------------------Tabla que muestra los datos de el proveedor--------------------------->
    <h5 class="title">Datos del Proveedor</h5>
    <table id="container-info">
        <tr>
            <td>
                <strong>Nombre: </strong>
                <p><?php echo $data['compra']['NOMBRE'] ?></p>
            </td>
            <td>
                <strong>RTN: </strong>
                <p><?php echo $data['compra']['IDENTIFICACION'] ?></p>
            </td>
        </tr>
    </table>
<!-- -----------------------Tabla que muestra los productos que se compraron--------------------------->    
    <h5 class="title">Detalle de los Producto</h5>
    <table id="container-producto">
        <thead>
            <tr>
                <th>Cant</th>
                <th>Descripción</th>
                <th>Costo unitario</th>
                <th>SubTotal</th>
            </tr>
        </thead>
<!-- -----------------------Aqui se extraen los datos que se generaron en la compra (Subtotal, Impuesto, total)--------------------------->         
        <tbody>
            <?php
            $productos = json_decode($data['compra']['DESCRIPCION'], true);
            //ISV incluido
            $subTotal = $data['compra']['TOTAL'] / 1.15;
            $iSV = $data['compra']['TOTAL'] - $subTotal;
            $total = $data['compra']['TOTAL'];

//------------------Codigo no utilizado, pero para futuro se puede dejar ----------------------------

            //ISV NO Incluido
            // $subTotal = $data['compra']['TOTAL'];
            // $ISV = $subTotal * 0.18;
            // $TOTAL = $subTotal + $ISV;


//------------------Se recorre el array de los productos para poder ingresarlos a la tabla ----------------------------
            foreach ($productos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['EXISTENCIA']; ?></td>
                    <td><?php echo $producto['NOMBRE_PRODUCTO']; ?></td>
                    <td><?php echo number_format($producto['PRECIO'], 2); ?></td>
                    <td><?php echo number_format($producto['EXISTENCIA'] * $producto['PRECIO'], 2); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td class="text-right" colspan="3">SubTotal</td>
                <td class="text-right"><?php echo number_format($subTotal, 2); ?></td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">ISV 15%</td>
                <td class="text-right"><?php echo number_format($iSV, 2); ?></td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">Total</td>
                <td class="text-right"><?php echo number_format($total, 2); ?></td>
            </tr>
        </tbody>
    </table>
 
<!-- -----------------------Mensaje se mesutra una vez que se anula las compras--------------------------->     
    <div class="mensaje">
        <?php echo $data['empresa']['mensaje']; ?>
        <?php if ($data['compra']['status'] == 0) { ?>
            <h1>Compra Anulada</h1>      
        <?php } ?>
    </div>
</body>
<!-- -----------------------Formato de impresion para las compras--------------------------->
<!-- -----------------------Creado por Bayron Meraz--------------------------->
</html>
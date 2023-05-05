<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?> </title>
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/factura.css'; ?>">
</head>

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
            <td class="info-venta">
                <div class="container-factura">
                    <span class="factura">Factura</span>
                    <p>N°: <strong><?php echo $data['venta']['NUMERO_FACTURA']; ?></strong></p>
                    <p>Fecha: <?php echo $data['venta']['FECHA_CREACION']; ?></p>
                </div>
            </td>

        </tr>
    </table>
    <table>
        <tr>
            <td class="info-regimen">
                <p>Fecha inicio <?php echo $data['regimen']['FECHA_INICIO']; ?></p>
                <p>Fecha Limite: <?php echo $data['regimen']['FECHA_LIMITE']; ?></p>
                <p>Rango desde: <?php echo $data['regimen']['RANGO_DESDE']; ?></p>
                <p>Rango hasta: <?php echo $data['regimen']['RANGO_HASTA']; ?></p>
                <p>CAI: <?php echo $data['regimen']['CAI']; ?></p>
            </td>
        </tr>
    </table>

    <h5 class="title">Datos del Cliente</h5>
    <table id="container-info">
        <tr>
            <td>
                <strong>Nombre: </strong>
                <p><?php echo $data['venta']['NOMBRE'] ?></p>
            </td>
            <td>
                <strong>RTN: </strong>
                <p><?php echo $data['venta']['IDENTIFICACION'] ?></p>
            </td>
        </tr>
    </table>
    <h5 class="title">Detalle de los Producto</h5>
    <table id="container-producto">
        <thead>
            <tr>
                <th>Cant</th>
                <th>Descripción</th>
                <th>PrecioVenta</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $productos = json_decode($data['venta']['DESCRIPCION'], true);
            //ISV incluido
            $subTotal = $data['venta']['TOTAL'] / 1.15;
            $iSV = $data['venta']['TOTAL'] - $subTotal;
            $total = $data['venta']['TOTAL'];

            //ISV NO Incluido
            // $subTotal = $data['venta']['TOTAL'];
            // $ISV = $subTotal * 0.18;
            // $TOTAL = $subTotal + $ISV;

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
                <td class="text-right" colspan="3">Importe Exonerado</td>
                <td class="text-right">0.00</td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">Importe Exento</td>
                <td class="text-right">0.00</td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">Importe Agravado</td>
                <td class="text-right">0.00</td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">Total</td>
                <td class="text-right"><?php echo number_format($total, 2); ?></td>
            </tr>
        </tbody>
    </table>
    <div class="mensaje">
        <?php echo $data['empresa']['mensaje']; ?>
        <?php if ($data['venta']['status'] == 0) { ?>
            <h1>Venta Anulada</h1>
        <?php } ?>
    </div>

</body>

</html>
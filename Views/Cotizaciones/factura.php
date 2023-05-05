
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
    <!-- CREADO POR EDWIN JUANEZ -->
    <!-- AQUI TRAIGO LO QUE ES LOS DATOS DE LA EMPRESA Y TAMBIEN INFORMACION DE LA FACTURA -->
    <table id="datos-empresa">
        <tr>
            <td class="logo"><img src="<?php echo BASE_URL . '/assets/images/logo.png'; ?> " alt=""></td>
            <td class="info-empresa">
                <p><?php echo $data['empresa']['NOMBRE_EMPRESA']; ?></p>
                <p>RTN: <?php echo $data['empresa']['RTN']; ?></p>
                <p>Correo: <?php echo $data['empresa']['CORREO']; ?></p>
                <p>Direccion: <?php echo $data['empresa']['DIRECCION']; ?></p>
            </td>
            <td class="info-cotizacion">
                <div class="container-factura">
                    <span class="factura">Cotizacion</span>
                    <p>N°: <strong><?php echo $data['cotizacion']['NUMERO_COTIZACION']; ?></strong></p>
                    <p>Fecha: <?php echo $data['cotizacion']['FECHA_CREACION']; ?></p>
                </div>
            </td>

        </tr>
    </table>
   <!-- AQUI TRAIGO LO QUE SON LOS DATOS DEL CLIENTE -->
    <h5 class="title">Datos del Cliente</h5>
    <table id="container-info">
        <tr>
            <td>
                <strong>Nombre: </strong>
                <p><?php echo $data['cotizacion']['NOMBRE'] ?></p>
            </td>
            <td>
                <strong>RTN: </strong>
                <p><?php echo $data['cotizacion']['IDENTIFICACION'] ?></p>
            </td>
        </tr>
    </table>
    <h5 class="title">Detalle de los Producto</h5>
    <table id="container-producto">
        <thead>
            <tr>
                <th>Cant</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $productos = json_decode($data['cotizacion']['DESCRIPCION'], true);
            //ISV incluido
            $subTotal = $data['cotizacion']['TOTAL'] / 1.15;
            $iSV = $data['cotizacion']['TOTAL'] - $subTotal;
            $total = $data['cotizacion']['TOTAL'];

            //ISV NO Incluido
            // $subTotal = $data['cotizacion']['TOTAL'];
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
                <td class="text-right" colspan="3">Total</td>
                <td class="text-right"><?php echo number_format($total, 2); ?></td>
            </tr>
        </tbody>
    </table>
    <div class="mensaje">
        <?php echo $data['empresa']['mensaje']; ?>
        <?php if ($data['cotizacion']['status'] == 0) { ?>
            <h1>cotizacion Anulada</h1>
        <?php } ?>
    </div>

</body>

</html>
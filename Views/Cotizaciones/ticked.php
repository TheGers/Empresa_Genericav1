
<!DOCTYPE html>
<html lang="en"> cotizacion

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?> </title>
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/ticked.css'; ?>">
</head>

<!-- CREADO POR EDWIN JUANEZ -->
<!-- AQUI TRAIGO LO QUE ES LOS DATOS DE LA EMPRESA Y TAMBIEN INFORMACION DEL TCKED -->

<body>
    <img src="<?php echo BASE_URL . '/assets/images/logo.png'; ?> " alt="">
    <div class="datos-empresa">
        <p><?php echo $data['empresa']['NOMBRE_EMPRESA']; ?></p>
        <p><?php echo $data['empresa']['CORREO']; ?></p>
        <p><?php echo $data['empresa']['DIRECCION']; ?></p>
    </div>
    <h5 class="title">Datos del Cliente</h5>
    <div class="datos-info">
        <p><strong>Nombre :</strong> <?php echo $data['cotizacion']['NOMBRE']; ?></p>
        <p><strong>RTN : </strong> <?php echo $data['cotizacion']['IDENTIFICACION']; ?></p>
    </div>
    <h5 class="title">Datos del Producto</h5>
    <table>
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
            foreach ($productos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['EXISTENCIA']; ?></td>
                    <td><?php echo $producto['NOMBRE_PRODUCTO']; ?></td>
                    <td><?php echo number_format($producto['PRECIO'], 2); ?></td>
                    <td><?php echo number_format($producto['EXISTENCIA'] * $producto['PRECIO'], 2); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td class="text-right" colspan="3">Total</td>
                <td class="text-right"><?php echo number_format($data['cotizacion']['TOTAL'], 2); ?></td>
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
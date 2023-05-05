<?php headerAdmin($data); ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i><?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <a href="<?= base_url() ?>/usuarios" class="linkw">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>Usuarios</h4>
                        <p><b><?= $data['usuarios']['total'] ?></b></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="<?= base_url() ?>/productos" class="linkw">
                <div class="widget-small warning coloured-icon"><i class="icon fas fa-box fa-3x"></i>
                    <div class="info">
                        <h4>Productos</h4>
                        <p><b><?= $data['productos']['total'] ?></b></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="<?= base_url() ?>/compras" class="linkw">
                <div class="widget-small danger coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
                    <div class="info">
                        <h4>Compras</h4>
                        <p><b><?= $data['compras']['total'] ?></b></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="<?= base_url() ?>/ventas" class="linkw">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-dollar fa-3x"></i>
                    <div class="info">
                        <h4>Ventas</h4>
                        <p><b><?= $data['ventas']['total'] ?></b></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <div style="text-align: center;">
                    <h3 class="tile-title">Últimos Pedidos</h3>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>N#Factura</th>
                                <th>Total</th>
                                <th>Ver</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php 
                    if(count($data['ventasT']) > 0 ){
                      foreach ($data['ventasT'] as $venta) {
                 ?>
                                <td><?= $venta['COD_VENTA'] ?></td>
                                <td><?= $venta['NOMBRE'] ?></td>
                                <td><?= $venta['NUMERO_FACTURA'] ?></td>
                                <td class="text-right"><?= SMONEY." ".formatMoney($venta['TOTAL']) ?></td>
                                <td><a href="<?= base_url() ?>/ventas/<?= $venta['COD_VENTA'] ?>" target="_blank"><i
                                            class="fa fa-eye" aria-hidden="true"></i></a></td>

                            </tr>
                            <?php } 
                  } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <div class="container-title">
                    <h3 class="tile-title">Productos Vendidos</h3>
                </div>
                <div id="productosDiaMesAnio"></div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="container-title">
                    <h3 class="tile-title">Ventas Por Mes </h3>
                    <div class="dflex">
                        <input class="date-picker ventasMes" name="ventasMes" placeholder="Mes y Año">
                        <button type="button" class="btnVentasMes btn btn-info btn-sm" onclick="fntSearchVMes()"> <i
                                class="fas fa-search"></i> </button>
                    </div>
                </div>
        
                <div id="graficaMes"></div>
            </div>

        </div>
        <div class="col-md-12">
            <div class="tile">
                <div class="container-title">
                    <h3 class="tile-title">Ventas Por Año </h3>
                    <div class="dflex">
                        <input class="ventasAnio" name="ventasAnio" placeholder="Año" minlength="4" maxlength="4"
                            onkeypress="return controlTag(event);">
                        <button type="button" class="btnVentasAnio btn btn-info btn-sm" onclick="fntSearchVAnio()"> <i
                                class="fas fa-search"></i> </button>
                    </div>
                </div>
                <div id="graficaAnio"></div>
            </div>

        </div>
    </div>
</main>
<?php footerAdmin($data); ?>
<script>
// Data retrieved from https://netmarketshare.com
Highcharts.chart('productosDiaMesAnio', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<?= $data['productosT']['dia'].' '.$data['productosT']['mes'].' '.$data['productosT']['anio'] ?>',
        align: 'left'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Existencia',
        colorByPoint: true,
        data: [
            <?php 
      $data_string = "";
      foreach ($data['productosT']['Vendidos'] as $pagos) {
        $data_string .= "{name:'".$pagos['NOMBRE_PRODUCTO']."',y:".$pagos['existencias']."},";
      }
      echo rtrim($data_string, ','); // eliminamos la última coma sobrante
    ?>
        ]
    }]

});

Highcharts.chart('graficaMes', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Ventas de <?= $data['ventasMDia']['mes'].' del '.$data['ventasMDia']['anio'] ?>',
    },
    subtitle: {
        text: 'Total Ventas <?= SMONEY.'. '.formatMoney($data['ventasMDia']['total']) ?>',
    },
    xAxis: {
        categories: [<?php 
                foreach ($data['ventasMDia']['ventas'] as $dia) {
                  echo $dia['dia'].",";
                }
            ?>]
    },
    yAxis: {
        title: {
            text: ''
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: '',
        data: [
            <?php 
                foreach ($data['ventasMDia']['ventas'] as $dia) {
                  echo $dia['total'].",";
                }
            ?>
        ]
    }]
});

Highcharts.chart('graficaAnio', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Ventas del año <?= $data['ventasAnio']['anio'] ?> '
    },
    subtitle: {
        text: 'Estadistica de ventas por mes'
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
    },
    series: [{
        name: 'Population',
        data: [
            <?php 
              foreach ($data['ventasAnio']['meses'] as $mes) {
                echo "['".$mes['mes']."',".$mes['venta']."],";
              }
             ?>
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
</script>
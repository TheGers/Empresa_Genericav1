
<?php
// ---------------------------------- CREADO POR EDWIN JUANEZ ---------------------------------
headerAdmin($data);
getModal('modalConfiguracion', $data);
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fas fa-box-tissue"></i> <?= $data['page_title'] ?>
                <?php if ($_SESSION['permisosMod']['w']) { ?>
                    <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Nuevo</button>
                <?php } ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/configuracion"><?= $data['page_title'] ?></a></li>
        </ul>
    </div>

    <!-- ESTA ES NUESTRA TABLA DONDE SE REFLEJAN LOS DATOS DEL CAI Y LO QUE PIDE LA SAR PARA FACTURAR -->

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableConfiguracion">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Limite</th>
                                    <th>Rango Desde</th>
                                    <th>Rango hasta</th>
                                    <th>CAI</th>
                                    <th>Estado</th>v
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php footerAdmin($data); ?>
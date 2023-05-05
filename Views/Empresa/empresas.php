<?php
headerAdmin($data);
getModal('modalEmpresas', $data);
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fas fa-box-tissue"></i> <?= $data['page_title'] ?>
               
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/empresas"><?= $data['page_title'] ?></a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableEmpresa">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre de la Empresa</th>
                                    <th>Descripcion de la Empresa</th>
                                    <th>Correo Electronico</th>
                                    <th>Direccion</th>
                                    <th>Mensaje de la Empresa</th>
                                    <th>Rtn</th>v
                                    <th>Estado</th>
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
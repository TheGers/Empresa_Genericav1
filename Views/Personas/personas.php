<?php 
    headerAdmin($data); 
    getModal('modalPersonas',$data);
?>
<main class="app-content">
    <div class="app-title">
        <h1><i class="fas fa-users"></i> <?= $data['page_title'] ?>
            <?php if($_SESSION['permisosMod']['w']){ ?>
            <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i>
                Nuevo</button>
            <?php } ?>
        </h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/personas"><?= $data['page_title'] ?></a></li>
        </ul>
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableRegistros">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo Persona</th>
                                    <th>Nombre</th>
                                    <th>Genero</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Tipo Identificacion</th>
                                    <th>Identificacion</th>
                                    <th>Estado</th>
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
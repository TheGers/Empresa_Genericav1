<?php headerAdmin($data); ?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dollar"></i> <?= $data['page_title'] ?>
                <?php if ($_SESSION['permisosMod']['w']) { ?>

                <?php } ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/caja"><?= $data['page_title'] ?></a></li>
        </ul>   
    </div> 

    <div class="card">
    <div class="card-body">
    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
        <div class="d-flex align-items-center">
            <div class="font-35 text-white"><i class="bx bxs-check-circle"></i>
        </div>
        <div class="ms-3">
            <h6 class="mb-0 text-white">CAJA ABIERTA</h6>
            <div class="text-white">A simple success alert—check it out!</div>
            <button class="close" type="button" data-dismiss="alert">×</button>
        </div>
    </div>
</div>
        <div class="d-flex align-items-center">
            <div>
                <h5 class="card-title text-center"><i class="fas fa-box"></i> Historial Cajas</h5>
            </div>
            <div class="dropdown ms-auto">
                <!-- Insertar la seleccion de abrir y cerrar caja en esta linea -->
                <a class="dropdown-toggle dropdown-toggle" href="#" data-bs-toggle="dropdown">
                </a>
                <ul class="dropdown-menu">
                    <?php if (empty($data['caja'])) { ?>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalCaja"><i class="fas fa-box"></i> Abrir Caja</a>
                        </li>
                    <?php } else { ?>
                        <li><a class="dropdown-item" href="#" onclick="cerrarCaja()"><i class="fas fa-lock"></i> Cerrar Caja</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
     
        <hr>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Apertura y Cierre</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Nuevo Gasto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile2" role="tab" aria-controls="pills-profile2" aria-selected="false">Historial Gastos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile3" role="tab" aria-controls="pills-profile3" aria-selected="false">Movimientos</a>
        </li>
    </ul>
        <!-- desde aca -->
        <div class="card">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <table class="table table-bordered table-striped table-hover align-middle nowrap" id="tblAperturaCierre" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Monto Inicial</th>
                                    <th>Fecha Apertura</th>
                                    <th>Fecha Cierre</th>
                                    <th>Monto Final</th>
                                    <th>Total Ventas</th>
                                    <th>Usuario</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
              

                <!--Nuevos Gasto -->
                <div class="tab-pane fade show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                    <form id="formulario">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" id="id">
                                <label for="">Monto <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    <input class="form-control" id="monto" type="text" name="monto" placeholder="Monto">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="descripcion">Descripcion <span class="text-danger">*</span></label>
                                    <textarea id="descripcion" class="form-control" name="descripcion" rows="3" placeholder="Descripcion"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="foto">Foto (Opcional)</label>
                                    <input id="foto" class="form-control" type="file" name="foto">
                                </div>
                                <div id="containerPreview">
                                </div>
                            </div>
                        </div>
                        <div class="float-end">
                            <button class="btn btn-primary" type="submit" id="btnRegistrarGasto">Registrar</button>
                        </div>
                    </form>
                </div>

                <!-- Historial  -->
                <div class="tab-pane fade" id="pills-profile2" role="tabpanel" aria-labelledby="pills-profile2-tab">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered" id="tableVentas">
                                        <thead>
                                            <tr>
                                    <th>Monto</th>
                                    <th>Descrpcion</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    </div>

                </div>
                </div>

     </main> 
        

<?php footerAdmin($data); ?>
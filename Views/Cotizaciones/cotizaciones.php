<?php
headerAdmin($data); 
?>
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
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/cotizaciones"><?= $data['page_title'] ?></a></li>
        </ul>

    </div>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Nueva Cotizacion</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Historial</a>
        </li>
    </ul>
    <!-- ----------------------- FORMULARIO DE cotizaciones /------------------------- -->
    <div class="card">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active p-3" id="nav-cotizaciones" role="tabpanel" aria-labelledby="nav-cotizaciones-tab" tabindex="0">
                        <h5 class="card-title text-center"><i class="fas fa-cash-register"></i> Nueva cotizacion</h5>
                        <hr>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="buscarProducto" id="barcode" value="barcode" checked>
                            <label class="form-check-label" for="barcode"><i class="fas fa-barcode"></i> Codigo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="buscarProducto" id="nombre" value="nombre">
                            <label class="form-check-label" for="nombre"><i class="fas fa-list"></i> Nombre</label>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="formCotizaciones" name="formCotizaciones" class="form-horizontal">
                        <input type="hidden" id="idCotizacion" name="idCotizacion" value="">
                        <div class="tab-content" id="nav-tabContent">


                            <!-- input para buscar codigo -->
                            <div class="input-group mb-2" id="containerCodigo">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input class="form-control" type="text" id="buscarProductoCodigo" placeholder="Ingrese Codigo - Enter">
                            </div>

                            <!-- input para buscar nombre -->
                            <div class="input-group d-none mb-2" id="containerNombre">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input class="form-control" type="text" id="buscarProductoNombre" placeholder="Buscar Producto">
                            </div>

                            <!-- table productos -->

                            <div class=" table-responsive">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover align-middle" id="tblNuevaCotizacion" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Precio Unitario</th>
                                                <th>Cantidad</th>
                                                <th>SubTotal</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                    <hr>

                                    <div class="d-flex justify-content-between">
                                        <div class="col-md-4">

                                            <label>Cliente</label>
                                            <div class="input-group mb-2">
                                                <input type="hidden" id="idCliente">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                                <input class="form-control" type="text" id="buscarCliente" placeholder="Buscar Cliente">
                                            </div>
                                            <span class="text-danger fw-bold mb-2" id="errorCliente"></span>
                                            <label>Telefono</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text"><i class="fas fa-phone fas fa-search"></i></span>
                                                <input class="form-control" type="text" id="telefonoCliente" placeholder="Telefono" disabled>
                                            </div>

                                            <label>Dirección</label>
                                            <ul class="list-group">
                                                <li class="list-group-item" id="clienteDireccion"><i class="fas fa-home"></i></span></li>

                                            </ul>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Vendedor</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                <input class="form-control" type="text" value="<?php echo $_SESSION['userData']['nombres']; ?>" disabled>
                                            </div>


                                            <label>Total a Pagar</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                <input class="form-control" type="text" id="totalPagar" placeholder="Total Pagar" disabled>
                                            </div>

                                            <label># Numero de Cotizacion</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                                <input class="form-control" type="text" id="serie" placeholder="Serie">
                                            </div>

                                            <button class="btn btn-primary btn-block" type="button" id="btnAccion">Completar</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="nav-historial" role="tabpanel" aria-labelledby="nav-historial-tab" tabindex="0">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered" id="tableCotizaciones">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Fecha de la Cotizacion</th>
                                                <th>Cliente</th>
                                                <th>Numero Cotizacion</th>
                                                <th>Total</th>
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
            </div>
        </div>

    </div>
    </div>
</main>

<?php footerAdmin($data); ?>
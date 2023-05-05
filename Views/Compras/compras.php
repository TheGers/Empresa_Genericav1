<!-- -----------------------Vista de las compras o entradas de productos en el sistema--------------------------->
<!-- -----------------------Creado por Bayron Meraz--------------------------->
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
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/ventas"><?= $data['page_title'] ?></a></li>
        </ul>

    </div>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Nueva Compra</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Historial</a>
        </li>

    </ul>
    <!-- ----------------------- FORMULARIO DE COMPRAS ------------------------- -->
    <div class="card">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active p-3" id="nav-compras" role="tabpanel" aria-labelledby="nav-compras-tab" tabindex="0">
                        <h5 class="card-title text-center"><i class="fas fa-truck"></i> Nueva Compra</h5>
                        <hr>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="buscarProducto" id="barcode" value="barcode" checked>
                            <label class="form-check-label" for="barcode"><i class="fas fa-barcode"></i> Código</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="buscarProducto" id="nombre" value="nombre">
                            <label class="form-check-label" for="nombre"><i class="fas fa-list"></i> Nombre</label>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="formCompras" name="formCompras" class="form-horizontal">
                        <input type="hidden" id="idCompra" name="idCompra" value="">
                        <div class="tab-content" id="nav-tabContent">


                            <!-- input para buscar codigo los productos -->
                            <div class="input-group mb-2" id="containerCodigo">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input class="form-control" type="text" id="buscarProductoCodigo" placeholder="Ingrese el código de barra - Enter">
                            </div>

                            <!-- input para buscar nombre los productos -->
                            <div class="input-group d-none mb-2" id="containerNombre">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input class="form-control" type="text" id="buscarProductoNombre" placeholder="Buscar Producto">
                            </div>

                            <!-- table productos que se agregaran al carrito -->

                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover align-middle" id="tblNuevaCompra" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Código de barra</th>
                                                <th>Producto</th>
                                                <th>Costo unitario</th>
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
                                            <!-- input para buscar nombre proveedor -->
                                            <label>Proveedor</label>
                                            <div class="input-group mb-2">
                                                <input type="hidden" id="idProveedor">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                                <input class="form-control" type="text" id="buscarProveedor" placeholder="Buscar Proveedor">
                                            </div>
                                            <span class="text-danger fw-bold mb-2" id="errorProveedor"></span>
                                            <!-- input para buscar telefono proveedor -->
                                            <label>Telefono</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                <input class="form-control" type="text" id="telefonoProveedor" placeholder="Telefono" disabled>
                                            </div>
                                            <!-- input para buscar direccion proveedor -->
                                            <label>Dirección</label>
                                            <ul class="list-group">
                                                <li class="list-group-item" id="proveedorDireccion"><i class="fas fa-home"></i></span></li>

                                            </ul>
                                        </div>
                                        <!-- input para llenar con datos de usuario que realice la compra -->
                                        <div class="col-md-4">
                                            <label>Usuario</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                <input class="form-control" type="text" value="<?php echo $_SESSION['userData']['nombres']; ?>" disabled>
                                            </div>
                                            <!-- input que genera el impuesto de los productos que se van agregando al carrito de compra -->
                                            <label>Impuesto (15%)</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text"><i class="fas fa-calculator"></i></span>
                                                <input class="form-control" type="text" id="ISV" placeholder="Impuesto" disabled>
                                            </div>
                                            <!-- input que genera el Total a pagar de los productos que se van agregando al carrito de compra -->
                                            <label>Total a Pagar</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                <input class="form-control" type="text" id="totalPagar" placeholder="Total Pagar" disabled>
                                            </div>
                                            <!-- input para llenar los datos de el numero de factura que entrega el proveedor -->
                                            <label># Factura de la Compra</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                                <input class="form-control" type="text" id="serie" placeholder="Serie de Compras">
                                            </div>
                                            <!-- input para llenar los datos de el numero CAI de la facturacion que entrega el proveedor -->
                                            <label>CAI</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                                                <input class="form-control" type="text" id="cai" placeholder="CAI">
                                            </div>
                                            <!-- Boton que completa la compra una vez que comple con los requisitos -->
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
            <!-- Tabla que muestra los registrsos de las compras que se han ingresado en el sistema -->
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="tableCompras">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Fecha de la Compra</th>
                                                <th>Proveedor</th>
                                                <th>CAI</th>
                                                <th>Numero Factura</th>
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

<!-- -----------------------Vista de las compras o entradas de productos en el sistema--------------------------->
<!-- -----------------------Creado por Bayron Meraz--------------------------->


    </div>
</main>

<?php footerAdmin($data); ?>
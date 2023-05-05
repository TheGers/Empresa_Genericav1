<div class="modal fade" id="modalFormPersonas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="true">Registro</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">Direccion</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button"
                        role="tab" aria-controls="contact" aria-selected="false">Telefono</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- vista de Persona -->
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="modal-body">

                        <form id="formPersonas" name="formPersonas" class="form-horizontal">
                            <input type="hidden" id="idPersona" name="idPersona" value="">
                            <p class="text-primary">Todos los campos son obligatorios.</p>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="txtNombre">Nombres</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control valid validText" id="txtNombre"
                                            name="txtNombre" required="">
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="listgenero">Genero:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                        </div>
                                        <select class="form-control selectpicker" id="listgenero" name="listgenero"
                                            required>
                                            <option value="1">FEMENINO</option>
                                            <option value="2">MASCULINO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="datefecha">Fecha Nacimiento: <span class="required">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="datefecha" name="datefecha"
                                            required="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="listTipoIdentificacion">Tipo Identificacion <span
                                            class="required">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <select class="form-control" data-live-search="true" id="listTipoIdentificacion"
                                            name="listTipoIdentificacion">

                                            <?php
                                             include("Config/Config.php");
                                               $sql =$conexion->query("SELECT * FROM tbl_tipo_identificacion");
                                                    while($resultado = $sql->fetch_assoc()){
                                                      echo "<option value='".$resultado['id']."'>".$resultado['TIPO_IDENTIFICACION']."</option>";

                                                                 }
                                             ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="txtIdentificacion">Identificación</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="txtIdentificacion"
                                            name="txtIdentificacion" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="listTipoPersona">Tipo Persona <span class="required">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                                        </div>
                                        <select class="form-control" data-live-search="true" id="listTipoPersona"
                                            name="listTipoPersona">

                                            <?php
                                              include("Config/Config.php");
                                                  $sql =$conexion->query("SELECT * FROM tbl_tipo_persona");
                                                   while($resultado = $sql->fetch_assoc()){
                                                   echo "<option value='".$resultado['idTipo']."'>".$resultado['TIPO_PERSONA']."</option>";

                                                           }
                                                     ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="listStatus">Estado</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-check"></i></span>
                                        </div>
                                        <select class="form-control selectpicker" id="listStatus" name="listStatus"
                                            required>
                                            <option value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <button id="btnActionForm" class="btn btn-primary" type="submit"><i
                                        class="fa fa-fw fa-lg fa-check-circle"></i><span
                                        id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                                <button class="btn btn-danger" type="button" data-dismiss="modal"><i
                                        class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- vista de Direccion -->
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="modal-body">

                        <form id="formDireccion" name="formDireccion" class="form-horizontal">
                            <input type="hidden" id="idPersona" name="idPersona" value="">
                            <p class="text-primary">Todos los campos son obligatorios.</p>
                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="listTipoDireccion">Tipo Direccion <span
                                            class="required">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                                        </div>
                                        <select class="form-control" data-live-search="true" id="listTipoDireccion"
                                            name="listTipoDireccion">
                                            <?php
                                               include("Config/Config.php");
                                                  $sql =$conexion->query("SELECT * FROM tbl_tipo_direccion");
                                                       while($resultado = $sql->fetch_assoc()){
                                                         echo "<option value='".$resultado['id']."'>".$resultado['TIPO_DIRECCION']."</option>";

                                                           }
                                                         ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="txtCiudad">Ciudad</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="txtCiudad" name="txtCiudad"
                                            required="">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="txtCalle">Calle</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-walking"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="txtCalle" name="txtCalle"
                                            required="">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="txtCasa">Casa</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="txtCasa" name="txtCasa" required="">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="txtColonia">Colonia</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="txtColonia" name="txtColonia"
                                            required="">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="txtAvenida">Avenida</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fas fa-road"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="txtAvenida" name="txtAvenida"
                                            required="">
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="control-label">Direccion1 </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <textarea class="form-control" id="txtDireccion1"
                                            name="txtDireccion1"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Direccion2 </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <textarea class="form-control" id="txtDireccion2"
                                            name="txtDireccion2"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="listStatus">Estado</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-check"></i></span>
                                        </div>
                                        <select class="form-control selectpicker" id="listStatus" name="listStatus"
                                            required>
                                            <option value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                        </select>
                                    </div>
                                </div>

                            </div>




                            <div class="col-md-12">


                            </div>
                            <div class="tile-footer">
                                <button id="btnActionForm" class="btn btn-success" type="submit"><i
                                        class="fa fa-fw fa-lg fa-plus"></i><span
                                        id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;


                                <button class="btn btn-danger" type="button" data-dismiss="modal"><i
                                        class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                            </div>
                        </form>
                        <br>
                        <table class="table" id="tablaModal">
                            <thead id="content_table">
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo Direccion</th>
                                    <th>Ciudad</th>
                                    <th>Calle</th>
                                    <th>Casa</th>
                                    <th>Colonia</th>
                                    <th>Avenida</th>
                                    <th>Direccion1</th>
                                    <th>Direccion2</th>
                                    <th>Estado</th>
                                    <th>Eliminar</th>
                              
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>



                </div>
                <!-- vista de Telefono -->

                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="modal-body">

                        <form id="formTelefono" name="formTelefono" class="form-horizontal">
                            <input type="hidden" id="idPersona" name="idPersona" value="">
                            <p class="text-primary">Todos los campos son obligatorios.</p>
                            <div class="form-row">


                                <div class="form-group col-md-3">
                                    <label for="listTipoTelefono">Tipo Telefono <span class="required">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-fax"></i></span>

                                        </div>
                                        <select class="form-control" data-live-search="true" id="listTipoTelefono"
                                            name="listTipoTelefono">

                                            <?php
                                         include("Config/Config.php");
                                          $sql =$conexion->query("SELECT * FROM tbl_tipo_telefono");
                                                while($resultado = $sql->fetch_assoc()){
                                                  echo "<option value='".$resultado['id']."'>".$resultado['TIPO_TELEFONO']."</option>";

                                                         }
                                          ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="txtTelefono">Teléfono</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-phone-alt"></i></span>

                                        </div>
                                        <input type="text" class="form-control valid validNumber" id="txtTelefono"
                                            name="txtTelefono" required="" onkeypress="return controlTag(event);">
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                <label for="txtCodigo">Codigo Area</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-pin"></i></span>

                                        </div>
                                        <input type="text" class="form-control valid validNumber" id="txtCodigo"
                                            name="txtCodigo" required="" onkeypress="return controlTag(event);">
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="listStatus">Estado</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-check"></i></span>
                                        </div>
                                        <select class="form-control selectpicker" id="listStatus" name="listStatus"
                                            required>
                                            <option value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <button id="btnActionForm" class="btn btn-success" type="submit"><i
                                        class="fa fa-fw fa-lg fa-plus"></i><span
                                        id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;


                                <button class="btn btn-danger" type="button" data-dismiss="modal"><i
                                        class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                            </div>

                        </form>
                        <br>
                        <table class="table" id="tablaModalTelefono">
                            <thead id="content_table">
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo Telefono</th>
                                    <th>Telefono</th>
                                    <th>Codigo Area</th>
                                    <th>Estado</th>
                                    <th>Eliminar</th>
                       
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


<!-- Modal para la funcion de ver -->
<div class="modal fade" id="modalViewPersona" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-primary">Datos de la persona</p>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label><i class="fas fa-id-card"></i> Tipo Persona:</label>
                        <span id="celTipoP" class="text-primary"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <label><i class="fas fa-user"></i> Nombres:</label>
                        <span id="celNombre" class="text-primary"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <label><i class="fas fa-venus-mars"></i> Género:</label>
                        <span id="celGenero" class="text-primary"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <label><i class="far fa-calendar-alt"></i> Fecha Nacimiento:</label>
                        <span id="celFecha" class="text-primary"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <label><i class="fas fa-id-card"></i> Tipo Identificación:</label>
                        <span id="celTipoI" class="text-primary"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <label><i class="far fa-id-card"></i> Identificación:</label>
                        <span id="celIdent" class="text-primary"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <label><i class="fas fa-check"></i> Estado:</label>
                        <span id="celStatus" class="text-primary"></span>
                    </div>
                </div>
                <table class="table table-bordered" id="tableDireccion">
                    <tbody>
                        <tr class="bg-primary text-white" style="text-align:center;">
                            <td colspan="11">Datos de Dirección</td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Tipo Direccion</th>
                            <th>Ciudad</th>
                            <th>Calle</th>
                            <th>Casa</th>
                            <th>Colonia</th>
                            <th>Avenida</th>
                            <th>Direccion1</th>
                            <th>Direccion2</th>
                            <th>Estado</th>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered" id="tableTelefono">
                    <tbody>
                        <tr class="bg-primary text-white" style="text-align:center;">
                            <td colspan="6">Datos de Telefono</td>
                        </tr>
                        <tr>
                            <td>N-Registro:</td>
                            <td>Nombre:</td>
                            <td>Tipo Telefono:</td>
                            <td>Teléfono:</td>
                            <td>Codigo:</td>
                            <td>Estado:</td>

                        </tr>


                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
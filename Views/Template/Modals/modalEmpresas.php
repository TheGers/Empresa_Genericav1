<!-- Modal -->
<div class="modal fade" id="modalFormEmpresa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Informacion de la Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formConfiguracion" name="formEmpresa" class="form-horizontal">
                    <input type="hidden" id="idEmpresa" name="idEmpresa" value="">
                    <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.
                    </p>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nombre de la Empresa <span class="required">*</span></label>
                                <input class="form-control" id="txtNombreEmpresa" name="txtNombreEmpresa" type="text" placeholder="Nombre de la Empresa" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Descripcion de la Empresa <span class="required">*</span></label>
                                <input class="form-control" id="txtDescripcion" name="txtDescripcion" type="text" placeholder="Descripcion" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Correo electronico <span class="required">*</span></label>
                                <input class="form-control" id="txtCorreo" name="txtCorreo" type="text" placeholder="Correo Electronico" required="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Direccion <span class="required">*</span></label>
                                <input class="form-control" id="txtDireccion" name="txtDireccion" type="text" placeholder="Direccion" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Mnesaje de la Empresa<span class="required">*</span></label>
                                <input class="form-control" id="txtMensaje" name="txtMensaje" type="text" placeholder="mensaje" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">RTN de la Empresa<span class="required">*</span></label>
                                <input class="form-control" id="txtRtn" name="txtRtn" type="text" placeholder="RTN" required="">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelect1">Estado <span class="required">*</span></label>
                                <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="tile-footer">
                        <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewConfiguracion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del CAI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>COD_REGIMEN:</td>
                            <td id="celCOD_REGIMEN"></td>
                        </tr>
                        <tr>
                            <td>Fecha Inicio:</td>
                            <td id="celFechainicio"></td>
                        </tr>
                        <tr>
                            <td>Fecha Limite:</td>
                            <td id="celFechaLimite"></td>
                        </tr>
                        <tr>
                            <td>Rango Desde:</td>
                            <td id="celRangodesde"></td>
                        </tr>
                        <tr>
                            <td>Rango hasta:</td>
                            <td id="celRangohasta"></td>
                        </tr>
                        <tr>
                            <td>CAI:</td>
                            <td id="celCai"></td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celEstado"></td>
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
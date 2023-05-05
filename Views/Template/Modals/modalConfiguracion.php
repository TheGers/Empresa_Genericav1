<!-- Modal -->
<div class="modal fade" id="modalFormConfiguracion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">CAI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formConfiguracion" name="formConfiguracion" class="form-horizontal">
                    <input type="hidden" id="idConfiguracion" name="idConfiguracion" value="">
                    <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.
                    </p>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Fecha inicio <span class="required">*</span></label>
                                <input class="form-control" id="txtFechainicio" name="txtFechainicio" type="text" placeholder="Inicio de Fecha" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Fecha Limite <span class="required">*</span></label>
                                <input class="form-control" id="txtFechaLimite" name="txtFechaLimite" type="text" placeholder="Limite de fecha" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">CAI <span class="required">*</span></label>
                                <input class="form-control" id="txtCai" name="txtCai" type="text" placeholder="CAI" required="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Rango Desde <span class="required">*</span></label>
                                <input class="form-control" id="txtRangodesde" name="txtRangodesde" type="text" placeholder="Rango Desde" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Rango hasta <span class="required">*</span></label>
                                <input class="form-control" id="txtRangohasta" name="txtRangohasta" type="text" placeholder="Rango hasta" required="">
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
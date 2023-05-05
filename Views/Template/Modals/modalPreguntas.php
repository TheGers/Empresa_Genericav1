<!-- Modal -->
<div class="modal fade" id="modalFormPregunta" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Actulizar Pregunta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formPregunta" name="formPregunta">
                <input type="hidden" id="idPregunta" name="idPregunta" value="">
                <div class="form-group">
                <label for="listUsuario">Usuario: </label>
                <select class="form-control" data-live-search="true" id="listUsuario" name="listUsuario"> <?php
                include("Config/Config.php"); 
                $sql =$conexion->query("SELECT * FROM tbl_ms_usuarios");
                while($resultado = $sql->fetch_assoc()){
                  echo "<option value='".$resultado['idpersona']."'>".$resultado['username']."</option>";
                  }?> </select>
                  </div>
                <div class="form-group">
                  <label class="control-label">Pregunta de Seguridad</label>
                  <input class="form-control" id="txtPregunta" name="txtPregunta" type="text" placeholder="Pregunta de Seguridad" required="">
                </div>
                <label class="control-label">Respuesta</label>
                  <input class="form-control" id="txtRespuesta" name="txtRespuesta" type="text" placeholder="Respuesta" required="">
                </div>
   
                <div class="form-group">
                    <label for="exampleSelect1">Estado</label>
                    <select class="form-control" id="listStatus" name="listStatus" required="">
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                    </select>
                </div>
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Actualizar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>


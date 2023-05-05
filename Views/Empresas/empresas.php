<?php 
    headerAdmin($data); 
    
?>

<?php
headerAdmin($data);

?>
<main class="app-content">
    <div class="app-title">
    <div class="card-body">
        <h5 class="card-title text-center">Datos de de Empresa</h5>
        <hr>
        <form class="p-4" id="formularioEmpresa" name="formularioEmpresa" autocomplete="off">
            <input type="hidden" id="id" name="id" value=<? echo $data['empresa'] ['id'];?>>
            <div class="row">
                <div class="col-lg-4 col-sm-6 mb-2">
                    <label>RTN <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" id="rtn" name="rtn" class="form-control"  placeholder="RTN" value="<?php echo $data['empresa'] ['RTN'];?>">
                    </div>
                    <span id="errorRuc" class="text-danger"></span>
                </div>
                <div class="col-lg-4 col-sm-6 mb-2">
                    <label>Nombre de la Empresa <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                        <input type="text" id="nombre" name="nombre" class="form-control"  placeholder="NOMBRE EMPRESA" value="<?php echo $data['empresa'] ['NOMBRE_EMPRESA'];?>">
                    </div>
                    <span id="errorNombre" class="text-danger"></span>
                </div>
                <div class="col-lg-4 col-sm-6 mb-2">
                    <label>Teléfono <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="number" id="telefono" name="telefono" class="form-control"   placeholder="Teléfono" value="<?php echo $data['empresa'] ['telefono'];?>">
                    </div>
                    <span id="errorTelefono" class="text-danger"></span>
                </div>
                <div class="col-lg-4 col-sm-6 mb-2">
                    <label>Correo <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="correo" name="correo" class="form-control"  placeholder="Correo Electrónico" value="<?php echo $data['empresa'] ['CORREO'];?>">
                    </div>
                    <span id="errorCorreo" class="text-danger"></span>
                </div>
                <div class="col-lg-8 col-sm-6 mb-2">
                    <label>Dirección <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                        <input type="text" id="direccion" name="direccion" class="form-control"  placeholder="Dirección" value="<?php echo $data['empresa'] ['DIRECCION'];?>">
                    </div>
                    <span id="errorDireccion" class="text-danger"></span>
                </div>
                <div class="col-lg-9 col-sm-6 mb-2">
                    <label>DESCRIPCION (Opcional)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                        <input type="text" id="descripcion" name="descripcion" class="form-control"  placeholder="Descripcion" value="<?php echo $data['empresa'] ['DESCRIPCION'];?>">
                    </div>
                </div>
                <div class="col-lg-9 col-sm-6 mb-2">
                    <div class="form-group">
                        <label for="mensaje">Mensaje (Opcional)</label>
                        <input id="mensaje" class="form-control" name="mensaje" value="<?php echo $data['empresa'] ['mensaje'];?>" rows="3" placeholder="Vision de la Empresa"></input>
                    </div>
                </div>
                
            </div>
            <div class="text-end">
                <button class="btn btn-primary" type="submit" id="btnAccion">Actualizar</button>
            </div>
        </form>
    </div>
</main>
<?php footerAdmin($data); ?>






<?php footerAdmin($data); ?>
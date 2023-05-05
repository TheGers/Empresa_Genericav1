<?php 
    headerAdmin($data); 
  
?>
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-box"></i> <?= $data['page_title'] ?>
            
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/historial"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tablehistorial">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Accion</th>
                          <th>Usuario Afectado</th>
                          <th>Antigua Contraseña (Encriptada)</th>
                          <th>Creado por el Usuario(Original)</th>
                          <th>Fecha de Registro</th>
                          <th>Cambio de contraseña realizado por el Usuario</th>
                          <th>Fecha de Cambio de Contraseña</th>
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
    
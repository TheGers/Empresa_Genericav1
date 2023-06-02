<?php 
    headerAdmin($data); 
 
?>
    <div id="contentAjax"></div> 
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>
              <?php if($_SESSION['permisosMod']['w']){ ?>
              <?php } ?> 
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/bitacoras"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>

        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableBitacoras">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>ACCION</th>
                          <th>Vista</th>
                          <th>Campo</th>
                          <th>Dato anterior</th>
                          <th>Nuevo Dato</th>
                          <th>FECHA CREACION</th>
                          <th>USUARIO</th>
                          <th>Editado por</th>
                          <th>FECHA DE MODIFICACION</th>
                          <th>ESTADO</th>
                        
                          
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
    
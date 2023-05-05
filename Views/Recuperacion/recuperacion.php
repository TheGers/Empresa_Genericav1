<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Gers">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="<?= media();?>/images/favicon.ico">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media();?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media();?>/css/style.css">

    <title><?= $data['page_tag']; ?></title>
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1><?= $data['page_title']; ?></h1>
        </div>
        <div class="login-box">
            <div id="divLoading">
                <div>
                    <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
                </div>
            </div>
            <form class="login-form" name="formPregunta" id="formPregunta" action="">
                <h3 class="login-head"><i class="fa fa-question-circle"></i>Recuperacion por Pregunta</h3>
                <div class="form-group col-md-16">
                    <label for="txtUsername">Respuesta</label>
                   
                        <input type="text" class="form-control valid validText" id="txtUsername" name="txtUsername"
                            required="">
                 
                </div>
                <div class="form-group">
                    <div class="form-group col-md-16">
                        <label for="listPregunta">Pregunta</label>
                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-question-circle"></i></span>
                            </div>
                            <select class="form-control" data-live-search="true" id="listPregunta" name="listPregunta">

                                <?php
                 include("Config/Config.php");
                 $sql =$conexion->query("SELECT * FROM tbl_ms_preguntas_por_usuario");
                 while($resultado = $sql->fetch_assoc()){
                    echo "<option value='".$resultado['COD_PRREGUNTA']."'>".$resultado['PREGUNTA']."</option>";

                 }
              ?>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="form-group col-md-16">
                    <label for="txtRespuesta">Respuesta</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-reply"></i></span>
                        </div>
                        <input type="text" class="form-control valid validText" id="txtRespuesta" name="txtRespuesta"
                            required="">
                    </div>
                </div>
                <div id="alertLogin" class="text-center"></div>
                <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Validar
                        Respuesta</button>
                </div>
            </form>



        </div>
    </section>
    <script>
    const base_url = "<?= base_url(); ?>";
    </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/popper.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/fontawesome.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/sweetalert.min.js"></script>
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
</body>

</html>
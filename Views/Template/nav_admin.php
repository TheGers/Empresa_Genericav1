<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">

    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>/images/avatar.png" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">
                <?= $_SESSION['userData']['nombres']; ?>
            </p>
            <p class="app-sidebar__user-designation">
                <?= $_SESSION['userData']['nombrerol']; ?>
            </p>
        </div>
    </div>
    <ul class="app-menu">

    <!-- -------------------------------------------- DASHBOARD --------------------------------------------- -->

        <?php if (!empty($_SESSION['permisos'][1]['r'])) { ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
                    <i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Inicio</span>
                </a>
            </li>
        <?php } ?>

        <!-- -------------------------------------------- PERMISOS --------------------------------------------- -->

        <?php if (!empty($_SESSION['permisos'][2]['r']) || !empty($_SESSION['permisos'][13]['r'])) { ?>
            <li class="treeview">
                <a class="app-menu__item " href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                    <span class="app-menu__label">Usuarios</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon fa fa-circle-o"></i>
                                Usuarios</a></li>
                    <?php } ?>
                    <?php if (!empty($_SESSION['permisos'][13]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon fa fa-circle-o"></i>
                                Roles</a></li>
                    <?php } ?>

                </ul>
            </li>
        <?php } ?>

        <?php if (!empty($_SESSION['permisos'][3]['r'])) { ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/personas">
                    <i class="app-menu__icon fa fa-user" aria-hidden="true"></i>
                    <span class="app-menu__label">Personas</span>
                </a>
            </li>
        <?php } ?>

        <?php if (!empty($_SESSION['permisos'][4]['r']) || !empty($_SESSION['permisos'][11]['r'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-archive" aria-hidden="true"></i>
                    <span class="app-menu__label">Tienda</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>

                <ul class="treeview-menu">

                    <!-- -------------------------------------------- PRODUCTOS --------------------------------------------- -->

                    <?php if (!empty($_SESSION['permisos'][4]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/productos"><i class="icon fa fa-circle-o"></i>
                                Productos</a></li>
                    <?php } ?>

                    <!-- -------------------------------------------- CATEGORIAS --------------------------------------------- -->

                    <?php if (!empty($_SESSION['permisos'][11]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/categorias"><i class="icon fa fa-circle-o"></i>
                                Categorías</a></li>
                    <?php } ?>

                </ul>
            </li>
        <?php } ?>

        <!--     <?php if (!empty($_SESSION['permisos'][18]['r']) || !empty($_SESSION['permisos'][19]['r'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-box" aria-hidden="true"></i>
                    <span class="app-menu__label">Cajas</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (!empty($_SESSION['permisos'][18]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/caja"><i class="icon fa fa-circle-o"></i> Caja</a>
                        </li>
                    <?php } ?>

                    <?php if (!empty($_SESSION['permisos'][11]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/arqueo"><i class="icon fa fa-circle-o"></i> Arqueo
                                Caja</a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?> -->

        <!-- -------------------------------------------- COMPRAS --------------------------------------------- -->

        <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
            <li>
            <li><a class="app-menu__item" href="<?= base_url(); ?>/compras">
                    <i class="app-menu__icon fa fa-shopping-cart"></i>
                    <span class="app-menu__label">Compras</span></a></li>
        <?php } ?>

        <!-- -------------------------------------------- VENTAS --------------------------------------------- -->

        <?php if (!empty($_SESSION['permisos'][6]['r'])) { ?>
            <li><a class="app-menu__item" href="<?= base_url(); ?>/ventas">
                    <i class="app-menu__icon fa fa-dollar"></i>
                    <span class="app-menu__label">Ventas</span></a></li>
        <?php } ?>

        <!-- -------------------------------------------- COTIZACIONES --------------------------------------------- -->

        <?php if (!empty($_SESSION['permisos'][21]['r'])) { ?>
            <li><a class="app-menu__item" href="<?= base_url(); ?>/cotizaciones">
                    <i class="app-menu__icon fas fa-clipboard-list"></i>
                    <span class="app-menu__label">Cotizaciones</span></a></li>

        <?php } ?>

        <!-- -------------------------------------------- INVENTARIOS --------------------------------------------- -->

        <?php if (!empty($_SESSION['permisos'][22]['r'])) { ?>
            <li><a class="app-menu__item" href="<?= base_url(); ?>/inventarios">
                    <i class="app-menu__icon fa fa-building"></i>
                    <span class="app-menu__label">Inventarios</span></a></li>
        <?php } ?>

        <?php if (
            !empty($_SESSION['permisos'][14]['r']) || !empty($_SESSION['permisos'][15]['r']) ||
            !empty($_SESSION['permisos'][16]['r']) || !empty($_SESSION['permisos'][17]['r']) ||
            !empty($_SESSION['permisos'][23]['r']) || !empty($_SESSION['permisos'][20]['r'])
        ) { ?>
            <li class="treeview">
                <a class="app-menu__item " href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                    <span class="app-menu__label">Parametros</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (!empty($_SESSION['permisos'][14]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/bitacoras"><i class="icon fa fa-circle-o"></i>
                                Bitacoras</a></li>
                    <?php } ?>

                    <?php if (!empty($_SESSION['permisos'][15]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/accesos"><i class="icon fa fa-circle-o"></i> Datos
                                de Acceso</a></li>
                    <?php } ?>

                    <?php if (!empty($_SESSION['permisos'][16]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/preguntas"><i class="icon fa fa-circle-o"></i>
                                Preguntas de Seguridad</a></li>
                    <?php } ?>

                    <?php if (!empty($_SESSION['permisos'][17]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/historial"><i class="icon fa fa-circle-o"></i>
                                Historial de contraseñas</a></li>
                    <?php } ?>

                    <?php if (!empty($_SESSION['permisos'][23]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/empresas"><i class="icon fa fa-circle-o"></i>
                                Empresa</a></li>
                    <?php } ?>

                    <!-- --------------------------------------------CONFIGURACION CAI --------------------------------------------- -->

                    <?php if (!empty($_SESSION['permisos'][20]['r'])) { ?>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/configuracion"><i class="icon fa fa-circle-o"></i>
                                Configuracion</a></li>
                    <?php } ?>

                </ul>
            </li>
        <?php } ?>

        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                <span class="app-menu__label">Cerrar Sesion</span>
            </a>
        </li>
    </ul>
</aside>
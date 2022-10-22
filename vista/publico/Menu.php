<!-- Menu Lateral -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link">
        <img src="<?php echo constant('URL') ?>config/img/web/navigation.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Prados de Occidente</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-compact nav-collapse-hide-child"
                data-widget="treeview" role="menu" data-accordion="false">
                <!-- ===============================================================================================  -->
                <li class="nav-item" onclick="cambio_modulo('Inicio')">
                    <a href="<?php Direcciones::_001_();?>" class="nav-link">
                        <i class="fas fa-bank nav-icon"></i>
                        <p>Inicio</p>
                    </a>
                </li>

                <!-- ===============================================================================================  -->

                <?php if ($_SESSION['Agenda']['consultar'] != '0' || $_SESSION['Agenda']['registrar'] != '0') {?>
                <li class="nav-header">Agenda</li>

                <li class="nav-item">
                    <?php if ($_SESSION['Agenda']['registrar'] == '1') {?>
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-calendar"></i>
                        <p>
                            Gestionar Agenda
                        </p>
                    </a>
                    <?php }?>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" onclick="cambio_modulo('Crear evento')">
                            <a href="<?php Direcciones::_006_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Crear Evento</p>
                            </a>
                        </li>
                        <?php if ($_SESSION['Agenda']['consultar'] == '1') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consultar eventos')">
                            <a href="<?php Direcciones::_007_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Evento</p>
                            </a>
                        </li>
                        <?php }?>

                    </ul>
                </li>
                <?php }?>

                <!-- ===============================================================================================  -->
                <?php if ($_SESSION['Personas']['consultar'] != '0' || $_SESSION['Personas']['registrar'] != '0') {?>
                <li class="nav-header">Habitantes</li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Gestionar Personas
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['Personas']['registrar'] == '1') {?>
                        <li class="nav-item" onclick="cambio_modulo('Registrar personas')">
                            <a href="<?php Direcciones::_008_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Registrar Personas</p>
                            </a>
                        </li>
                        <?php }?>

                        <?php if ($_SESSION['Agenda']['consultar'] == '1') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consultar personas')">
                            <a href="<?php Direcciones::_009_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Personas</p>
                            </a>
                        </li>
                        <?php }?>

                    </ul>
                </li>
                <?php }?>

                <!-- ===============================================================================================  -->
                <?php if ($_SESSION['Nucleo familiar']['consultar'] != '0' || $_SESSION['Nucleo familiar']['registrar'] != '0') {?>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon mdi mdi-account-multiple-plus"></i>
                        <p>
                            Gestionar Núcleo Familiar
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['Nucleo familiar']['registrar'] == '1') {?>
                        <li class="nav-item" onclick="cambio_modulo('Registrar familia')">
                            <a href="<?php Direcciones::_010_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Registrar Familias</p>
                            </a>
                        </li>
                        <?php }?>
                        <?php if ($_SESSION['Nucleo familiar']['consultar'] == '1') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consultar familias')">
                            <a href="<?php Direcciones::_011_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Familias</p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <?php }?>
                <!-- ===============================================================================================  -->
                <?php if ($_SESSION['Viviendas']['consultar'] != '0' || $_SESSION['Viviendas']['registrar'] != '0') {?>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Gestionar Viviendas
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['Viviendas']['registrar'] == '1') {?>
                        <li class="nav-item" onclick="cambio_modulo('Registrar viviendas')">
                            <a href="<?php Direcciones::_012_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Registrar Viviendas</p>
                            </a>
                        </li>
                        <?php }?>
                        <?php if ($_SESSION['Viviendas']['consultar'] == '1') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consultar viviendas')">
                            <a href="<?php Direcciones::_013_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Viviendas</p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </li>

                <?php }?>

                <!-- ===============================================================================================  -->
                <?php if ($_SESSION['Vacunados COVID']['consultar'] != '0' || $_SESSION['Vacunados COVID']['registrar'] != '0' || $_SESSION['Enfermos']['consultar'] != '0' || $_SESSION['Enfermos']['registrar'] != '0' || $_SESSION['Discapacitados']['consultar'] != '0' || $_SESSION['Discapacitados']['registrar'] != '0') {?>
                <li class="nav-header">Salud</li>
                <?php if ($_SESSION['Vacunados COVID']['consultar'] != '0' || $_SESSION['Vacunados COVID']['registrar'] != '0') {?>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-bug"></i>
                        <p>
                            Gestionar Vacunados Covid
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['Vacunados COVID']['registrar'] == '1') {?>
                        <li class="nav-item" onclick="cambio_modulo('Registrar vacunados covid')">
                            <a href="<?php Direcciones::_014_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Registrar Vacunado Covid</p>
                            </a>
                        </li>
                        <?php }?>
                        <?php if ($_SESSION['Vacunados COVID']['consultar'] == '1') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consultar vacunados covid')">
                            <a href="<?php Direcciones::_015_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Vacunados Covid</p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <?php }?>

                <?php if ($_SESSION['Enfermos']['consultar'] != '0' || $_SESSION['Enfermos']['registrar'] != '0') {?>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-ambulance"></i>
                        <p>
                            Gestionar Enfermos
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['Enfermos']['registrar'] == '1') {?>
                        <li class="nav-item" onclick="cambio_modulo('Registrar enfermos')">
                            <a href="<?php Direcciones::_016_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Registrar Enfermos</p>
                            </a>
                        </li>
                        <?php }?>
                        <?php if ($_SESSION['Enfermos']['consultar'] == '1') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consultar enfermos')">
                            <a href="<?php Direcciones::_017_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Enfermos</p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <?php }?>

                <?php if ($_SESSION['Discapacitados']['consultar'] != '0' || $_SESSION['Discapacitados']['registrar'] != '0') {?>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-wheelchair"></i>
                        <p>
                            Gestionar Discapacitados
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['Discapacitados']['registrar'] == '1') {?>
                        <li class="nav-item" onclick="cambio_modulo('Registrar discapacitados')">
                            <a href="<?php Direcciones::_018_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Registrar Discapacitados</p>
                            </a>
                        </li>
                        <?php }?>
                        <?php if ($_SESSION['Discapacitados']['consultar'] == '1') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consultar discapacitados')">
                            <a href="<?php Direcciones::_019_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Discapacitados</p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <?php }?>
                <?php }?>

                <!-- ===============================================================================================  -->
                <?php if ($_SESSION['Parto humanizado']['consultar'] != '0' || $_SESSION['Parto humanizado']['registrar'] != '0') {?>
                <li class="nav-header">Parto Humanizado</li>

                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-female"></i>
                        <p>
                            Gestionar Parto Humanizado
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['Parto humanizado']['registrar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Registrar embarazada')">
                            <a href="<?php Direcciones::_020_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Registrar Embarazadas</p>
                            </a>
                        </li>
                        <?php }?>
                        <?php if ($_SESSION['Parto humanizado']['consultar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consultar embarazadas')">
                            <a href="<?php Direcciones::_021_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Embarazadas</p>
                            </a>
                        </li>
                        <?php }?>

                    </ul>
                </li>
                <?php }?>

                <!-- ===============================================================================================  -->

                <?php if ($_SESSION['Sector agricola']['consultar'] != '0' || $_SESSION['Sector agricola']['registrar'] != '0') {?>
                <li class="nav-header">Sector Agrícola</li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-tree"></i>
                        <p>
                            Gestionar Sector Agrícola
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['Sector agricola']['registrar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Registrar Sector agrícola')">
                            <a href="<?php Direcciones::_022_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Registrar Agrícola</p>
                            </a>
                        </li>
                        <?php }?>
                        <?php if ($_SESSION['Sector agricola']['consultar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consultar sectores agrícolas')">
                            <a href="<?php Direcciones::_023_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Agrícola</p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <?php }?>
                <!-- ===============================================================================================  -->
                <?php if ($_SESSION['Grupos deportivos']['consultar'] != '0' || $_SESSION['Grupos deportivos']['registrar'] != '0') {?>
                <li class="nav-header">Grupos deportivos</li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-soccer-ball-o"></i>
                        <p>
                            Gestionar Grupos Deportivos
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['Grupos deportivos']['registrar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Registrar grupo deportivo')">
                            <a href="<?php Direcciones::_024_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Registrar Grupos Deportivos</p>
                            </a>
                        </li>
                        <?php }?>
                        <?php if ($_SESSION['Grupos deportivos']['consultar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consultar grupos deportivos')">
                            <a href="<?php Direcciones::_025_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Grupos Deportivos</p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <?php }?>


                <!-- ===============================================================================================  -->
                <?php if ($_SESSION['Negocios']['consultar'] != '0' || $_SESSION['Negocios']['registrar'] != '0' || $_SESSION['Inmuebles']['consultar'] != '0' || $_SESSION['Inmuebles']['registrar'] != '0') {?>
                <li class="nav-header">Edificaciones</li>
                <?php if ($_SESSION['Negocios']['consultar'] != '0' || $_SESSION['Negocios']['registrar'] != '0') {?>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon mdi mdi-hospital-building"></i>
                        <p>
                            Gestionar Negocios
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['Negocios']['registrar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Registrar negocios')">
                            <a href="<?php Direcciones::_026_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Registrar Negocios</p>
                            </a>
                        </li>
                        <?php }?>
                        <?php if ($_SESSION['Negocios']['consultar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consultar negocios')">
                            <a href="<?php Direcciones::_027_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Negocios</p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </li>

                <?php }?>



                <!-- ===============================================================================================  -->
                <?php if ($_SESSION['Inmuebles']['consultar'] != '0' || $_SESSION['Inmuebles']['registrar'] != '0') {?>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-building"></i>
                        <p>
                            Gestionar Inmuebles
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['Inmuebles']['registrar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Registrar inmuebles')">
                            <a href="<?php Direcciones::_028_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Registrar Inmuebles</p>
                            </a>
                        </li>
                        <?php }?>
                        <?php if ($_SESSION['Inmuebles']['consultar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consultar inmuebles')">
                            <a href="<?php Direcciones::_029_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Inmuebles</p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <?php }?>
                <?php }?>


                <!-- ===============================================================================================  -->
                <?php if ($_SESSION['Comite']['consultar'] != '0' || $_SESSION['Comite']['registrar'] != '0' || $_SESSION['Centros votacion']['consultar'] != '0' || $_SESSION['Centros votacion']['registrar'] != '0') {?>
                <li class="nav-header">Administrativo</li>
                <?php if ($_SESSION['Comite']['consultar'] != '0' || $_SESSION['Comite']['registrar'] != '0') {?>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Gestionar Comité
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['Comite']['registrar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consejo Comunal Asignar Comite')">
                            <a href="<?php Direcciones::_030_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Asignar Comité</p>
                            </a>
                        </li>
                        <?php }?>
                        <?php if ($_SESSION['Comite']['consultar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consejo Comunal Consultas')">
                            <a href="<?php Direcciones::_031_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Comité</p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </li>



                <?php }?>



                <!-- ===============================================================================================  -->
                <?php if ($_SESSION['Centros votacion']['consultar'] != '0' || $_SESSION['Centros votacion']['registrar'] != '0') {?>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-building-o"></i>
                        <p>
                            Gestionar Centro de Votación
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['Centros votacion']['registrar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Registrar centro de votación')">
                            <a href="<?php Direcciones::_032_();?>" class="nav-link">
                                <i class="fa fa-plus-circle nav-icon text-success"></i>
                                <p>Asignar Centro de Votación</p>
                            </a>
                        </li>
                        <?php }?>
                        <?php if ($_SESSION['Centros votacion']['consultar'] != '0') {?>
                        <li class="nav-item" onclick="cambio_modulo('Consultar centros de votación')">
                            <a href="<?php Direcciones::_033_();?>" class="nav-link">
                                <i class="fa fa-list nav-icon text-info"></i>
                                <p>Consultar Votantes</p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <?php }?>
                <?php }?>



                <!-- ===============================================================================================  -->
                <?php if ($_SESSION['Seguridad']['consultar'] != '0' || $_SESSION['Seguridad']['registrar'] != '0') {?>
                <li class="nav-header">Seguridad</li>

                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Gestionar Seguridad
                        </p>
                    </a>
                    <ul class="nav nav-treeview">



                        <li class="nav-item">
                            <a href="<?php Direcciones::_034_();?>" class="nav-link"
                                onclick="cambio_modulo('Seguridad (Gestionar roles y permisos)')">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>
                                    Gestionar Roles y permisos

                                </p>
                            </a>
                        </li>

                        <li class="nav-item" onclick="cambio_modulo('Consultar bitacora')">
                            <a href="<?php Direcciones::_035_();?>" class="nav-link">
                                <i class="nav-icon fa fa-list-ul"></i>
                                <p>
                                    Consultar Bitácora
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php }?>

                <!-- ===============================================================================================  -->
                <?php if ($_SESSION['rol_inicio'] != 'Habitante') {?>
                <li class="nav-header">Reportes</li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-file-pdf-o"></i>
                        <p>
                            Generar Reportes
                        </p>
                        <i class="right fas fa-angle-left"></i>
                        <span class="badge badge-info right">5</span>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" onclick="cambio_modulo('Generar Censos')">

                            <a href="<?php Direcciones::_036_(); ?>" class="nav-link">
                                <i class="fa fa-edit nav-icon"></i>
                                <p>
                                    Generar Censos
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php Direcciones::_037_(); ?>" class="nav-link">
                                <i class="fa fa-list-alt nav-icon"></i>
                                <p>
                                    Generar Listados
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php Direcciones::_038_(); ?>" class="nav-link">
                                <i class="mdi mdi-account-multiple nav-icon"></i>
                                <p>
                                    Generar Historial Familiar
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link"
                                onclick="$('#solicitar_constancia').modal('show');" data-toggle="dropdown">
                                <i class="fa fa-file-text nav-icon"></i>
                                <p>
                                    Generar Constancias
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php Direcciones::_039_(); ?>" class="nav-link">
                                <i class="fa fa-signal nav-icon"></i>
                                <p>
                                    Generar Estadísticas
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php }?>
                <!-- ===============================================================================================  -->
                <li class="nav-header">Ayuda</li>
                <li class="nav-item" onclick="cambio_modulo('Solicitar Ayuda')">
                    <a href="<?php Direcciones::_040_(); ?>" class="nav-link">
                        <i class="nav-icon fa fa-question-circle"></i>
                        <p>Solicitar Ayuda</p>
                    </a>
                </li>
                <li class="nav-header"></li>
                <!-- ===============================================================================================  -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>

</aside>
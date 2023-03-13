 <!-- Preloader -->
 <div class="preloader flex-column justify-content-center align-items-center">
     <img class="animation__wobble" src="<?php echo constant('URL');?>config/img/web/x3.png" alt="AdminLTELogo"
         height="60" width="60">
 </div>
 <input type="hidden" id="last_accion" value="<?php echo $_SESSION['modulo_actual']; ?>">
 <input type="hidden" id="rol_inicio" value="<?php echo $_SESSION['rol_inicio']; ?>">
 <!-- Barra superior -->
 <nav class="main-header navbar navbar-expand navbar-dark">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button"><i
                     class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="<?php Direcciones::_001_(); ?>" class="nav-link" onclick="cambio_modulo('Inicio')">Inicio</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="<?php Direcciones::_002_();?>" class="nav-link" onclick="cambio_modulo('Contacto')">Contacto</a>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <!-- Navbar Search -->
         <li class="nav-item">

             <div class="navbar-search-block">
                 <form class="form-inline">
                     <div class="input-group input-group-sm">
                         <input class="form-control form-control-navbar" type="search" placeholder="Search"
                             aria-label="Search">
                         <div class="input-group-append">
                             <button class="btn btn-navbar" type="submit">
                                 <i class="fas fa-search"></i>
                             </button>
                             <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                 <i class="fas fa-times"></i>
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </li>
         
         <li class="nav-item dropdown">
            <div class="theme-switch-wrapper nav-link">
                <label class="theme-switch" for="checkbox">
                    <input type="checkbox" id="checkbox" />
                    <span class="slider round"></span>
                </label>
            </div>     
         </li>
         <!-- Dak Modo  -->
         <?php if($_SESSION['Solicitudes']['registrar']=='1'){ ?>
         <li class="nav-item dropdown">
             <a onclick="$('#solicitar_constancia').modal('show');" class="nav-link" data-toggle="dropdown"
                 href="javascript:void(0)" title='Solicitar constancia'>
                 <i class="far fa-file"></i>
             </a>

         </li>
         <?php }?>

         <?php if($_SESSION['Solicitudes']['consultar']=='1' || $_SESSION['rol_inicio'] == 'Administrador'){ ?>
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
                 <i class="far fa-file-text"></i>
                 <span class="badge badge-warning navbar-badge" id="cant_solicitudes">0</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <span class="dropdown-item dropdown-header" id="solicitudes-no-leidas">15 Notifications</span>
                 <div class="dropdown-divider"></div>
                 <div style="height: 30vh;width: 100%;overflow-y: scroll;" id="body-solicitudes">

                 </div>
                 <div id="ver-todas-solicitudes">
                     <div class="dropdown-divider"></div>
                     <a href="<?php Direcciones::_003_();?>" onclick="cambio_modulo('Solicitudes')"
                         class="dropdown-item dropdown-footer">Ver todas las solicitudes</a>
                 </div>
             </div>
         </li>
         <?php }?>
         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
                 <i class="far fa-bell"></i>
                 <span class="badge badge-warning navbar-badge" id="cant_notificaciones">0</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <span class="dropdown-item dropdown-header" id="notificaciones-no-leidas">15 Notifications</span>
                 <div class="dropdown-divider"></div>
                 <div style="height: 30vh;width: 100%;overflow-y: scroll;" id="body-notificaciones">

                 </div>
                 <div id="ver-todas">
                     <div class="dropdown-divider"></div>
                     <a href="<?php Direcciones::_004_();?>" onclick="cambio_modulo('Notificaciones')"
                         class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
                 </div>
             </div>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-widget="fullscreen" href="javascript:void(0)" role="button">
                 <i class="fas fa-expand-arrows-alt"></i>
             </a>
         </li>

         <li class="nav-item dropdown user-menu">
             <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
                 <img src="<?php echo constant('URL')?>config/img/users/user-3.png"
                     class="user-image img-circle elevation-2" alt="User Image">
                 <span class="d-none d-md-inline"><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'] ; ?></span><i
                     class="fas fa-sort-down fa-fw"></i>
             </a>
             <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <!-- User image -->
                 <?php if ($_SESSION['rol_inicio'] != 'Super Usuario') { ?>
                 <li class="user-header bg-primary" style='height:250px'>
                 <?php } else { ?>
                    <li class="user-header bg-primary" style='height:300px'>
                    <?php } ?>
                     <img src="<?php echo constant('URL')?>config/img/users/user-3.png" class="img-circle elevation-2"
                         alt="User Image">
                     <p>
                         <?php echo $_SESSION['nombre']." ".$_SESSION['apellido'] ; ?>
                         <small>
                             <?php echo $_SESSION['cedula_usuario']; ?>
                         </small>
                     </p>
                     <div style='text-align:left'>
                        Clave pública:
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Clave pública" disabled value='<?php echo $_SESSION['public_key']; ?>'>
                                <div class="input-group-append">
                                    <div class="input-group-text" style="background:#003886;">
                                        <a href="javascript:void(0);" type="button" onclick="copyPaste(this)" class="btn" style="margin: 0px;padding: 0px; color:white" title="Click aquí para copiar la clave">
                                           <span class="fas fa-copy"></span>
                                        </a>
                                    </div>
                                </div>
                         </div>
                     </div>
                     <?php if ($_SESSION['rol_inicio'] == 'Super Usuario') { ?>
                        <div style='text-align:left'>
                        Clave privada:
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Clave privada" disabled value='<?php echo $_SESSION['private_key']; ?>'>
                                <div class="input-group-append">
                                    <div class="input-group-text" style="background:#003886;">
                                        <a href="javascript:void(0);" type="button" onclick="copyPaste(this)" class="btn" style="margin: 0px;padding: 0px; color:white" title="Click aquí para copiar la clave">
                                           <span class="fas fa-copy"></span>
                                        </a>
                                    </div>
                                </div>
                         </div>
                     </div>
                 <?php }  ?>
                   
                 </li>
                 <!-- Menu Body -->

                 <!-- Menu Footer-->
                 <li class="user-footer">

                     <a id='close-button' href="<?php Direcciones::_005_();?>" class="btn btn-danger btn-flat float-right">
                         <i class="fas fa-power-off fa-fw"></i>
                         Salir
                     </a>
                 </li>
             </ul>
         </li>

     </ul>
 </nav>
 <!-- /.navbar -->
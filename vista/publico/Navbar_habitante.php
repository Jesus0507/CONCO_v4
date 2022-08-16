 <!-- Preloader -->
 <div class="preloader flex-column justify-content-center align-items-center">
     <img class="animation__wobble" src="<?php echo constant('URL');?>config/img/web/x3.png" alt="AdminLTELogo"
         height="60" width="60">
 </div>
 <!-- Barra superior -->
 <nav class="main-header navbar navbar-expand navbar-dark">
     <!-- Left navbar links -->

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <!-- Navbar Search -->
         <li class="nav-item">
             <!-- <a class="nav-link" data-widget="navbar-search" href="javascript:void(0)" role="button">
                 <i class="fas fa-search"></i>
             </a> -->
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

         <!-- Dak Modo  -->

         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
                 <i class="far fa-bell"></i>
                 <span class="badge badge-warning navbar-badge" id="cant_notificaciones">0</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" >
                 <span class="dropdown-item dropdown-header" id="notificaciones-no-leidas">15 Notifications</span>
                 <div class="dropdown-divider"></div>
                 <div style="height: 30vh;width: 100%;overflow-y: scroll;" id="body-notificaciones">

             </div>
             <div id="ver-todas">
                 <div class="dropdown-divider"></div>
       
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
                 <span class="d-none d-md-inline" id='nombres_habitante'><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'] ; ?></span><i class="fas fa-sort-down fa-fw"></i>
             </a>
             <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <!-- User image -->
                 <li class="user-header bg-primary">
                     <img src="<?php echo constant('URL')?>config/img/users/user-3.png" class="img-circle elevation-2"
                         alt="User Image">
                     <p>
                     <?php echo $_SESSION['nombre']." ".$_SESSION['apellido'] ; ?>
                         <small>
                            <?php echo $_SESSION['cedula_usuario']; ?>
                         </small>
                     </p>
                 </li>
                 <!-- Menu Body -->
                 
                 <!-- Menu Footer-->
                 <li class="user-footer">
                    
                     <a href="<?php echo constant('URL'); ?>login/Salir" class="btn btn-danger btn-flat float-right">
                         <i class="fas fa-power-off fa-fw"></i>
                         Salir
                     </a>
                 </li>
             </ul>
         </li>

     </ul>
 </nav>
 <!-- /.navbar -->
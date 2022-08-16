<!DOCTYPE html>
<html lang="es">
<?php include (call."Head.php"); ?>

<body
    class="hold-transition text-sm  sidebar-mini sidebar-collapse  layout-fixed layout-navbar-fixed layout-footer-fixed "
    id="body">
    <!-- ============================================================== -->
    <!-- Inicio contenido de pagina -->
    <!-- ============================================================== -->
    <main class="wrapper">
        <?php include (call."Navbar.php"); ?>

        <?php

        include (call."Menu.php"); 

        ?>
<script src="<?php echo constant('URL')?>config/js/news/notificaciones.js"></script> 
<?php if($_SESSION['Solicitudes']['consultar']!='0'){ ?>
<script src="<?php echo constant('URL')?>config/js/news/solicitudes.js"></script> 
<?php } ?>
<script src="<?php echo constant('URL')?>config/js/news/add_acciones.js"></script> 
<script src="<?php echo constant('URL')?>config/js/news/consultar-permisos.js"></script> 
   
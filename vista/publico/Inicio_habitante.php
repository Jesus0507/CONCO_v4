<!DOCTYPE html>
<html lang="es">
<?php include (call."Head_habitante.php"); ?>
<?php include (call."Script.php"); ?>

 
<body
    class="hold-transition text-sm  sidebar-mini sidebar-collapse  layout-fixed layout-navbar-fixed layout-footer-fixed "
    id="body">
    <!-- ============================================================== -->
    <!-- Inicio contenido de pagina -->
    <!-- ============================================================== -->
    <main class="wrapper">
        <?php include (call."Navbar_habitante.php"); ?>

<script src="<?php echo constant('URL')?>config/js/news/notificaciones_habitante.js"></script> 

	<style>

.calendar_td{
	cursor:pointer;
	background: #C7F2EE;
}	




.calendar_td_selected{
	cursor:pointer;
	background:  #00C428;
}	



.calendar_ocupado{background: #85D7CF;cursor:pointer;}



.calendar_ocupado_selected{
	cursor:pointer;
	background:  #00C428;
}	

.table_calendar{
	border-radius:7px
	;width:100%;
	font-weight:bold;
	font-size:22px;
}

.calendar_td:hover{
	
	background: #00C428;
}	




.calendar_td_selected:hover{
	
	background:  #00C428;
}	



.calendar_ocupado:hover{background: #00C428;}



.calendar_ocupado_selected:hover{
	
	background:  #00C428;
}


.iconMarker{
	color:#78275F;
	cursor:pointer;
}

.iconMarker:hover{
	color:#A84A8B;
}


.bigSwal{
	width:80% !important;
	margin-left: -40% !important;
}


.bigSwalV2{
	width:95% !important;
	margin-left: -48% !important;
}



</style>
   
<?php 
//-------------------------URL PRINCIPAL--------------------
define('SISTEMA', 	'CONCO_v4');
define('URL', 'http://localhost/dashboard/www/'.SISTEMA."/");

//--------------Base de Datos--------------------

define('SERVIDOR', 	'mysql'); 
define('HOST', 		'localhost'); 
define('BD', 		'conco');

// MYSQL contraseña
define('PORT_MYSQL', 		'3306');
define('USER_MYSQL', 		'root');
define('PASSWORD_MYSQL', 	'root');

//--------------Direcciones--------------------

define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"]);

define('call', 'vista/publico/'); 
define('privado', 'vista/privado/');

define('modal', 'vista/publico/modal/');
define('PDF', 'config/plugins/pdf/');

define('web', 'config/img/web/');
define('ayuda', 'config/img/ayuda/');
define('X', 'config/img/web/x.html');

//--------------TIEMPO--------------------

$hora = date('h:i A');

$dias = [ "Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado" ];

$meses = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ];

$fecha_corta = date('d-m-Y');

$fecha_media = date('d') . " de " . $meses[ date('n')-1 ] . " del " . date('Y');

$GLOBALS['fecha_larga'] = $dias[ date('w') ] . " , " . date('d') . " de " . $meses[ date('n')-1 ] . " del " . date('Y');
$fecha = $fecha_corta;
$fecha_sql = explode("-", $fecha);
$fecha = $fecha_sql[0] . "/" . $fecha_sql[1] . "/" . $fecha_sql[2];

$fecha_inicio=date("Y")."-".date("m")."-".date("d");

?>
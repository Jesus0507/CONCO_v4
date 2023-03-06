<?php

ini_set("max_execution_time", "0");
error_reporting(E_ERROR);
require_once "traits/Componentes.php";

use PDO as pdo;

class BASE_DATOS extends PDO
{
    use Componentes {Conexion as private;}

    private $servidor;
    private $host;
    private $bd;
    private $port_mysql;
    private $user_mysql;
    private $password_mysql;
    private $DNS;
    private $opciones;

    public $conexion;
    public $comprobar;
    public $error_conexion;

    public function __construct()
    {
        $this->servidor       = $this->Conexion()["Mysql"]["Servidor"];
        $this->host           = $this->Conexion()["Mysql"]["Host"];
        $this->bd             = $this->Conexion()["Mysql"]["Base_Datos"];
        $this->port_mysql     = $this->Conexion()["Mysql"]["Puerto"];
        $this->user_mysql     = $this->Conexion()["Mysql"]["Usuario"];
        $this->password_mysql = $this->Conexion()["Mysql"]["Contraseña"];

        try
        {
            $this->DNS = "{$this->servidor}:host={$this->host};dbname={$this->bd};";

            $this->opciones = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT         => false,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\'',
            );

            // $this->conexion = parent::__construct($this->DNS, $this->user_mysql, $this->password_mysql, $this->opciones);
            $this->conexion       = new PDO($this->DNS, $this->user_mysql, $this->password_mysql, $this->opciones);
            $this->error_conexion = "No se han encontrado errores.";
            $this->comprobar      = 1;
            return $this->conexion;
        } catch (PDOException $e) {
            switch ($e->getCode()) {
                case '1049':
                    $tipo = "Acceso denegado,  Nombre de la Base de Datos Incorrecto.";
                    break;
                case '2002':
                    $tipo = "Acceso denegado,  Host desconocido o MSQL esta Apagado.";
                    break;
                case '1044':
                    $tipo = "Acceso denegado,  Usuario de MSQL Incorrecto.";
                    break;
                case '1045':
                    $tipo = "Acceso denegado,  Contraseña de MSQL Incorrecta.";
                    break;
                default:
                    $tipo = "Sin Definicion.";
                    break;
            }

            $this->error_conexion = 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: </br>' .
            "[ Archivo ] => " . $e->getFile() . "</br>" .
            "[ Linea ]   => (" . $e->getLine() . ")</br>" .
            "[ Codigo ]   => (" . $e->getCode() . ")</br>" .
            "[ Tipo Error ]   => " . $tipo . "</br>" .
            "[ Error PHP]   => (" . $e->getMessage() . ")</br>";

            $error_log          = new stdClass();
            $error_log->Fecha   = $GLOBALS['fecha_larga'];
            $error_log->Hora    = date('h:i A');
            $error_log->Archivo = $e->getFile();
            $error_log->Linea   = $e->getLine();
            $error_log->Codigo  = $e->getCode();
            $error_log->Mensaje = $e->getMessage();
            $error_log->Tipo    = $tipo;
            error_log(print_r($error_log, true), 3, "errores.log");

            $this->comprobar = 0;
            return false;
            unset($error_log, $tipo);
        }
    }

    function Conectar()
    {return $this->conexion;}

    function Probar_Conexion()
    {return $this->comprobar;}

    function Error_Conexion()
    {return $this->error_conexion;}

}

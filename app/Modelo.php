<?php 
// =============MODELO==============

class Modelo extends BASE_DATOS 
{
    #Public: acceso sin restricción.
    #Protected:Solo puede ser accesado por una clase heredada y la clase que lo define.
    #Private:Solo puede ser accesado por la clase que lo define.

    protected $estado;
    private $crud;

    public function __construct()
    {
        parent::__construct();
    }
    public function Desconectar_BD()
    {
        return $this->conexion->close();
    }
     // =============CREAR VARIABLE PRIVADAS==============
    public function __GET($A)
    {
        return $this->$A;
    }
    public function __SET($A, $B)
    {
        return $this->$A = $B;
    }
    public function _CRUD_(array $crud)
    {
         $this->crud = $crud;
    }
    // =========================================
    protected function Capturar_Error($e,$modulo)
    {   
        $this->conexion->rollBack(); #Revierte una transacción
        $error_log          = new stdClass();
        $error_log->Modulo  = "------".$modulo."------";
        $error_log->Fecha   = $GLOBALS['fecha_larga'];
        $error_log->Hora    = date('h:i:s A');
        $error_log->Archivo = $e->getFile();
        $error_log->Linea   = $e->getLine();
        $error_log->Mensaje = $e->getMessage();
        error_log(print_r($error_log, true), 3, "errores.log"); 

        $this->error = 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: </br>' .
        "[ Archivo ] => " . $e->getFile() . "</br>" .
        "[ Linea ]   => (" . $e->getLine() . ")</br>" .
        "[ Codigo ]   => (" . $e->getCode() . ")</br>" .
        "[ Error PHP]   => (" . $e->getMessage() . ")</br>";

        echo ($this->error);unset($this->error,$error_log,$modulo );
        return false;
    }

    protected function ACT_DES():string
    {
    return  "UPDATE ".$this->estado["tabla"]." SET estado = :estado "."WHERE ".$this->estado['id_tabla']." = :".$this->estado['id_tabla'];
    }

    protected function _01_():string
    {
    return  "SELECT * FROM ".$this->crud['consultar']['tabla']." WHERE estado = ".$this->crud['consultar']['estado']." ORDER BY ".$this->crud['consultar']['orden']." ASC";
    }

    protected function _02_():string
    {
    return  'INSERT INTO ' . $this->crud["registrar"]['tabla'] . ' (' . $this->crud["registrar"]['columna'] . ', estado) VALUES (:' . $this->crud["registrar"]['columna'] . ', :estado)';
    }

    protected function _03_():string
    {
    return  "SELECT MAX(" . $this->crud["ultimo"]['id'] . ") FROM " . $this->crud["ultimo"]['tabla'] . "";
    }

    protected function _04_():string
    {
    return  "UPDATE " . $this->crud["actualizar"]['tabla'] . " SET " . $this->crud["actualizar"]['columna'] . " = :" . $this->crud["actualizar"]['columna'] . " WHERE " . $this->crud["actualizar"]['id_tabla'] . " =:" . $this->crud["actualizar"]['id_tabla'] . "";
    }

    protected function _05_():string
    {
    return  "SELECT * FROM " . $this->crud['consultar']['tabla'] . " WHERE " . $this->crud['consultar']['columna'] . "=" . $this->crud['consultar']['data'] . "";
    }

    protected function _06_():string
    {
    return  "SELECT * FROM ".$this->crud['consultar']['tabla']." ORDER BY ".$this->crud['consultar']['orden']." ASC";
    }

    protected function _07_():string
    {
    return  'DELETE FROM ' . $this->crud["eliminar"]['tabla'] . ' WHERE ' . $this->crud["eliminar"]['id_tabla'] . ' = :' . $this->crud["eliminar"]['id_tabla'] . '';
    }

   
}
?>
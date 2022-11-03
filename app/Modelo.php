<?php 
// =============MODELO==============

class Modelo extends BASE_DATOS 
{
    #Public: acceso sin restricción.
    #Protected:Solo puede ser accesado por una clase heredada y la clase que lo define.
    #Private:Solo puede ser accesado por la clase que lo define.

    private $sentencia;
    private $datos;
    private $estado;
    private $PDO;

    private $crud;

    public $sql; 
    public $resultado;

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
    // =============DATOS PRIVADOS==============
    public function Datos($datos)
    {
         $this->datos = $datos;
    }
    public function Estado($estado)
    {
         $this->estado = $estado;
    }

    public function _CRUD_(array $crud)
    {
         $this->crud = $crud;
    }
    // =============FUNCIONES PUBLICAS==============
    # Ejecutar un query simple del tipo INSERT, DELETE, UPDATE
    protected function Ejecutar_Tarea()
    { 
        $this->conexion->beginTransaction();
        $this->PDO = $this->conexion->prepare($this->sentencia);
        $this->PDO->execute($this->datos);
        $this->conexion->commit();
        return true;
    }

    # Traer resultados de una consulta en un Array
    protected function Resultado_Consulta()
    {   
        $this->conexion->beginTransaction();
        $this->PDO = $this->conexion->prepare($this->sentencia);
        $this->PDO->execute();
        $this->conexion->commit();
        $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
        $this->resultado =  $this->PDO->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultado;
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

    protected function ACT_DES()
    {
    return  "UPDATE ".$this->estado["tabla"]." SET estado = :estado "."WHERE ".$this->estado['id_tabla']." = :".$this->estado['id_tabla'];
    }

    protected function _01_()
    {
    return  "SELECT * FROM ".$this->crud['consultar']['tabla']." WHERE estado = ".$this->crud['consultar']['estado']." ORDER BY ".$this->crud['consultar']['orden']." ASC";
    }

    protected function _02_()
    {
    return  'INSERT INTO ' . $this->registrar['tabla'] . ' (' . $this->registrar['columna'] . ', estado) VALUES (:' . $this->registrar['columna'] . ', :estado)';
    }

    protected function _03_()
    {
    return  "SELECT MAX(" . $this->ultimo['id'] . ") FROM " . $this->ultimo['tabla'] . "";
    }

    protected function _04_()
    {
    return  "UPDATE " . $this->actualizar['tabla'] . " SET " . $this->actualizar['columna'] . " = :" . $this->actualizar['columna'] . " WHERE " . $this->actualizar['id_tabla'] . " =:" . $this->actualizar['id_tabla'] . "";
    }

    protected function _05_()
    {
    return  "SELECT * FROM " . $this->crud['consultar']['tabla'] . " WHERE " . $this->crud['consultar']['columna'] . "=" . $this->crud['consultar']['data'] . "";
    }

    protected function _06_()
    {
    return  "SELECT * FROM ".$this->crud['consultar']['tabla']." ORDER BY ".$this->crud['consultar']['orden']." ASC";
    }

    protected function _07_()
    {
    return  'DELETE FROM ' . $this->eliminar['tabla'] . ' WHERE ' . $this->eliminar['id_tabla'] . ' = :' . $this->eliminar['id_tabla'] . '';
    }

   
}
?>
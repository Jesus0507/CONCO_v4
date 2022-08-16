<?php 
use BASE_DATOS as BASE_DATOS;
// =============MODELO==============
class Modelo   
{
    private $sentencia;
    private $datos;
    private $estado;
    private $PDO;

    public $conexion; 
    public $sql; 
    public $resultado;

    public function __construct()
    {
        $this->Conectar_BD();
    }
    public function Conectar_BD()
    {
        $this->conexion = new BASE_DATOS();
        return $this->conexion;
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

    // =============FUNCIONES PUBLICAS==============
    # Ejecutar un query simple del tipo INSERT, DELETE, UPDATE
    public function Ejecutar_Tarea()
    {
        $this->PDO = $this->conexion->prepare($this->sentencia);
        $this->PDO->execute($this->datos);
        return true;
        $this->Limpiar([$this->datos,$this->sentencia,$this->PDO,$this->conexion]);
    }

    # Traer resultados de una consulta en un Array
    public function Resultado_Consulta()
    {   
        $this->PDO = $this->conexion->prepare($this->sentencia);
        $this->PDO->execute();
        $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
        $this->resultado =  $this->PDO->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultado;
        $this->Limpiar([$this->resultado,$this->sentencia,$this->PDO,$this->conexion]);
    }

    // =========================================
    public function Capturar_Error($e)
    {   
        $error_log          = new stdClass();
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

        echo ($this->error);
        unset($this->error,$error_log );
        return false;
    }

    public function ACT_DES()
    {
    return  "UPDATE ".$this->estado["tabla"]." SET estado = :estado "."WHERE ".$this->estado['id_tabla']." = :".$this->estado['id_tabla'];
    }

    public function _01_()
    {
    return  "SELECT * FROM ".$this->consultar['tabla']." WHERE estado = ".$this->consultar['estado']." ORDER BY ".$this->consultar['orden']." ASC";
    }

    public function _02_()
    {
    return  'INSERT INTO ' . $this->registrar['tabla'] . ' (' . $this->registrar['columna'] . ', estado) VALUES (:' . $this->registrar['columna'] . ', :estado)';
    }

    public function _03_()
    {
    return  "SELECT MAX(" . $this->ultimo['id'] . ") FROM " . $this->ultimo['tabla'] . "";
    }

    public function _04_()
    {
    return  "UPDATE " . $this->actualizar['tabla'] . " SET " . $this->actualizar['columna'] . " = :" . $this->actualizar['columna'] . " WHERE " . $this->actualizar['id_tabla'] . " =:" . $this->actualizar['id_tabla'] . "";
    }

    public function _05_()
    {
    return  "SELECT * FROM " . $this->consultar['tabla'] . " WHERE " . $this->consultar['columna'] . "=" . $this->consultar['data'] . "";
    }

    public function _06_()
    {
    return  "SELECT * FROM ".$this->consultar['tabla']." ORDER BY ".$this->consultar['orden']." ASC";
    }

    public function _07_()
    {
    return  'DELETE FROM ' . $this->eliminar['tabla'] . ' WHERE ' . $this->eliminar['id_tabla'] . ' = :' . $this->eliminar['id_tabla'] . '';
    }

    public function Limpiar($limpiar)
    { 
        unset($limpiar);
    }

    public function __destruct()
    {
        unset($this->estado,$this->consultar,$this->registrar,$this->actualizar,$this->eliminar,$this->ultimo);
    }
}
?>
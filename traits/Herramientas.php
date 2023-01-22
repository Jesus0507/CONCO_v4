<?php

trait Herramientas
{
	private $url;
	private $modulo;
	private $modelName;
	private $reflectionClass;

	public $validacion;
	public $modelo;
	public $error;
    public $error_log; 
    
    # VER CONTENIDO DE UN ARRAY DE MANERA ORDENADA
 	public function Ver_Array($value)
    {
        echo "<pre>";
        echo var_dump($value);
        echo "</pre>";
    }
    #CARGA DE MODELOS 
    public function Cargar_Modelo($modulo)
    {
        $this->url = 'modelo/' . $this->modulo . '_class.php';

        if (file_exists($this->url)) {
            require $this->url;

            $this->modelName       = $this->modulo . '_Class';
            $this->reflectionClass = new ReflectionClass($this->modelName);

            if ($this->reflectionClass->IsInstantiable()) {
                $this->modelo = new $this->modelName();
            } else {
                $this->error = '[Error Objeto] => "El Objeto: [ ' . $this->modelName . ' ] No puede ser Instanciado."';
                return $this->Capturar_Error($this->error);
            }
        }
    }

    # CARGAR ARCHIVOS DE BACKEND
    public function Validacion($modulo)
    {
        $this->url = 'controlador/backend/' . $this->modulo . '_validacion.php';

        if (file_exists($this->url)) {
            require $this->url;

            $this->modelName       = ucfirst($this->modulo) . '_Validacion';
            $this->reflectionClass = new ReflectionClass($this->modelName);

            if ($this->reflectionClass->IsInstantiable()) {
                $this->validacion = new $this->modelName();

            } else {
                $this->error = '[Error Objeto] => "El Objeto: [ ' . $this->modelName . ' ] No puede ser Instanciado."';
                return $this->Capturar_Error($this->error);
            }
        }
    }

    #IMPRIMIR ARRAY MEDIANTE JSON ENCODE
    public function Escribir_JSON($array)
    {
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
    }

    #Captura de herrores en modulos
    protected function Capturar_Error($e,$modulo)
    {   
        $this->conexion->rollBack(); #Revierte una transacción
        $this->error_log          = new stdClass();
        $this->error_log->Modulo  = "------".$modulo."------";
        $this->error_log->Fecha   = $GLOBALS['fecha_larga'];
        $this->error_log->Hora    = date('h:i:s A');
        $this->error_log->Archivo = $e->getFile();
        $this->error_log->Linea   = $e->getLine();
        $this->error_log->Mensaje = $e->getMessage();
        error_log(print_r($this->error_log, true), 3, "errores.log"); 

        $this->error = 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: </br>' .
        "[ Archivo ] => " . $e->getFile() . "</br>" .
        "[ Linea ]   => (" . $e->getLine() . ")</br>" .
        "[ Codigo ]   => (" . $e->getCode() . ")</br>" .
        "[ Error PHP]   => (" . $e->getMessage() . ")</br>";

        echo ($this->error);
        unset($this->error,$this->error_log, $modulo);
        return false;
    }
}

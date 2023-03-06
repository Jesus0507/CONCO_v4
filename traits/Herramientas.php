<?php

trait Herramientas
{
	private $url;
	private $modulo;
	private $modelName;
	private $reflectionClass;

	public $validacion;
	public $modelo;
    public $controlador;
	public $error;
    public $error_log; 
    public $session;
    public $dias = [ "Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado" ];
    public $meses = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ];

    #GETTER obtiene datos declarados en una clase
    public function __GET($A)
    {
        return $this->$A;
    }
    #SETTER GENERICO declara variables en una clase de forma publica
    public function __SET($A, $B)
    {
        return $this->$A = $B;
    }
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

    #CARGA DE CONTROLADORES
    public function Cargar_Controlador($modulo)
    {
        $this->controlador = 'controlador/' . $modulo . '_controlador.php';
        require_once $this->controlador;

        $this->controlador = new $modulo();
    }

    # CARGAR ARCHIVOS DE BACKEND
    public function Cargar_Validacion($modulo)
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

    #ERROR 403 
    public function _403_()
    {
        die("No posee los permisos para realizar esta accion.");
    }
    #SEGURIDAD DE SESSION ver que el usuario este logueado
    public function Seguridad_de_Session()
    {
        @session_start();
        $var = $_SESSION['cedula_usuario'];
        if ($var == null || $var == '') {
            session_start();
            session_destroy();
            $this->_403_();
        }
    }
    #Seter der sesiones
    public function _SESSION_($session): void {$this->session = $session;}
    #GETER DE SESIONES
    public function SESSION():string  {return $this->session;}

    #captura de error de algoritmos sin conexion
    protected function Capturar_Error()
    {
        $this->error_log          = new stdClass();
        $this->error_log->Fecha   = $this->dias[ date('w') ]." , ".date('d')." de ".$this->meses[ date('n')-1 ] ." del ". date('Y');
        $this->error_log->Hora    = date('h:i:s a');
        $this->error_log->Mensaje = $this->error;
        error_log(print_r($this->error_log, true), 3, "errores.log");
        return false;
    }

    #Captura de herrores en modulos con conexion
    protected function Capturar_Error_Modulo($e,$modulo)
    {   
        $this->conexion->rollBack(); #Revierte una transacción
        $this->error_log          = new stdClass();
        $this->error_log->Modulo  = "------".$modulo."------";
        $this->error_log->Fecha   = $this->dias[ date('w') ]." , ".date('d')." de ".$this->meses[ date('n')-1 ] ." del ". date('Y');
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

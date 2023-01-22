<?php

trait Herramientas
{
	private $url;
	private $modulo;
	private $modelName;
	private $reflectionClass;

	public $validacion ;
	public $error;

    # VER CONTENIDO DE UN ARRAY DE MANERA ORDENADA
 	public function Ver_Array($value)
    {
        echo "<pre>";
        echo var_dump($value);
        echo "</pre>";
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
}

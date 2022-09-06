<?php

class Negocios_Validacion extends Validacion 
{ 
    public function __construct($modelo)
    {
        parent::__construct();
        $this->modelo = $modelo;
    }
    
    public function Prueba()
    {
        echo "string";
    }  
}
?> 
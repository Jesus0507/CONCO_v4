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
        if ($_POST) {
            
            $this->input('nombre_negocio', true, 'string', 50, 5,"Nombre del Negocio");
            
            if ($this->Fallo_Validacion()) { // Si la validacion falla
               echo $this->mensaje;
            } else {
                
            }
        }

    }
}

<?php

class Ayuda extends Controlador 
{ 
    public function __construct()
    {
        parent::__construct();
     //   $this->Cargar_Modelo("ayuda");
    }
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();$this->vista->Cargar_Vistas('ayuda/index'); 
    }   
    public function Ayuda()
    {
        $this->Seguridad_de_Session();$this->vista->Cargar_Vistas('ayuda/index'); 
    }  
}
?> 
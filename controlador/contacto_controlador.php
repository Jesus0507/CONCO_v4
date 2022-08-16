<?php

class Contacto extends Controlador
{
    public function __construct()
    {
        parent::__construct();
      // $this->Cargar_Modelo("contacto");
    }
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();$this->vista->Cargar_Vistas('contacto/contactos'); 
    }   
    public function Desarrolladores()
    {
        $this->Seguridad_de_Session();$this->vista->Cargar_Vistas('contacto/contactos'); 
    }  
}
?> 
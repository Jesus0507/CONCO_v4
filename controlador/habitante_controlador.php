<?php

class Habitante extends Controlador 
{ 
    public function __construct()
    {
        parent::__construct();
      // $this->Cargar_Modelo("habitante");
    }

    public function Establecer_Consultas() 
    {
        $viviendas = $this->Consultar_Tabla("vivienda", 1, "id_vivienda");
        $personas = $this->Consultar_Tabla("personas", 1, "cedula_persona");
        $calles = $this->Consultar_Tabla("calles", 1, "nombre_calle"); 
        $tipo_vivienda  = $this->Consultar_Tabla("tipo_vivienda", 1, "nombre_tipo_vivienda");
        $tipo_techo = $this->Consultar_Tabla("tipo_techo", 1, "techo");
        $tipo_pared = $this->Consultar_Tabla("tipo_pared", 1, "pared");         
        $tipo_piso = $this->Consultar_Tabla("tipo_piso", 1, "piso"); 

        $this->vista->viviendas = $viviendas;
        $this->viviendas = $viviendas; 
        
        $this->vista->personas = $personas;
        $this->personas = $personas; 

        $this->vista->calles = $calles;
        $this->calles = $calles; 

        $this->vista->tipo_vivienda = $tipo_vivienda;
        $this->tipo_vivienda = $tipo_vivienda; 

        $this->vista->tipo_pared = $tipo_pared;
        $this->tipo_pared = $tipo_pared; 


        $this->vista->tipo_piso = $tipo_piso;
        $this->tipo_piso = $tipo_piso; 


        $this->vista->tipo_techo = $tipo_techo;
        $this->tipo_techo = $tipo_techo; 

        $servicios_gas=$this->Consultar_Tabla("servicio_gas",1,"nombre_servicio_gas");
        $this->vista->servicios_gas=$servicios_gas;
        $this->servicios_gas=$servicios_gas;

        $electrodomesticos=$this->Consultar_Tabla("electrodomesticos",1,"id_electrodomestico");
        $this->vista->electrodomesticos=$electrodomesticos;
        $this->electrodomesticos=$electrodomesticos;

        $cantidad_viviendas = count($viviendas);
        $cantidad_personas = count($personas);
        $cantidad_calles = count($calles);

        $this->vista->cantidad_viviendas = $cantidad_viviendas;
        $this->vista->cantidad_personas = $cantidad_personas;
        $this->vista->cantidad_calles = $cantidad_calles;
    }

    public function Cargar_Vistas()
    {
        $this->Establecer_Consultas();
        $this->vista->Cargar_Vistas('habitante/index'); 
    }   

    public function Inicio()
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        $this->vista->Cargar_Vistas('habitante/index'); 
    }  

}
?> 
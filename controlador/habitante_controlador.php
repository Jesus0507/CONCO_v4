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
        $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_01_");
        $this->modelo->__SET("consultar", array("tabla" => "calles", "estado" => 1, "orden" => "nombre_calle"));
        $this->datos["calles"] = $this->modelo->Administrar();
        $this->modelo->__SET("consultar", array("tabla" => "vivienda", "estado" => 1, "orden" => "id_vivienda"));
        $this->datos["viviendas"] = $this->modelo->Administrar();
        $this->modelo->__SET("consultar", array("tabla" => "tipo_vivienda", "estado" => 1, "orden" => "nombre_tipo_vivienda"));
        $this->datos["tipo_vivienda"] = $this->modelo->Administrar();
        $this->modelo->__SET("consultar", array("tabla" => "tipo_techo", "estado" => 1, "orden" => "techo"));
        $this->datos["tipo_techo"] = $this->modelo->Administrar();
        $this->modelo->__SET("consultar", array("tabla" => "tipo_pared", "estado" => 1, "orden" => "pared"));
        $this->datos["tipo_pared"] = $this->modelo->Administrar();
        $this->modelo->__SET("consultar", array("tabla" => "tipo_piso", "estado" => 1, "orden" => "piso"));
        $this->datos["tipo_piso"] = $this->modelo->Administrar();
        $this->modelo->__SET("consultar", array("tabla" => "servicio_gas", "estado" => 1, "orden" => "nombre_servicio_gas"));
        $this->datos["servicios_gas"] = $this->modelo->Administrar();
        $this->modelo->__SET("consultar", array("tabla" => "electrodomesticos", "estado" => 1, "orden" => "id_electrodomestico"));
        $this->datos["electrodomesticos"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_01");$this->datos["personas"] = $this->modelo->Administrar();
        $this->vista->datos = $this->datos;
    }

    public function Cargar_Vistas()
    {
        $this->Establecer_Consultas();$this->Seguridad_de_Session();$this->vista->Cargar_Vistas('habitante/index'); 
    }   

}
?> 
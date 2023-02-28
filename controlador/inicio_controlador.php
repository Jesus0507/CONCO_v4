<?php

class Inicio extends Controlador
{
    private $datos; #array con los datos necesarios para el modulo (consultas)
    private $adulto_mayor;
    private $menores_edad;
    private $votantes;
    private $anio;
    private $edad;
    
    public function __construct()
    {
        parent::__construct();
        //  $this->Cargar_Modelo("inicio");
    }

    private function Get_Datos_Vista(): array {return $this->datos;}

    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("_01_");
        $this->modelo->_CRUD_(["consultar" => array("tabla" => "calles", "estado" => 1, "orden" => "nombre_calle")]);
        $this->datos["calle"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("_01_");
        $this->modelo->_CRUD_(["consultar" => array("tabla" => "vivienda", "estado" => 1, "orden" => "id_vivienda")]);
        $this->datos["viviendas"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_01");
        $this->datos["personas"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("_06_");
        $this->modelo->_CRUD_(["consultar" => array("tabla" => "comite_persona", "orden" => "cedula_persona")]);
        $this->datos["miembros_consejo"] = $this->modelo->Administrar();

        $this->adulto_mayor = 0;$this->menores_edad = 0;$this->votantes     = 0;

        foreach ($this->datos["personas"] as $p) {
            $this->anio = explode('-', $p["fecha_nacimiento"]);
            $this->edad = date("Y") - $this->anio[0];

            $this->modelo->_SQL_("_05_");
            $this->modelo->_CRUD_(["consultar" => array(
                "tabla"   => "votantes_centro_votacion",
                "columna" => "cedula_votante",
                "data"    => $p['cedula_persona'],
            )]);
            $this->datos["centro_votante"] = $this->modelo->Administrar();

            if ($this->edad <= 17) {$this->menores_edad++;}
            if ($this->edad > 55) {$this->adulto_mayor++;}
            if (count($this->datos["centro_votante"]) != 0) {$this->votantes++;}

        }
        $this->datos["cantidad_viviendas"] = count($this->datos["viviendas"]);
        $this->datos["cantidad_personas"]  = count($this->datos["personas"]);
        $this->datos["cantidad_calles"]    = count($this->datos["calle"]);
        $this->datos["cantidad_miembros"]  = count($this->datos["miembros_consejo"]);
        $this->datos["menores_edad"]       = $this->menores_edad;
        $this->datos["adulto_mayor"]       = $this->adulto_mayor;
        $this->datos["votantes"]           = $this->votantes;
        $this->vista->datos                = $this->Get_Datos_Vista();
        unset($this->menores_edad, $this->adulto_mayor, $this->votantes, $this->anio, $this->edad);
    }

    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();$this->Establecer_Consultas();
        $this->vista->Cargar_Vistas('inicio/index');
    }

}

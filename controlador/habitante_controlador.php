<?php

class Habitante extends Controlador
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.
    private $permisos; #permisos correspondiente del modulo
    private $sql; #nombre de la sentencia SQL que se ejecutara en el modelo
    private $datos_consulta; #array con los datos necesarios para el modulo (consultas)
    private $mensaje; #mensaje que se mandara a la vista

    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        $this->permisos["rol"] = $_SESSION['rol_inicio'];
        // $this->Cargar_Modelo("habitante");
    }

    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_02");
        $this->datos_consulta["calles"]        = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_03");
        $this->datos_consulta["viviendas"]     = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_04");
        $this->datos_consulta["tipo_vivienda"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_05");
        $this->datos_consulta["tipo_techo"]    = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_06");
        $this->datos_consulta["tipo_pared"]    = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_07");
        $this->datos_consulta["tipo_piso"]     = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_08");
        $this->datos_consulta["servicios_gas"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_09");
        $this->datos_consulta["electrodomesticos"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_01");
        $this->datos_consulta["personas"]       = $this->modelo->Administrar();
        $this->vista->datos                     = $this->Get_Datos_Vista();
    }
    // ==================GETTERS=========================
    #getters usados para obtener la informacion de las variables privadas
    # retornan tipo string o array

    private function Get_Datos_Vista(): array{return $this->datos_consulta;}

    // ==============================================================================

    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        if ($this->permisos["rol"] === "Habitante") {
            $this->vista->Cargar_Vistas('habitante/index');
        } else { $this->_403_();}
    }

}

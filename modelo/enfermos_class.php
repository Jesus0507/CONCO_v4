<?php

class Enfermos_Class extends Modelo
{

    public function __construct()
    {
        parent::__construct();
    }

    public function Administrar()
    {
        $this->sentencia = $this->{$this->SQL}();
        try {
            switch ($this->tipo) {
                case '0':
                    return $this->Resultado_Consulta();
                    break;
                case '1':
                    return $this->Ejecutar_Tarea();
                    break;
                default:
                    die('[Error 400] => "La Peticion es Incorrecta, solo se permite peticion de tipo 0/1."');
                    break;
            }
        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    // ===============================================================================

    private function SQL_01()
    {
        return "SELECT * FROM enfermedades WHERE estado=1";
    }

    private function SQL_02()
    {
        return "SELECT DISTINCT PE.cedula_persona, P.* FROM personas_enfermedades PE, personas P WHERE PE.cedula_persona=P.cedula_persona AND P.estado=1";
    }

     private function SQL_03()
    {
        return "SELECT E.*,PE.cedula_persona,PE.medicamentos, PE.id_persona_enfermedad FROM enfermedades E, personas_enfermedades PE WHERE PE.id_enfermedad=E.id_enfermedad AND E.estado=1";
    }

    private function SQL_04()
    {
        return "SELECT E.*,PE.cedula_persona,PE.medicamentos, PE.id_persona_enfermedad FROM enfermedades E, personas_enfermedades PE WHERE PE.cedula_persona = $this->cedula AND PE.id_enfermedad=E.id_enfermedad AND E.estado=1";
    }

    private function SQL_05()
    {
        return "INSERT INTO personas_enfermedades (cedula_persona, id_enfermedad, medicamentos) VALUES (:cedula_persona, :id_enfermedad, :medicamentos)";
    }

    private function SQL_06()
    {
        return "SELECT p.cedula_persona,p.primer_nombre,p.primer_apellido FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }
}
?>
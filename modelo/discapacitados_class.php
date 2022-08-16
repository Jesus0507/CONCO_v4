<?php

class Discapacitados_Class extends Modelo
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
        return "SELECT * FROM discapacidad WHERE estado=1";
    }

    private function SQL_02()
    {
        return "SELECT DISTINCT DP.cedula_persona, P.* FROM discapacidad_persona DP, personas P WHERE DP.cedula_persona=P.cedula_persona AND P.estado=1";
    }

    private function SQL_03()
    {
        return "SELECT p.cedula_persona,p.primer_nombre,p.primer_apellido FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }

    private function SQL_04()
    {
        return "SELECT D.*,DP.* FROM discapacidad D, discapacidad_persona DP WHERE DP.id_discapacidad=D.id_discapacidad AND D.estado=1";
    }

    private function SQL_05()
    {
        return "SELECT D.*,DP.* FROM discapacidad D, discapacidad_persona DP WHERE  DP.id_discapacidad=D.id_discapacidad AND D.estado=1 AND DP.cedula_persona= " . $this->cedula;
    }

    private function SQL_06()
    {
        return "INSERT INTO discapacidad_persona (cedula_persona, id_discapacidad, necesidades_discapacidad, observacion_discapacidad, en_cama) VALUES (:cedula_persona, :id_discapacidad, :necesidades_discapacidad, :observacion_discapacidad, :en_cama)";
    }

}

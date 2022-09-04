 <?php

class Familias_Class extends Modelo
{
    public function __construct()
    {
        parent::__construct();
    }
    // ===============================================================================
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
        return "SELECT F.*,V.* FROM familia F , vivienda V WHERE F.estado=1 AND F.id_vivienda=V.id_vivienda";
    }
    
    private function SQL_02()
    {
        return "SELECT P.* FROM familia_personas FP, personas P WHERE FP.id_familia= $this->id AND FP.cedula_persona = P.cedula_persona";
    }

    private function SQL_03()
    {
        return "INSERT INTO familia (id_vivienda, condicion_ocupacion, nombre_familia,  observacion,  telefono_familia, ingreso_mensual_aprox, estado) VALUES (:id_vivienda, :condicion_ocupacion, :nombre_familia, :observacion, :telefono_familia,:ingreso_mensual_aprox, :estado)";
    }

    private function SQL_04()
    {
        return "UPDATE familia SET id_vivienda = :id_vivienda, condicion_ocupacion = :condicion_ocupacion, nombre_familia = :nombre_familia, observacion = :observacion, telefono_familia = :telefono_familia, ingreso_mensual_aprox = :ingreso_mensual_aprox, estado = :estado WHERE id_familia = :id_familia";
    }

    private function SQL_05()
    {
        return "INSERT INTO familia_personas (id_familia, cedula_persona) VALUES (:id_familia, :cedula_persona)";
    }

    private function SQL_06()
    {
        return "SELECT p.cedula_persona,p.primer_nombre,p.primer_apellido FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }
}

<?php

class Consejo_Comunal_Class extends Modelo
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
        return "SELECT id_comite_persona, c.nombre_comite, cc.cedula_persona, p.primer_nombre, p.primer_apellido, cargo_persona, cc.fecha_ingreso, cc.fecha_salida FROM comite_persona cc INNER JOIN personas p, comite c WHERE cc.id_comite = c.id_comite AND cc.cedula_persona = p.cedula_persona ORDER BY `cc`.`cedula_persona` ASC";
    }

    private function SQL_02()
    {
        return "INSERT INTO comite_persona (id_comite, cedula_persona, cargo_persona, fecha_ingreso, fecha_salida) VALUES (:id_comite, :cedula_persona, :cargo_persona, :fecha_ingreso, :fecha_salida)";
    }

    private function SQL_03()
    {
        return "UPDATE comite_persona  SET id_comite = :id_comite, cedula_persona = :cedula_persona, cargo_persona = :cargo_persona, fecha_ingreso = :fecha_ingreso, fecha_salida = :fecha_salida WHERE id_comite_persona = :id_comite_persona";
    }
    
    private function SQL_04()
    {
        return "SELECT p.cedula_persona,p.primer_nombre,p.primer_apellido FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }
}
?>
<?php

class Centro_Votacion_Class extends Modelo
{
    public function __construct(){parent::__construct();}

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
            return $this->Capturar_Error($e,"Centro_Votacion");
        }
    }

    // ===============================================================================

    private function SQL_01()
    {
        return "SELECT * FROM  centros_votacion WHERE estado = 1"; 
    }

    private function SQL_02()
    {
        return "SELECT v.id_votante_centro_votacion, p.cedula_persona, p.primer_nombre, p.primer_apellido, c.id_centro_votacion, c.nombre_centro, par.id_parroquia, par.nombre_parroquia, v.estado FROM votantes_centro_votacion v INNER JOIN centros_votacion c, parroquias par, personas p WHERE v.estado = 1 AND v.id_centro_votacion = c.id_centro_votacion AND c.id_parroquia = par.id_parroquia AND v.cedula_votante = p.cedula_persona ORDER BY `c`.`nombre_centro` ASC";
    }

    private function SQL_03()
    {
        return 'INSERT INTO votantes_centro_votacion (id_centro_votacion, cedula_votante, estado) VALUES (:id_centro_votacion, :cedula_votante, :estado)';
    }

    private function SQL_04()
    {
        return 'INSERT INTO centros_votacion (id_parroquia, nombre_centro, estado ) VALUES (:id_parroquia, :nombre_centro, :estado )';
    }

    private function SQL_05()
    {
        return "UPDATE votantes_centro_votacion SET id_centro_votacion = :id_centro_votacion, cedula_votante = :cedula_votante, estado = :estado WHERE id_votante_centro_votacion =:id_votante_centro_votacion";
    }

    private function SQL_06()
    {
        return "SELECT p.cedula_persona,p.primer_nombre,p.primer_apellido FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }

}

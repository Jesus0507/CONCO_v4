<?php

class Grupos_Deportivos_Class extends Modelo
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
        return "INSERT INTO grupo_deportivo (id_deporte, nombre_grupo_deportivo, descripcion, estado) VALUES (:id_deporte, :nombre_grupo_deportivo, :descripcion, :estado)";
    }

    private function SQL_02()
    {
        return "UPDATE grupo_deportivo SET id_deporte = :id_deporte, nombre_grupo_deportivo = :nombre_grupo_deportivo, descripcion = :descripcion, estado = :estado WHERE id_grupo_deportivo =:id_grupo_deportivo";
    }

    private function SQL_03()
    {
        return "SELECT id_grupo_deportivo, g.id_deporte, d.nombre_deporte, g.nombre_grupo_deportivo, g.descripcion, g.estado FROM grupo_deportivo g INNER JOIN deportes d WHERE g.estado = 1 AND g.id_deporte = d.id_deporte";
    }

    private function SQL_04()
    {
        return "SELECT pg.id_persona_grupo_deportivo, pg.id_grupo_deportivo, pg.cedula_persona, p.primer_nombre, p.primer_apellido, gp.id_deporte, d.nombre_deporte FROM personas_grupo_deportivo pg, grupo_deportivo gp, personas p, deportes d WHERE pg.estado = 1 AND pg.cedula_persona = p.cedula_persona AND gp.id_deporte = d.id_deporte AND pg.id_grupo_deportivo = gp.id_grupo_deportivo ORDER BY `p`.`primer_nombre` ASC";
    }

    private function SQL_05()
    {
        return "SELECT DISTINCT pg.cedula_persona ,pg.id_persona_grupo_deportivo, pg.id_grupo_deportivo, p.primer_nombre, p.primer_apellido FROM grupo_deportivo gp, personas_grupo_deportivo pg, personas p WHERE  pg.id_grupo_deportivo = $this->id AND p.cedula_persona= pg.cedula_persona and pg.estado = 1";
    }

    private function SQL_06()
    {
        return "INSERT INTO personas_grupo_deportivo (cedula_persona, id_grupo_deportivo, estado) VALUES (:cedula_persona ,  :id_grupo_deportivo, :estado)";
    }

    private function SQL_07()
    {
        return "SELECT p.cedula_persona,p.primer_nombre,p.primer_apellido FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }

}

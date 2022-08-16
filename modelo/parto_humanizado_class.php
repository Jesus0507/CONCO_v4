<?php

class Parto_Humanizado_Class extends Modelo
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

    //=======================================================================

    private function SQL_01()
    {
        return 'SELECT id_parto_humanizado, par.cedula_persona, per.primer_nombre, per.primer_apellido, recibe_micronutrientes, tiempo_gestacion, fecha_aprox_parto FROM parto_humanizado par, personas per WHERE par.estado = 1 AND par.cedula_persona = per.cedula_persona AND per.estado = 1 ORDER BY `per`.`primer_nombre` ASC';
    }

    private function SQL_02()
    {
        return 'INSERT INTO parto_humanizado (cedula_persona, recibe_micronutrientes, tiempo_gestacion, fecha_aprox_parto, estado) VALUES (:cedula_persona , :recibe_micronutrientes, :tiempo_gestacion, :fecha_aprox_parto, :estado)';
    }

    private function SQL_03()
    {
        return 'UPDATE parto_humanizado SET cedula_persona = :cedula_persona, recibe_micronutrientes = :recibe_micronutrientes, tiempo_gestacion = :tiempo_gestacion, fecha_aprox_parto = :fecha_aprox_parto,  estado = :estado WHERE id_parto_humanizado =:id_parto_humanizado';
    }

    private function SQL_04()
    {
        return "SELECT p.cedula_persona, p.primer_nombre, p.primer_apellido, p.genero, p.estado FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }
}

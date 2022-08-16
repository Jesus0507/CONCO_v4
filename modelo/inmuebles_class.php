<?php

class Inmuebles_Class extends Modelo
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
        return "SELECT id_inmueble, nombre_inmueble, direccion_inmueble, c.id_calle, c.nombre_calle, t.id_tipo_inmueble, t.nombre_tipo, i.estado FROM inmuebles i INNER JOIN calles c, tipo_inmueble t WHERE i.estado = 1 AND i.id_calle = c.id_calle AND i.id_tipo_inmueble = t.id_tipo_inmueble";
    }

    private function SQL_02()
    {
        return "INSERT INTO inmuebles (id_calle, nombre_inmueble, direccion_inmueble , id_tipo_inmueble, estado) VALUES (:id_calle, :nombre_inmueble, :direccion_inmueble, :id_tipo_inmueble, :estado)";
    }

    private function SQL_03()
    {
        return "UPDATE inmuebles  SET id_calle = :id_calle, nombre_inmueble = :nombre_inmueble, direccion_inmueble = :direccion_inmueble, id_tipo_inmueble = :id_tipo_inmueble, estado = :estado WHERE id_inmueble = :id_inmueble";
    }


}

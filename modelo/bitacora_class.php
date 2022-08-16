<?php

class Bitacora_Class extends Modelo
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
        return 'SELECT B.*, p.cedula_persona, p.primer_nombre, p.primer_apellido FROM bitacoras B, personas p WHERE p.cedula_persona = B.cedula_usuario ORDER BY B.id_bitacora ASC';
    }

    private function SQL_02()
    {
        return 'INSERT INTO bitacoras (cedula_usuario, fecha, dia, hora_inicio, acciones, hora_fin) VALUES (:cedula_usuario, :fecha, :dia, :hora_inicio, :acciones, :hora_fin)';
    }

    private function SQL_03()
    {
        return 'UPDATE bitacoras SET hora_fin =:hora_fin WHERE id_bitacora = :id_bitacora';
    }

    private function SQL_04()
    {
        return 'UPDATE bitacoras SET acciones =:acciones WHERE id_bitacora = :id_bitacora';
    }

}
?>
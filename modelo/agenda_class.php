<?php

class Agenda_Class extends Modelo 
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
        return 'SELECT A.*, p.cedula_persona, p.primer_nombre, p.primer_apellido FROM agenda A, personas p WHERE A.creador = p.cedula_persona AND p.estado = 1 ORDER BY id_agenda ASC';
    }
    private function SQL_02()
    {
        return "INSERT INTO agenda (tipo_evento, fecha,  creador,  ubicacion, horas, detalle) VALUES (:tipo_evento,  :fecha, :creador, :ubicacion, :horas, :detalle)";
    }

    private function SQL_03()
    {
        return "UPDATE agenda  SET tipo_evento = :tipo_evento, fecha = :fecha, creador = :creador, ubicacion = :ubicacion, horas = :horas, detalle = :detalle WHERE id_agenda = :id_agenda";
    }

    private function SQL_04()
    {
        return "SELECT nombre_calle FROM calles WHERE estado=1 ORDER BY id_calle ASC";
    }

    private function SQL_05()
    {
        return "SELECT nombre_inmueble FROM inmuebles WHERE estado=1 ORDER BY id_inmueble ASC";
    }

    private function SQL_06()
    {
        return "DELETE FROM agenda WHERE id_agenda = :id_agenda";
    }

}
?>
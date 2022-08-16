<?php

class Login_Class extends Modelo
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

    public function Cerrar_Session()
    {
        session_unset();
        session_start();
        session_destroy();
        session_regenerate_id(true);
    }

    public function SQL_01()
    {
    return  "SELECT p.cedula_persona, p.primer_nombre, p.primer_apellido, p.preguntas_seguridad, p.rol_inicio FROM personas p WHERE ". $this->consultar['columna'] . "=" . $this->consultar['data'] . "";
    }

}

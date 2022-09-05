<?php
class Notificaciones_Class extends Modelo
{
    public function __construct(){parent::__construct();}

    //=======================================================================
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
            return $this->Capturar_Error($e,"Notificaciones");
        }
    }
    // ===============================================================================
    private function SQL_01()
    {
        return "INSERT INTO notificaciones (usuario_emisor, usuario_receptor, accion, leido) VALUES (:usuario_emisor, :usuario_receptor, :accion, :leido)";
    }
    private function SQL_02()
    {
        return "SELECT * FROM notificaciones WHERE usuario_receptor = $this->consultar ORDER BY id_notificacion DESC";
    }
    private function SQL_03()
    {
        return "UPDATE notificaciones SET leido =:leido WHERE id_notificacion = :id_notificacion";
    }
    private function SQL_04()
    {
        return "DELETE FROM notificaciones WHERE id_notificacion = :id_notificacion";
    }
    private function SQL_05()
    {
        return "SELECT p.cedula_persona,p.primer_nombre,p.primer_apellido FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }
}
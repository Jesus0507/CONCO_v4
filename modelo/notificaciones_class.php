<?php
class Notificaciones_Class extends Modelo
{
    public function __construct(){parent::__construct();}

    public function Registrar($data)
    {

        $accion = $data['tipo_notificacion'] . "/" . $_SESSION['nombre'] . " " . $_SESSION['apellido'] . " " . $data['accion'];

        try {
            $datos = $this->conexion->prepare('INSERT INTO notificaciones (
                usuario_emisor,
                usuario_receptor,
                accion,
                leido
                ) VALUES (
                :usuario_emisor,
                :usuario_receptor,
                :accion,
                :leido
                )');

            $datos->execute([
                'usuario_emisor'   => $_SESSION['cedula_usuario'],
                'usuario_receptor' => $data['usuario_receptor'],
                'accion'           => $accion,
                'leido'            => 0,
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    public function Consultar($cedula_receptor)
    {

        $tabla             = "SELECT * FROM notificaciones WHERE usuario_receptor = $cedula_receptor ORDER BY id_notificacion DESC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }

    }

    public function get_receptores_1()
    {

        $tabla             = "SELECT * FROM personas  WHERE estado=1";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }

    }

    public function setStatus($data)
    {

        $sql     = 'UPDATE notificaciones SET leido =:leido WHERE id_notificacion = :id_notificacion';
        $arreglo = '';

        try {

            $datos = $this->conexion->prepare($sql);

            $datos->execute([
                'leido'           => $data['leido'],
                'id_notificacion' => $data['id_notificacion'],
            ]);

            return true;

        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function Eliminar($param)
    {
        try {

            $query = $this->conexion->prepare('DELETE FROM notificaciones WHERE id_notificacion = :id_notificacion');
            $query->execute(['id_notificacion' => $param]);

            return true;

        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }
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
}

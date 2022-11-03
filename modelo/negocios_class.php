<?php

class Negocios_Class extends Modelo
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.
    private $SQL;
    private $tipo;
    private $PDO;
    private $sentencia;
    private $datos;

    public  $resultado;

    public function __construct()
    {
        parent::__construct();
    }

    public function _SQL_(string $SQL)
    {
        $this->SQL = $SQL;
    }
    public function _Tipo_(int $tipo)
    {
        $this->tipo = $tipo;
    }
    public function _Datos_(array $datos)
    {
        $this->datos = $datos;
    }
    public function _Estado_($estado)
    {
         $this->estado = $estado;
    }
    public function Administrar()
    {
        $this->sentencia = $this->{$this->SQL}();
        try {
            switch ($this->tipo) {
                case '0':
                    $this->conexion->beginTransaction();
                    $this->PDO = $this->conexion->prepare($this->sentencia);
                    $this->PDO->execute();
                    $this->conexion->commit();
                    $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
                    $this->resultado = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
                    return $this->resultado;
                    break;
                case '1':
                    $this->conexion->beginTransaction();
                    $this->PDO = $this->conexion->prepare($this->sentencia);
                    $this->PDO->execute($this->datos);
                    $this->conexion->commit();
                    return true;
                    break;
                default:
                    die('[Error 400] => "La Peticion es Incorrecta, solo se permite peticion de tipo 0/1."');
                    break;
            }
        } catch (PDOException $e) {
            return $this->Capturar_Error($e, "Negocios");
        }
    }

    // ===============================================================================

    private function SQL_01()
    {
        return "SELECT id_negocio, nombre_negocio, direccion_negocio, cedula_propietario, rif_negocio, c.id_calle, c.nombre_calle, n.estado FROM negocios n INNER JOIN calles c WHERE n.estado = 1 AND n.id_calle = c.id_calle";
    }

    private function SQL_02()
    {
        return 'INSERT INTO negocios (id_calle, nombre_negocio, direccion_negocio, cedula_propietario, rif_negocio, estado) VALUES (:id_calle, :nombre_negocio, :direccion_negocio, :cedula_propietario, :rif_negocio, :estado)';
    }

    private function SQL_03()
    {
        return "UPDATE negocios  SET id_calle = :id_calle, nombre_negocio = :nombre_negocio, direccion_negocio = :direccion_negocio, cedula_propietario = :cedula_propietario, rif_negocio = :rif_negocio,estado = :estado WHERE id_negocio = :id_negocio";
    }

    private function SQL_04()
    {
        return "SELECT p.cedula_persona,p.primer_nombre,p.primer_apellido FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }
}

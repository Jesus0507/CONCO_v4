<?php

class Centro_Votacion_Class extends Modelo
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.

    private $SQL;           #nombre de la sentencia SQL que se ejecutara en el modelo
    private $tipo;          #tipo de peticion que usaremos 1/0
    private $PDO;           #sentecia sql iniciada con prepare
    private $sentencia;     #sentencia sql que se ejecutara
    private $datos;         #datos a ejecutar para enviar a la bd

    public  $resultado;     #resultado de consultas de la bd

    public function __construct(){parent::__construct();}

    // SETTER estaablece los datos a usar en el modelo (tipo void no retornan un valor)
    public function _SQL_(string $SQL): void        {$this->SQL = $SQL;}
    public function _Tipo_(int $tipo): void         {$this->tipo = $tipo;}
    public function _Datos_(array $datos): void     {$this->datos = $datos;}
    public function _Estado_(array $estado): void   {$this->estado = $estado;}

    public function Administrar()
    {
        $this->sentencia = $this->{$this->SQL}(); #funcion anonima en espera de asignar nombre
        try {
            switch ($this->tipo) {
                case '0':           #tipo 0 trae consultas de la bd retorna a un array con los datos 
                    $this->conexion->beginTransaction(); # Inicia una transacción
                    $this->PDO = $this->conexion->prepare($this->sentencia);
                     $this->PDO->execute();
                    $this->conexion->commit(); #Consigna una transacción
                    $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
                    $this->resultado = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
                    return $this->resultado;
                    break;
                case '1':       #tipo 1 ejecuta un INSERT , UPDATE, DELETE  retorna a true (si no hay falla)
                    $this->conexion->beginTransaction();
                    $this->PDO = $this->conexion->prepare($this->sentencia);
                    $this->PDO->execute($this->datos);
                    $this->conexion->commit();
                    return true;   
                    break;
                default:        # mensaje error si la peticion fue incorrecta
                    die('[Error 400] => "La Peticion es Incorrecta, solo se permite peticion de tipo 0/1."');
                    break;
            }
        } catch (PDOException $e) { #capturamos el error y se envia la respuesta(ubicacion MODELO)
            return $this->Capturar_Error($e, "Centro_Votacion"); 
        }
    }

    // ===============================================================================
 
    private function SQL_01():string
    {
        return "SELECT * FROM  centros_votacion WHERE estado = 1"; 
    }

    private function SQL_02():string
    {
        return "SELECT v.id_votante_centro_votacion, p.cedula_persona, p.primer_nombre, p.primer_apellido, c.id_centro_votacion, c.nombre_centro, par.id_parroquia, par.nombre_parroquia, v.estado FROM votantes_centro_votacion v INNER JOIN centros_votacion c, parroquias par, personas p WHERE v.estado = 1 AND v.id_centro_votacion = c.id_centro_votacion AND c.id_parroquia = par.id_parroquia AND v.cedula_votante = p.cedula_persona ORDER BY `c`.`nombre_centro` ASC";
    }

    public function SQL_03():string
    {
        return 'INSERT INTO votantes_centro_votacion (id_centro_votacion, cedula_votante, estado) VALUES (:id_centro_votacion, :cedula_votante, :estado)';
    }

    private function SQL_04():string
    {
        return 'INSERT INTO centros_votacion (id_parroquia, nombre_centro, estado ) VALUES (:id_parroquia, :nombre_centro, :estado )';
    }

    private function SQL_05():string
    {
        return "UPDATE votantes_centro_votacion SET id_centro_votacion = :id_centro_votacion, cedula_votante = :cedula_votante, estado = :estado WHERE id_votante_centro_votacion =:id_votante_centro_votacion";
    }

    private function SQL_06():string
    {
        return "SELECT p.cedula_persona,p.primer_nombre,p.primer_apellido FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }

    private function SQL_07():string
    {
        return "SELECT * FROM votantes_centro_votacion WHERE estado = 1";
    }

}

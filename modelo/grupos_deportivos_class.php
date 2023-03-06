<?php

class Grupos_Deportivos_Class extends Modelo
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
    public function _ID_(string $id): void          {$this->id = $id;}
    
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
            return $this->Capturar_Error($e, "Grupos_Deportivos"); 
        }
    }

    // ===============================================================================

    #sentecias sql en espera de ser llamadas retornan string

    private function SQL_01():string
    {
        return "INSERT INTO grupo_deportivo (id_deporte, nombre_grupo_deportivo, descripcion, estado) VALUES (:id_deporte, :nombre_grupo_deportivo, :descripcion, :estado)";
    }

    private function SQL_02():string
    {
        return "UPDATE grupo_deportivo SET id_deporte = :id_deporte, nombre_grupo_deportivo = :nombre_grupo_deportivo, descripcion = :descripcion, estado = :estado WHERE id_grupo_deportivo =:id_grupo_deportivo";
    }

    private function SQL_03():string
    {
        return "SELECT id_grupo_deportivo, g.id_deporte, d.nombre_deporte, g.nombre_grupo_deportivo, g.descripcion, g.estado FROM grupo_deportivo g INNER JOIN deportes d WHERE g.estado = 1 AND g.id_deporte = d.id_deporte";
    }

    private function SQL_04():string
    {
        return "SELECT pg.id_persona_grupo_deportivo, pg.id_grupo_deportivo, pg.cedula_persona, p.primer_nombre, p.primer_apellido, gp.id_deporte, d.nombre_deporte FROM personas_grupo_deportivo pg, grupo_deportivo gp, personas p, deportes d WHERE pg.estado = 1 AND pg.cedula_persona = p.cedula_persona AND gp.id_deporte = d.id_deporte AND pg.id_grupo_deportivo = gp.id_grupo_deportivo ORDER BY `p`.`primer_nombre` ASC";
    }

    private function SQL_05():string
    {
        return "SELECT DISTINCT pg.cedula_persona ,pg.id_persona_grupo_deportivo, pg.id_grupo_deportivo, p.primer_nombre, p.primer_apellido FROM grupo_deportivo gp, personas_grupo_deportivo pg, personas p WHERE  pg.id_grupo_deportivo = $this->id AND p.cedula_persona= pg.cedula_persona and pg.estado = 1";
    }

    private function SQL_06():string
    {
        return "INSERT INTO personas_grupo_deportivo (cedula_persona, id_grupo_deportivo, estado) VALUES (:cedula_persona ,  :id_grupo_deportivo, :estado)";
    }

    private function SQL_07():string
    {
        return "SELECT p.cedula_persona,p.primer_nombre,p.primer_apellido FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }

}

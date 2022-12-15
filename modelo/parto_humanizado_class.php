<?php

class Parto_Humanizado_Class extends Modelo 
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
            return $this->Capturar_Error($e, "Negocios"); 
        }
    }

    //=======================================================================

    private function SQL_01():string
    {
        return 'SELECT id_parto_humanizado, par.cedula_persona, per.primer_nombre, per.primer_apellido, recibe_micronutrientes, tiempo_gestacion, fecha_aprox_parto FROM parto_humanizado par, personas per WHERE par.estado = 1 AND par.cedula_persona = per.cedula_persona AND per.estado = 1 ORDER BY `per`.`primer_nombre` ASC';
    }

    private function SQL_02():string
    {
        return 'INSERT INTO parto_humanizado (cedula_persona, recibe_micronutrientes, tiempo_gestacion, fecha_aprox_parto, estado) VALUES (:cedula_persona , :recibe_micronutrientes, :tiempo_gestacion, :fecha_aprox_parto, :estado)';
    }

    private function SQL_03():string
    {
        return 'UPDATE parto_humanizado SET cedula_persona = :cedula_persona, recibe_micronutrientes = :recibe_micronutrientes, tiempo_gestacion = :tiempo_gestacion, fecha_aprox_parto = :fecha_aprox_parto,  estado = :estado WHERE id_parto_humanizado =:id_parto_humanizado';
    }

    private function SQL_04():string
    {
        return 'SELECT p.cedula_persona, p.primer_nombre, p.primer_apellido, p.genero, p.estado FROM personas p WHERE p.estado = 1 AND p.genero = "F" ORDER BY p.cedula_persona ASC';
    }
}

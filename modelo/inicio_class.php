<?php

class Inicio_Class extends Modelo
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.

    private $SQL; #nombre de la sentencia SQL que se ejecutara en el modelo
    private $tipo; #tipo de peticion que usaremos 1/0
    private $PDO; #sentecia sql iniciada con prepare
    private $sentencia; #sentencia sql que se ejecutara
    private $datos; #datos a ejecutar para enviar a la bd

    public $resultado; #resultado de consultas de la bd

    public function __construct()
    {parent::__construct();}

    // SETTER estaablece los datos a usar en el modelo (tipo void no retornan un valor)
    public function _SQL_(string $SQL): void
    {$this->SQL = $SQL;}
    public function _Tipo_(int $tipo): void
    {$this->tipo = $tipo;}

    public function Administrar()
    {
        $this->sentencia = $this->{$this->SQL}(); #funcion anonima en espera de asignar nombre
        try {
            switch ($this->tipo) {
                case '0': #tipo 0 trae consultas de la bd retorna a un array con los datos
                    $this->conexion->beginTransaction(); # Inicia una transacción
                    $this->PDO = $this->conexion->prepare($this->sentencia);
                    $this->PDO->execute();
                    $this->conexion->commit(); #Consigna una transacción
                    $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
                    $this->resultado = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
                    return $this->resultado;
                    break;
                case '1': #tipo 1 ejecuta un INSERT , UPDATE, DELETE  retorna a true (si no hay falla)
                    $this->conexion->beginTransaction();
                    $this->PDO = $this->conexion->prepare($this->sentencia);
                    $this->PDO->execute($this->datos);
                    $this->conexion->commit();
                    return true;
                    break;
                // case '2':
                //     $this->parametros = array(
                //         'columna'    => ":cedula_persona",
                //         'parametros' => "26142326",
                //         'tipo'       => PDO::PARAM_INT,
                //         'longitud'   => 8,
                //     );

                //     $this->conexion->beginTransaction();
                //     $this->PDO = $this->conexion->prepare($this->sentencia);

                //     foreach ($this->parametros as $key) {
                //         $this->PDO->bindParam($key["columna"], $key["parametros"], $key["tipo"], $key["longitud"]);
                //     }

                //     $this->PDO->execute();
                //     $this->conexion->commit();
                //     break;

                default: # mensaje error si la peticion fue incorrecta
                    die('[Error 400] => "La Peticion es Incorrecta, solo se permite peticion de tipo 0/1."');
                    break;
            }
        } catch (PDOException $e) {
            #capturamos el error y se envia la respuesta(ubicacion MODELO)
            return $this->Capturar_Error($e, "Inicio");
        }
    }

    private function SQL_01(): string
    {
        return "SELECT p.cedula_persona, p.fecha_nacimiento FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }

}

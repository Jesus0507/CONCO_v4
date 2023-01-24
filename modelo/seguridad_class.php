<?php

class Seguridad_Class extends Modelo 
{ 
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.

    private $SQL;           #nombre de la sentencia SQL que se ejecutara en el modelo
    private $tipo;          #tipo de peticion que usaremos 1/0
    private $PDO;           #sentecia sql iniciada con prepare
    private $sentencia;     #sentencia sql que se ejecutara
    private $datos;         #datos a ejecutar para enviar a la bd
    public  $resultado;     #resultado de consultas de la bd
    private $id;

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
                case '2':           #tipo 0 trae consultas de la bd retorna a un array con los datos 
                    $this->conexion->beginTransaction(); # Inicia una transacción
                    $this->PDO = $this->conexion->prepare($this->sentencia);
                    $this->PDO->execute($this->datos);
                    $this->conexion->commit(); #Consigna una transacción
                    $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
                    $this->resultado = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
                    return $this->resultado;
                    break;

                default:        # mensaje error si la peticion fue incorrecta
                    die('[Error 400] => "La Peticion es Incorrecta, solo se permite peticion de tipo 0/1."');
                    break;
            }
        } catch (PDOException $e) { #capturamos el error y se envia la respuesta(ubicacion MODELO)
            return $this->Capturar_Error($e, "Seguridad"); 
        }
    }

    // ===============================================================================

    #sentecias sql en espera de ser llamadas retornan string
    private function SQL_01():string
    {
        return "SELECT * FROM roles_permisos_modulo WHERE rol = :rol";
    }

    private function SQL_02():string
    {
        return "SELECT * FROM personas order by primer_nombre";
    }

    private function SQL_03():string
    {
        return "SELECT  PUM.* , M.nombre FROM permisos_usuario_modulo PUM , modulos M WHERE PUM.cedula_usuario = $this->id AND M.id_modulo = PUM.id_modulo";
    }

    private function SQL_04():string
    {
        return "UPDATE roles_permisos_modulo SET $this->id = :$this->id WHERE rol = :rol AND id_modulo = :id_modulo";
    }

    private function SQL_05():string
    {
        return "UPDATE personas SET rol_inicio = :rol_inicio ,contrasenia = :contrasenia WHERE cedula_persona = :cedula_usuario";
    }

    private function SQL_06():string
    {
        return "UPDATE personas SET estado=:estado  WHERE cedula_persona = :cedula_persona";
    }

    private function SQL_07():string
    {
        return "UPDATE permisos_usuario_modulo SET registrar = :registrar, consultar = :consultar, modificar = :modificar, eliminar  = :eliminar WHERE cedula_usuario = :cedula_usuario AND  id_modulo = :id_modulo";
    }

    // ===============================================================================

}

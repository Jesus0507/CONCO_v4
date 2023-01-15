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
        return "SELECT * FROM roles_permisos_modulo WHERE rol = $this->id";
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
        return "UPDATE roles_permisos_modulo SET $this->id = :permiso WHERE rol = :rol AND id_modulo = :id_modulo";
    }

    private function SQL_05():string
    {
        return "UPDATE personas SET rol_inicio=:rol_inicio ,contrasenia = :contrasenia WHERE cedula_persona = :cedula_usuario";
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
    public function get_permisos_rol($rol)
    {

        $tabla = "SELECT * FROM roles_permisos_modulo WHERE rol=:rol";

        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute([
                "rol" => $rol,
            ]);
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {
            return $this->Capturar_Error($e,"Seguridad");
        }
    }

    public function consultar_personas_seguridad()
    {

        $tabla = "SELECT * FROM personas order by primer_nombre";

        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {
            return $this->Capturar_Error($e,"Seguridad");
        }
    }

    public function get_permisos($cedula)
    {

        $tabla = "SELECT  PUM.* , M.nombre FROM permisos_usuario_modulo PUM , modulos M WHERE PUM.cedula_usuario = $cedula AND M.id_modulo = PUM.id_modulo";

        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function change_permiso($data)
    {
        $campo = $data['campo'];

        $sql     = 'UPDATE roles_permisos_modulo SET ' . $campo . ' = :permiso WHERE rol = :rol AND id_modulo = :id_modulo';
        $arreglo = '';

        try {

            $datos = $this->conexion->prepare($sql);

            $datos->execute([
                'permiso'   => $data['permiso'],
                'rol'       => $data['rol'],
                'id_modulo' => $data['modulo'],
            ]);

            return true;

        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Seguridad");
        }
    }

    public function change_roles($data)
    {

        $sql     = 'UPDATE personas SET rol_inicio=:rol_inicio ,contrasenia = :contrasenia WHERE cedula_persona = :cedula_usuario';
        $arreglo = '';

        try {

            $datos = $this->conexion->prepare($sql);

            $datos->execute([
                'rol_inicio'     => $data['rol'],
                'cedula_usuario' => $data['cedula_usuario'],
                'contrasenia'    => $data['contrasenia'],
            ]);

            return true;

        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Seguridad");
        }
    }

    public function cambio_estado($data)
    {

        $sql     = 'UPDATE personas SET estado=:estado  WHERE cedula_persona = :cedula_persona';
        $arreglo = '';

        try {

            $datos = $this->conexion->prepare($sql);

            $datos->execute([
                'cedula_persona' => $data['cedula_persona'],
                'estado'         => $data['estado'],
            ]);

            return true;

        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Seguridad");
        }
    }

    public function cambiar_permisos_rol($data)
    {

        $ejecucion = false;

        if ($data['rol'] == "Super Usuario") {

            for ($i = 1; $i < 17; $i++) {
                try {
                    $datos = $this->conexion->prepare('UPDATE permisos_usuario_modulo SET
                        registrar = :registrar,
                        consultar = :consultar,
                        modificar = :modificar,
                        eliminar  = :eliminar
                        WHERE
                        cedula_usuario = :cedula_usuario AND  id_modulo = :id_modulo');

                    $datos->execute([
                        'cedula_usuario' => $data['cedula_usuario'],
                        'id_modulo'      => $i,
                        'registrar'      => 1,
                        'consultar'      => 1,
                        'modificar'      => 1,
                        'eliminar'       => 1,
                    ]);

                    $ejecucion = true;
                } catch (PDOException $e) {
                    $this->error = 'Ha surgido un error y no se puede cargar los datos. Detalle: ' . $e->getMessage();
                    $ejecucion   = $e->getMessage();
                }
            }

        } else {

            if ($data['rol'] == 'Administrador') {

                for ($i = 1; $i < 17; $i++) {
                    if ($i != 1 && $i != 16) {
                        $permiso = 1;
                    } else {
                        $permiso = 0;
                    }
                    try {
                        $datos = $this->conexion->prepare('UPDATE permisos_usuario_modulo SET
                        registrar = :registrar,
                        consultar = :consultar,
                        modificar = :modificar,
                        eliminar  = :eliminar
                        WHERE
                        cedula_usuario = :cedula_usuario AND  id_modulo = :id_modulo');

                        $datos->execute([
                            'cedula_usuario' => $data['cedula_usuario'],
                            'id_modulo'      => $i,
                            'registrar'      => $permiso,
                            'consultar'      => $permiso,
                            'modificar'      => $permiso,
                            'eliminar'       => 0,
                        ]);

                        $ejecucion = true;
                    } catch (PDOException $e) {
                        $this->error = 'Ha surgido un error y no se puede cargar los datos. Detalle: ' . $e->getMessage();
                        $ejecucion   = $e->getMessage();
                    }
                }
            } else {
                for ($i = 1; $i < 17; $i++) {
                    if ($i == 2 || $i == 9 || $i == 12 || $i == 3) {
                        $permiso = 1;
                    } else {
                        $permiso = 0;
                    }
                    try {
                        $datos = $this->conexion->prepare('UPDATE permisos_usuario_modulo SET
                        registrar = :registrar,
                        consultar = :consultar,
                        modificar = :modificar,
                        eliminar  = :eliminar
                        WHERE
                        cedula_usuario = :cedula_usuario AND  id_modulo = :id_modulo');

                        $datos->execute([
                            'cedula_usuario' => $data['cedula_usuario'],
                            'id_modulo'      => $i,
                            'registrar'      => $permiso,
                            'consultar'      => $permiso,
                            'modificar'      => 0,
                            'eliminar'       => 0,
                        ]);

                        $ejecucion = true;
                    } catch (PDOException $e) {
                        $this->error = 'Ha surgido un error y no se puede cargar los datos. Detalle: ' . $e->getMessage();
                        $ejecucion   = $e->getMessage();
                    }
                }
            }
        }

        return $ejecucion;

    }

}

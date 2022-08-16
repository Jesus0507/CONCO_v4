<?php
// =============CONTROLADOR=========
class Controlador
{

    public function __construct()
    {
        $this->Cargar_Vista();
        $this->conexion = new BASE_DATOS();
    }

    public function Cargar_Controlador($nombre)
    {
        $controlador = 'controlador/' . $nombre . '_controlador.php';
        require_once $controlador;

        $this->controlador = new $nombre();
    }

    public function Cargar_Modelo($model)
    {
        $url = 'modelo/' . $model . '_class.php';

        if (file_exists($url)) {
            require $url;

            $modelName       = $model . '_Class';
            $reflectionClass = new ReflectionClass($modelName);

            if ($reflectionClass->IsInstantiable()) {
                $this->modelo = new $modelName();
            } else {
                $this->error = '[Error Objeto] => "El Objeto: [ ' . $modelName . ' ] No puede ser Instanciado."';
                return $this->Capturar_Error($this->error);
            }
        }
    }
    public function Cargar_Vista()
    {
        $this->vista = new Vista();
    }
    public function Seguridad_de_Session()
    {
        @session_start();
        $var = $_SESSION['cedula_usuario'];
        if ($var == null || $var == '') {
            session_start();
            session_destroy();
            $this->vista->Cargar_Vistas('error/403');
            die();
        }
    }

    public function Codificar($string)
    {
        $codec = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $codec = $codec . base64_encode($string[$i]) . "#";
        }
        $string = base64_encode(base64_encode($codec));
        $string = base64_encode($string);
        return $string;
    }

    public function Decodificar($string)
    {
        $decodec = '';
        $string  = base64_decode(base64_decode($string));
        $string  = base64_decode($string);
        $string  = explode("#", $string);

        foreach ($string as $str) {
            $decodec = $decodec . base64_decode($str);
        }
        return $decodec;
    }

    public function Escribir_JSON($array)
    {
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
    }

    //===========================CRUD GENERAL===================================

    public function Consultar_Tabla($tabla, $estado, $orden)
    {

        $sql               = "SELECT * FROM  $tabla where estado = $estado ORDER BY $orden ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($sql);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            $errorReturn = ['estatus' => false];
            $errorReturn += ['info' => "error sql:{$e}"];
            return $errorReturn;
        }
    }

    public function Consultar_Tabla_sin_estado($tabla, $estado, $orden)
    {

        $sql               = "SELECT * FROM  $tabla  ORDER BY $orden ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($sql);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            $errorReturn = ['estatus' => false];
            $errorReturn += ['info' => "error sql:{$e}"];
            return $errorReturn;
        }
    }

    public function Consultar_Columna($tabla, $columna, $param)
    {

        $tabla = "SELECT * FROM " . $tabla . " WHERE " . $columna . "=" . $param . "";

        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {
            $errorReturn = ['estatus' => false];
            $errorReturn += ['info' => "error sql:{$e}"];
            return $errorReturn;
        }
    }

    public function Registrar_Tablas($tabla, $columna, $data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO ' . $tabla . '(' . $columna . ', estado) VALUES (:' . $columna . ', :estado)');
            $datos->execute([
                $columna => $data,
                'estado' => 1,
            ]);

            return true;

        } catch (PDOException $e) {
            $this->error = 'Ha surgido un error y no se puede cargar los datos. Detalle: ' . $e->getMessage();
            return false;
        }
    }

    public function Eliminar_Tablas($tabla, $id_tabla, $param)
    {
        try {

            $query = $this->conexion->prepare('DELETE FROM ' . $tabla . ' WHERE ' . $id_tabla . ' = :' . $id_tabla . '');
            $query->execute([$id_tabla => $param]);

            return true;

        } catch (PDOException $e) {

            echo $e->getMessage();
            return false;
        }
    }

    public function Actualizar_Tablas($tabla, $columna, $id_tabla, $data, $param)
    {

        try {
            $query = $this->conexion->prepare("UPDATE " . $tabla . " SET " . $columna . " = :" . $columna . " WHERE " . $id_tabla . " =:" . $id_tabla . "");

            $query->execute([
                $columna  => $data,
                $id_tabla => $param,
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    public function Ultimo_Ingresado($tabla, $id)
    {
        $tabla            = "SELECT MAX(" . $id . ") FROM " . $tabla . "";
        $respuestaArreglo = '';

        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {

            $errorReturn = ['estatus' => false];
            $errorReturn += ['info' => "error sql:{$e}"];
            return $errorReturn;
        }
    }

    //===========================ELIMINACION LOGICA===================================

    public function Activar($tabla, $id_tabla, $param)
    {

        try {
            $query = $this->conexion->prepare('UPDATE ' . $tabla . ' SET estado = :estado WHERE ' . $id_tabla . ' = :' . $id_tabla . '');
            $query->execute([
                $id_tabla => $param,
                'estado'  => 1,
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function Desactivar($tabla, $id_tabla, $param)
    {

        try {
            $query = $this->conexion->prepare('UPDATE ' . $tabla . ' SET estado = :estado WHERE ' . $id_tabla . ' = :' . $id_tabla . '');
            $query->execute([
                $id_tabla => $param,
                'estado'  => 0,
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function Accion($accion)
    {

        $this->Cargar_Modelo("bitacora");
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("SQL", "SQL_01");

        foreach ($this->modelo->Administrar() as $b) {
            if ($b['cedula_usuario'] == $_SESSION['cedula_usuario'] && $b['hora_fin'] == "Activo") {
                $b['acciones'] = $b['acciones'] . $accion . "/";

                $this->modelo->__SET("tipo", "1");
                $this->modelo->__SET("SQL", "SQL_04");

                $this->modelo->Datos(["acciones" => $b['acciones'], "id_bitacora" => $b['id_bitacora']]);

                if ($this->modelo->Administrar()) {$this->mensaje = 1;}
            }
        }

    }
    public function ERROR()
    {
        return $this->modelo->error;
    }

    private function Capturar_Error()
    {
        $error_log          = new stdClass();
        $error_log->Fecha   = $GLOBALS['fecha_larga'];
        $error_log->Hora    = date('h:i:s a');
        $error_log->Mensaje = $this->error;
        error_log(print_r($error_log, true), 3, "errores.log");
        die($this->error);
    }

}

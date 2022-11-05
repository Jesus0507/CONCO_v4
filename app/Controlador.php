<?php
// =============CONTROLADOR=========
class Controlador
{  
    #Public: acceso sin restricción.
    #Protected:Solo puede ser accesado por una clase heredada y la clase que lo define.
    #Private:Solo puede ser accesado por la clase que lo define. 
    protected $controlador;
    protected $modelo;
    protected $vista;
    protected $validacion;


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
    public function Validacion($modulo)
    {
        $url = 'controlador/backend/' . $modulo . '_validacion.php';

        if (file_exists($url)) {
            require $url;

            $modelName       = ucfirst($modulo) . '_Validacion';
            $reflectionClass = new ReflectionClass($modelName);

            if ($reflectionClass->IsInstantiable()) {
                $this->validacion = new $modelName();

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
            $this->_403_();
        }
    }

    public function _403_()
    {
        die($this->vista->Cargar_Vistas('error/403'));
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

    public function Seguridad_Password($string, $accion = null)
    {
        $codec   = '';
        $decodec = '';
        $base62 = new Tuupola\Base62;

        if ($accion === 1) {
            for ($i = 0; $i < strlen($string); $i++) {
                $codec = $codec . base64_encode($string[$i]) . "#";
            }
            $string = base64_encode(base64_encode(base64_encode($codec)));
            $salida = $base62->encode($string);
        } else if ($accion === 0) {
            $string = $base62->decode($string);
            $string = base64_decode(base64_decode(base64_decode($string)));
            $string = explode("#", $string);

            foreach ($string as $str) {
                $decodec = $decodec . base64_decode($str);
            }
            $salida = filter_var($decodec, FILTER_SANITIZE_STRING);
        }
        return $salida;
        unset($codec, $decodec, $base62, $string, $accion, $salida);
    }

    public function GenerateRSAKeys($keys)
    {
        $bits              = [128, 160, 256, 320];
        $privateKeyWord    = $keys[array_rand($keys)];
        $publicKeyWord     = $keys[array_rand($keys)];
        $encryptValPrivate = $bits[array_rand($bits)];
        $encryptValPublic  = $bits[array_rand($bits)];

        while ($privateKeyWord == $publicKeyWord) {
            $publicKeyWord = $keys[array_rand($keys)];
        }

        while ($encryptValPrivated == $encryptValPublic) {
            $encryptValPublic = $bits[array_rand($bits)];
        }

        $hashValPrivate = hash('ripemd' . $encryptValPrivate, $privateKeyWord);
        $hashValPublic  = hash('ripemd' . $encryptValPrivate, $privateKeyWord);

        $privateKey = $this->Codificar($hashValPrivate);
        $publicKey  = $this->Codificar($hashValPublic);

        $encryptValPrivate = $this->EncryptBits($encryptValPrivate);
        $encryptValPublic  = $this->EncryptBits($encryptValPublic);

        $privateKey = $encryptValPrivate . '#' . $privateKey;
        $publicKey  = $encryptValPublic . '#' . $publicKey;

        $userKeys = [
            "privateKey" => $privateKey,
            "publicKey"  => $publicKey,
        ];

        return $userKeys;
    }

    public function EncryptBits($bits)
    {
        $array   = array_map('intval', str_split($bits));
        $encrypt = '';

        for ($i = 0; $i < count($array); $i++) {
            switch ($array[$i]) {
                case 1:
                    $encrypt .= '!';
                    break;
                case 2:
                    $encrypt .= 'A';
                    break;
                case 3:
                    $encrypt .= '?';
                    break;
                case 4:
                    $encrypt .= 'M';
                    break;
                case 5:
                    $encrypt .= 'Z';
                    break;
                case 6:
                    $encrypt .= '@';
                    break;
                case 7:
                    $encrypt .= '<';
                    break;
                case 8:
                    $encrypt .= '>';
                    break;
                case 9:
                    $encrypt .= 'B';
                    break;
                default:
                    $encrypt .= 'X';
                    break;
            }
        }
        return $encrypt;
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

    public function validKeys($public, $private)
    {
        $sql               = "SELECT * FROM  personas where public_key = $public OR private_key = $private";
        $respuesta_arreglo = '';
        $resp              = false;
        try {
            $datos = $this->conexion->prepare($sql);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            if (count($respuesta_arreglo) == 2) {
                $resp = true;
            }
            return $resp;
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
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_01");
        foreach ($this->modelo->Administrar() as $b) {
            if ($b['cedula_usuario'] == $_SESSION['cedula_usuario'] && $b['hora_fin'] == "Activo") {
                $b['acciones'] = $b['acciones'] . $accion . "/";

                $this->modelo->_Tipo_(1);
                $this->modelo->_SQL_("SQL_04");
                $this->modelo->_Datos_(["acciones" => $b['acciones'], "id_bitacora" => $b['id_bitacora']]);
                if ($this->modelo->Administrar()) {return true;}
            }
        }
        
    }

    public function Ejecutar_Sentencia()
    {
        $this->modelo->_SQL_($_POST['sql']);
        $this->modelo->_Tipo_(1);
        if ($this->modelo->Administrar()) {
            $this->mensaje = 1;
            $this->Accion($_POST['accion']);
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

    public function Ver_Array($value)
    {
        echo "<pre>";
        echo var_dump($value);
        echo "</pre>";
    }

}

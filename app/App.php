<?php

final class Iniciar_Sistema
{
    private $url;
    private $error;
    private $parametros;
    private $controlador;
    private $directorrio;
    private $archivo_controlador;

    public function __construct()
    {
        session_start();
        $this->Errores = new Errores;

        $this->url = isset($_GET['url']) ? $_GET['url'] : null;
        $this->url = rtrim($this->url, '/');
        $this->url = explode('/', $this->url);

        $this->archivo_controlador = 'controlador/' . strtolower($this->url[0]) . '_controlador.php';

        if (isset($_SESSION['cedula_usuario'])) {
            if ($this->Validar_Direccion()) {
                if ($this->Validar_Conexion()) {
                    if (empty($this->url[0])) {
                        require_once 'controlador/inicio_controlador.php';
                        $this->controlador = new Inicio();
                        $this->controlador->Cargar_Modelo('inicio');
                        $this->controlador->Inicio();
                    } else {
                        if ($this->Validar_URL()) {
                            if ($this->Validar_Archivos() || $this->Validar_Controlador() || $this->Validar_Modelo()) {
                                $this->Cargar_Controladores();
                                $N_parametors = sizeof($this->url);
                                if ($N_parametors > 1) {
                                    if ($N_parametors > 2) {
                                        $parametros = [];
                                        for ($i = 2; $i < $N_parametors; $i++) {
                                            array_push($parametros, $this->url[$i]);
                                        }
                                        $this->parametros = $parametros;
                                        if ($this->Validar_Funcion() == true) {
                                            $this->controlador->{$this->url[1]}($this->parametros);
                                        } else {
                                            $this->Errores->Error_409($this->error);
                                        }
                                    } else {
                                        $this->Cargar_Funciones();
                                    }
                                } else {
                                    $this->controlador->Cargar_Vistas();
                                }
                            } else {
                                $this->Errores->Error_404($this->error);
                                $this->Guardar_Error();
                            }
                        } else {
                            $this->Errores->Error_404($this->error);
                        }
                    }
                } else {
                    $this->Errores->Error_500($this->error);
                }
            } else {
                $this->Errores->Error_404_1($this->error);
            }
        } else {
            if ($this->Validar_Direccion()) {
                if ($this->Validar_Conexion()) {
                    if (file_exists($this->archivo_controlador)) {
                        $this->Cargar_Controladores();
                        if (isset($this->url[1])) {
                            $this->Cargar_Funciones();
                        } else {
                            $this->controlador->Cargar_Vistas();
                        }
                    } else {
                        require_once 'controlador/login_controlador.php';
                        $this->controlador = new Login();
                        $this->controlador->Cargar_Modelo('login');
                        if (isset($this->url[1])) {
                            $this->controlador->{$this->url[1]}();
                        } else {
                            $this->controlador->Administrar(["Login"]);
                        }
                    }
                } else {
                    $this->Errores->Error_500($this->error);
                }
            } else {
                $this->Errores->Error_404_1($this->error);
            }
        }
    }
    public function Establecer_Directorio()
    {
        $this->directorrio = rtrim(getcwd(), '\\');
        $this->directorrio = explode('\\', $this->directorrio);
        $this->directorrio = end($this->directorrio);
        return $this->directorrio;
    }

    public function Cargar_Controladores()
    {
        require_once $this->archivo_controlador;
        $this->controlador = new $this->url[0];
        $this->controlador->Cargar_Modelo($this->url[0]);
        return true;
    }
    public function Cargar_Funciones()
    {
        if ($this->Validar_Funcion() == true) {
            $this->controlador->{$this->url[1]}();
        } else {
            $this->Errores->Error_409($this->error);
        }
        return true;
    }

    private function Validar_Archivos()
    {
        if (!file_exists($this->archivo_controlador)) {
            $this->error[] = '[Error Archivo] => "El Archivo: [ ' . $this->archivo_controlador . ' ] No Existe."';
            return false;
        } else {
            return true;
        }
    }
    private function Validar_Controlador()
    {
        $controlador = ucfirst($this->url[0]);
        if (!class_exists($controlador)) {
            $this->error[] = '[Error Controlador] => "El Controlador: [ ' . $controlador . ' ] No se encuentra definido."';
            return false;
        } else {
            return true;
        }
    }
    private function Validar_Modelo()
    {
        $modelo = ucfirst($this->url[0] . "_Class");
        if (!class_exists($modelo)) {
            $this->error[] = '[Error Modelo] => "El Modelo: [ ' . $modelo . ' ] No se encuentra definido."';
            return false;
        } else {
            return true;
        } 
    }
    private function Validar_Funcion()
    {
        $reflector = new ReflectionClass($this->url[0]);
        if (!$reflector->hasMethod($this->url[1])) {
            $this->error[] = '[Error Funcion] => "La Funcion: [ ' . $this->url[1] . '() ] No se encuentra definida, en el controlador: [ ' . $this->url[0] . ' ]"';
            $this->Guardar_Error();
            return false;
        } else {
            return true;
        }
    }
    private function Validar_URL()
    {
        $url = preg_match_all("/^[a-zA-Z0-9\/_]{1,700}$/", $_GET['url']);
        if (!$url == 1) {
            $this->error[] = '[Error Url] => "La URL: [ ' . URL . $_GET['url'] . ' ] </br> No es una direccion valida."';
            return false;
        } else {
            return true;
        }
    }
    private function Validar_Direccion()
    {
        $this->directorrio = str_replace(" ", "%20", $this->Establecer_Directorio());
        if (SISTEMA == $this->directorrio) {
            return true;
        } else {
            $this->error[] = '[Error Direccion] => "El Directorrio: [ ' . $this->directorrio . ' ] Es diferente a la configuracion del sistema,</br>
            Configuracion: [' . SISTEMA . ']. </br>
            Actualice la configuracion en el archivo: app/Config.php </br>
            Linea: ( 3 )';
            $this->Guardar_Error();
            return false;
        }
    }
    private function Validar_Conexion()
    {
        $conexion = new BASE_DATOS();
        if (!$conexion->comprobar == 1) {
            $this->error[] = $conexion->error_conexion;
            return false;
        } else {
            return true;
        }
    }
    private function Guardar_Error()
    {
        $error_log          = new stdClass();
        $error_log->Fecha   = $GLOBALS['fecha_larga'];
        $error_log->Hora    = date('h:i:s a');
        $error_log->Mensaje = $this->error;
        error_log(print_r($error_log, true), 3, "errores.log"); 
    }
     
}

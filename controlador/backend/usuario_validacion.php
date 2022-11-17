<?php

class Usuario_Validacion extends Validacion
{
    public $mensaje;
    private $Errores;
    private $datos;

    public function __construct()
    {
        parent::__construct();
        $this->datos = $_POST['datos'];
    }

    public function Validacion_Registro()
    {
        $this->Errores = array();
        if (!empty($_POST) && isset($_POST)) {
            if ($this->Comprobar($this->datos['cedula']) &&
                $this->Comprobar($this->datos["contrasenia"]) &&
                $this->Comprobar($this->datos["captcha"])
            ) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($this->datos["cedula"])) {
                    $this->Errores[] = 'El campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($this->datos["cedula"])) {
                        $this->Errores[] = "La cedula es invalida.";
                    } else {
                        if ($this->Comprobar($this->datos["contrasenia"])) {
                            $this->Errores[] = 'El campo contraeña es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($this->datos["contrasenia"])) {
                                $this->Errores[] = "La contraeña es invalida";
                            } else {
                                if ($this->Comprobar($this->datos["captcha"])) {
                                    $this->Errores[] = 'El campo captcha es obligatorio';
                                } else {
                                    if ($this->Validar_Caracteres($this->datos["captcha"])) {
                                        $this->Errores[] = 'El campo captcha no debe tener caracteres especiales.';
                                    } else {
                                        $_POST["datos"] = array(
                                            "cedula"      => $this->Datos_Limpios($this->datos["cedula"]),
                                            "contrasenia" => $this->Datos_Limpios($this->datos["contrasenia"]),
                                            "captcha"     => $this->Datos_Limpios($this->datos["captcha"]),
                                        );
                                    }
                                }
                            }

                        }
                    }
                }
            }
        }

        if (count($this->Errores) > 0) {
            for ($i = 0; $i < count($this->Errores); $i++) {
                $this->mensaje = json_encode($this->Errores, JSON_UNESCAPED_UNICODE);
                return false;
            }
        } else {
            return true;
        }
    }

    public function Fallo()
    {
        return $this->mensaje;
    }

    public function Datos_Validos()
    {
        return $this->datos;
    }
}

<?php

class Usuario_Validacion extends Validacion
{
    public $mensaje;

    public function __construct()
    {
        parent::__construct();
    }

    public function Validacion_Registro()
    {
        $Errores = array();
        if (!empty($_POST) && isset($_POST)) {
            if ($this->Comprobar($_POST['cedula']) &&
                $this->Comprobar($_POST["contrasenia"]) &&
                $this->Comprobar($_POST["captcha"])
            ) {
                $Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($_POST["cedula"])) {
                    $Errores[] = 'El campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($_POST["cedula"])) {
                        $Errores[] = "La cedula es invalida.";
                    } else {
                        if ($this->Comprobar($_POST["contrasenia"])) {
                            $Errores[] = 'El campo contraeña es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($_POST["contrasenia"])) {
                                $Errores[] = "La contraeña es invalida";
                            } else {
                                if ($this->Comprobar($_POST["captcha"])) {
                                    $Errores[] = 'El campo captcha es obligatorio';
                                } else {
                                    if ($this->Validar_Caracteres($_POST["captcha"])) {
                                        $Errores[] = 'El campo captcha no debe tener caracteres especiales.';
                                    } else {
                                        $_POST["datos"] = array(
                                            "cedula"      => $this->Datos_Limpios($_POST["cedula"]),
                                            "contrasenia" => $this->Datos_Limpios($_POST["contrasenia"]),
                                            "captcha"     => $this->Datos_Limpios($_POST["captcha"]),
                                        );
                                    }
                                }
                            }

                        }
                    }
                }
            }
        }

        if (count($Errores) > 0) {
            for ($i = 0; $i < count($Errores); $i++) {
                $this->mensaje = json_encode($Errores, JSON_UNESCAPED_UNICODE);
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
}

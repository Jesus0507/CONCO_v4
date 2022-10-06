<?php

class Login_Validacion extends Validacion
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
            if ($this->Comprobar($_POST['cedula_usuario']) &&
                $this->Comprobar($_POST["datos"]["password"]) &&
                $this->Comprobar($_POST["captcha"])
            ) {
                $Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($_POST["cedula_usuario"])) {
                    $Errores[] = 'El campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($_POST["cedula_usuario"])) {
                        $Errores[] = "La cedula es invalida.";
                    } else {
                        if ($this->Comprobar($_POST["datos"]["password"])) {
                            $Errores[] = 'El campo contraeña es obligatorio';
                        } else {
                            if ($this->Validar_Contrasenia($_POST["datos"]["password"])) {
                                $Errores[] = "La contraeña es invalida";
                            } else {
                                if ($this->Verificar_Base64($_POST["datos"]["password"])) {
                                    $Errores[] = "La contraeña no se encruentra cifrada.";
                                } else {
                                    if ($this->Comprobar($_POST["captcha"])) {
                                        $Errores[] = 'El campo captcha es obligatorio';
                                    } else {
                                        if ($this->Validar_Caracteres($_POST["captcha"])) {
                                            $Errores[] = 'El campo captcha no debe tener caracteres especiales.';
                                        } else {
                                            $_POST["datos"] = array(
                                                "cedula_usuario" => $this->Datos_Limpios($_POST["cedula_usuario"]),
                                                "password"       => $this->Datos_Limpios($_POST["datos"]["password"]),
                                                "captcha"        => $this->Datos_Limpios($_POST["captcha"]),
                                            );
                                        }
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

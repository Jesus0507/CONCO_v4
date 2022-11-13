<?php

class Login_Validacion extends Validacion
{
    public $mensaje;
    private $datos;
    private $Errores;

    public function __construct()
    {
        parent::__construct();
        $this->datos = array(
            "cedula_usuario" => $_POST["cedula_usuario"],
            "password"       => $_POST["datos"]["password"],
            "captcha"        => $_POST["captcha"],
        );
    }

    public function Validacion_Registro()
    {
        $this->Errores = array();
        if (!empty($_POST) && isset($_POST)) {
            if ($this->Comprobar($this->datos['cedula_usuario']) &&
                $this->Comprobar($this->datos["password"]) &&
                $this->Comprobar($this->datos["captcha"])
            ) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($this->datos["cedula_usuario"])) {
                    $this->Errores[] = 'El campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($this->datos["cedula_usuario"])) {
                        $this->Errores[] = "La cedula es invalida.";
                    } else {
                        if ($this->Comprobar($this->datos["password"])) {
                            $this->Errores[] = 'El campo contraeña es obligatorio';
                        } else {
                            // if ($this->Validar_Contrasenia($this->datos["password"])) {
                            //     $this->Errores[] = "La contraeña es invalida";
                            // } else {
                            //     if ($this->Verificar_Base64($this->datos["password"])) {
                            //         $this->Errores[] = "La contraeña no se encruentra cifrada.";
                            //     } else {

                            //     }
                            // }
                            if ($this->Comprobar($this->datos["captcha"])) {
                                $this->Errores[] = 'El campo captcha es obligatorio';
                            } else {
                                if ($this->Validar_Caracteres($this->datos["captcha"])) {
                                    $this->Errores[] = 'El campo captcha no debe tener caracteres especiales.';
                                } else {
                                    $this->datos["datos"] = array(
                                        "cedula_usuario" => $this->Datos_Limpios($this->datos["cedula_usuario"]),
                                        "password"       => $this->Datos_Limpios($this->datos["password"]),
                                        "captcha"        => $this->Datos_Limpios($this->datos["captcha"]),
                                    );
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

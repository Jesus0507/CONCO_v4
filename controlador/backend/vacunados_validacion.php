<?php

class Vacunados_Validacion extends Validacion
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
            if (
                $this->Comprobar($_POST["datos"]["cedula_persona"]) &&
                $this->Comprobar($_POST["datos"]["dosis"]) &&
                $this->Comprobar($_POST["datos"]["fecha"])
            ) {
                $Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($_POST["datos"]["cedula_persona"])) {
                            $Errores[] = 'El campo cedula es obligatorio';
                        } else {
                            if ($this->Validar_Cedula($_POST["datos"]["cedula_persona"])) {
                                $Errores[] = "El campo cedula no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($_POST["datos"]["dosis"])) {
                                    $Errores[] = 'El campo dosis es obligatorio';
                                } else {
                                    if ($this->Validar_Caracteres($_POST["datos"]["dosis"])) {
                                        $Errores[] = "El campo dosis no debe tener caracteres especiales.";
                                    } else {
                                        if ($this->Comprobar($_POST["datos"]["fecha"])) {
                                                    $Errores[] = 'La fecha es obligatorio';
                                                } else {
                                                    if ($this->Validar_Caracteres($_POST["datos"]["fecha"])) {
                                                        $Errores[] = 'El campo fecha no puede tener caracteres especiales.';
                                                    } else {
                                                        
                                                        if ($this->Validar_Estado($_POST["datos"]["estado"])) {
                                                            $Errores[] = 'el estado es invalido ';
                                                        } else {
                                                            $_POST["datos"] = array(
                                                                "cedula_persona"             => $this->Datos_Limpios($_POST["datos"]["cedula_persona"]),
                                                                "dosis"         => $this->Datos_Limpios($_POST["datos"]["dosis"]),
                                                                "fecha"       => $this->Datos_Limpios($_POST["datos"]["fecha"]),
                                                                "estado"             => $this->Datos_Limpios($_POST["datos"]["estado"]),
                                                            );
                                                        }}}
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

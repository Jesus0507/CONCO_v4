<?php

class Enfermos_Validacion extends Validacion
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
                $this->Comprobar($_POST["datos"]["cedula"]) &&
                $this->Comprobar($_POST["datos"]["enfermedad"]) &&
                $this->Comprobar($_POST["datos"]["medicamentos"])
            ) {
                $Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($_POST["datos"]["cedula"])) {
                    $Errores[] = 'El campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($_POST["datos"]["cedula"])) {
                        $Errores[] = "El campo cedula no debe tener caracteres especiales.";
                    } else {
                        if ($this->Comprobar($_POST["datos"]["enfermedad"])) {
                            $Errores[] = 'El campo enfermedad es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($_POST["datos"]["enfermedad"])) {
                                $Errores[] = "El campo enfermedad no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($_POST["datos"]["medicamentos"])) {
                                    $Errores[] = 'El medicamentos es obligatorio';
                                } else {
                                    if ($this->Validar_Caracteres($_POST["datos"]["medicamentos"])) {
                                        $Errores[] = 'El campo medicamentos no puede tener caracteres especiales.';
                                    } else {

                                        if ($this->Validar_Estado($_POST["datos"]["estado"])) {
                                            $Errores[] = 'el estado es invalido ';
                                        }
                                    }
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

    function Fallo()
{
        return $this->mensaje;
    }
}

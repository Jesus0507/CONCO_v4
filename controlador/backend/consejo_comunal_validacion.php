<?php

class Consejo_Comunal_Validacion extends Validacion
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
            if ($this->Comprobar($_POST["datos"]["cedula_persona"]) &&
                $this->Comprobar($_POST["datos"]["nombre_comite"]) &&
                $this->Comprobar($_POST["datos"]["cargo_persona"]) &&
                $this->Comprobar($_POST["datos"]["fecha_ingreso"]) &&
                $this->Comprobar($_POST["datos"]["fecha_salida"])
            ) {
                $Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($_POST["datos"]["cedula_persona"])) {
                    $Errores[] = 'El campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($_POST["datos"]["cedula_persona"])) {
                        $Errores[] = "La cedula es invalida.";
                    } else {
                        if ($this->Comprobar($_POST["datos"]["nombre_comite"])) {
                            $Errores[] = "El campo comite es obligatorio.";
                        } else {
                            if ($this->Comprobar($_POST["datos"]["cargo_persona"])) {
                                $Errores[] = "El campo cargo es obligatorio.";
                            } else {
                                if ($this->Validar_Caracteres($_POST["datos"]["cargo_persona"])) {
                                    $Errores[] = "El campo cargo no debe tener caracteres especiales.";
                                } else {
                                    if ($this->Comprobar($_POST["datos"]["fecha_ingreso"])) {
                                        $Errores[] = 'El campo fecha de ingreso es obligatorio';
                                    } else {
                                        if ($this->Validar_Fecha($_POST["datos"]["fecha_ingreso"])) {
                                            $Errores[] = "la fecha de ingreso introducida es inválida.";
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

            if (count($Errores) > 0) {
                for ($i = 0; $i < count($Errores); $i++) {
                    $this->mensaje = json_encode($Errores, JSON_UNESCAPED_UNICODE);
                    return false;
                }
            } else {
                return true;
            }
        }
    }

    public function Fallo()
    {
        return $this->mensaje;
    }
}

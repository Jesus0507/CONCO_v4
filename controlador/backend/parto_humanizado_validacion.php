<?php

class Parto_Humanizado_Validacion extends Validacion
{
    public $mensaje;

    public function __construct()
    {parent::__construct();}

    public function Validacion_Registro()
    {
        $Errores = array();
        if (!empty($_POST) && isset($_POST)) {
            if ($this->Comprobar($_POST["datos"]["cedula_persona"]) &&
                $this->Comprobar($_POST["datos"]["tiempo_gestacion"]) &&
                $this->Comprobar($_POST["datos"]["fecha_aprox_parto"])
            ) {
                $Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($_POST["datos"]["cedula_persona"])) {
                    $Errores[] = 'El campo cedula  es obligatorio';
                } else {
                    if ($this->Validar_Cedula($_POST["datos"]["cedula_persona"])) {
                        $Errores[] = "La cedula es invalida.";
                    } else {
                        if ($this->Comprobar($_POST["datos"]["tiempo_gestacion"])) {
                            $Errores[] = 'El campo tiempo de gestacion  es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($_POST["datos"]["tiempo_gestacion"])) {
                                $Errores[] = "El campo tiempo de gestacion no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($_POST["datos"]["fecha_aprox_parto"])) {
                                    $Errores[] = 'El campo fecha aproximada de parto es obligatorio';
                                } else {
                                    if ($this->Validar_Fecha($_POST["datos"]["fecha_aprox_parto"])) {
                                        $Errores[] = "la fecha introducida es inválida.";
                                    } else {
                                        if ($this->Validar_Estado($_POST["datos"]["estado"])) {
                                            $Errores[] = 'el estado es invalido ';
                                        } else {
                                            $_POST["datos"]["cedula_persona"]         = $this->Datos_Limpios($_POST["datos"]["cedula_persona"]);
                                            $_POST["datos"]["recibe_micronutrientes"] = $this->Datos_Limpios($_POST["datos"]["recibe_micronutrientes"]);
                                            $_POST["datos"]["tiempo_gestacion"]       = $this->Datos_Limpios($_POST["datos"]["tiempo_gestacion"]);
                                            $_POST["datos"]["fecha_aprox_parto"]      = $this->Datos_Limpios($_POST["datos"]["fecha_aprox_parto"]);
                                            $_POST["datos"]["estado"]                 = $this->Datos_Limpios($_POST["datos"]["estado"]);
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

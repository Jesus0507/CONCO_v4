<?php

class Discapacitados_Validacion extends Validacion
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
                $this->Comprobar($_POST["datos"]["discapacidad"]) &&
                $this->Comprobar($_POST["datos"]["necesidades"]) &&
                $this->Comprobar($_POST["datos"]["observaciones"]) &&
                $this->Comprobar($_POST["datos"]["en_cama"])
            ) {
                $Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($_POST["datos"]["cedula"])) {
                    $Errores[] = 'El campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($_POST["datos"]["cedula"])) {
                        $Errores[] = "El campo cedula no debe tener caracteres especiales.";
                    } else {
                        if ($this->Comprobar($_POST["datos"]["discapacidad"])) {
                            $Errores[] = 'El campo discapacidad es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($_POST["datos"]["discapacidad"])) {
                                $Errores[] = "El campo discapacidad no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($_POST["datos"]["necesidades"])) {
                                    $Errores[] = 'El necesidades es obligatorio';
                                } else {
                                    if ($this->Validar_Caracteres($_POST["datos"]["necesidades"])) {
                                        $Errores[] = 'El campo necesidades no puede tener caracteres especiales.';
                                    } else {
                                        if ($this->Comprobar($_POST["datos"]["observaciones"])) {
                                            $Errores[] = 'El observaciones es obligatorio';
                                        } else {
                                            if ($this->Validar_Caracteres($_POST["datos"]["observaciones"])) {
                                                $Errores[] = 'El campo observaciones no puede tener caracteres especiales.';
                                            } else {
                                                if ($this->Comprobar($_POST["datos"]["en_cama"])) {
                                                    $Errores[] = 'El en_cama es obligatorio';
                                                } else {
                                                    if ($this->Validar_Caracteres($_POST["datos"]["en_cama"])) {
                                                        $Errores[] = 'El campo en_cama no puede tener caracteres especiales.';
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

            public function Fallo()
            {
                return $this->mensaje;
            }
        }

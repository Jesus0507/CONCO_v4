<?php

class Inmuebles_Validacion extends Validacion
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
            if ($_POST["datos"]["id_calle"] == 0 &&
                $this->Comprobar($_POST["datos"]["nombre_inmueble"]) &&
                $this->Comprobar($_POST["datos"]["direccion_inmueble"]) &&
                $this->Comprobar($_POST["datos"]["id_tipo_inmueble"])
            ) {
                $Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($_POST["datos"]["id_calle"] == 0) {
                    $Errores[] = 'El campo calle es obligatorio';
                } else {
                    if (!is_numeric($_POST["datos"]["id_calle"])) {
                        $Errores[] = 'la id es invalida.';
                    } else {
                        if ($this->Comprobar($_POST["datos"]["nombre_inmueble"])) {
                            $Errores[] = 'El campo nombre del inmueble es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($_POST["datos"]["nombre_inmueble"])) {
                                $Errores[] = "El campo nombre del inmueble no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($_POST["datos"]["direccion_inmueble"])) {
                                    $Errores[] = 'El campo direccion del inmueble es obligatorio';
                                } else {
                                    if ($this->Validar_Caracteres($_POST["datos"]["direccion_inmueble"])) {
                                        $Errores[] = "El campo direccion del inmueble no debe tener caracteres especiales.";
                                    } else {
                                        if ($this->Comprobar($_POST["datos"]["id_tipo_inmueble"])) {
                                            $Errores[] = 'El campo tipo  inmueble es obligatorio';
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

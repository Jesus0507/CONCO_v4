<?php

class Viviendas_Validacion extends Validacion
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
                $this->Comprobar($_POST["datos"]["direccion_vivienda"]) &&
                $this->Comprobar($_POST["datos"]["numero_casa"]) &&
                $this->Comprobar($_POST["datos"]["cantidad_habitaciones"]) &&
                $this->Comprobar($_POST["datos"]["id_tipo_vivienda"]) &&
                $this->Comprobar($_POST["datos"]["condicion"]) &&
                $this->Comprobar($_POST["datos"]["hacinamiento"]) &&
                $this->Comprobar($_POST["datos"]["espacio_siembra"]) &&
                $this->Comprobar($_POST["datos"]["banio_sanitario"]) &&
                $this->Comprobar($_POST["datos"]["agua_consumo"]) &&
                $this->Comprobar($_POST["datos"]["aguas_negras"]) &&
                $this->Comprobar($_POST["datos"]["residuos_solidos"]) &&
                $this->Comprobar($_POST["datos"]["servicio_electrico"]) &&
                $this->Comprobar($_POST["datos"]["cable_telefonico"]) &&
                $this->Comprobar($_POST["datos"]["internet"]) &&
                $this->Comprobar($_POST["datos"]["gas"]) &&
                $this->Comprobar($_POST["datos"]["animales_domesticos"]) &&
                $this->Comprobar($_POST["datos"]["insectos_roedores"]) &&
                $this->Comprobar($_POST["datos"]["descripcion"]) &&
                $this->Comprobar($_POST["datos"]["tipo_techo"]) &&
                $this->Comprobar($_POST["datos"]["tipo_pared"]) &&
                $this->Comprobar($_POST["datos"]["tipo_piso"]) &&
                $this->Comprobar($_POST["datos"]["servicio_gas"]) &&
                $this->Comprobar($_POST["datos"]["electrodomestico"])
            ) {
                $Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($_POST["datos"]["id_calle"] == 0) {
                    $Errores[] = 'El campo calle es obligatorio';
                } else {
                    if (!is_numeric($_POST["datos"]["id_calle"])) {
                        $Errores[] = 'la id es invalida.';
                    } else {
                        if ($this->Comprobar($_POST["datos"]["direccion_vivienda"])) {
                            $Errores[] = 'El campo direccion del direccion_vivienda es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($_POST["datos"]["direccion_vivienda"])) {
                                $Errores[] = "El campo direccion del direccion_vivienda no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($_POST["datos"]["numero_casa"])) {
                                    $Errores[] = 'El campo numero de casa es obligatorio';
                                } else {
                                    if ($this->Validar_Caracteres($_POST["datos"]["numero_casa"])) {
                                        $Errores[] = "El campo numero de casa no debe tener caracteres especiales.";
                                    } else {
                                        if ($this->Comprobar($_POST["datos"]["cantidad_habitaciones"])) {
                                            $Errores[] = 'El campo cantidad de habitaciones es obligatorio';
                                        } else {
                                            if ($this->Validar($_POST["datos"]["cantidad_habitaciones"])) {
                                                $Errores[] = "La cantidad de habitaciones no debe tener caracteres especiales.";
                                            } else {
                                                if ($this->Comprobar($_POST["datos"]["id_tipo_vivienda"])) {
                                                    $Errores[] = 'El campo tipo de vivienda del negocio es obligatorio';
                                                } else {
                                                    if ($this->Validar($_POST["datos"]["id_tipo_vivienda"])) {
                                                        $Errores[] = 'El tipo de vivienda no debe tener caracteres especiales.';
                                                    } else {
                                                        if ($this->Comprobar($_POST["datos"]["condicion"])) {
                                                            $Errores[] = 'El campo condicion es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["condicion"])) {
                                                                $Errores[] = 'La condicion no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["hacinamiento"])) {
                                                            $Errores[] = 'El campo hacinamiento es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["hacinamiento"])) {
                                                                $Errores[] = 'El hacinamiento no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["espacio_siembra"])) {
                                                            $Errores[] = 'El campo espacio de siembra es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["espacio_siembra"])) {
                                                                $Errores[] = 'El espacio de siembra no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["banio_sanitario"])) {
                                                            $Errores[] = 'El campo baño sanitario obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["banio_sanitario"])) {
                                                                $Errores[] = 'El baño sanitario no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["agua_consumo"])) {
                                                            $Errores[] = 'El campo agua de consumod obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["agua_consumo"])) {
                                                                $Errores[] = 'El agua de consumo no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["aguas_negras"])) {
                                                            $Errores[] = 'El campo aguas negras es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["aguas_negras"])) {
                                                                $Errores[] = 'El aguas negras no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["residuos_solidos"])) {
                                                            $Errores[] = 'El campo residuos solidos es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["residuos_solidos"])) {
                                                                $Errores[] = 'El residuos_solidos no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["servicio_electrico"])) {
                                                            $Errores[] = 'El campo servicio electrico es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["servicio_electrico"])) {
                                                                $Errores[] = 'El servicio electrico no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["cable_telefonico"])) {
                                                            $Errores[] = 'El campo cable telefonico es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["cable_telefonico"])) {
                                                                $Errores[] = 'El cable telefonico no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["internet"])) {
                                                            $Errores[] = 'El campo internet es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["internet"])) {
                                                                $Errores[] = 'El internet no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["gas"])) {
                                                            $Errores[] = 'El campo gas es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["gas"])) {
                                                                $Errores[] = 'El gas no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["animales_domesticos"])) {
                                                            $Errores[] = 'El campo animales domesticos es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["animales_domesticos"])) {
                                                                $Errores[] = 'El tipo de animales domesticos no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["insectos_roedores"])) {
                                                            $Errores[] = 'El campo insectos o roedores es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["insectos_roedores"])) {
                                                                $Errores[] = 'El insectos o roedores no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["descripcion"])) {
                                                            $Errores[] = 'El campo descripcion es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["descripcion"])) {
                                                                $Errores[] = 'El descripcion no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["tipo_techo"])) {
                                                            $Errores[] = 'El campo tipo de techo es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["tipo_techo"])) {
                                                                $Errores[] = 'El tipo de techo no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["tipo_pared"])) {
                                                            $Errores[] = 'El campo tipo de pared es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["tipo_pared"])) {
                                                                $Errores[] = 'El tipo de pared no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["tipo_piso"])) {
                                                            $Errores[] = 'El campo tipo de piso es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["tipo_piso"])) {
                                                                $Errores[] = 'El tipo de piso no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["servicio_gas"])) {
                                                            $Errores[] = 'El campo servicio de gas es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["servicio_gas"])) {
                                                                $Errores[] = 'El servicio de gas no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($_POST["datos"]["electrodomestico"])) {
                                                            $Errores[] = 'El campo electrodomestico es obligatorio';
                                                        } else {
                                                            if ($this->Validar($_POST["datos"]["electrodomestico"])) {
                                                                $Errores[] = 'El electrodomestico no debe tener caracteres especiales.';
                                                            } else {

                                                            }

                                                        }}
                                                }

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

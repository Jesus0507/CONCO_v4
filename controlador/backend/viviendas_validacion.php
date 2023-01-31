<?php

class Viviendas_Validacion extends Validacion
{
    public $mensaje;
    private $Errores;
    private $datos;

    public function __construct()
    {
        parent::__construct();
        $this->datos= $_POST['datos'];
    }

    public function Validacion_Registro()
    {
        $this->Errores = array();
        if (!empty($_POST) && isset($_POST)) {
            if ($this->datos["id_calle"] == 0 &&
                $this->Comprobar($this->datos["direccion_vivienda"]) &&
                $this->Comprobar($this->datos["numero_casa"]) &&
                $this->Comprobar($this->datos["cantidad_habitaciones"]) &&
                $this->Comprobar($this->datos["id_tipo_vivienda"]) &&
                $this->Comprobar($this->datos["condicion"]) &&
                $this->Comprobar($this->datos["hacinamiento"]) &&
                $this->Comprobar($this->datos["espacio_siembra"]) &&
                $this->Comprobar($this->datos["banio_sanitario"]) &&
                $this->Comprobar($this->datos["agua_consumo"]) &&
                $this->Comprobar($this->datos["aguas_negras"]) &&
                $this->Comprobar($this->datos["residuos_solidos"]) &&
                $this->Comprobar($this->datos["servicio_electrico"]) &&
                $this->Comprobar($this->datos["cable_telefonico"]) &&
                $this->Comprobar($this->datos["internet"]) &&
                $this->Comprobar($this->datos["gas"]) &&
                $this->Comprobar($this->datos["animales_domesticos"]) &&
                $this->Comprobar($this->datos["insectos_roedores"]) &&
                $this->Comprobar($this->datos["descripcion"]) &&
                $this->Comprobar($this->datos["tipo_techo"]) &&
                $this->Comprobar($this->datos["tipo_pared"]) &&
                $this->Comprobar($this->datos["tipo_piso"]) &&
                $this->Comprobar($this->datos["servicio_gas"]) &&
                $this->Comprobar($this->datos["electrodomestico"])
            ) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->datos["id_calle"] == 0) {
                    $this->Errores[] = 'El campo calle es obligatorio';
                } else {
                    if (!is_numeric($this->datos["id_calle"])) { 
                        $this->Errores[] = 'la id es invalida.';
                    } else {
                        if ($this->Comprobar($this->datos["direccion_vivienda"])) {
                            $this->Errores[] = 'El campo direccion del direccion_vivienda es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($this->datos["direccion_vivienda"])) {
                                $this->Errores[] = "El campo direccion del direccion_vivienda no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($this->datos["numero_casa"])) {
                                    $this->Errores[] = 'El campo numero de casa es obligatorio';
                                } else {
                                    if (!preg_match_all("/^[a-zA-Z0-9 - \b]{1,100}$/", $this->datos["numero_casa"])) {
                                        $this->Errores[] = "El campo numero de casa no debe tener caracteres especiales.";
                                    } else {
                                        if ($this->Comprobar($this->datos["cantidad_habitaciones"])) {
                                            $this->Errores[] = 'El campo cantidad de habitaciones es obligatorio';
                                        } else {
                                            if ($this->Validar($this->datos["cantidad_habitaciones"])) {
                                                $this->Errores[] = "La cantidad de habitaciones no debe tener caracteres especiales.";
                                            } else {
                                                if ($this->Comprobar($this->datos["id_tipo_vivienda"])) {
                                                    $this->Errores[] = 'El campo tipo de vivienda del negocio es obligatorio';
                                                } else {
                                                    if ($this->Validar($this->datos["id_tipo_vivienda"])) {
                                                        $this->Errores[] = 'El tipo de vivienda no debe tener caracteres especiales.';
                                                    } else {
                                                        if ($this->Comprobar($this->datos["condicion"])) {
                                                            $this->Errores[] = 'El campo condicion es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["condicion"])) {
                                                                $this->Errores[] = 'La condicion no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["hacinamiento"])) {
                                                            $this->Errores[] = 'El campo hacinamiento es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["hacinamiento"])) {
                                                                $this->Errores[] = 'El hacinamiento no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["espacio_siembra"])) {
                                                            $this->Errores[] = 'El campo espacio de siembra es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["espacio_siembra"])) {
                                                                $this->Errores[] = 'El espacio de siembra no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["banio_sanitario"])) {
                                                            $this->Errores[] = 'El campo baño sanitario obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["banio_sanitario"])) {
                                                                $this->Errores[] = 'El baño sanitario no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["agua_consumo"])) {
                                                            $this->Errores[] = 'El campo agua de consumod obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["agua_consumo"])) {
                                                                $this->Errores[] = 'El agua de consumo no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["aguas_negras"])) {
                                                            $this->Errores[] = 'El campo aguas negras es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["aguas_negras"])) {
                                                                $this->Errores[] = 'El aguas negras no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["residuos_solidos"])) {
                                                            $this->Errores[] = 'El campo residuos solidos es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["residuos_solidos"])) {
                                                                $this->Errores[] = 'El residuos_solidos no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["servicio_electrico"])) {
                                                            $this->Errores[] = 'El campo servicio electrico es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["servicio_electrico"])) {
                                                                $this->Errores[] = 'El servicio electrico no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["cable_telefonico"])) {
                                                            $this->Errores[] = 'El campo cable telefonico es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["cable_telefonico"])) {
                                                                $this->Errores[] = 'El cable telefonico no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["internet"])) {
                                                            $this->Errores[] = 'El campo internet es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["internet"])) {
                                                                $this->Errores[] = 'El internet no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["gas"])) {
                                                            $this->Errores[] = 'El campo gas es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["gas"])) {
                                                                $this->Errores[] = 'El gas no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["animales_domesticos"])) {
                                                            $this->Errores[] = 'El campo animales domesticos es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["animales_domesticos"])) {
                                                                $this->Errores[] = 'El tipo de animales domesticos no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["insectos_roedores"])) {
                                                            $this->Errores[] = 'El campo insectos o roedores es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["insectos_roedores"])) {
                                                                $this->Errores[] = 'El insectos o roedores no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["descripcion"])) {
                                                            $this->Errores[] = 'El campo descripcion es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["descripcion"])) {
                                                                $this->Errores[] = 'El descripcion no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["tipo_techo"])) {
                                                            $this->Errores[] = 'El campo tipo de techo es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["tipo_techo"])) {
                                                                $this->Errores[] = 'El tipo de techo no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["tipo_pared"])) {
                                                            $this->Errores[] = 'El campo tipo de pared es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["tipo_pared"])) {
                                                                $this->Errores[] = 'El tipo de pared no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["tipo_piso"])) {
                                                            $this->Errores[] = 'El campo tipo de piso es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["tipo_piso"])) {
                                                                $this->Errores[] = 'El tipo de piso no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["servicio_gas"])) {
                                                            $this->Errores[] = 'El campo servicio de gas es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["servicio_gas"])) {
                                                                $this->Errores[] = 'El servicio de gas no debe tener caracteres especiales.';
                                                            } else {

                                                            }
                                                        }
                                                        if ($this->Comprobar($this->datos["electrodomestico"])) {
                                                            $this->Errores[] = 'El campo electrodomestico es obligatorio';
                                                        } else {
                                                            if ($this->Validar($this->datos["electrodomestico"])) {
                                                                $this->Errores[] = 'El electrodomestico no debe tener caracteres especiales.';
                                                            } else {

                                                            }

                                                        }}
                                                }

                                                if ($this->Validar_Estado($this->datos["estado"])) {
                                                    $this->Errores[] = 'el estado es invalido ';
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

    

            if (count($this->Errores) > 0) {
              for ($i = 0; $i < count($this->Errores); $i++) {
                 $this->mensaje = json_encode($this->Errores, JSON_UNESCAPED_UNICODE);
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
             public function Datos_Validos()
    {
        return $this->datos;
    }

 }
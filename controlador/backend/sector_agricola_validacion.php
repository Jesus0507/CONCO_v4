<?php

class Sector_Agricola_Validacion extends Validacion
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
            if ($this->Comprobar($this->datos["cedula_persona"]) &&
                $this->Comprobar($this->datos["area_produccion"]) &&
                $this->Comprobar($this->datos["anios_experiencia"]) &&
                $this->Comprobar($this->datos["rubro_principal"]) &&
                $this->Comprobar($this->datos["rubro_alternativo"]) &&
                $this->Comprobar($this->datos["financiado"])
            ) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($this->datos["cedula_persona"])) {
                    $this->Errores[] = 'El campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($this->datos["cedula_persona"])) {
                        $this->Errores[] = "La cedula es invalida.";
                    } else {
                        if ($this->Comprobar($this->datos["area_produccion"])) {
                            $this->Errores[] = 'El campo area de produccion es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($this->datos["area_produccion"])) {
                                $this->Errores[] = "El campo area de produccion no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($this->datos["anios_experiencia"])) {
                                    $this->Errores[] = 'El campo años de experiencia es obligatorio';
                                } else {
                                    if ($this->Validar_Entero($this->datos["anios_experiencia"])) {
                                        $this->Errores[] = "El campo años de experiencia es invalido";
                                    } else {
                                        if ($this->Comprobar($this->datos["org_agricola"])) {
                                            $this->Errores[] = 'El campo organizacion agricola es obligatorio';
                                        } else {
                                            if ($this->Validar_Caracteres($this->datos["org_agricola"])) {
                                                $this->Errores[] = "El campo organizacion agricola no debe tener caracteres especiales.";
                                            } else {
                                                if ($this->Comprobar($this->datos["rubro_principal"])) {
                                                    $this->Errores[] = 'El campo rubro principal  es obligatorio';
                                                } else {
                                                    if ($this->Validar_Caracteres($this->datos["rubro_principal"])) {
                                                        $this->Errores[] = "El campo rubro principal no debe tener caracteres especiales.";
                                                    } else {
                                                        if ($this->Comprobar($this->datos["rubro_alternativo"])) {
                                                            $this->Errores[] = 'El campo rubro alternativo  es obligatorio';
                                                        } else {
                                                            if ($this->Validar_Caracteres($this->datos["rubro_alternativo"])) {
                                                                $this->Errores[] = "El campo rubro alternativo no debe tener caracteres especiales.";
                                                            } else {
                                                                if ($this->Comprobar($this->datos["financiado"])) {
                                                                    $this->Errores[] = 'El campo financiamiento es obligatorio';
                                                                } else {
                                                                    if ($this->Validar_Dinero($this->datos["financiado"])) {
                                                                        $this->Errores[] = "El monto financiado es inválido.";
                                                                    } else {
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

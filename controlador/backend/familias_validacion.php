<?php

class Familias_Validacion extends Validacion
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
            if ($this->datos["id_vivienda"] == "vacio" &&
                $this->datos["condicion_ocupacion"] == 0 &&
                $this->Comprobar($this->datos["nombre_familia"]) &&
                $this->Comprobar($this->datos["telefono_familia"]) &&
                $this->Comprobar($this->datos["ingreso_mensual_aprox"]) &&
                $this->Comprobar($this->datos["observacion"])
            ) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->datos["id_vivienda"] == "vacio") {
                    $this->Errores[] = 'El campo vivienda es obligatorio';
                } else {
                    if ($this->Validar_Caracteres($this->datos["id_vivienda"])) {
                        $this->Errores[] = "El campo vivienda no debe tener caracteres especiales.";
                    } else {
                        if ($this->Validar_Caracteres($this->datos["condicion_ocupacion"])) {
                            $this->Errores[] = "El campo condición en que ocupa la vivienda no debe tener caracteres especiales.";
                        } else {
                            if ($this->Comprobar($this->datos["nombre_familia"])) {
                                $this->Errores[] = 'El campo nombre de familia es obligatorio';
                            } else {
                                if ($this->Validar_Caracteres($this->datos["nombre_familia"])) {
                                    $this->Errores[] = "El campo nombre de familia no debe tener caracteres especiales.";
                                } else {
                                    if ($this->Comprobar($this->datos["telefono_familia"])) {
                                        $this->Errores[] = 'El campo téléfono de familia es obligatorio';
                                    } else {
                                        if ($this->Validar_Telefono($this->datos["telefono_familia"])) {
                                            $this->Errores[] = "El  téléfono de familia es invalido";
                                        } else {
                                            if ($this->Comprobar($this->datos["ingreso_mensual_aprox"])) {
                                                $this->Errores[] = 'El campo Ingreso mensual Aprox de familia es obligatorio';
                                            } else {
                                                if ($this->Validar_Dinero($this->datos["ingreso_mensual_aprox"])) {
                                                    $this->Errores[] = "El monto introducido es inválido.";
                                                } else {
                                                    if ($this->Comprobar($this->datos["observacion"])) {
                                                        $this->Errores[] = 'El campo observacion de familia es obligatorio';
                                                    } else {
                                                        if ($this->Validar_Caracteres($this->datos["observacion"])) {
                                                            $this->Errores[] = "El campo observacion no debe tener caracteres especiales.";
                                                        } else {
                                                            if ($this->Comprobar($_POST["integrantes"])) {
                                                                $this->Errores[] = 'Debe tener al menos 1 integrantes';
                                                            } else {
                                                                if ($this->Validar_Estado($this->datos["estado"])) {
                                                                    $this->Errores[] = 'el estado es invalido ';
                                                                } else {
                                                                    $this->datos = array(
                                                                        "id_vivienda"           => $this->Datos_Limpios($this->datos["id_vivienda"]),
                                                                        "condicion_ocupacion"   => $this->Datos_Limpios($this->datos["condicion_ocupacion"]),
                                                                        "nombre_familia"        => $this->Datos_Limpios($this->datos["nombre_familia"]),
                                                                        "telefono_familia"      => $this->Datos_Limpios($this->Normalizar_Telefono($this->datos["telefono_familia"])),
                                                                        "ingreso_mensual_aprox" => $this->Datos_Limpios($this->datos["ingreso_mensual_aprox"]),
                                                                        "observacion"           => $this->Datos_Limpios($this->datos["observacion"]),
                                                                        "estado"                => $this->Datos_Limpios($this->datos["estado"]),
                                                                    );
                                                                    if (isset($_POST["id_familia"])) {
                                                                        $this->datos["id_familia"] = $this->Datos_Limpios($_POST["id_familia"]);
                                                                    }
                                                                }
                                                                foreach ($_POST["integrantes"] as $key => $value) {
                                                                    if ($this->Validar_Cedula($value)) {
                                                                        $this->Errores[] = "La cedula " . $value . " es invalida.";
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
}

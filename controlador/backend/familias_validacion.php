<?php

class Familias_Validacion extends Validacion
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
            if ($_POST["datos"]["id_vivienda"] == "vacio" &&
                $_POST["datos"]["condicion_ocupacion"] == 0 &&
                $this->Comprobar($_POST["datos"]["nombre_familia"]) &&
                $this->Comprobar($_POST["datos"]["telefono_familia"]) &&
                $this->Comprobar($_POST["datos"]["ingreso_mensual_aprox"]) &&
                $this->Comprobar($_POST["datos"]["observacion"])
            ) {
                $Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($_POST["datos"]["id_vivienda"] == "vacio") {
                    $Errores[] = 'El campo vivienda es obligatorio';
                } else {
                    if ($this->Validar_Caracteres($_POST["datos"]["id_vivienda"])) {
                        $Errores[] = "El campo vivienda no debe tener caracteres especiales.";
                    } else {
                        if ($this->Validar_Caracteres($_POST["datos"]["condicion_ocupacion"])) {
                            $Errores[] = "El campo condición en que ocupa la vivienda no debe tener caracteres especiales.";
                        } else {
                            if ($this->Comprobar($_POST["datos"]["nombre_familia"])) {
                                $Errores[] = 'El campo nombre de familia es obligatorio';
                            } else {
                                if ($this->Validar_Caracteres($_POST["datos"]["nombre_familia"])) {
                                    $Errores[] = "El campo nombre de familia no debe tener caracteres especiales.";
                                } else {
                                    if ($this->Comprobar($_POST["datos"]["telefono_familia"])) {
                                        $Errores[] = 'El campo téléfono de familia es obligatorio';
                                    } else {
                                        if ($this->Validar_Telefono($_POST["datos"]["telefono_familia"])) {
                                            $Errores[] = "El  téléfono de familia es invalido";
                                        } else {
                                            if ($this->Comprobar($_POST["datos"]["ingreso_mensual_aprox"])) {
                                                $Errores[] = 'El campo Ingreso mensual Aprox de familia es obligatorio';
                                            } else {
                                                if ($this->Validar_Dinero($_POST["datos"]["ingreso_mensual_aprox"])) {
                                                    $Errores[] = "El monto introducido es inválido.";
                                                } else {
                                                    if ($this->Comprobar($_POST["datos"]["observacion"])) {
                                                        $Errores[] = 'El campo observacion de familia es obligatorio';
                                                    } else {
                                                        if ($this->Validar_Caracteres($_POST["datos"]["observacion"])) {
                                                            $Errores[] = "El campo observacion no debe tener caracteres especiales.";
                                                        } else {
                                                            if ($this->Comprobar($_POST["integrantes"])) {
                                                                $Errores[] = 'Debe tener al menos 1 integrantes';
                                                            } else {
                                                                if ($this->Validar_Estado($_POST["datos"]["estado"])) {
                                                                    $Errores[] = 'el estado es invalido ';
                                                                } else {
                                                                    $_POST["datos"] = array(
                                                                        "id_vivienda"           => $this->Datos_Limpios($_POST["datos"]["id_vivienda"]),
                                                                        "condicion_ocupacion"   => $this->Datos_Limpios($_POST["datos"]["condicion_ocupacion"]),
                                                                        "nombre_familia"        => $this->Datos_Limpios($_POST["datos"]["nombre_familia"]),
                                                                        "telefono_familia"      => $this->Datos_Limpios($this->Normalizar_Telefono($_POST["datos"]["telefono_familia"])),
                                                                        "ingreso_mensual_aprox" => $this->Datos_Limpios($_POST["datos"]["ingreso_mensual_aprox"]),
                                                                        "observacion"           => $this->Datos_Limpios($_POST["datos"]["observacion"]),
                                                                        "estado"                => $this->Datos_Limpios($_POST["datos"]["estado"]),
                                                                    );
                                                                    if (isset($_POST["id_familia"])) {
                                                                        $_POST["datos"]["id_familia"] = $this->Datos_Limpios($_POST["id_familia"]);
                                                                    }
                                                                }
                                                                foreach ($_POST["integrantes"] as $key => $value) {
                                                                    if ($this->Validar_Cedula($value)) {
                                                                        $Errores[] = "La cedula " . $value . " es invalida.";
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

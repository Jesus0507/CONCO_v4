<?php

class Negocios_Validacion extends Validacion
{
    public $mensaje;
    private $Errores;
    private $datos;

    public function __construct()
    {
        parent::__construct();
        $this->datos = $_POST['datos'];
    }

    public function Validacion_Registro()
    {
        $this->Errores = array();
        if (!empty($_POST) && isset($_POST)) {
            if ($this->Datos_Validos()["id_calle"] == 0 &&
                $this->Comprobar($this->Datos_Validos()["direccion_negocio"]) &&
                $this->Comprobar($this->Datos_Validos()["nombre_negocio"]) &&
                $this->Comprobar($this->Datos_Validos()["cedula_propietario"]) &&
                $this->Comprobar($this->Datos_Validos()["rif_negocio"])
            ) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Datos_Validos()["id_calle"] == 0) {
                    $this->Errores[] = 'El campo calle es obligatorio';
                } else {
                    if (!is_numeric($this->datos["id_calle"])) {
                        $this->Errores[] = 'la id es invalida.';
                    } else {
                        if ($this->Comprobar($this->Datos_Validos()["direccion_negocio"])) {
                            $this->Errores[] = 'El campo direccion del negocio es obligatorio';
                        } else {
                            if ($this->Validar("caracteres", $this->Datos_Validos()["direccion_negocio"])) {
                                $this->Errores[] = "El campo direccion del negocio no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($this->Datos_Validos()["nombre_negocio"])) {
                                    $this->Errores[] = 'El campo nombre del negocio es obligatorio';
                                } else {
                                    if ($this->Validar("caracteres", $this->Datos_Validos()["nombre_negocio"])) {
                                        $this->Errores[] = "El campo nombre del negocio no debe tener caracteres especiales.";
                                    } else {
                                        if ($this->Comprobar($this->Datos_Validos()["cedula_propietario"])) {
                                            $this->Errores[] = 'El campo cedula del propietario es obligatorio';
                                        } else {
                                            if ($this->Validar("cedula",$this->Datos_Validos()["cedula_propietario"])) {
                                                $this->Errores[] = "La cedula es invalida.";
                                            } else {
                                                if ($this->Comprobar($this->Datos_Validos()["rif_negocio"])) {
                                                    $this->Errores[] = 'El campo rif del negocio es obligatorio';
                                                } else {
                                                    if ($this->Validar("rif",$this->Datos_Validos()["rif_negocio"])) {
                                                        $this->Errores[] = 'El rif es inválido verifique que la informacion sea correcta.';
                                                    } else {
                                                        if ($this->Validar_Estado($this->Datos_Validos()["estado"])) {
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

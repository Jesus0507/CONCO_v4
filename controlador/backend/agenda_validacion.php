<?php

class Agenda_Validacion extends Validacion
{
    public $mensaje;
    private $Errores;
    private $datos;

    public function __construct()
    {
        parent::__construct();
        $this->datos            = isset($_POST['datos']) ? $_POST['datos']: null;
        $this->datos["creador"] = $_SESSION['cedula_usuario'];
    }

    public function Validacion_Registro()
    {
        $this->Errores = array();
        if (!empty($_POST) && isset($_POST)) {
            if ($this->Comprobar($this->datos["tipo_evento"]) &&
                $this->Comprobar($this->datos["fechas"]) &&
                $this->Comprobar($this->datos["creador"]) &&
                $this->Comprobar($this->datos["ubicacion"]) &&
                $this->Comprobar($this->datos["horas"]) &&
                $this->Comprobar($this->datos["detalle_evento"])) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($this->datos["tipo_evento"])) {
                    $this->Errores[] = 'Debe especificar qué tipo de evento se está creando';
                } else {
                    if ($this->Validar("caracteres", $this->Datos_Validos()["tipo_evento"])) {
                        $this->Errores[] = "El campo tipo de evento no debe tener caracteres especiales.";
                    } else {
                        if ($this->Comprobar($this->datos["fechas"])) {
                            $this->Errores[] = 'Debe seleccionar al menos una fecha para crear un evento';
                        } else {
                            if ($this->Comprobar($this->datos["creador"])) {
                                $this->Errores[] = 'El evento debe ser creado por un usuario permitido.';
                            } else {
                                if ($this->Validar_Cedula($this->datos["creador"])) {
                                    $this->Errores[] = "La cedula es invalida.";
                                } else {
                                    if ($this->Comprobar($this->datos["ubicacion"])) {
                                        $this->Errores[] = 'El campo ubicacion es obligatorio';
                                    } else {
                                        if ($this->Validar_Caracteres($this->datos["ubicacion"])) {
                                            $this->Errores[] = "El campo ubicacion no debe tener caracteres especiales.";
                                        } else {
                                            if ($this->Comprobar($this->datos["horas"])) {
                                                $this->Errores[] = 'El campo horas es obligatorio';
                                            } else {
                                                if ($this->Comprobar($this->datos["detalle_evento"])) {
                                                    $this->Errores[] = "El campo detalles es obligatorio";
                                                } else {

                                                    if ($this->Validar("caracteres", $this->Datos_Validos()["detalle_evento"])) {
                                                        $this->Errores[] = "El campo detalles no debe tener caracteres especiales.";
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

                if (count($this->Errores) > 0) {
                    for ($i = 0; $i < count($this->Errores); $i++) {
                        $this->mensaje = json_encode($this->Errores, JSON_UNESCAPED_UNICODE);
                        return false;
                    }
                } else {
                    return true;
                }
            }
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

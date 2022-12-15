<?php

class Parto_Humanizado_Validacion extends Validacion
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
                $this->Comprobar($this->datos["tiempo_gestacion"]) &&
                $this->Comprobar($this->datos["fecha_aprox_parto"])
            ) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($this->datos["cedula_persona"])) {
                    $this->Errores[] = 'El campo cedula  es obligatorio';
                } else {
                    if ($this->Validar("cedula", $this->datos["cedula_persona"])) {
                        $this->Errores[] = "La cedula es invalida.";
                    } else {
                        if ($this->Comprobar($this->datos["tiempo_gestacion"])) {
                            $this->Errores[] = 'El campo tiempo de gestacion  es obligatorio';
                        } else {
                            if ($this->Validar("caracteres", $this->datos["tiempo_gestacion"])) {
                                $this->Errores[] = "El campo tiempo de gestacion no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($this->datos["fecha_aprox_parto"])) {
                                    $this->Errores[] = 'El campo fecha aproximada de parto es obligatorio';
                                } else {
                                    if ($this->Validar("fechas", $this->datos["fecha_aprox_parto"])) {
                                        $this->Errores[] = "la fecha introducida es inválida.";
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

    public function Fallo(){return $this->mensaje;}
    public function Datos_Validos(){return $this->datos;}
}

<?php

class Consejo_Comunal_Validacion extends Validacion
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
            if ($this->Comprobar($this->datos["cedula_persona"]) &&
                $this->Comprobar($this->datos["nombre_comite"]) &&
                $this->Comprobar($this->datos["cargo_persona"]) &&
                $this->Comprobar($this->datos["fecha_ingreso"]) &&
                $this->Comprobar($this->datos["fecha_salida"])
            ) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($this->datos["cedula_persona"])) {
                    $this->Errores[] = 'El campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($this->datos["cedula_persona"])) {
                        $this->Errores[] = "La cedula es invalida.";
                    } else {
                        if ($this->Comprobar($this->datos["nombre_comite"])) {
                            $this->Errores[] = "El campo comite es obligatorio.";
                        } else {
                            if ($this->Comprobar($this->datos["cargo_persona"])) {
                                $this->Errores[] = "El campo cargo es obligatorio.";
                            } else {
                                if ($this->Validar_Caracteres($this->datos["cargo_persona"])) {
                                    $this->Errores[] = "El campo cargo no debe tener caracteres especiales.";
                                } else {
                                    if ($this->Comprobar($this->datos["fecha_ingreso"])) {
                                        $this->Errores[] = 'El campo fecha de ingreso es obligatorio';
                                    } else {
                                        if ($this->Validar_Fecha($this->datos["fecha_ingreso"])) {
                                            $this->Errores[] = "la fecha de ingreso introducida es inválida.";
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

    public function Fallo()
    {
        return $this->mensaje;
    }

    public function Datos_Validos()
    {
        return $this->datos;
    }
}

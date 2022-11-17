<?php

class Discapacitados_Validacion extends Validacion
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
            if (
                $this->Comprobar($this->datos["cedula"]) &&
                $this->Comprobar($this->datos["discapacidad"]) &&
                $this->Comprobar($this->datos["necesidades"]) &&
                $this->Comprobar($this->datos["observaciones"]) &&
                $this->Comprobar($this->datos["en_cama"])
            ) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($this->datos["cedula"])) {
                    $this->Errores[] = 'El campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($this->datos["cedula"])) {
                        $this->Errores[] = "El campo cedula no debe tener caracteres especiales.";
                    } else {
                        if ($this->Comprobar($this->datos["discapacidad"])) {
                            $this->Errores[] = 'El campo discapacidad es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($this->datos["discapacidad"])) {
                                $this->Errores[] = "El campo discapacidad no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($this->datos["necesidades"])) {
                                    $this->Errores[] = 'El necesidades es obligatorio';
                                } else {
                                    if ($this->Validar_Caracteres($this->datos["necesidades"])) {
                                        $this->Errores[] = 'El campo necesidades no puede tener caracteres especiales.';
                                    } else {
                                        if ($this->Comprobar($this->datos["observaciones"])) {
                                            $this->Errores[] = 'El observaciones es obligatorio';
                                        } else {
                                            if ($this->Validar_Caracteres($this->datos["observaciones"])) {
                                                $this->Errores[] = 'El campo observaciones no puede tener caracteres especiales.';
                                            } else {
                                                if ($this->Comprobar($this->datos["en_cama"])) {
                                                    $this->Errores[] = 'El en_cama es obligatorio';
                                                } else {
                                                    if ($this->Validar_Caracteres($this->datos["en_cama"])) {
                                                        $this->Errores[] = 'El campo en_cama no puede tener caracteres especiales.';
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
}
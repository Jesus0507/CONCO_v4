<?php

class Vacunados_Validacion extends Validacion
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
                $this->Comprobar($this->datos["cedula_persona"]) &&
                $this->Comprobar($this->datos["dosis"]) &&
                $this->Comprobar($this->datos["fecha"])
            ) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($this->datos["cedula_persona"])) {
                    $this->Errores[] = 'El campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($this->datos["cedula_persona"])) {
                        $this->Errores[] = "El campo cedula no debe tener caracteres especiales.";
                    } else {
                        if ($this->Comprobar($this->datos["dosis"])) {
                            $this->Errores[] = 'El campo dosis es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($this->datos["dosis"])) {
                                $this->Errores[] = "El campo dosis no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($this->datos["fecha"])) {
                                    $this->Errores[] = 'La fecha es obligatorio';
                                } else {
                                    if ($this->Validar_Caracteres($this->datos["fecha"])) {
                                        $this->Errores[] = 'El campo fecha no puede tener caracteres especiales.';
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
           }else {
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

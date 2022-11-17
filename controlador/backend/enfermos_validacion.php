<?php

class Enfermos_Validacion extends Validacion
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
                $this->Comprobar($this->datos["enfermedad"]) &&
                $this->Comprobar($this->datos["medicamentos"])
            ) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($this->datos["cedula"])) {
                    $this->Errores[] = 'El campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($this->datos["cedula"])) {
                        $this->Errores[] = "El campo cedula no debe tener caracteres especiales.";
                    } else {
                        if ($this->Comprobar($this->datos["enfermedad"])) {
                            $this->Errores[] = 'El campo enfermedad es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($this->datos["enfermedad"])) {
                                $this->Errores[] = "El campo enfermedad no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($this->datos["medicamentos"])) {
                                    $this->Errores[] = 'El medicamentos es obligatorio';
                                } else {
                                    if ($this->Validar_Caracteres($this->datos["medicamentos"])) {
                                        $this->Errores[] = 'El campo medicamentos no puede tener caracteres especiales.';
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
    function Fallo()
      {
        return $this->mensaje;
          }

 }
<?php

class Inmuebles_Validacion extends Validacion
{
    public  $mensaje;
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
            if ($this->datos["id_calle"] == 0 &&
                $this->Comprobar($this->datos["nombre_inmueble"]) &&
                $this->Comprobar($this->datos["direccion_inmueble"]) &&
                $this->Comprobar($this->datos["id_tipo_inmueble"])
            ) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->datos["id_calle"] == 0) {
                    $this->Errores[] = 'El campo calle es obligatorio';
                } else {
                    if (!is_numeric($this->datos["id_calle"])) {
                        $this->Errores[] = 'la id es invalida.';
                    } else {
                        if ($this->Comprobar($this->datos["nombre_inmueble"])) {
                            $this->Errores[] = 'El campo nombre del inmueble es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($this->datos["nombre_inmueble"])) {
                                $this->Errores[] = "El campo nombre del inmueble no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($this->datos["direccion_inmueble"])) {
                                    $this->Errores[] = 'El campo direccion del inmueble es obligatorio';
                                } else {
                                    if ($this->Validar_Caracteres($this->datos["direccion_inmueble"])) {
                                        $this->Errores[] = "El campo direccion del inmueble no debe tener caracteres especiales.";
                                    } else {
                                        if ($this->Comprobar($this->datos["id_tipo_inmueble"])) {
                                            $this->Errores[] = 'El campo tipo  inmueble es obligatorio';
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

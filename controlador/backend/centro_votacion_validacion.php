<?php

class Centro_Votacion_Validacion extends Validacion
{
    public $mensaje;
    private $Eroores;
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
            if ($this->Comprobar($this->datos["cedula_votante"]) &&
                $this->Comprobar($this->datos["nombre_centro"]) &&
                $this->datos["id_parroquia"] == 0
            ) {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($this->datos["cedula_votante"])) {
                    $this->Errores[] = 'el campo cedula es obligatorio';
                } else {
                if ($this->Validar_Cedula($this->datos["cedula_votante"])) {
                        $this->Errores[] = "La cedula es invalida.";
                    } else {
                        if ($this->Comprobar($this->datos["nombre_centro"])) {
                            $this->Errores[] = 'el campo nombre centro  es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($this->datos["nombre_centro"])) {
                                $this->Errores[] = "El campo nombre del centro no debe tener caracteres especiales.";
                            } else {
                                if ($this->datos["id_parroquia"] === 0) {
                                    $this->Errores[] = 'el campo parroquia  es obligatorio';
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

    public function Fallo()
    {
        return $this->mensaje;
    }
}

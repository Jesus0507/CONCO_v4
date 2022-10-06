<?php

class Centro_Votacion_Validacion extends Validacion
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
            if ($this->Comprobar($_POST["datos"]["cedula_votante"]) &&
                $this->Comprobar($_POST["datos"]["nombre_centro"]) &&
                $_POST["datos"]["id_parroquia"] == 0
            ) {
                $Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($_POST["datos"]["cedula_votante"])) {
                    $Errores[] = 'el campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($_POST["datos"]["cedula_votante"])) {
                        $Errores[] = "La cedula es invalida.";
                    } else {
                        if ($this->Comprobar($_POST["datos"]["nombre_centro"])) {
                            $Errores[] = 'el campo nombre centro  es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($_POST["datos"]["nombre_centro"])) {
                                $Errores[] = "El campo nombre del centro no debe tener caracteres especiales.";
                            } else {
                                if ($_POST["datos"]["id_parroquia"] === 0) {
                                    $Errores[] = 'el campo parroquia  es obligatorio';
                                } else {
                                    if ($this->Validar_Estado($_POST["datos"]["estado"])) {
                                        $Errores[] = 'el estado es invalido ';
                                    } else {
                                        $_POST["datos"] = array(
                                            "cedula_votante" => $this->Datos_Limpios($_POST["datos"]["cedula_votante"]),
                                            "nombre_centro"  => $this->Datos_Limpios($_POST["datos"]["nombre_centro"]),
                                            "id_parroquia"   => $this->Datos_Limpios($_POST["datos"]["id_parroquia"]),
                                            "estado"         => $this->Datos_Limpios($_POST["datos"]["estado"]),
                                        );
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

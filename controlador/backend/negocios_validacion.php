<?php

class Negocios_Validacion extends Validacion
{
    public $mensaje;

    public function __construct($modelo)
    {
        parent::__construct();
        $this->modelo = $modelo;
    }

    public function Validacion_Registro()
    {
        $Errores = array();
        if (!empty($_POST) && isset($_POST)) {
            if ($_POST["datos"]["id_calle"] == 0 &&
                $this->Comprobar($_POST["datos"]["direccion_negocio"]) &&
                $this->Comprobar($_POST["datos"]["nombre_negocio"]) &&
                $this->Comprobar($_POST["datos"]["cedula_propietario"]) &&
                $this->Comprobar($_POST["datos"]["rif_negocio"])
            ) {
                $Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($_POST["datos"]["id_calle"] == 0) {
                    $Errores[] = 'El campo calle es obligatorio';
                } else {
                    if ($this->Comprobar($_POST["datos"]["direccion_negocio"])) {
                        $Errores[] = 'El campo direccion del negocio es obligatorio';
                    } else {
                        if ($this->Validar_Caracteres($_POST["datos"]["direccion_negocio"])) {
                            $Errores[] = "El campo direccion del negocio no debe tener caracteres especiales.";
                        } else {
                            if ($this->Comprobar($_POST["datos"]["nombre_negocio"])) {
                                $Errores[] = 'El campo nombre del negocio es obligatorio';
                            } else {
                                if ($this->Validar_Caracteres($_POST["datos"]["nombre_negocio"])) {
                                    $Errores[] = "El campo nombre del negocio no debe tener caracteres especiales.";
                                } else {
                                    if ($this->Comprobar($_POST["datos"]["cedula_propietario"])) {
                                        $Errores[] = 'El campo cedula del propietario es obligatorio';
                                    } else {
                                        if ($this->Validar_Cedula($_POST["datos"]["cedula_propietario"])) {
                                            $Errores[] = "La cedula es invalida.";
                                        } else {
                                            if ($this->Comprobar($_POST["datos"]["rif_negocio"])) {
                                                $Errores[] = 'El campo rif del negocio es obligatorio';
                                            }else{
                                                if ($this->Validar_Rif($_POST["datos"]["rif_negocio"])) {
                                                    $Errores[] = 'El rif es inválido verifique que la informacion sea correcta.';
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

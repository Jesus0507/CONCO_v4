<?php

class Sector_Agricola_Validacion extends Validacion
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
            if ($this->Comprobar($_POST["datos"]["cedula_persona"]) &&
                $this->Comprobar($_POST["datos"]["area_produccion"]) &&
                $this->Comprobar($_POST["datos"]["anios_experiencia"]) &&
                $this->Comprobar($_POST["datos"]["rubro_principal"]) &&
                $this->Comprobar($_POST["datos"]["rubro_alternativo"]) &&
                $this->Comprobar($_POST["datos"]["financiado"]) &&
                $this->Comprobar($_POST["datos"]["registro_INTI"]) &&
                $this->Comprobar($_POST["datos"]["constancia_productor"]) &&
                $this->Comprobar($_POST["datos"]["senial_hierro"]) &&
                $this->Comprobar($_POST["datos"]["senial_hierro"]) &&
                $this->Comprobar($_POST["datos"]["org_agricola"])
            ) {
                $Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->Comprobar($_POST["datos"]["cedula_persona"])) {
                    $Errores[] = 'El campo cedula es obligatorio';
                } else {
                    if ($this->Validar_Cedula($_POST["datos"]["cedula_persona"])) {
                        $Errores[] = "La cedula es invalida.";
                    } else {
                        if ($this->Comprobar($_POST["datos"]["area_produccion"])) {
                            $Errores[] = 'El campo area de produccion es obligatorio';
                        } else {
                            if ($this->Validar_Caracteres($_POST["datos"]["area_produccion"])) {
                                $Errores[] = "El campo area de produccion no debe tener caracteres especiales.";
                            } else {
                                if ($this->Comprobar($_POST["datos"]["anios_experiencia"])) {
                                    $Errores[] = 'El campo años de experiencia es obligatorio';
                                } else {
                                    if ($this->Validar_Entero($_POST["datos"]["anios_experiencia"])) {
                                        $Errores[] = "El campo años de experiencia es invalido";
                                    } else {
                                        if ($this->Comprobar($_POST["datos"]["org_agricola"])) {
                                            $Errores[] = 'El campo organizacion agricola es obligatorio';
                                        } else {
                                            if ($this->Validar_Caracteres($_POST["datos"]["org_agricola"])) {
                                                $Errores[] = "El campo organizacion agricola no debe tener caracteres especiales.";
                                            } else {
                                                if ($this->Comprobar($_POST["datos"]["rubro_principal"])) {
                                                    $Errores[] = 'El campo rubro principal  es obligatorio';
                                                } else {
                                                    if ($this->Validar_Caracteres($_POST["datos"]["rubro_principal"])) {
                                                        $Errores[] = "El campo rubro principal no debe tener caracteres especiales.";
                                                    } else {
                                                        if ($this->Comprobar($_POST["datos"]["rubro_alternativo"])) {
                                                            $Errores[] = 'El campo rubro alternativo  es obligatorio';
                                                        } else {
                                                            if ($this->Validar_Caracteres($_POST["datos"]["rubro_alternativo"])) {
                                                                $Errores[] = "El campo rubro alternativo no debe tener caracteres especiales.";
                                                            } else {
                                                                if ($this->Comprobar($_POST["datos"]["financiado"])) {
                                                                    $Errores[] = 'El campo financiamiento es obligatorio';
                                                                } else {
                                                                    if ($this->Validar_Dinero($_POST["datos"]["financiado"])) {
                                                                        $Errores[] = "El monto financiado es inválido.";
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

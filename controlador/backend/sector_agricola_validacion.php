<?php

class Sector_Agricola_Validacion extends Validacion
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
            if ($this->Comprobar($_POST["datos"]["cedula_persona"]) &&
                $this->Comprobar($_POST["datos"]["area_produccion"]) &&
                $this->Comprobar($_POST["datos"]["anios_experiencia"]) &&
                $this->Comprobar($_POST["datos"]["rubro_principal"]) &&
                $this->Comprobar($_POST["datos"]["rubro_alternativo"]) &&
                $this->Comprobar($_POST["datos"]["financiado"])
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
                                                                    } else {
                                                                        if ($this->Validar_Estado($_POST["datos"]["estado"])) {
                                                                            $Errores[] = 'el estado es invalido ';
                                                                        } else {
                                                                            $_POST["datos"] = array(
                                                                                "cedula_persona"       => $this->Datos_Limpios($_POST["datos"]["cedula_persona"]),
                                                                                "area_produccion"      => $this->Datos_Limpios($_POST["datos"]["area_produccion"]),
                                                                                "anios_experiencia"    => $this->Datos_Limpios($_POST["datos"]["anios_experiencia"]),
                                                                                "org_agricola"         => $this->Datos_Limpios($_POST["datos"]["org_agricola"]),
                                                                                "rubro_principal"      => $this->Datos_Limpios($_POST["datos"]["rubro_principal"]),
                                                                                "rubro_alternativo"    => $this->Datos_Limpios($_POST["datos"]["rubro_alternativo"]),
                                                                                "financiado"           => $this->Datos_Limpios($_POST["datos"]["financiado"]),
                                                                                "registro_INTI"        => $this->Datos_Limpios($_POST["datos"]["registro_INTI"]),
                                                                                "constancia_productor" => $this->Datos_Limpios($_POST["datos"]["constancia_productor"]),
                                                                                "senial_hierro"        => $this->Datos_Limpios($_POST["datos"]["senial_hierro"]),
                                                                                "agua_riego"           => $this->Datos_Limpios($_POST["datos"]["agua_riego"]),
                                                                                "produccion_actual"    => $this->Datos_Limpios($_POST["datos"]["produccion_actual"]),
                                                                                "estado"               => $this->Datos_Limpios($_POST["datos"]["estado"]),
                                                                            );
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

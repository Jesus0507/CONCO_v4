<?php

class Grupos_Deportivos_Validacion extends Validacion
{
    public $mensaje;
    private $Errores;
    private $datos;


    public function __construct()
    {
        parent::__construct();
        $this->datos= $_POST['datos'];
    }

    public function Validacion_Registro()
    {
       $this->Errores = array();
        if (!empty($_POST) && isset($_POST)) {
            if ($this->datos["id_deporte"] == 0 &&
                $this->Comprobar($this->$datos["nombre_grupo_deportivo"]) &&
                $this->Comprobar($this->$datos["cedula_propietario"]) &&
                $this->Comprobar($this->$datos["descripcion"]) 
                )
             {
                $this->Errores[] = 'Debe llenar los datos del formulario';
            } else {
                if ($this->datos["id_deporte"] == 0) {
                    $this->Errores[] = 'El campo de deporte es obligatorio';
                  } else {
                    if (!is_numeric($this->datos["id_deporte"])) {
                        $this->Errores[] = 'la id es invalida.';
                    } else {
                        if ($this->Comprobar($this->datos["nombre_grupo_deportivo"])) {
                            $this->Errores[] = 'El campo grupo deporivo es obligatorio';
                        } else { 
                               if ($this->Validar_Caracteres($this->datos["nombe_grupo_deportivo"])) {
                                $this->Errores[] = "El campo grupo deportivo no debe tener caracteres especiales.";
                            } else {
                                    if ($this->comprobar($this->datos["cedula_persona"])) {
                                        $Errores[] = "El campo cédula es obligatorio ";
                                    } else {
                                            if ($this->Validar_Cedula($this->datos["cedula_persona"])) {
                                                $this->Errores[] = "La cedula es invalida.";
                                            } else {
                                                if ($this->Comprobar($this->datos["descripcion"])) {
                                                    $this->Errores[] = 'El campo descrición de grupo deportivo es obligatorio';
                                                } else {
                                                    if ($this->Validar_Caraceres($this->datos["descripcion"])) {
                                                        $this->Errores[] = 'El rif es inválido verifique que la informacion sea correcta.';
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
    public function Datos_Validos(){
        return $this->datos;
    }
}

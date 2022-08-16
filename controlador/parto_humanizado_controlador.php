<?php

class Parto_Humanizado extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        //    $this->Cargar_Modelo("parto_humanizado");
    }
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();$this->vista->Cargar_Vistas('parto_humanizado/consultar'); 
    } 
    // ==============================================================================
    public function Establecer_Consultas()
    {
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("SQL", "SQL_01");$this->datos["parto_humanizado"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_04");$this->datos["personas"] = $this->modelo->Administrar();
        $this->vista->datos      = $this->datos;
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Registros':$this->vista->Cargar_Vistas('parto_humanizado/registrar');break;
            case 'Consultas':$this->vista->Cargar_Vistas('parto_humanizado/consultar');break;
            case 'Consulta_Ajax':$this->Escribir_JSON($this->datos["parto_humanizado"]);break;

            case 'Administrar':
                if (isset($_POST['datos'])) {
                    $this->modelo->Datos($_POST['datos']);
                } else {
                    $this->modelo->Estado($_POST['estado']);
                    $this->modelo->Datos([
                        $_POST['estado']["id_tabla"] => $_POST['estado']["param"],
                        "estado"                     => $_POST['estado']["estado"],
                    ]);
                }
                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");

                if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            case 'Persona_Parto_Humanizado':
                $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", $_POST['sql']);
                $this->modelo->__SET("consultar", array(
                    "tabla"   => "parto_humanizado",
                    "columna" => "id_parto_humanizado",
                    "data"    => $_POST['id'],
                ));
                $retornar = $this->modelo->Administrar();
                $this->Escribir_JSON($retornar);unset($_POST, $retornar);
                break;

            case 'Existente':
                $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
                $this->modelo->__SET("consultar", array(
                    "tabla"   => "personas",
                    "columna" => "cedula_persona",
                    "data"    => $_POST['cedula_persona'],
                ));
                $consulta  = $this->modelo->Administrar();$respuesta = "";
                if (count($consulta) == 0 || $consulta[0]['estado'] == 0 || $consulta[0]['estado'] == 2) {
                    $respuesta = "Esta persona no se encuentra registrada";
                } else {
                    if ($consulta[0]['genero'] == 'M') {$respuesta = "Esta cédula no es válida, su propietario es masculino.";} 
                    else {$respuesta = 1;}
                }
                echo ($respuesta);unset($respuesta, $consulta);
                break;

            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }

}

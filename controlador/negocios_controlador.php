<?php

class Negocios extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        //   $this->Cargar_Modelo("negocios");
    }
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();$this->vista->Cargar_Vistas('negocios/consultar');
    } 
    // ==============================================================================
    public function Establecer_Consultas()
    {
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("SQL", "SQL_01");$this->datos["negocios"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "_01_");
        $this->modelo->__SET("consultar", array("tabla" => "calles", "estado" => 1, "orden" => "nombre_calle"));
        $this->datos["calle"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_04");$this->datos["personas"] = $this->modelo->Administrar();
        $this->vista->datos = $this->datos;
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();$this->Establecer_Consultas();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Registros':$this->vista->Cargar_Vistas('negocios/registrar');break;
            case 'Consultas':$this->vista->Cargar_Vistas('negocios/consultar');break;

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

                if ($this->modelo->Administrar()) {$this->mensaje = 1; $this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            case 'Consulta_Ajax':$this->Escribir_JSON($this->datos["negocios"]);break;

            case 'Existente':
                foreach ($this->datos["negocios"] as $key => $value) {
                    if ($value["rif_negocio"] == $_POST['rif_negocio']) {$existente = 1;} else {$existente = 0;}
                }
                echo ($existente);unset($existente);
                break;

            case 'Consultas_Calle':
                foreach ($this->datos["calle"] as $key => $value) {
                    if ($value["nombre_calle"] == $_POST['calle']) { $id = $value["id_calle"];}
                }
                echo $id;unset($id);
                break;

            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

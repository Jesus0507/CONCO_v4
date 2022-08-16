<?php

class Inmuebles extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        //  $this->Cargar_Modelo("inmuebles");
    }
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();$this->vista->Cargar_Vistas('inmueble/consultar');
    }
    // ==============================================================================
    public function Establecer_Consultas()
    {
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("SQL", "SQL_01");$this->datos["inmueble"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "_01_");
        $this->modelo->__SET("consultar", array("tabla" => "calles", "estado" => 1, "orden" => "nombre_calle"));
        $this->datos["calle"] = $this->modelo->Administrar();
        $this->modelo->__SET("consultar", array("tabla" => "tipo_inmueble", "estado" => 1, "orden" => "nombre_tipo"));
        $this->datos["tipo_inmueble"] = $this->modelo->Administrar();
        $this->vista->datos = $this->datos;
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();$this->Establecer_Consultas();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Registros':$this->vista->Cargar_Vistas('inmueble/registrar');break;
            case 'Consultas':$this->vista->Cargar_Vistas('inmueble/consultar');break;

            case 'Eliminar':
                $this->modelo->Estado($_POST['estado']);
                $this->modelo->Datos([
                    $_POST['estado']["id_tabla"] => $_POST['estado']["param"],
                    "estado"                     => $_POST['estado']["estado"],
                ]);
                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");

                if ($this->modelo->Administrar()) { $this->mensaje = 1;$this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            case 'Administrar':
                $cont = 0;
                foreach ($this->datos["tipo_inmueble"] as $datos_t) {
                    if ($datos_t["nombre_tipo"] == $_POST['datos']['id_tipo_inmueble']) {
                        $_POST['datos']["id_tipo_inmueble"] = $datos_t["id_tipo_inmueble"];

                        $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                        $this->modelo->Datos($_POST['datos']);

                        if ($this->modelo->Administrar()) { $this->mensaje = 1; $this->Accion($_POST['accion']);} 

                        echo $this->mensaje;$cont++;
                    }
                }

                if ($cont == 0) { 
                    $this->modelo->__SET("SQL", "_02_");$this->modelo->__SET("tipo", "1");
                    $this->modelo->__SET("registrar", array("tabla"   => "tipo_inmueble","columna" => "nombre_tipo"));
                    $this->modelo->Datos(["nombre_tipo" => $_POST['datos']["id_tipo_inmueble"], "estado" => 1]);

                    if ($this->modelo->Administrar()) {

                        $this->modelo->__SET("SQL", "_03_");$this->modelo->__SET("tipo", "0");
                        $this->modelo->__SET("ultimo", array("tabla" => "tipo_inmueble", "id" => "id_tipo_inmueble"));
                        $id = $this->modelo->Administrar();
                        foreach ($id as $i) {
                            $_POST['datos']["id_tipo_inmueble"] = $i['MAX(id_tipo_inmueble)'];
                            $this->modelo->Datos($_POST['datos']);
                            $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");

                            if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}
                            echo $this->mensaje;
                        }
                    }
                }
                unset($cont,$id,$_POST,$this->mensaje);
                break;

            case 'Consulta_Ajax':$this->Escribir_JSON($this->datos["inmueble"]);break;

            case 'Consultas_Calle':
                foreach ($this->datos["calle"] as $key => $value) {
                    if ($value["nombre_calle"] == $_POST['calle']) {$id = $value["id_calle"];}
                }
                echo $id;unset($id);
                break;
                
            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

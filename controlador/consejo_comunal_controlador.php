<?php

class Consejo_Comunal extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        //   $this->Cargar_Modelo("consejo_comunal");
    }
// ==============================VISTAS=====================================
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();$this->vista->Cargar_Vistas('consejo_comunal/consultar');
    }
// ==============================================================================

    public function Establecer_Consultas()
    {
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("SQL", "SQL_01");$this->datos["consejo_comunal"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_04");$this->datos["personas"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "_01_");
        $this->modelo->__SET("consultar", array("tabla" => "comite", "estado" => 1, "orden" => "nombre_comite"));
        $this->datos["comite"] = $this->modelo->Administrar();
        $this->vista->datos = $this->datos;
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();$this->Establecer_Consultas();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Registros':$this->vista->Cargar_Vistas('consejo_comunal/registrar');break;
            case 'Consultas':$this->vista->Cargar_Vistas('consejo_comunal/consultar');break;
            case 'Consulta_Ajax':$this->Escribir_JSON($this->datos["consejo_comunal"]);break;

            case 'Registrar':
                foreach ($this->datos["comite"] as $tabla_comite) {
                    if ($tabla_comite["nombre_comite"] == $_POST['datos']["nombre_comite"]) {
                        $id_comite = $tabla_comite["id_comite"];
                    }
                }
                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                $this->modelo->Datos([
                    'id_comite'      => $id_comite,
                    'cedula_persona' => $_POST['datos']["cedula_persona"],
                    'cargo_persona'  => $_POST['datos']["cargo_persona"],
                    'fecha_ingreso'  => $_POST['datos']["fecha_ingreso"],
                    'fecha_salida'   => $_POST['datos']["fecha_salida"],
                ]);
                if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($this->mensaje,$_POST,$id_comite);
                break;
            case 'Eliminar':
                $this->modelo->__SET("eliminar", array(
                    "tabla"    => $_POST['estado']["tabla"],
                    "id_tabla" => $_POST['estado']["id_tabla"]));
                $this->modelo->Datos([$_POST['estado']["id_tabla"] => $_POST['estado']["param"]]);

                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            case 'Editar':
                foreach ($this->datos["comite"] as $tabla_comite) {
                    if ($tabla_comite["nombre_comite"] == $_POST['datos']["nombre_comite"]) {
                        $id_comite = $tabla_comite["id_comite"];
                    }
                }
                $this->modelo->__SET("SQL", "_07_");$this->modelo->__SET("tipo", "1");
                $this->modelo->__SET("eliminar", array("tabla" => "comite_persona", "id_tabla" => "id_comite_persona"));
                $this->modelo->Datos(["id_comite_persona" => $_POST['datos']["id_comite_persona"]]);

                if ($this->modelo->Administrar()) {
                    $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                    $this->modelo->Datos([
                        'id_comite'      => $id_comite,
                        'cedula_persona' => $_POST['datos']["cedula_persona"],
                        'cargo_persona'  => $_POST['datos']["cargo_persona"],
                        'fecha_ingreso'  => $_POST['datos']["fecha_ingreso"],
                        'fecha_salida'   => $_POST['datos']["fecha_salida"],
                    ]);
                    if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}
                }
                echo $this->mensaje;unset($this->mensaje, $_POST, $id_comite);
                break;

            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}
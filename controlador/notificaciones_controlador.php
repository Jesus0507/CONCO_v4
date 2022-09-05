<?php
class Notificaciones extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        //    $this->Cargar_Modelo("notificaciones");
    }
    public function Establecer_Consultas()
    {
        $notificaciones              = $this->modelo->Consultar($_SESSION['cedula_usuario']);
        $this->vista->notificaciones = $notificaciones; //datos para mandar a la vista
        $this->datos_notificaciones  = $notificaciones; //datos para usar en el controlador
    }
// ==============================VISTAS=====================================

    public function Cargar_Vistas()
    {
        $this->Establecer_Consultas();
        $this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('notificaciones/index');
    }
    // public function Notificacion()
    // {
    //     $this->Seguridad_de_Session();
    //     $this->Establecer_Consultas();
    //     $this->vista->Cargar_Vistas('notificaciones/consultar');
    // }

    // ==============================CRUD=====================================

    public function Nueva_notificacion()
    {
        $datos = $_POST['datos'];
        $this->modelo->Registrar($datos);
    }

    // public function Consultar_notificaciones()
    // {
    //     $this->Establecer_Consultas();

    //     $this->Escribir_JSON($this->datos_notificaciones);
    // }

    public function Set_status()
    {
        $data = [
            "id_notificacion" => $_POST['id'],
            "leido"           => 1,
        ];

        $this->modelo->setStatus($data);
    }

    public function Consultas_Receptores_Ajax()
    {
        $receptores1 = $this->modelo->get_receptores_1();
        // $receptores2=$this->modelo->get_receptores_2();

        $retornar = [];

        foreach ($receptores1 as $r) {
            $retornar[] = [
                "cedula_usuario" => $r['cedula_persona'],
            ];
        }

        // foreach ($receptores2 as $r) {
        //     $retornar[]=[
        //         "cedula_usuario" => $r['cedula_usuario']
        //     ];
        // }

        $this->Escribir_JSON($retornar);

    }
    // ==============================================================================
    public function Establecer_Consultas2()
    {
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("consultar", $_SESSION['cedula_usuario']);
        $this->modelo->__SET("SQL", "SQL_02");
        $this->datos["notificaciones"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "_01_");
        $this->modelo->__SET("consultar", array("tabla" => "personas", "estado" => 1, "orden" => "cedula_persona"));
        $this->datos["receptores"] = $this->modelo->Administrar();
        $this->vista->datos        = $this->datos;
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas2();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Listar':$this->vista->Cargar_Vistas('notificaciones/index'); break;
            case 'Consultas':$this->vista->Cargar_Vistas('notificaciones/consultar');break;

            case 'Administrar':
                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                $this->modelo->Datos($_POST['datos']);
                if ($this->modelo->Administrar()) {$this->mensaje = 1;}

                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            case 'Consulta_Ajax':$this->Escribir_JSON($this->datos["notificaciones"]);
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

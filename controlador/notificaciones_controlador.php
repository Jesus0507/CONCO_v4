<?php
class Notificaciones extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        //    $this->Cargar_Modelo("notificaciones");
    }

    public function Cargar_Vistas()
    {
        $this->Establecer_Consultas();$this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('notificaciones/index');
    }
    // ==============================================================================
    public function Establecer_Consultas2()
    {
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("consultar", $_SESSION['cedula_usuario']);
        $this->modelo->__SET("SQL", "SQL_02");$this->datos["notificaciones"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_05");$this->datos["receptores"]     = $this->modelo->Administrar();
        $this->vista->datos        = $this->datos;
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();$this->Establecer_Consultas2();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Listar':   $this->vista->Cargar_Vistas('notificaciones/index');    break;
            case 'Consultas':$this->vista->Cargar_Vistas('notificaciones/consultar');break;

            case 'Administrar':
                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                $this->modelo->Datos($_POST['datos']);
                if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            case 'Nueva':
                $this->modelo->__SET("SQL", $_POST['sql']);
                $this->modelo->__SET("tipo", "1");
                $accion = $_POST['datos']['tipo_notificacion'] . "/" . $_SESSION['nombre'] . " " . $_SESSION['apellido'] . " " . $_POST['datos']['accion'];
                $this->modelo->Datos([
                    'usuario_emisor'   => $_SESSION['cedula_usuario'],
                    'usuario_receptor' => $_POST['datos']['usuario_receptor'],
                    'accion'           => $accion,
                    'leido'            => 0,
                ]);
                if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            case 'Receptores':
                $retornar = [];
                foreach ($this->datos["receptores"] as $r) {
                    $retornar[] = ["cedula_usuario" => $r['cedula_persona']];
                }
                $this->Escribir_JSON($retornar);unset($retornar);
                break;

            case 'Consulta_Ajax':$this->Escribir_JSON($this->datos["notificaciones"]);break;

            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

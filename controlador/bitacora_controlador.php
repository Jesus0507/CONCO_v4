<?php

class Bitacora extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        $this->vista->mensaje = "";
        // $this->Cargar_Modelo("bitacora");
    }
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();$this->vista->Cargar_Vistas('seguridad/bitacora');
    }
    // =============================================================================
    public function Establecer_Consultas()
    {
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("SQL", "SQL_01");$this->datos["bitacoras"] = $this->modelo->Administrar();
        $this->vista->datos = $this->datos;
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();$this->Establecer_Consultas();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Consultas':$this->vista->Cargar_Vistas('seguridad/bitacora');break;
            
            case 'Consulta_Ajax':
                for ($i = 0; $i < count($this->datos["bitacoras"]); $i++) {
                    $acciones     = "";
                    $separado     = explode("/", $this->datos["bitacoras"][$i]['acciones']);
                    $usuario      = "";
                    $acciones_Ver = "";

                    for ($j = 0; $j < (count($separado) - 1); $j++) {
                        $acciones_Ver .= "-" . $separado[$j] . "<br><br><hr>";
                    }

                    $usuario = $this->datos["bitacoras"][$i]['primer_nombre'] . " " . $this->datos["bitacoras"][$i]['primer_apellido'];

                    $acciones = "<button class='btn btn-info' onclick='mostrar_acciones(`$acciones_Ver`,`$usuario`)'><em class='fas fa-eye'></em></button>";

                    $this->datos["bitacoras"][$i]['acciones'] = $acciones;
                    $this->datos["bitacoras"][$i]['usuario']  = $usuario;
                }
                $this->Escribir_JSON($this->datos["bitacoras"]);
                unset($acciones, $usuario, $separado, $acciones_Ver);
                break;

            case 'Administrar':

                foreach ($this->datos["bitacoras"] as $b) {
                    if ($b['cedula_usuario'] == $_SESSION['cedula_usuario'] && $b['hora_fin'] == "Activo") {
                        $b['acciones'] = $b['acciones'] . $accion . "/";

                        $this->modelo->__SET("tipo", "1");$this->modelo->__SET("SQL", "SQL_04");
                        $this->modelo->Datos(["acciones" => $b['acciones'], "id_bitacora" => $b['id_bitacora']]);
                        if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                    }
                }
                unset($this->mensaje);
                break;

            case 'Nueva':
                foreach ($this->datos["bitacoras"] as $b) {
                    if ($b['cedula_usuario'] == $_SESSION['cedula_usuario'] && $b['hora_fin'] == "Activo") {
                        $b['acciones'] = $b['acciones'] . $_POST['nueva_accion'] . "/";

                        if ($_POST['tipo'] != 1) {$_SESSION['modulo_actual'] = $_POST['tipo'];}

                        $this->modelo->__SET("tipo", "1");$this->modelo->__SET("SQL", "SQL_04");
                        $this->modelo->Datos(["acciones" => $b['acciones'], "id_bitacora" => $b['id_bitacora']]);
                        if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                    }
                }
                unset($this->mensaje);
                break;
            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

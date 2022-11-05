<?php

class Bitacora extends Controlador
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.
    private $permisos; #permisos correspondiente del modulo
    private $peticion; #peticion a ejecutar de la funcion administrar
    private $sql; #nombre de la sentencia SQL que se ejecutara en el modelo
    private $datos_ejecutar; #array con datos para enviar a la bd
    private $datos_consulta; #array con los datos necesarios para el modulo (consultas)
    private $accion; #accion para enviar a la bitacora
    private $mensaje; #mensaje que se mandara a la vista
    
    // DATOS independientes usados para el manejo del modulo
    private $cedula_usuario;
    private $nueva_accion;
    public $tipo;
    private $acciones;
    private $separado;
    private $usuario;
    private $acciones_Ver;

    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        $this->permisos       = $_SESSION['Seguridad'];
        $this->sql            = $_POST['sql'];
        $this->accion         = $_POST['accion'];
        $this->mensaje        = 1;
        $this->cedula_usuario = $_SESSION['cedula_usuario'];
        $this->tipo           = $_POST['tipo'];
        $this->acciones       = "";
        $this->usuario        = "";
        $this->acciones_Ver   = "";
        $this->nueva_accion   = $_POST['nueva_accion'];
        // $this->Cargar_Modelo("bitacora");
    }

    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_01");
        $this->datos_consulta["bitacoras"] = $this->modelo->Administrar();
        $this->vista->datos                = $this->Get_Datos_Vista();
    }

    // ==================GETTERS=========================
    #getters usados para obtener la informacion de las variables privadas
    # retornan tipo string o array
    public function Get_Sql(): string           {return $this->sql;}
    public function Get_Mensaje(): string       {return $this->mensaje;}
    public function Get_Datos(): array          {return $this->datos_ejecutar;}
    public function Get_Datos_Vista(): array    {return $this->datos_consulta;}

    // =============================================================================

    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        if ($this->permisos['consultar'] === 1 || $this->permisos['registrar'] === 1) {
            $this->vista->Cargar_Vistas('seguridad/bitacora');
        } else { $this->_403_();}
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        $this->peticion = (isset($_POST['peticion'])) ? $_POST['peticion'] : $peticion[0];

        switch ($this->peticion) {
            case 'Consultas':
                if ($this->permisos['consultar'] === 1 || $this->permisos['registrar'] === 1) {
                    $this->vista->Cargar_Vistas('seguridad/bitacora');
                } else { $this->_403_();}
                break;

            case 'Consulta_Ajax':
                if ($this->permisos['consultar'] === 1 || $this->permisos['registrar'] === 1) {
                    for ($i = 0; $i < count($this->datos_consulta["bitacoras"]); $i++) {

                        $this->separado = explode("/", $this->datos_consulta["bitacoras"][$i]['acciones']);

                        for ($j = 0; $j < (count($this->separado) - 1); $j++) {
                            $this->acciones_Ver .= "-" . $this->separado[$j] . "<br><hr>";
                        }

                        $this->usuario = $this->datos_consulta["bitacoras"][$i]['primer_nombre'] . " " . $this->datos_consulta["bitacoras"][$i]['primer_apellido'];

                        $this->acciones = "<button class='btn btn-info' onclick='mostrar_acciones(`$this->acciones_Ver`,`$this->usuario`)'><em class='fas fa-eye'></em></button>";

                        $this->datos_consulta["bitacoras"][$i]['acciones'] = $this->acciones;
                        $this->datos_consulta["bitacoras"][$i]['usuario']  = $this->usuario;
                    }
                    $this->Escribir_JSON($this->Get_Datos_Vista()["bitacoras"]);
                } else { $this->_403_();}

                break;

            case 'Administrar':
                if ($this->permisos['consultar'] === 1 || $this->permisos['registrar'] === 1) {
                    foreach ($this->datos_consulta["bitacoras"] as $b) {
                        if ($b['cedula_usuario'] == $this->cedula_usuario && $b['hora_fin'] == "Activo") {
                            $b['acciones'] = $b['acciones'] . $this->accion . "/";

                            $this->modelo->_Tipo_(1);
                            $this->modelo->_SQL_("SQL_04");
                            $this->datos_ejecutar = array("acciones" => $b['acciones'], "id_bitacora" => $b['id_bitacora']);
                            $this->modelo->_Datos_($this->Get_Datos());
                            if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                        }
                    }
                } else { $this->_403_();}
                break;

            case 'Nueva':
                if ($this->permisos['consultar'] === 1 || $this->permisos['registrar'] === 1) {
                    foreach ($this->datos_consulta["bitacoras"] as $b) {
                        if ($b['cedula_usuario'] == $this->cedula_usuario && $b['hora_fin'] == "Activo") {
                            $b['acciones'] = $b['acciones'] . $this->nueva_accion . "/";

                            if ($this->tipo != 1) {$_SESSION['modulo_actual'] = $this->tipo;}

                            $this->modelo->_Tipo_(1);
                            $this->modelo->_SQL_("SQL_04");
                            $this->datos_ejecutar = array("acciones" => $b['acciones'], "id_bitacora" => $b['id_bitacora']);
                            $this->modelo->_Datos_($this->Get_Datos());
                            $this->modelo->Administrar();
                        }
                    }
                } else { $this->_403_();}
                break;
            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        exit();
    }
}

<?php

class Solicitudes extends Controlador
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.
    private $permisos; #permisos correspondiente del modulo
    private $peticion; #peticion a ejecutar de la funcion administrar
    private $estado; #array con parametros de eliminacion logica (tabla,id_tabla,param,estado)
    private $estado_ejecutar; #array con parametro a ejecutar (id_tabla, estado)
    private $sql; #nombre de la sentencia SQL que se ejecutara en el modelo
    private $datos_ejecutar; #array con datos para enviar a la bd
    private $datos_consulta; #array con los datos necesarios para el modulo (consultas)
    private $accion; #accion para enviar a la bitacora
    private $mensaje; #mensaje que se mandara a la vista
    private $crud; #array con peticion generica sql

    // DATOS independientes usados para el manejo del modulo
    private $id;
    private $personas_familia;
    private $integrante;
    private $observaciones;
    private $digital_sign;
    private $public_key;
    private $firma;
    private $procesada;
    private $id_solicitud;
    private $respuesta;
    public $data;
    public $confirm;
    public $cedula;
    public $clave_publica;
    public $clave_privada;
    public $solicitud;

    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        $this->permisos       = $_SESSION["Solicitudes"];
        $this->estado         = $_POST['estado'];
        $this->datos_ejecutar = $_POST['datos'];
        $this->sql            = $_POST['sql'];
        $this->accion         = $_POST['accion'];
        $this->id             = $_GET['id'];
        $this->mensaje        = 1;
        $this->observaciones  = $_POST['observaciones'];
        $this->digital_sign   = $_SESSION['digital_sign'];
        $this->public_key     = $_SESSION['public_key'];
        $this->procesada      = $_POST['procesada'];
        $this->id_solicitud   = $_POST['id'];
        $this->cedula         = $_POST['cedula'];
        $this->clave_publica  = $_POST['public_key'];
        $this->clave_privada  = $_POST['private_key'];
        $this->firma          = $_POST['firma'];

        $this->estado_ejecutar = array($this->estado["id_tabla"] => $this->estado["param"], "estado" => $this->estado["estado"]);
        //  $this->Cargar_Modelo("solicitudes");
    }

    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_02");
        $this->datos_consulta["solicitudes"] = $this->modelo->Administrar();

        $this->modelo->_SQL_("SQL_03");
        $this->datos_consulta["solicitudes_todas"] = $this->modelo->Administrar();
        $this->vista->datos                        = $this->Get_Datos_Vista();
    }

    // ==================GETTERS=========================
    #getters usados para obtener la informacion de las variables privadas
    # retornan tipo string o array
    private function Get_Sql(): string
    {
        return $this->sql;
    }
    private function Get_Accion(): string
    {
        return $this->accion;
    }
    private function Get_Mensaje(): string
    {
        return $this->mensaje;
    }
    private function Get_Datos(): array
    {
        return $this->datos_ejecutar;
    }
    private function Get_Estado(): array
    {
        return $this->estado;
    }
    private function Get_Estado_Ejecutar(): array
    {
        return $this->estado_ejecutar;
    }
    private function Get_Datos_Vista(): array
    {
        return $this->datos_consulta;
    }
    private function Get_Crud_Sql(): array
    {
        return $this->crud;
    }

    // ==============================================================================
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        if ($this->permisos["consultar"] === 1) {
            $this->vista->Cargar_Vistas('solicitudes/index');
        } else {
            $this->_403_();
        }
    }

    // ==============================================================================
    public function Administrar($peticion = null)
    {
        // $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        $this->peticion = (isset($_POST['peticion'])) ? $_POST['peticion'] : $peticion[0];
        switch ($this->peticion) {
            case 'Solicitudes':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('solicitudes/index');
                } else {
                    $this->_403_();
                }
                break;

            case 'Solicitud':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('solicitudes/consultar');
                } else {
                    $this->_403_();
                }
                break;

            case 'Solicitud_Vivienda':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('solicitudes/consultar_vivienda');
                } else {
                    $this->_403_();
                }
                break;

            case 'Solicitud_View_Only':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('solicitudes/consultar_only_view');
                } else {
                    $this->_403_();
                }
                break;

            case 'Consulta_Ajax':
                $this->Escribir_JSON($this->Get_Datos_Vista()["solicitudes"]);
                break;

            case 'Consulta_Todas':
                $this->Escribir_JSON($this->Get_Datos_Vista()["solicitudes_todas"]);
                break;

            case 'Solicitud_Familia':
                $this->modelo->_SQL_("_05_");
                $this->modelo->_Tipo_(0);

                $this->crud["consultar"] = array(
                    "tabla"   => "solicitudes",
                    "columna" => "id_solicitud",
                    "data"    => $this->id
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->datos_consulta["solicitud"] = $this->modelo->Administrar();

                $this->crud["consultar"] = array(
                    "tabla"   => "personas",
                    "columna" => "cedula_persona",
                    "data"    => $this->datos_consulta["solicitud"][0]['cedula_persona'],
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->datos_consulta["solicitante"] = $this->modelo->Administrar();

                $this->crud["consultar"] = array(
                    "tabla"   => "familia",
                    "columna" => "id_familia",
                    "data"    => $this->datos_consulta["solicitud"][0]['observaciones'],
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->datos_consulta["familia"] = $this->modelo->Administrar();

                $this->crud["consultar"] = array(
                    "tabla"   => "vivienda",
                    "columna" => "id_vivienda",
                    "data"    => $this->datos_consulta["familia"][0]['id_vivienda'],
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->datos_consulta["vivienda"] = $this->modelo->Administrar();

                $this->crud["consultar"] = array(
                    "tabla"   => "familia_personas",
                    "columna" => "id_familia",
                    "data"    => $this->datos_consulta["solicitud"][0]['observaciones'],
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->datos_consulta["integrantes"] = $this->modelo->Administrar();

                $this->personas_familia = [];

                foreach ($this->datos_consulta["integrantes"] as $i) {

                    $this->crud["consultar"] = array(
                        "tabla"   => "personas",
                        "columna" => "cedula_persona",
                        "data"    => $i['cedula_persona'],
                    );
                    $this->modelo->_CRUD_($this->Get_Crud_Sql());
                    $this->integrante         = $this->modelo->Administrar();
                    $this->personas_familia[] = $this->integrante[0];
                }
                $this->datos_consulta["integrantes"] = $this->personas_familia;
                $this->vista->Cargar_Vistas('solicitudes/consultar_familia');
                break;

            case 'Estado_Contrasenia':
                $this->confirm = explode('/', $this->observaciones);
                if ($this->Codificar(strtolower($this->confirm[1])) != $this->digital_sign) {
                    echo 0;
                } else {
                    if ($this->confirm[2] != $this->public_key) {
                        echo 1;
                    } else {
                        $this->confirm = $this->confirm[0] . '/' . $this->digital_sign . '/' . $this->confirm[2];

                        $this->datos_ejecutar = [
                            "id_solicitud"  => $this->id_solicitud,
                            "procesada"     => $this->procesada,
                            "observaciones" => $this->confirm,
                        ];

                        $this->modelo->_Datos_($this->Get_Datos());
                        $this->modelo->_SQL_("SQL_10");
                        $this->modelo->_Tipo_(1);

                        if ($this->modelo->Administrar()) {
                            echo 'proceder';
                        }
                    }
                }
                break;

            case 'Establecer_Estado':
                if ($this->permisos["registrar"] === 1 || $this->permisos["modificar"] === 1) {
                    $this->datos_ejecutar = [
                        "id_solicitud"  => $this->id_solicitud,
                        "procesada"     => $this->procesada,
                        "observaciones" => $this->observaciones,
                    ];

                    $this->modelo->_Datos_($this->Get_Datos());
                    $this->modelo->_SQL_("SQL_10");
                    $this->modelo->_Tipo_(1);
                    echo $this->modelo->Administrar();
                } else {
                    $this->_403_();
                }
                break;

            case 'Aprobar_Cambio_Clave':
                $this->modelo->_SQL_("_05_");
                $this->modelo->_Tipo_(0);
                $this->crud["consultar"] = array(
                    "tabla"   => "personas",
                    "columna" => "cedula_persona",
                    "data"    => $this->cedula,
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->datos_consulta["persona"] = $this->modelo->Administrar();

                foreach ($this->datos_consulta["persona"] as $p) {
                    $this->modelo->_Tipo_(1);
                    $this->modelo->_SQL_("_04_");

                    $this->crud["actualizar"] = array(
                        "tabla"    => "personas",
                        "columna"  => "contrasenia",
                        "id_tabla" => "cedula_persona",
                    );
                    $this->modelo->_CRUD_($this->Get_Crud_Sql());

                    $this->datos_ejecutar = array(
                        "contrasenia"    => $p['contrasenia_nueva'],
                        "cedula_persona" => $this->cedula,
                    );

                    $this->modelo->_Datos_($this->Get_Datos());
                    if ($this->modelo->Administrar()) {
                        $this->mensaje = 1;
                    }

                    $this->crud["actualizar"] = array(
                        "tabla"    => "personas",
                        "columna"  => "user_locked",
                        "id_tabla" => "cedula_persona",
                    );
                    $this->modelo->_CRUD_($this->Get_Crud_Sql());

                    $this->datos_ejecutar = array(
                        "user_locked"    => "0",
                        "cedula_persona" => $this->cedula,
                    );

                    $this->modelo->_Datos_($this->Get_Datos());
                    if ($this->modelo->Administrar()) {
                        $this->mensaje = 1;
                    }
                }

                $this->datos_ejecutar = [
                    "id_solicitud"  => $this->id_solicitud,
                    "procesada"     => $this->procesada,
                    "observaciones" => $this->observaciones,
                ];

                $this->modelo->_Datos_($this->Get_Datos());
                $this->modelo->_SQL_("SQL_10");
                $this->modelo->_Tipo_(1);

                if ($this->modelo->Administrar()) {
                    echo true;
                }

                break;

            case 'Ver_Claves':
                $this->respuesta = [
                    'public' => 0,
                    'priv'   => 0,
                    'firma'  => '',
                ];

                if ($this->validKeys($this->clave_publica, $this->clave_privada)) {
                    $this->respuesta = [
                        'public' => 1,
                        'priv'   => 1,
                        'firma'  => $this->Decodificar($this->firma),
                    ];
                }

                echo json_encode($this->respuesta);
                break;

            case 'Consultar_Solicitudes_Vivienda':
                $this->modelo->_Tipo_("0");
                $this->modelo->_SQL_("SQL_04");
                $this->modelo->_ID_($this->id_solicitud);
                $this->solicitud = $this->modelo->Administrar();
                $this->modelo->_ID_($this->solicitud[0]['observaciones']);
                $this->modelo->_SQL_("SQL_05");
                $this->solicitud[0]['servicio_gas'] = $this->modelo->Administrar();
                $this->modelo->_SQL_("SQL_06");
                $this->solicitud[0]['tipos_techo'] = $this->modelo->Administrar();
                $this->modelo->_SQL_("SQL_07");
                $this->solicitud[0]['tipos_piso'] = $this->modelo->Administrar();
                $this->modelo->_SQL_("SQL_08");
                $this->solicitud[0]['tipos_pared'] = $this->modelo->Administrar();
                $this->modelo->_SQL_("SQL_09");
                $this->solicitud[0]['electrodomesticos'] = $this->modelo->Administrar();

                $this->solicitud[0]['gas_detalle'] = "<table style='width:100%'><tr><td>Tipo de Bombona</td>";
                $this->solicitud[0]['gas_detalle'] .= "<td>Días de duración</td></tr>";

                foreach ($this->solicitud[0]['servicio_gas'] as $g) {
                    $this->solicitud[0]['gas_detalle'] .= "<td>" . $g['tipo_bombona'] . "</td><td>" . $g['dias_duracion'] . "</td></tr>";
                }
                $this->solicitud[0]['gas_detalle'] .= "</table>";

                $this->Escribir_JSON($this->solicitud);
                unset($this->solicitud);
                break;

            case 'Nueva_solicitud':
                if ($this->permisos["registrar"] === 1) {
                    $this->datos_ejecutar['observaciones'] = "";
                    $this->datos_ejecutar['procesada']     = 0;
                    echo $this->datos_ejecutar;
                    $this->modelo->_Datos_($this->Get_Datos());
                    $this->modelo->_SQL_("SQL_01");
                    $this->modelo->_Tipo_(1);
                    if ($this->modelo->Administrar()) {
                        echo true;
                    }
                } else {
                    $this->_403_();
                }
                break;
            case 'Nueva_solicitud_cambio_contrasenia':
                $this->datos_ejecutar['observaciones'] = "";
                $this->datos_ejecutar['procesada']     = 0;
                echo $this->datos_ejecutar;
                $this->modelo->_Datos_($this->Get_Datos());
                $this->modelo->_SQL_("SQL_01");
                $this->modelo->_Tipo_(1);
                if ($this->modelo->Administrar()) {
                    echo true;
                }
                break;

            case 'Nueva_Solicitud_Familia':

                $this->modelo->_SQL_("_03_");
                $this->modelo->_Tipo_(0);
                $this->crud["ultimo"] = array("tabla" => "familia", "id" => "id_familia");
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->id                              = $this->modelo->Administrar();
                $this->datos_ejecutar['observaciones'] = $this->id[0]['MAX(id_familia)'];
                $this->datos_ejecutar['procesada']     = 0;
                $this->modelo->_Datos_($this->Get_Datos());
                $this->modelo->_SQL_("SQL_01");
                $this->modelo->_Tipo_(1);
                echo $this->modelo->Administrar();
                break;

            case 'Nueva_Solicitud_Vivienda':

                $this->modelo->_SQL_("_03_");
                $this->modelo->_Tipo_(0);
                $this->crud["ultimo"] = array("tabla" => "vivienda", "id" => "id_vivienda");
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->id                              = $this->modelo->Administrar();
                $this->datos_ejecutar['observaciones'] = $this->id[0]['MAX(id_vivienda)'];
                $this->datos_ejecutar['procesada']     = 0;
                $this->modelo->_Datos_($this->Get_Datos());
                $this->modelo->_SQL_("SQL_01");
                $this->modelo->_Tipo_(1);
                echo $this->modelo->Administrar();
                break;

            default:
                $this->vista->Cargar_Vistas('error/400');
                break;
        }
        exit();
    }

    // ==============================================================================

}

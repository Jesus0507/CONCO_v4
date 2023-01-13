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
    {return $this->sql;}
    private function Get_Accion(): string
    {return $this->accion;}
    private function Get_Mensaje(): string
    {return $this->mensaje;}
    private function Get_Datos(): array
    {return $this->datos_ejecutar;}
    private function Get_Estado(): array
    {return $this->estado;}
    private function Get_Estado_Ejecutar(): array
    {return $this->estado_ejecutar;}
    private function Get_Datos_Vista(): array
    {return $this->datos_consulta;}
    private function Get_Crud_Sql(): array
    {return $this->crud;}

    // ==============================================================================

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        $this->peticion = (isset($_POST['peticion'])) ? $_POST['peticion'] : $peticion[0];
        switch ($this->peticion) {
            case 'Solicitudes':
                $this->vista->Cargar_Vistas('solicitudes/index');
                break;

            case 'Solicitud':
                $this->vista->Cargar_Vistas('solicitudes/consultar');
                break;

            case 'Solicitud_Vivienda':
                $this->vista->Cargar_Vistas('solicitudes/consultar_vivienda');
                break;

            case 'Solicitud_View_Only':
                $this->vista->Cargar_Vistas('solicitudes/consultar_only_view');
                break;

            case 'Consulta_Ajax':$this->Escribir_JSON($this->Get_Datos_Vista()["solicitudes"]);
                break;

            case 'Consulta_Todas':$this->Escribir_JSON($this->Get_Datos_Vista()["solicitudes_todas"]);
                break;

            case 'Solicitud_Familia':
                $this->modelo->_SQL_("_05_");
                $this->modelo->_Tipo_(0);

                $this->crud["consultar"] = array(
                    "tabla"   => "solicitudes",
                    "columna" => "id_solicitud",
                    "data"    => $this->id);
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

                $this->datos_ejecutar = [
                    "id_solicitud"  => $this->id_solicitud,
                    "procesada"     => $this->procesada,
                    "observaciones" => $this->observaciones,
                ];

                $this->modelo->_Datos_($this->Get_Datos());
                $this->modelo->_SQL_("SQL_10");
                $this->modelo->_Tipo_(1);
                echo $this->modelo->Administrar();
                break;

            case 'Aprobar_Cambio_Clave':

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
                    if ($this->modelo->Administrar()) {$this->mensaje = 1;}

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
                    if ($this->modelo->Administrar()) {$this->mensaje = 1;}
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
                $this->datos_ejecutar['observaciones'] = "";
                $this->datos_ejecutar['procesada'] = 0;
                $this->modelo->_Datos_($this->Get_Datos());
                $this->modelo->_SQL_("SQL_01");
                $this->modelo->_Tipo_(1);
                if ($this->modelo->Administrar()) {
                    echo true;
                }
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        exit();
    }

    // ==============================================================================
    public function Cargar_Vistas()
    {
        
        $this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('solicitudes/index');
    }
    // public function Solicitud()
    // {
    //     $this->Seguridad_de_Session();
    //     $this->vista->Cargar_Vistas('solicitudes/consultar');
    // }

    // public function Solicitud_vivienda()
    // {
    //     $this->Seguridad_de_Session();
    //     $this->vista->Cargar_Vistas('solicitudes/consultar_vivienda');
    // }

    // public function Solicitud_familia()
    // {
    //     $this->Seguridad_de_Session();
    //     $solicitud                = $this->Consultar_Columna("solicitudes", "id_solicitud", $_GET['id']);
    //     $this->vista->solicitud   = $solicitud;
    //     $solicitante              = $this->Consultar_Columna("personas", "cedula_persona", $solicitud[0]['cedula_persona']);
    //     $this->vista->solicitante = $solicitante;
    //     $familia                  = $this->Consultar_Columna("familia", "id_familia", $solicitud[0]['observaciones']);
    //     $this->vista->familia     = $familia;
    //     $vivienda                 = $this->Consultar_Columna("vivienda", "id_vivienda", $familia[0]['id_vivienda']);
    //     $this->vista->vivienda    = $vivienda;
    //     $integrantes              = $this->Consultar_Columna("familia_personas", "id_familia", $solicitud[0]['observaciones']);
    //     $personas_familia         = [];
    //     foreach ($integrantes as $i) {
    //         $integrante         = $this->Consultar_Columna("personas", "cedula_persona", $i['cedula_persona']);
    //         $personas_familia[] = $integrante[0];
    //     }
    //     $this->vista->integrantes = $personas_familia;
    //     $this->vista->Cargar_Vistas('solicitudes/consultar_familia');
    // }

    // public function Solicitud_viewOnly()
    // {
    //     $this->Seguridad_de_Session();
    //     $this->vista->Cargar_Vistas('solicitudes/consultar_only_view');
    // }

    function print() {
        $this->Seguridad_de_Session();
        $solicitudes = $this->modelo->Consultar_all();

        foreach ($solicitudes as $s) {
            if ($s['id_solicitud'] == $_GET['id']) {

                $header_constancia = "";
                $body_constancia   = "";
                $footer_constancia = "";

                switch ($s['tipo_constancia']) {

                    case "Residencia":

                        $header_constancia = "<table style='width:100%'><tr><td style='width:10%'></td><td style='width:80%'>REPUBLICA BOLIVARIANA DE VENEZUELA<br>CONSEJO COMUNAL<br>PRADOS DE OCCIDENTE SECTOR III<br>RIF. J-30725585 CODIGO 13-03-04-608-0002<br>Barquisimeto Municipio Iribarren<br>Parroquia Guerrera Ana Soto Estado Lara<br><u><h4>CONSTANCIA DE RESIDENCIA</h4></u></td><td style='width:10%'></td></tr></table>";

                        break;

                    case "Buena conducta":
                        break;

                    case "No poseer vivienda":
                        break;

                }

                $this->vista->header_constancia = $header_constancia;

                $this->vista->titulo = "Constancia de " . $s['tipo_constancia'];
                $this->vista->Cargar_Vistas('solicitudes/constancia_pdf');

            }
        }

    }

    // ==============================CRUD=====================================

    // public function Nueva_solicitud()
    // {
    //     $datos                  = $_POST['datos'];
    //     $datos['observaciones'] = "";
    //     echo $this->modelo->Registrar($datos);

    // }

    public function Nueva_solicitud_vivienda()
    {
        $datos  = $_POST['datos'];
        $ultimo = $this->Ultimo_Ingresado("vivienda", "id_vivienda");
        $id     = '';
        foreach ($ultimo as $i) {
            $id = $i['MAX(id_vivienda)'];

        }
        $datos['observaciones'] = $id;
        echo $this->modelo->Registrar($datos);

    }

    public function Nueva_solicitud_familia()
    {
        $datos  = $_POST['datos'];
        $ultimo = $this->Ultimo_Ingresado("familia", "id_familia");
        $id     = '';
        foreach ($ultimo as $i) {
            $id = $i['MAX(id_familia)'];

        }
        $datos['observaciones'] = $id;
        echo $this->modelo->Registrar($datos);

    }

    // public function Consultar_solicitudes()
    // {
    //     $this->Establecer_Consultas();
    //     $this->Escribir_JSON($this->datos_solicitudes);
    // }

    // public function Consultar_solicitudes_vivienda()
    // {
    //     $solicitud                    = $this->modelo->get_solicitud_vivienda($_POST['id']);
    //     $solicitud[0]['servicio_gas'] = $this->modelo->get_info_vivienda_gas($solicitud[0]['observaciones']);
    //     $solicitud[0]['tipos_techo']  = $this->modelo->get_info_vivienda_techos($solicitud[0]['observaciones']);
    //     $solicitud[0]['tipos_piso']   = $this->modelo->get_info_vivienda_pisos($solicitud[0]['observaciones']);
    //     $solicitud[0]['tipos_pared']  = $this->modelo->get_info_vivienda_paredes($solicitud[0]['observaciones']);
    //     $solicitud[0]['gas_detalle']  = "<table style='width:100%'><tr><td>Tipo de Bombona</td>";
    //     $solicitud[0]['gas_detalle'] .= "<td>Días de duración</td></tr>";

    //     foreach ($solicitud[0]['servicio_gas'] as $g) {
    //         $solicitud[0]['gas_detalle'] .= "<td>" . $g['tipo_bombona'] . "</td><td>" . $g['dias_duracion'] . "</td></tr>";
    //     }

    //     $solicitud[0]['gas_detalle'] .= "</table>";

    //     $solicitud[0]['electrodomesticos'] = $this->modelo->get_info_vivienda_electrodomesticos($solicitud[0]['observaciones']);

    //     $this->Escribir_JSON($solicitud);
    // }

    // public function Consultar_solicitudes_all()
    // {
    //     $solicitudes = $this->modelo->Consultar_all();

    //     $this->Escribir_JSON($solicitudes);
    // }

    // public function Set_status()
    // {
    //     $data = [
    //         "id_solicitud"  => $_POST['id'],
    //         "procesada"     => $_POST['procesada'],
    //         "observaciones" => $_POST['observaciones'],
    //     ];

    //     $this->modelo->setStatus($data);

    // }

    // public function Set_status_contrasenia()
    // {
    //     $confirm = explode('/', $_POST['observaciones']);
    //     if ($this->Codificar(strtolower($confirm[1])) != $_SESSION['digital_sign']) {
    //         echo 0;
    //     } else {
    //         if ($confirm[2] != $_SESSION['public_key']) {
    //             echo 1;
    //         } else {
    //             $confirm = $confirm[0] . '/' . $_SESSION['digital_sign'] . '/' . $confirm[2];
    //             $data    = [
    //                 "id_solicitud"  => $_POST['id'],
    //                 "procesada"     => $_POST['procesada'],
    //                 "observaciones" => $confirm,
    //             ];

    //             $this->modelo->setStatus($data);
    //             echo 'proceder';
    //         }
    //     }
    // }

    // public function check_keys()
    // {
    //     $resp = [
    //         'public' => 0,
    //         'priv'   => 0,
    //         'firma'  => '',
    //     ];

    //     if ($this->validKeys($_POST['public_key'], $_POST['private_key'])) {
    //         $resp = [
    //             'public' => 1,
    //             'priv'   => 1,
    //             'firma'  => $this->Decodificar($_POST['firma']),
    //         ];
    //     }

    //     echo json_encode($resp);
    // }

    // public function approve_change_password()
    // {
    //     $persona = $this->Consultar_Columna("personas", "cedula_persona", $_POST['cedula']);
    //     foreach ($persona as $p) {
    //         $this->Actualizar_tablas('personas', 'contrasenia', 'cedula_persona', $p['contrasenia_nueva'], $_POST['cedula']);
    //         $this->Actualizar_tablas('personas', 'user_locked', 'cedula_persona', '0', $_POST['cedula']);
    //     }
    //     $data = [
    //         "id_solicitud"  => $_POST['id'],
    //         "procesada"     => $_POST['procesada'],
    //         "observaciones" => $_POST['observaciones'],
    //     ];

    //     $this->modelo->setStatus($data);

    //     echo true;
    // }
}

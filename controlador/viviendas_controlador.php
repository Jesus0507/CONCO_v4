<?php
class Viviendas extends Controlador
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
    private $validar; #objeto con la clase validacion correspondiente al modulo
    private $crud; #array con peticion generica sql

    // DATOS independientes usados para el manejo del modulo
    private $datos;
    public $consulta;
    public $id_servicio;
    public $servicio;
    public $id;
    public $id_tipo_pared;
    public $id_tipo_piso;
    public $id_tipo_techo;
    private $id_vivienda;
    public $gases;
    public $id_gas;
    public $electrodomesticos;
    public $id_elect;
    public $techos;
    public $pisos;
    public $paredes;
    public $tabla;
    public $familia;
    public $ids;
    public $family;
    public $existe;
    public $servicios_vivienda;
    public $retornar;
    public $companias;
    public $gas;
    public $texto;
    public $electrodomesticos_vivienda;
    public $electrodomesticos_all;
    private $electrodomestico;

    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        $this->Validacion("Viviendas");
        $this->permisos          = $_SESSION["Viviendas"];
        $this->estado            = $_POST['estado'];
        $this->datos_ejecutar    = $_POST['vivienda'];
        $this->sql               = $_POST['sql'];
        $this->accion            = $_POST['accion'];
        $this->datos             = $_POST['datos'];
        $this->id_servicio       = $this->datos_ejecutar['id_servicio'];
        $this->validar           = $this->validacion;
        $this->mensaje           = 1;
        $this->id_vivienda       = $_POST['id_vivienda'];
        $this->gases             = $_POST['gases'];
        $this->gas               = $_POST['gas'];
        $this->electrodomesticos = $_POST['electrodomesticos'];
        $this->electrodomestico  = $_POST['electrodomestico'];
        $this->techos            = $_POST['techos'];
        $this->pisos             = $_POST['pisos'];
        $this->paredes           = $_POST['paredes'];
        $this->estado_ejecutar   = array($this->estado["id_tabla"] => $this->estado["param"], "estado" => $this->estado["estado"]);
        //    $this->Cargar_Modelo("viviendas");
    }
    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_01");
        $this->datos_consulta["viviendas"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("_01_");
        $this->crud["consultar"] = array("tabla" => "tipo_vivienda", "estado" => 1, "orden" => "nombre_tipo_vivienda");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["tipo_vivienda"] = $this->modelo->Administrar();
        $this->crud["consultar"]               = array("tabla" => "calles", "estado" => 1, "orden" => "nombre_calle");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["calle"] = $this->modelo->Administrar();
        $this->crud["consultar"]       = array("tabla" => "tipo_techo", "estado" => 1, "orden" => "techo");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["tipo_techo"] = $this->modelo->Administrar();
        $this->crud["consultar"]            = array("tabla" => "tipo_pared", "estado" => 1, "orden" => "pared");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["tipo_pared"] = $this->modelo->Administrar();
        $this->crud["consultar"]            = array("tabla" => "tipo_piso", "estado" => 1, "orden" => "piso");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["tipo_piso"] = $this->modelo->Administrar();
        $this->crud["consultar"]           = array("tabla" => "servicio_gas", "estado" => 1, "orden" => "nombre_servicio_gas");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["servicios_gas"] = $this->modelo->Administrar();
        $this->crud["consultar"]               = array("tabla" => "electrodomesticos", "estado" => 1, "orden" => "id_electrodomestico");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["electrodomesticos"] = $this->modelo->Administrar();
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
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        if ($this->permisos["consultar"] === 1) {
            $this->vista->Cargar_Vistas('vivienda/consultar');
        } else { $this->_403_();}
    }
    // ==============================================================================
    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        $this->peticion = (isset($_POST['peticion'])) ? $_POST['peticion'] : $peticion[0];
        switch ($this->peticion) {
            case 'Registros':
                if ($this->permisos["registrar"] === 1) {
                    $this->vista->Cargar_Vistas('vivienda/registrar');
                } else { $this->_403_();}
                break;
            case 'Consultas':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('vivienda/consultar');
                } else { $this->_403_();}
                break;

            case 'Registrar':
                if ($this->permisos["registrar"] === 1) {
                    $this->modelo->_SQL_("SQL_12");
                    $this->modelo->_Tipo_(1);
                    $this->modelo->_Datos_($this->id_servicio);
                    if ($this->modelo->Administrar()) {
                        $this->existe = 0;
                        $this->modelo->_SQL_("_03_");
                        $this->modelo->_Tipo_(0);
                        $this->crud["ultimo"] = array("tabla" => "servicios", "id" => "id_servicio");
                        $this->modelo->_CRUD_($this->Get_Crud_Sql());
                        $this->servicio                      = $this->modelo->Administrar();
                        $this->datos_ejecutar['id_servicio'] = $this->servicio[0]['MAX(id_servicio)'];

                        foreach ($this->datos_consulta["tipo_vivienda"] as $tv) {
                            if (strtolower($tv['nombre_tipo_vivienda']) == strtolower($this->datos_ejecutar['id_tipo_vivienda'])) {
                                $this->existe = $tv['id_tipo_vivienda'];
                            }
                        }
                        if ($this->existe == 0) {
                            $this->modelo->_SQL_("_02_");
                            $this->modelo->_Tipo_(1);
                            $this->crud["registrar"] = array(
                                "tabla"   => "tipo_vivienda",
                                "columna" => "nombre_tipo_vivienda",
                            );
                            $this->modelo->_CRUD_($this->Get_Crud_Sql());
                            $this->modelo->_Datos_(["nombre_tipo_vivienda" => $this->Get_Datos_()['id_tipo_vivienda'], "estado" => 1]);
                            if ($this->modelo->Administrar()) {
                                $this->modelo->_SQL_("_03_");
                                $this->modelo->_Tipo_(0);
                                $this->crud["ultimo"] = array("tabla" => "tipo_vivienda", "id" => "id_tipo_vivienda");
                                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                                $this->id                                 = $this->modelo->Administrar();
                                $this->datos_ejecutar['id_tipo_vivienda'] = $this->id[0]['MAX(id_tipo_vivienda)'];
                            }
                        } else {
                            $this->datos_ejecutar['id_tipo_vivienda'] = $this->existe;
                        }

                        $this->modelo->_SQL_($this->Get_Sql());
                        $this->modelo->_Tipo_(1);
                        $this->modelo->_Datos_($this->Get_Datos());
                        if ($this->modelo->Administrar()) {
                            $this->mensaje = 1;
                            $this->modelo->_SQL_("_03_");
                            $this->modelo->_Tipo_(0);
                            $this->crud["ultimo"] = array("tabla" => "vivienda", "id" => "id_vivienda");
                            $this->modelo->_CRUD_($this->Get_Crud_Sql());
                            $this->id = $this->modelo->Administrar();
                            $this->id = $this->id[0]['MAX(id_vivienda)'];
                            foreach ($this->datos_consulta["tipo_techo"] as $techo) {
                                foreach ($this->techos as $tipo) {
                                    if ($techo["techo"] == $tipo["id_tipo_techo"]) {$this->id_tipo_techo[] = $techo["id_tipo_techo"];}
                                }
                            }
                            foreach ($this->datos_consulta["tipo_pared"] as $pared) {
                                foreach ($this->paredes as $tipo) {
                                    if ($pared["pared"] == $tipo["id_tipo_pared"]) {$this->id_tipo_pared[] = $pared["id_tipo_pared"];}
                                }
                            }
                            foreach ($this->datos_consulta["tipo_piso"] as $piso) {
                                foreach ($this->pisos as $tipo) {
                                    if ($piso["piso"] == $tipo["id_tipo_piso"]) {$this->id_tipo_piso[] = $piso["id_tipo_piso"];}
                                }
                            }
                            if (isset($this->id_tipo_techo)) {
                                for ($i = 0; $i < count($this->id_tipo_techo); $i++) {
                                    $this->modelo->_SQL_("SQL_13");
                                    $this->modelo->_Tipo_(1);
                                    $this->modelo->_Datos_([
                                        'id_tipo_techo' => $this->id_tipo_techo[$i],
                                        'id_vivienda'   => $this->id,
                                        'estado'        => 1,
                                    ]);
                                    $this->modelo->Administrar();
                                }
                            }

                            if (isset($this->id_tipo_pared)) {
                                for ($i = 0; $i < count($this->id_tipo_pared); $i++) {
                                    $this->modelo->_SQL_("SQL_14");
                                    $this->modelo->_Tipo_(1);
                                    $this->modelo->_Datos_([
                                        'id_tipo_pared' => $this->id_tipo_pared[$i],
                                        'id_vivienda'   => $this->id,
                                        'estado'        => 1,
                                    ]);
                                    $this->modelo->Administrar();
                                }
                            }
                            if (isset($this->id_tipo_piso)) {
                                for ($i = 0; $i < count($this->id_tipo_piso); $i++) {
                                    $this->modelo->_SQL_("SQL_15");
                                    $this->modelo->_Tipo_(1);
                                    $this->modelo->_Datos_([
                                        'id_tipo_piso' => $this->id_tipo_piso[$i],
                                        'id_vivienda'  => $this->id,
                                        'estado'       => 1,
                                    ]);
                                    $this->modelo->Administrar();
                                }
                            }
                            for ($i = 0; $i < count($this->gases); $i++) {
                                if ($this->gases[$i]['nuevo'] == '0') {
                                    $this->modelo->_SQL_("SQL_16");
                                    $this->modelo->_Tipo_(1);
                                    $this->modelo->_Datos_([
                                        "id_servicio_gas" => $this->gases[$i]['servicio_gas'],
                                        "id_vivienda"     => $this->id,
                                        "tipo_bombona"    => $this->gases[$i]['tipo_bombona'],
                                        "dias_duracion"   => $this->gases[$i]['tiempo_duracion'],
                                        "estado"          => 1,
                                    ]);
                                    $this->modelo->Administrar();
                                } else {
                                    $this->modelo->_SQL_("_02_");
                                    $this->modelo->_Tipo_(1);
                                    $this->crud["registrar"] = array(
                                        "tabla"   => "servicio_gas",
                                        "columna" => "nombre_servicio_gas");
                                    $this->modelo->_CRUD_($this->Get_Crud_Sql());
                                    $this->modelo->_Datos_(["nombre_servicio_gas" => $this->gases[$i]['servicio_gas'], "estado" => 1]);
                                    if ($this->modelo->Administrar()) {
                                        $this->modelo->_SQL_("_03_");
                                        $this->modelo->_Tipo_(0);
                                        $this->crud["ultimo"] = array("tabla" => "servicio_gas", "id" => "id_servicio_gas");
                                        $this->modelo->_CRUD_($this->Get_Crud_Sql());
                                        $this->id_gas = $this->modelo->Administrar();
                                    }
                                    $this->modelo->_SQL_("SQL_16");
                                    $this->modelo->_Tipo_(1);
                                    $this->modelo->_Datos_([
                                        "id_servicio_gas" => $this->id_gas[0]['MAX(id_servicio_gas)'],
                                        "id_vivienda"     => $this->id,
                                        "tipo_bombona"    => $this->gases[$i]['tipo_bombona'],
                                        "dias_duracion"   => $this->gases[$i]['tiempo_duracion'],
                                        "estado"          => 1,
                                    ]);
                                    $this->modelo->Administrar();
                                }
                            }
                            for ($i = 0; $i < count($this->electrodomesticos); $i++) {
                                if ($this->electrodomesticos[$i]['nuevo'] == '0') {
                                    $this->modelo->_SQL_("SQL_17");
                                    $this->modelo->_Tipo_(1);
                                    $this->modelo->_Datos_([
                                        "id_electrodomestico" => $this->electrodomesticos[$i]['electrodomestico'],
                                        "id_vivienda"         => $this->id,
                                        "cantidad"            => $this->electrodomesticos[$i]['cantidad'],
                                        "estado"              => 1,
                                    ]);
                                    $this->modelo->Administrar();
                                } else {
                                    $this->modelo->_SQL_("_02_");
                                    $this->modelo->_Tipo_(1);
                                    $this->crud["registrar"] = array(
                                        "tabla"   => "electrodomesticos",
                                        "columna" => "nombre_electrodomestico",
                                    );
                                    $this->modelo->_CRUD_($this->Get_Crud_Sql());
                                    $this->modelo->_Datos_(["nombre_electrodomestico" => $this->electrodomesticos[$i]['electrodomestico'], "estado" => 1]);
                                    if ($this->modelo->Administrar()) {
                                        $this->modelo->_SQL_("_03_");
                                        $this->modelo->_Tipo_(0);
                                        $this->crud["ultimo"] = array("tabla" => "electrodomesticos", "id" => "id_electrodomestico");
                                        $this->modelo->_CRUD_($this->Get_Crud_Sql());
                                        $this->id_elect = $this->modelo->Administrar();
                                    }
                                    $this->modelo->_SQL_("SQL_16");
                                    $this->modelo->_Tipo_(1);
                                    $this->id_elect = $this->id_elect[0]['MAX(id_electrodomestico)'];
                                    $this->modelo->_Datos_([
                                        "id_electrodomestico" => $this->id_elect,
                                        "id_vivienda"         => $this->id,
                                        "cantidad"            => $this->electrodomesticos[$i]['cantidad'],
                                        "estado"              => 1,
                                    ]);
                                    $this->modelo->Administrar();
                                }
                            }
                        }

                    }
                    $this->Accion($this->Get_Accion());
                    echo $this->Get_Mensaje();
                } else { $this->_403_();}
                break;

            case 'Actualizar':
                if ($this->permisos["modificar"] === 1) {
                    $this->modelo->_Tipo_(0);
                    $this->modelo->_SQL_("_05_");

                    $this->crud["consultar"] = array(
                        "tabla"   => $this->datos["tabla"],
                        "columna" => $this->datos["columna"],
                        "data"    => $this->datos_ejecutar['id_vivienda'],
                    );
                    $this->modelo->_CRUD_($this->Get_Crud_Sql());
                    $this->servicios_vivienda = $this->modelo->Administrar();
                    $this->modelo->_SQL_("SQL_12");
                    $this->modelo->_Tipo_(1);
                    $this->modelo->_Datos_($this->datos_ejecutar['id_servicio']);
                    if ($this->modelo->Administrar()) {
                        $this->existe = 0;
                        $this->modelo->_SQL_("_03_");
                        $this->modelo->_Tipo_(0);

                        $this->crud["ultimo"] = array("tabla" => "servicios", "id" => "id_servicio");
                        $this->modelo->_CRUD_($this->Get_Crud_Sql());
                        $this->id_servicio                   = $this->modelo->Administrar();
                        $this->datos_ejecutar['id_servicio'] = $this->id_servicio[0]['MAX(id_servicio)'];

                        foreach ($this->datos_consulta["tipo_vivienda"] as $tv) {
                            if (strtolower($tv['nombre_tipo_vivienda']) == strtolower($this->datos_ejecutar['id_tipo_vivienda'])) {
                                $this->existe = $tv['id_tipo_vivienda'];
                            }
                        }
                        if ($this->existe == 0) {
                            $this->modelo->_SQL_("_02_");
                            $this->modelo->_Tipo_(1);

                            $this->crud["registrar"] = array(
                                "tabla"   => "tipo_vivienda",
                                "columna" => "nombre_tipo_vivienda");
                            $this->modelo->_CRUD_($this->Get_Crud_Sql());
                            $this->modelo->_Datos_(["nombre_tipo_vivienda" => $this->datos_ejecutar['id_tipo_vivienda'], "estado" => 1]);
                            if ($this->modelo->Administrar()) {
                                $this->modelo->_SQL_("_03_");
                                $this->modelo->_Tipo_(0);

                                $this->crud["ultimo"] = array("tabla" => "tipo_vivienda", "id" => "id_tipo_vivienda");
                                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                                $this->id                                 = $this->modelo->Administrar();
                                $this->datos_ejecutar['id_tipo_vivienda'] = $this->id[0]['MAX(id_tipo_vivienda)'];
                            }
                        } else {
                            $this->datos_ejecutar['id_tipo_vivienda'] = $this->existe;
                        }
                        $this->modelo->_SQL_($this->Get_Sql());
                        $this->modelo->_Tipo_(1);
                        $this->modelo->_Datos_($this->datos_ejecutar);

                        if ($this->modelo->Administrar()) {

                            $this->Accion($this->Get_Accion());
                            $this->modelo->_SQL_("_07_");
                            $this->modelo->_Tipo_(1);

                            $this->crud["eliminar"] = array(
                                "tabla" => "servicios", "id_tabla" => "id_servicio");
                            $this->modelo->_CRUD_($this->Get_Crud_Sql());
                            $this->modelo->_Datos_(["id_servicio" => $this->servicios_vivienda[0]['id_servicio']]);
                            $this->modelo->Administrar();
                        }
                    }
                    echo $this->Get_Mensaje();
                } else { $this->_403_();}
                break;

            case 'Consulta_Ajax':
                $this->tabla = [];

                foreach ($this->datos_consulta["viviendas"] as $value) {
                    $this->modelo->_Tipo_(0);
                    $this->modelo->_ID_($value['id_vivienda']);
                    $this->modelo->_SQL_("SQL_08");
                    $this->gas = $this->modelo->Administrar();
                    $this->modelo->_SQL_("SQL_09");
                    $this->electrodomesticos = $this->modelo->Administrar();
                    $this->modelo->_SQL_("SQL_03");
                    $this->techos = $this->modelo->Administrar();
                    $this->modelo->_SQL_("SQL_05");
                    $this->pisos = $this->modelo->Administrar();
                    $this->modelo->_SQL_("SQL_07");
                    $this->paredes = $this->modelo->Administrar();
                    $this->modelo->_SQL_("SQL_04");
                    $this->familia = $this->modelo->Administrar();

                    foreach ($this->familia as $v) {$this->family = $v['nombre_familia'];}
                    $value['familia'] = $this->family;
                    $this->tabla[]    = [
                        "nombre_calle"          => $value["nombre_calle"],
                        "nombre_tipo_vivienda"  => $value["nombre_tipo_vivienda"],
                        "condicion_vivienda"    => $value["condicion_vivienda"],
                        "direccion_vivienda"    => $value["direccion_vivienda"],
                        "numero_casa"           => $value["numero_casa"],
                        "cantidad_habitaciones" => $value["cantidad_habitaciones"],
                        "espacio_siembra"       => $value["espacio_siembra"],
                        "hacinamiento"          => $value["hacinamiento"],
                        "banio_sanitario"       => $value["banio_sanitario"],
                        "condicion"             => $value["condicion"],
                        "animales_domesticos"   => $value["animales_domesticos"],
                        "insectos_roedores"     => $value["insectos_roedores"],
                        "agua_consumo"          => $value["agua_consumo"],
                        "aguas_negras"          => $value["aguas_negras"],
                        "residuos_solidos"      => $value["residuos_solidos"],
                        "cable_telefonico"      => $value["cable_telefonico"],
                        "internet"              => $value["internet"],
                        "servicio_electrico"    => $value["servicio_electrico"],
                        "ver"                   => "<a style='background: #4dbdbd !important;' href='javascript:void(0)' class='btn bg-info ver-popup' title='Ver' type='button' onclick='Ver(`" . json_encode($value) . "`,`" . json_encode($this->techos) . "`,`" . json_encode($this->paredes) . "`,`" . json_encode($this->pisos) . "`,`" . json_encode($this->gas) . "`,`" . json_encode($this->electrodomesticos) . "`);'><i class='fa fa-eye'></i></a>",
                        "editar"                => "<a href='javascript:void(0)' class='btn bg-info btnEditar'  title='Actualizar' type='button' data-toggle='modal' data-target='#actualizar' onclick='Modificar(" . json_encode($value["id_vivienda"]) . ",`" . json_encode($value) . "`,`" . json_encode($this->techos) . "`,`" . json_encode($this->paredes) . "`,`" . json_encode($this->pisos) . "`,`" . json_encode($this->gas) . "`,`" . json_encode($this->electrodomesticos) . "`)'><i class='fa fa-edit' style='color: white;'></i></a>",
                        "eliminar"              => ' <a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar" onclick="Eliminar(' . json_encode($value["id_vivienda"]) . ',' . $value['id_servicio'] . ')"><i class="fa fa-trash"></i></a>',
                    ];
                }
                $this->Escribir_JSON($this->tabla);
                unset($this->tabla, $this->gas, $this->electrodomesticos, $this->techos, $this->pisos, $this->paredes, $this->familia, $this->family);
                break;

            case 'Agregar':

                $this->modelo->_Tipo_(0);
                $this->modelo->_SQL_("_05_");

                $this->crud["consultar"] = array(
                    "tabla"   => $this->datos["tabla"],
                    "columna" => $this->datos["columna"],
                    "data"    => $this->datos["data"],
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->consulta = $this->modelo->Administrar();
                $mensaje        = "Este elemento ya se encuentra asignado";
                switch ($this->datos["buscar"]) {
                    case 'id_tipo_techo':
                        foreach ($this->consulta as $value) {
                            if ($value["id_tipo_techo"] == $this->datos["id"]) {$this->mensaje = $mensaje;}}
                        break;
                    case 'id_tipo_pared':
                        foreach ($this->consulta as $value) {
                            if ($value["id_tipo_pared"] == $this->datos["id"]) {$this->mensaje = $mensaje;}}
                        break;
                    case 'id_tipo_piso':
                        foreach ($this->consulta as $value) {
                            if ($value["id_tipo_piso"] == $this->datos["id"]) {$this->mensaje = $mensaje;}}
                        break;
                }

                if ($this->mensaje == 1) {
                    $this->modelo->_Tipo_(1);
                    $this->modelo->_SQL_($this->Get_Sql());
                    $this->modelo->_Datos_([
                        $this->datos["buscar"] => $this->datos["id"],
                        "id_vivienda"          => $this->datos["data"],
                        "estado"               => $this->datos["estado"],
                    ]);
                    if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                }
                echo $this->Get_Mensaje();unset($this->consulta, $mensaje, $this->mensaje);
                break;

            case 'Servicio_Gas':
                $this->retornar = 1;
                $this->existe   = "";
                $mensaje        = "Este servicio de gas ya está asociado a esta vivienda";
                $this->modelo->_Tipo_(0);
                $this->modelo->_SQL_("_05_");

                $this->crud["consultar"] = array(
                    "tabla"   => $this->datos["tabla"],
                    "columna" => $this->datos["columna"],
                    "data"    => $this->datos["id"],
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->servicios_vivienda = $this->modelo->Administrar();
                $this->modelo->_SQL_("_01_");

                $this->crud["consultar"] = array("tabla" => "servicio_gas", "estado" => 1, "orden" => "id_servicio_gas");
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->companias = $this->modelo->Administrar();

                if ($this->gas['nuevo'] == 1) {
                    foreach ($this->companias as $c) {
                        if (strtolower($c['nombre_servicio_gas']) == strtolower($this->gas['gas'])) {
                            $this->existe = $c['id_servicio_gas'];
                        }
                    }
                    if ($this->existe == "") {
                        $this->modelo->_SQL_("_02_");
                        $this->modelo->_Tipo_(1);

                        $this->crud["registrar"] = array(
                            "tabla"   => "servicio_gas",
                            "columna" => "nombre_servicio_gas");
                        $this->modelo->_CRUD_($this->Get_Crud_Sql());
                        $this->modelo->_Datos_(["nombre_servicio_gas" => $this->gas['gas'], "estado" => 1]);
                        if ($this->modelo->Administrar()) {
                            $this->modelo->_SQL_("_03_");
                            $this->modelo->_Tipo_(0);

                            $this->crud["ultimo"] = array("tabla" => "servicio_gas", "id" => "id_servicio_gas");
                            $this->modelo->_CRUD_($this->Get_Crud_Sql());
                            $this->id = $this->modelo->Administrar();

                            $this->modelo->_SQL_($this->Get_Sql());
                            $this->modelo->_Tipo_(1);
                            $this->modelo->_Datos_([
                                "id_servicio_gas" => $this->id[0]['MAX(id_servicio_gas)'],
                                "id_vivienda"     => $this->datos["id"],
                                "tipo_bombona"    => $this->gas['tipo_bombona'],
                                "dias_duracion"   => $this->gas['tiempo_duracion'],
                                "estado"          => $this->datos["estado"],
                            ]);
                            $this->modelo->Administrar();
                        }

                    } else {
                        foreach ($this->servicios_vivienda as $sv) {
                            if ($sv['id_servicio_gas'] == $this->existe && $sv['tipo_bombona'] == $this->gas['tipo_bombona'] && $sv['dias_duracion'] == $this->gas['tiempo_duracion']) {
                                $this->retornar = $mensaje;
                            }
                        }
                        if ($this->retornar == 1) {
                            $this->modelo->_SQL_($this->Get_Sql());
                            $this->modelo->_Tipo_(1);
                            $this->modelo->_Datos_([
                                "id_servicio_gas" => $this->existe,
                                "id_vivienda"     => $this->datos["id"],
                                "tipo_bombona"    => $this->gas['tipo_bombona'],
                                "dias_duracion"   => $this->gas['tiempo_duracion'],
                                "estado"          => $this->datos["estado"],
                            ]);
                            $this->modelo->Administrar();
                        }
                    }
                } else {
                    foreach ($this->servicios_vivienda as $sv) {
                        if ($sv['id_servicio_gas'] == $this->gas['gas'] && $sv['tipo_bombona'] == $this->gas['tipo_bombona'] && $sv['dias_duracion'] == $this->gas['tiempo_duracion']) {
                            $this->retornar = $mensaje;
                        }
                    }

                    if ($this->retornar == 1) {
                        $this->modelo->_SQL_($this->Get_Sql());
                        $this->modelo->_Tipo_(1);
                        $this->modelo->_Datos_([
                            "id_servicio_gas" => $this->gas['gas'],
                            "id_vivienda"     => $this->datos["id"],
                            "tipo_bombona"    => $this->gas['tipo_bombona'],
                            "dias_duracion"   => $this->gas['tiempo_duracion'],
                            "estado"          => $this->datos["estado"],
                        ]);
                        $this->modelo->Administrar();
                    }
                }
                echo $this->retornar;unset($this->retornar, $mensaje, $this->existe, $this->servicios_vivienda, $this->companias);
                break;
            case 'Cargar_Gas':

                $this->modelo->_SQL_("_01_");
                $this->crud["consultar"] = array("tabla" => "servicio_gas", "estado" => 1, "orden" => "id_servicio_gas");
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->consulta = $this->modelo->Administrar();
                $this->texto    = "<option value='vacio'>-Compañia-</option>";
                foreach ($this->consulta as $g) {
                    $this->texto .= "<option value='" . $g['id_servicio_gas'] . "'>" . $g['nombre_servicio_gas'] . "</option>";
                }
                echo $this->texto;
                unset($this->consulta, $this->texto);
                break;

            case 'Electrodomesticos':
                $this->retornar = 1;
                $this->existe   = "";
                $mensaje        = "Este electrodomestico ya esta asociado a esta vivienda";
                $this->modelo->_Tipo_(0);
                $this->modelo->_SQL_("_05_");

                $this->crud["consultar"] = array(
                    "tabla"   => $this->datos["tabla"],
                    "columna" => $this->datos["columna"],
                    "data"    => $this->datos["id"],
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->electrodomesticos_vivienda = $this->modelo->Administrar();

                $this->modelo->_SQL_("_01_");

                $this->crud["consultar"] = array("tabla" => "electrodomesticos", "estado" => 1, "orden" => "id_electrodomestico");
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->electrodomesticos_all = $this->modelo->Administrar();

                if ($this->electrodomestico['nuevo'] == 1) {
                    foreach ($this->electrodomesticos_all as $e) {
                        if (strtolower($e['nombre_electrodomestico']) == strtolower($this->electrodomestico['electrodomestico'])) {
                            $this->existe = $e['id_electrodomestico'];
                        }
                    }
                    if ($this->existe == "") {
                        $this->modelo->_SQL_("_02_");
                        $this->modelo->_Tipo_(1);

                        $this->crud["registrar"] = array(
                            "tabla"   => "electrodomesticos",
                            "columna" => "nombre_electrodomestico");
                        $this->modelo->_CRUD_($this->Get_Crud_Sql());
                        $this->modelo->_Datos_(["nombre_electrodomestico" => $this->electrodomestico['electrodomestico'], "estado" => 1]);
                        if ($this->modelo->Administrar()) {
                            $this->modelo->_SQL_("_03_");
                            $this->modelo->_Tipo_(0);

                            $this->crud["ultimo"] = array("tabla" => "electrodomesticos", "id" => "id_electrodomestico");
                            $this->modelo->_CRUD_($this->Get_Crud_Sql());
                            $this->id = $this->modelo->Administrar();

                            $this->modelo->_SQL_($this->Get_Sql());
                            $this->modelo->_Tipo_(1);
                            $this->modelo->_Datos_([
                                "id_electrodomestico" => $this->id[0]['MAX(id_electrodomestico)'],
                                "id_vivienda"         => $this->datos["id"],
                                "cantidad"            => $this->electrodomestico['cantidad'],
                                "estado"              => $this->datos["estado"],
                            ]);
                            $this->modelo->Administrar();
                        }

                    } else {
                        foreach ($this->electrodomesticos_vivienda as $ev) {
                            if ($ev['id_electrodomestico'] == $this->existe) {$this->retornar = $mensaje;}
                        }

                        if ($this->retornar == 1) {
                            $this->modelo->_SQL_($this->Get_Sql());
                            $this->modelo->_Tipo_(1);
                            $this->modelo->_Datos_([
                                "id_electrodomestico" => $this->existe,
                                "id_vivienda"         => $this->datos["id"],
                                "cantidad"            => $this->electrodomestico['cantidad'],
                                "estado"              => $this->datos["estado"],
                            ]);
                            $this->modelo->Administrar();
                        }
                    }
                } else {
                    foreach ($this->electrodomesticos_vivienda as $ev) {
                        if ($ev['id_electrodomestico'] == $this->electrodomestico['electrodomestico']) {
                            $this->retornar = $mensaje;
                        }
                    }

                    if ($this->retornar == 1) {
                        $this->modelo->_SQL_($this->Get_Sql());
                        $this->modelo->_Tipo_(1);
                        $this->modelo->_Datos_([
                            "id_electrodomestico" => $this->electrodomestico['electrodomestico'],
                            "id_vivienda"         => $this->datos["id"],
                            "cantidad"            => $this->electrodomestico['cantidad'],
                            "estado"              => $this->datos["estado"],
                        ]);
                        $this->modelo->Administrar();
                    }
                }
                echo $this->retornar;
                break;

            case 'Cargar_Electrodomesticos':

                $this->modelo->_SQL_("_01_");

                $this->crud["consultar"] = array("tabla" => "electrodomesticos", "estado" => 1, "orden" => "id_electrodomestico");
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->consulta = $this->modelo->Administrar();
                $this->texto    = "<option value='vacio'>-Electrodoméstico-</option>";
                foreach ($this->consulta as $e) {
                    $this->texto .= "<option value='" . $e['id_electrodomestico'] . "'>" . $e['nombre_electrodomestico'] . "</option>";
                }
                echo $this->texto;unset($this->consulta, $this->texto);
                break;

            case 'Obtener':
                $this->modelo->_Tipo_(0);
                $this->modelo->_ID_($_POST['id']);
                $this->modelo->_SQL_($this->Get_Sql());
                $this->consulta = $this->modelo->Administrar();
                $this->Escribir_JSON($this->consulta);unset($this->consulta);
                break;

            case 'Eliminar':
                if ($this->permisos["eliminar"] === 1) {
                    $this->modelo->_SQL_("_07_");
                    $this->modelo->_Tipo_(1);

                    $this->crud["eliminar"] = array(
                        "tabla"    => $this->datos["tabla"],
                        "id_tabla" => $this->datos["id_tabla"]);
                    $this->modelo->_CRUD_($this->Get_Crud_Sql());
                    $this->modelo->_Datos_([$this->datos["id_tabla"] => $this->datos['id']]);
                    if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                    echo $this->Get_Mensaje();unset($this->mensaje);
                } else { $this->_403_();}
                break;

            case 'Eliminar_Vivienda':
                if ($this->permisos["eliminar"] === 1) {
                    $this->modelo->_Estado_($this->Get_Estado());
                    $this->modelo->_Datos_($this->Get_Estado_Ejecutar());
                    $this->modelo->_SQL_($this->Get_Sql());
                    $this->modelo->_Tipo_(1);
                    if ($this->modelo->Administrar()) {
                        $this->Accion($this->Get_Accion());
                        echo $this->Get_Mensaje();
                    }
                } else { $this->_403_();}
                break;

            case 'Activar_Vivienda':
                $this->ids    = explode("-", $this->id_vivienda);
                $this->estado = array(
                    "tabla"    => "viviendas",
                    "id_tabla" => "id_vivienda",
                    "param"    => $this->ids,
                    "estado"   => 1,
                );
                $this->estado_ejecutar = array(
                    $this->estado["id_tabla"] => $this->estado["param"],
                    "estado"                  => $this->estado["estado"],
                );
                $this->modelo->_Estado_($this->Get_Estado());
                    $this->modelo->_Datos_($this->Get_Estado_Ejecutar());
                $this->modelo->_SQL_($this->Get_Sql());
                $this->modelo->_Tipo_(1);
                if ($this->modelo->Administrar()) {
                    $this->Accion($this->Get_Accion());
                    echo $this->Get_Mensaje();
                }
                unset($this->mensaje);
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

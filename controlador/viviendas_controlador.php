<?php

class Viviendas extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        //    $this->Cargar_Modelo("viviendas");
    }

    // ==============================================================================
    public function Establecer_Consultas2()
    {
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("SQL", "SQL_01");
        $this->datos["viviendas"] = $this->modelo->Administrar();

        $this->modelo->__SET("SQL", "_01_");

        $this->modelo->__SET("consultar", array("tabla" => "tipo_vivienda", "estado" => 1, "orden" => "nombre_tipo_vivienda"));
        $this->datos["tipo_vivienda"] = $this->modelo->Administrar();

        $this->modelo->__SET("consultar", array("tabla" => "calles", "estado" => 1, "orden" => "nombre_calle"));
        $this->datos["calle"] = $this->modelo->Administrar();

        $this->modelo->__SET("consultar", array("tabla" => "tipo_techo", "estado" => 1, "orden" => "techo"));
        $this->datos["tipo_techo"] = $this->modelo->Administrar();

        $this->modelo->__SET("consultar", array("tabla" => "tipo_pared", "estado" => 1, "orden" => "pared"));
        $this->datos["tipo_pared"] = $this->modelo->Administrar();

        $this->modelo->__SET("consultar", array("tabla" => "tipo_piso", "estado" => 1, "orden" => "piso"));
        $this->datos["tipo_piso"] = $this->modelo->Administrar();

        $this->modelo->__SET("consultar", array("tabla" => "servicio_gas", "estado" => 1, "orden" => "nombre_servicio_gas"));
        $this->datos["servicios_gas"] = $this->modelo->Administrar();

        $this->modelo->__SET("consultar", array("tabla" => "electrodomesticos", "estado" => 1, "orden" => "id_electrodomestico"));
        $this->datos["electrodomesticos"] = $this->modelo->Administrar();

        $this->vista->datos = $this->datos;
    }
    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas2();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Registros':$this->vista->Cargar_Vistas('vivienda/registrar');
                break;
            case 'Consultas':$this->vista->Cargar_Vistas('vivienda/consultar');
                break;

            case 'Registrar':

                $this->modelo->__SET("SQL", "SQL_12");
                $this->modelo->__SET("tipo", "1");
                $this->modelo->Datos($_POST['vivienda']['id_servicio']);
                if ($this->modelo->Administrar()) {
                    $existe = 0;
                    $this->modelo->__SET("SQL", "_03_");
                    $this->modelo->__SET("tipo", "0");
                    $this->modelo->__SET("ultimo", array("tabla" => "servicios", "id" => "id_servicio"));
                    $id_servicio                      = $this->modelo->Administrar();
                    $_POST['vivienda']['id_servicio'] = $id_servicio[0]['MAX(id_servicio)'];

                    foreach ($this->datos["tipo_vivienda"] as $tv) {
                        if (strtolower($tv['nombre_tipo_vivienda']) == strtolower($_POST['vivienda']['id_tipo_vivienda'])) {
                            $existe = $tv['id_tipo_vivienda'];
                        }
                    }

                    if ($existe == 0) {

                        $this->modelo->__SET("SQL", "_02_");
                        $this->modelo->__SET("tipo", "1");
                        $this->modelo->__SET("registrar", array(
                            "tabla"   => "tipo_vivienda",
                            "columna" => "nombre_tipo_vivienda")
                        );
                        $this->modelo->Datos(["nombre_tipo_vivienda" => $_POST['vivienda']['id_tipo_vivienda'], "estado" => 1]);
                        if ($this->modelo->Administrar()) {
                            $this->modelo->__SET("SQL", "_03_");
                            $this->modelo->__SET("tipo", "0");
                            $this->modelo->__SET("ultimo", array("tabla" => "tipo_vivienda", "id" => "id_tipo_vivienda"));
                            $id                                    = $this->modelo->Administrar();
                            $_POST['vivienda']['id_tipo_vivienda'] = $id[0]['MAX(id_tipo_vivienda)'];
                        }

                    } else {
                        $_POST['vivienda']['id_tipo_vivienda'] = $existe;
                    }

                    $this->modelo->__SET("SQL", $_POST['sql']);
                    $this->modelo->__SET("tipo", "1");
                    $this->modelo->Datos($_POST['vivienda']);

                    if ($this->modelo->Administrar()) {
                        $this->mensaje = 1;
                        $this->Accion($_POST['accion']);

                        $this->modelo->__SET("SQL", "_07_");
                        $this->modelo->__SET("tipo", "1");
                        $this->modelo->__SET("eliminar", array(
                            "tabla" => "servicios", "id_tabla" => "id_servicio"));
                        $this->modelo->Datos(["id_servicio" => $servicios_vivienda[0]['id_servicio']]);
                        $this->modelo->Administrar();
                    }

                }
                echo $this->mensaje;
                break;

            case 'Actualizar':
                $this->modelo->__SET("tipo", "0");
                $this->modelo->__SET("SQL", "_05_");
                $this->modelo->__SET("consultar", array(
                    "tabla"   => $_POST['datos']["tabla"],
                    "columna" => $_POST['datos']["columna"],
                    "data"    => $_POST['vivienda']['id_vivienda'],
                ));
                $servicios_vivienda = $this->modelo->Administrar();

                $this->modelo->__SET("SQL", "SQL_12");
                $this->modelo->__SET("tipo", "1");
                $this->modelo->Datos($_POST['vivienda']['id_servicio']);
                if ($this->modelo->Administrar()) {
                    $existe = 0;
                    $this->modelo->__SET("SQL", "_03_");
                    $this->modelo->__SET("tipo", "0");
                    $this->modelo->__SET("ultimo", array("tabla" => "servicios", "id" => "id_servicio"));
                    $id_servicio                      = $this->modelo->Administrar();
                    $_POST['vivienda']['id_servicio'] = $id_servicio[0]['MAX(id_servicio)'];

                    foreach ($this->datos["tipo_vivienda"] as $tv) {
                        if (strtolower($tv['nombre_tipo_vivienda']) == strtolower($_POST['vivienda']['id_tipo_vivienda'])) {
                            $existe = $tv['id_tipo_vivienda'];
                        }
                    }

                    if ($existe == 0) {

                        $this->modelo->__SET("SQL", "_02_");
                        $this->modelo->__SET("tipo", "1");
                        $this->modelo->__SET("registrar", array(
                            "tabla"   => "tipo_vivienda",
                            "columna" => "nombre_tipo_vivienda")
                        );
                        $this->modelo->Datos(["nombre_tipo_vivienda" => $_POST['vivienda']['id_tipo_vivienda'], "estado" => 1]);
                        if ($this->modelo->Administrar()) {
                            $this->modelo->__SET("SQL", "_03_");
                            $this->modelo->__SET("tipo", "0");
                            $this->modelo->__SET("ultimo", array("tabla" => "tipo_vivienda", "id" => "id_tipo_vivienda"));
                            $id                                    = $this->modelo->Administrar();
                            $_POST['vivienda']['id_tipo_vivienda'] = $id[0]['MAX(id_tipo_vivienda)'];
                        }

                    } else {
                        $_POST['vivienda']['id_tipo_vivienda'] = $existe;
                    }

                    $this->modelo->__SET("SQL", $_POST['sql']);
                    $this->modelo->__SET("tipo", "1");
                    $this->modelo->Datos($_POST['vivienda']);

                    if ($this->modelo->Administrar()) {
                        $this->mensaje = 1;
                        $this->Accion($_POST['accion']);

                        $this->modelo->__SET("SQL", "_07_");
                        $this->modelo->__SET("tipo", "1");
                        $this->modelo->__SET("eliminar", array(
                            "tabla" => "servicios", "id_tabla" => "id_servicio"));
                        $this->modelo->Datos(["id_servicio" => $servicios_vivienda[0]['id_servicio']]);
                        $this->modelo->Administrar();
                    }

                }
                echo $this->mensaje;
                break;

            case 'Consulta_Ajax':
                $tabla = [];

                foreach ($this->datos["viviendas"] as $value) {
                    $this->modelo->__SET("tipo", "0");
                    $this->modelo->__SET("id", $value['id_vivienda']);

                    $this->modelo->__SET("SQL", "SQL_08");
                    $gas = $this->modelo->Administrar();
                    $this->modelo->__SET("SQL", "SQL_09");
                    $electrodomesticos = $this->modelo->Administrar();
                    $this->modelo->__SET("SQL", "SQL_03");
                    $techos = $this->modelo->Administrar();
                    $this->modelo->__SET("SQL", "SQL_05");
                    $pisos = $this->modelo->Administrar();
                    $this->modelo->__SET("SQL", "SQL_07");
                    $paredes = $this->modelo->Administrar();
                    $this->modelo->__SET("SQL", "SQL_04");
                    $familia = $this->modelo->Administrar();

                    foreach ($familia as $v) {
                        $family = $v['nombre_familia'];
                    }

                    $value['familia'] = $family;

                    $tabla[] = [
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

                        "ver"                   => "<a href='javascript:void(0)' class='btn bg-info ver-popup' title='Ver' type='button' onclick='Ver(`" . json_encode($value) . "`,`" . json_encode($techos) . "`,`" . json_encode($paredes) . "`,`" . json_encode($pisos) . "`,`" . json_encode($gas) . "`,`" . json_encode($electrodomesticos) . "`);'><i class='fa fa-eye'></i></a>",

                        "editar"                => "<a href='javascript:void(0)' class='btn bg-success btnEditar'  title='Actualizar' type='button' data-toggle='modal' data-target='#actualizar' onclick='Modificar(" . json_encode($value["id_vivienda"]) . ",`" . json_encode($value) . "`,`" . json_encode($techos) . "`,`" . json_encode($paredes) . "`,`" . json_encode($pisos) . "`,`" . json_encode($gas) . "`,`" . json_encode($electrodomesticos) . "`)'><i class='fa fa-edit' style='color: white;'></i></a>",

                        "eliminar"              => ' <a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar" onclick="Eliminar(' . json_encode($value["id_vivienda"]) . ',' . $value['id_servicio'] . ')"><i class="fa fa-trash"></i></a>',
                    ];
                }

                $this->Escribir_JSON($tabla);
                unset($tabla, $gas, $electrodomesticos, $techos, $pisos, $paredes, $familia, $family);
                break;

            case 'Agregar':

                $this->mensaje = 1;
                $this->modelo->__SET("tipo", "0");
                $this->modelo->__SET("SQL", "_05_");
                $this->modelo->__SET("consultar", array(
                    "tabla"   => $_POST['datos']["tabla"],
                    "columna" => $_POST['datos']["columna"],
                    "data"    => $_POST['datos']["data"],
                ));
                $datos   = $this->modelo->Administrar();
                $mensaje = "Este elemento ya se encuentra asignado";

                switch ($_POST["datos"]["buscar"]) {
                    case 'id_tipo_techo':
                        foreach ($datos as $value) {
                            if ($value["id_tipo_techo"] == $_POST["datos"]["id"]) {$this->mensaje = $mensaje;}
                        }
                        break;
                    case 'id_tipo_pared':
                        foreach ($datos as $value) {
                            if ($value["id_tipo_pared"] == $_POST["datos"]["id"]) {$this->mensaje = $mensaje;}
                        }
                        break;
                    case 'id_tipo_piso':
                        foreach ($datos as $value) {
                            if ($value["id_tipo_piso"] == $_POST["datos"]["id"]) {$this->mensaje = $mensaje;}
                        }
                        break;
                }

                if ($this->mensaje == 1) {
                    $this->modelo->__SET("tipo", "1");
                    $this->modelo->__SET("SQL", $_POST['sql']);
                    $this->modelo->Datos([
                        $_POST["datos"]["buscar"] => $_POST["datos"]["id"],
                        "id_vivienda"             => $_POST["datos"]["data"],
                        "estado"                  => $_POST["datos"]["estado"],
                    ]);
                    if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                }
                echo $this->mensaje;unset($_POST, $datos, $mensaje, $this->mensaje);
                break;

            case 'Servicio_Gas':
                $retornar = 1;
                $existe   = "";
                $mensaje  = "Este servicio de gas ya está asociado a esta vivienda";
                $this->modelo->__SET("tipo", "0");
                $this->modelo->__SET("SQL", "_05_");
                $this->modelo->__SET("consultar", array(
                    "tabla"   => $_POST['datos']["tabla"],
                    "columna" => $_POST['datos']["columna"],
                    "data"    => $_POST['datos']["id"],
                ));
                $servicios_vivienda = $this->modelo->Administrar();

                $this->modelo->__SET("SQL", "_01_");
                $this->modelo->__SET("consultar", array("tabla" => "servicio_gas", "estado" => 1, "orden" => "id_servicio_gas"));
                $companias = $this->modelo->Administrar();

                if ($_POST['gas']['nuevo'] == 1) {
                    foreach ($companias as $c) {
                        if (strtolower($c['nombre_servicio_gas']) == strtolower($_POST['gas']['gas'])) {
                            $existe = $c['id_servicio_gas'];
                        }
                    }

                    if ($existe == "") {

                        $this->modelo->__SET("SQL", "_02_");
                        $this->modelo->__SET("tipo", "1");
                        $this->modelo->__SET("registrar", array(
                            "tabla"   => "servicio_gas",
                            "columna" => "nombre_servicio_gas")
                        );
                        $this->modelo->Datos(["nombre_servicio_gas" => $_POST['gas']['gas'], "estado" => 1]);
                        if ($this->modelo->Administrar()) {
                            $this->modelo->__SET("SQL", "_03_");
                            $this->modelo->__SET("tipo", "0");
                            $this->modelo->__SET("ultimo", array("tabla" => "servicio_gas", "id" => "id_servicio_gas"));
                            $id = $this->modelo->Administrar();

                            $this->modelo->__SET("SQL", $_POST['sql']);
                            $this->modelo->__SET("tipo", "1");
                            $this->modelo->Datos([
                                "id_servicio_gas" => $id[0]['MAX(id_servicio_gas)'],
                                "id_vivienda"     => $_POST['datos']["id"],
                                "tipo_bombona"    => $_POST['gas']['tipo_bombona'],
                                "dias_duracion"   => $_POST['gas']['tiempo_duracion'],
                                "estado"          => $_POST['datos']["estado"],
                            ]);
                            $this->modelo->Administrar();
                        }

                    } else {
                        foreach ($servicios_vivienda as $sv) {
                            if ($sv['id_servicio_gas'] == $existe && $sv['tipo_bombona'] == $_POST['gas']['tipo_bombona'] && $sv['dias_duracion'] == $_POST['gas']['tiempo_duracion']) {
                                $retornar = $mensaje;
                            }
                        }

                        if ($retornar == 1) {

                            $this->modelo->__SET("SQL", $_POST['sql']);
                            $this->modelo->__SET("tipo", "1");
                            $this->modelo->Datos([
                                "id_servicio_gas" => $existe,
                                "id_vivienda"     => $_POST['datos']["id"],
                                "tipo_bombona"    => $_POST['gas']['tipo_bombona'],
                                "dias_duracion"   => $_POST['gas']['tiempo_duracion'],
                                "estado"          => $_POST['datos']["estado"],
                            ]);
                            $this->modelo->Administrar();
                        }
                    }
                } else {
                    foreach ($servicios_vivienda as $sv) {
                        if ($sv['id_servicio_gas'] == $_POST['gas']['gas'] && $sv['tipo_bombona'] == $_POST['gas']['tipo_bombona'] && $sv['dias_duracion'] == $_POST['gas']['tiempo_duracion']) {
                            $retornar = $mensaje;
                        }
                    }

                    if ($retornar == 1) {
                        $this->modelo->__SET("SQL", $_POST['sql']);
                        $this->modelo->__SET("tipo", "1");
                        $this->modelo->Datos([
                            "id_servicio_gas" => $_POST['gas']['gas'],
                            "id_vivienda"     => $_POST['datos']["id"],
                            "tipo_bombona"    => $_POST['gas']['tipo_bombona'],
                            "dias_duracion"   => $_POST['gas']['tiempo_duracion'],
                            "estado"          => $_POST['datos']["estado"],
                        ]);
                        $this->modelo->Administrar();
                    }

                }
                echo $retornar;unset($_POST, $retornar, $mensaje, $existe, $servicios_vivienda, $companias);
                break;
            case 'Cargar_Gas':

                $this->modelo->__SET("SQL", "_01_");
                $this->modelo->__SET("consultar", array("tabla" => "servicio_gas", "estado" => 1, "orden" => "id_servicio_gas"));
                $gases = $this->modelo->Administrar();

                $texto = "<option value='vacio'>-Compañia-</option>";
                foreach ($gases as $g) {
                    $texto .= "<option value='" . $g['id_servicio_gas'] . "'>" . $g['nombre_servicio_gas'] . "</option>";
                }

                echo $texto;unset($gases, $texto);
                break;

            case 'Electrodomesticos':

                $retornar = 1;
                $existe   = "";
                $mensaje  = "Este electrodomestico ya esta asociado a esta vivienda";
                $this->modelo->__SET("tipo", "0");
                $this->modelo->__SET("SQL", "_05_");
                $this->modelo->__SET("consultar", array(
                    "tabla"   => $_POST['datos']["tabla"],
                    "columna" => $_POST['datos']["columna"],
                    "data"    => $_POST['datos']["id"],
                ));
                $electrodomesticos_vivienda = $this->modelo->Administrar();

                $this->modelo->__SET("SQL", "_01_");
                $this->modelo->__SET("consultar", array("tabla" => "electrodomesticos", "estado" => 1, "orden" => "id_electrodomestico"));
                $electrodomesticos_all = $this->modelo->Administrar();

                if ($_POST['electrodomestico']['nuevo'] == 1) {
                    foreach ($electrodomesticos_all as $e) {
                        if (strtolower($e['nombre_electrodomestico']) == strtolower($_POST['electrodomestico']['electrodomestico'])) {
                            $existe = $e['id_electrodomestico'];
                        }
                    }

                    if ($existe == "") {
                        $this->modelo->__SET("SQL", "_02_");
                        $this->modelo->__SET("tipo", "1");
                        $this->modelo->__SET("registrar", array(
                            "tabla"   => "electrodomesticos",
                            "columna" => "nombre_electrodomestico")
                        );
                        $this->modelo->Datos(["nombre_electrodomestico" => $_POST['electrodomestico']['electrodomestico'], "estado" => 1]);
                        if ($this->modelo->Administrar()) {
                            $this->modelo->__SET("SQL", "_03_");
                            $this->modelo->__SET("tipo", "0");
                            $this->modelo->__SET("ultimo", array("tabla" => "electrodomesticos", "id" => "id_electrodomestico"));
                            $id = $this->modelo->Administrar();

                            $this->modelo->__SET("SQL", $_POST['sql']);
                            $this->modelo->__SET("tipo", "1");
                            $this->modelo->Datos([
                                "id_electrodomestico" => $id[0]['MAX(id_electrodomestico)'],
                                "id_vivienda"         => $_POST['datos']["id"],
                                "cantidad"            => $_POST['electrodomestico']['cantidad'],
                                "estado"              => $_POST['datos']["estado"],
                            ]);
                            $this->modelo->Administrar();
                        }

                    } else {
                        foreach ($electrodomesticos_vivienda as $ev) {
                            if ($ev['id_electrodomestico'] == $existe) {$retornar = $mensaje;}
                        }

                        if ($retornar == 1) {
                            $this->modelo->__SET("SQL", $_POST['sql']);
                            $this->modelo->__SET("tipo", "1");
                            $this->modelo->Datos([
                                "id_electrodomestico" => $existe,
                                "id_vivienda"         => $_POST['datos']["id"],
                                "cantidad"            => $_POST['electrodomestico']['cantidad'],
                                "estado"              => $_POST['datos']["estado"],
                            ]);
                            $this->modelo->Administrar();
                        }
                    }
                } else {
                    foreach ($electrodomesticos_vivienda as $ev) {
                        if ($ev['id_electrodomestico'] == $_POST['electrodomestico']['electrodomestico']) {
                            $retornar = $mensaje;
                        }
                    }

                    if ($retornar == 1) {
                        $this->modelo->__SET("SQL", $_POST['sql']);
                        $this->modelo->__SET("tipo", "1");
                        $this->modelo->Datos([
                            "id_electrodomestico" => $_POST['electrodomestico']['electrodomestico'],
                            "id_vivienda"         => $_POST['datos']["id"],
                            "cantidad"            => $_POST['electrodomestico']['cantidad'],
                            "estado"              => $_POST['datos']["estado"],
                        ]);
                        $this->modelo->Administrar();
                    }

                }
                echo $retornar;
                break;

            case 'Cargar_Electrodomesticos':

                $this->modelo->__SET("SQL", "_01_");
                $this->modelo->__SET("consultar", array("tabla" => "electrodomesticos", "estado" => 1, "orden" => "id_electrodomestico"));
                $electrodomesticos = $this->modelo->Administrar();

                $texto = "<option value='vacio'>-Electrodoméstico-</option>";
                foreach ($electrodomesticos as $e) {
                    $texto .= "<option value='" . $e['id_electrodomestico'] . "'>" . $e['nombre_electrodomestico'] . "</option>";
                }

                echo $texto;unset($electrodomesticos, $texto);
                break;

            case 'Obtener':
                $this->modelo->__SET("tipo", "0");
                $this->modelo->__SET("id", $_POST['id']);
                $this->modelo->__SET("SQL", $_POST['sql']);
                $datos = $this->modelo->Administrar();
                $this->Escribir_JSON($datos);unset($datos);
                break;

            case 'Eliminar':
                $this->modelo->__SET("SQL", "_07_");
                $this->modelo->__SET("tipo", "1");
                $this->modelo->__SET("eliminar", array(
                    "tabla"    => $_POST['datos']["tabla"],
                    "id_tabla" => $_POST['datos']["id_tabla"])
                );
                $this->modelo->Datos([$_POST['datos']["id_tabla"] => $_POST['datos']['id']]);
                if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                echo $this->mensaje;unset($this->mensaje);
                break;

            case 'Eliminar_Vivienda':
                $this->modelo->Estado($_POST['estado']);
                $this->modelo->Datos([
                    $_POST['estado']["id_tabla"] => $_POST['estado']["param"],
                    "estado"                     => $_POST['estado']["estado"],
                ]);

                $this->modelo->__SET("SQL", $_POST['sql']);
                $this->modelo->__SET("tipo", "1");

                if ($this->modelo->Administrar()) {
                    $this->mensaje = 1;
                    $this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
    public function Establecer_Consultas()
    {

        $tipo_vivienda = $this->Consultar_Tabla("tipo_vivienda", 1, "nombre_tipo_vivienda");

        $vivienda = $this->modelo->Consultar();
        $calle    = $this->Consultar_Tabla("calles", 1, "nombre_calle");

        $tipo_techo = $this->Consultar_Tabla("tipo_techo", 1, "techo");
        $tipo_pared = $this->Consultar_Tabla("tipo_pared", 1, "pared");
        $tipo_piso  = $this->Consultar_Tabla("tipo_piso", 1, "piso");

        $servicios_gas              = $this->Consultar_Tabla("servicio_gas", 1, "nombre_servicio_gas");
        $this->vista->servicios_gas = $servicios_gas;
        $this->servicios_gas        = $servicios_gas;

        $electrodomesticos              = $this->Consultar_Tabla("electrodomesticos", 1, "id_electrodomestico");
        $this->vista->electrodomesticos = $electrodomesticos;
        $this->electrodomesticos        = $electrodomesticos;

        $this->vista->tipo_vivienda = $tipo_vivienda;
        $this->tipo_vivienda        = $tipo_vivienda;

        $this->vista->vivienda = $vivienda;
        $this->vivienda        = $vivienda;

        $this->vista->calle = $calle;
        $this->calle        = $calle;

        $this->vista->tipo_techo = $tipo_techo;
        $this->tipo_techo        = $tipo_techo;

        $this->vista->tipo_pared = $tipo_pared;
        $this->tipo_pared        = $tipo_pared;

        $this->vista->tipo_piso = $tipo_piso;
        $this->tipo_piso        = $tipo_piso;
    }

    public function Consultas_Viviendas_Ajax()
    {
        $this->Establecer_Consultas();
        $tabla = [];

        foreach ($this->vivienda as $value) {

            $gas               = $this->modelo->get_gas_vivienda($value['id_vivienda']);
            $electrodomesticos = $this->modelo->get_electrodomesticos_vivienda($value['id_vivienda']);
            $techos            = $this->modelo->get_techos_vivienda($value['id_vivienda']);
            $pisos             = $this->modelo->get_pisos_vivienda($value['id_vivienda']);
            $paredes           = $this->modelo->get_paredes_vivienda($value['id_vivienda']);
            $familia           = $this->modelo->get_familia($value['id_vivienda']);

            foreach ($familia as $v) {
                $family = $v['nombre_familia'];
            }

            $value['familia'] = $family;

            $tabla[] = [
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

                "ver"                   => "<a href='javascript:void(0)' class='btn bg-info ver-popup' title='Ver' type='button' onclick='Ver(`" . json_encode($value) . "`,`" . json_encode($techos) . "`,`" . json_encode($paredes) . "`,`" . json_encode($pisos) . "`,`" . json_encode($gas) . "`,`" . json_encode($electrodomesticos) . "`);'>
            <i class='fa fa-eye'></i>
            </a>",

                "editar"                => "<a href='javascript:void(0)' class='btn bg-success btnEditar'  title='Actualizar' type='button' data-toggle='modal' data-target='#actualizar' onclick='Modificar(" . json_encode($value["id_vivienda"]) . ",`" . json_encode($value) . "`,`" . json_encode($techos) . "`,`" . json_encode($paredes) . "`,`" . json_encode($pisos) . "`,`" . json_encode($gas) . "`,`" . json_encode($electrodomesticos) . "`)'>
            <i class='fa fa-edit' style='color: white;'></i>
            </a>",

                "eliminar"              => ' <a href="javascript:void(0)" style="margin-right: 5px;" class="btn bg-danger mensaje-eliminar" title="Eliminar" onclick="Eliminar(' . json_encode($value["id_vivienda"]) . ',' . $value['id_servicio'] . ')">
            <i class="fa fa-trash"></i>
            </a>',

            ];

        }

        $this->Escribir_JSON($tabla);
    }

    //=====================================================================

    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('vivienda/consultar');
    }
    public function Registros()
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        $this->vista->Cargar_Vistas('vivienda/registrar');
    }

    public function Consultas()
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        $this->vista->Cargar_Vistas('vivienda/consultar');
    }

    // ==============================CRUD=====================================
    public function Nueva_Vivienda()
    {
        $datos = ($_POST['datos'] !== "") ? $_POST['datos'] : null;

        $this->Datos_Vivienda($datos);

        if ($this->modelo->Registrar(
            [
                'id_calle'              => $datos['id_calle'],
                'id_tipo_vivienda'      => $this->id_datos['id_tipo_vivienda'],
                'id_servicio'           => $_POST['id_servicio'],
                'direccion_vivienda'    => $datos['direccion_vivienda'],
                'numero_casa'           => $datos['numero_casa'],
                'cantidad_habitaciones' => $datos['cantidad_habitaciones'],
                'espacio_siembra'       => $datos['espacio_siembra'],
                'hacinamiento'          => $datos['hacinamiento'],
                'banio_sanitario'       => $datos['banio_sanitario'],
                'condicion'             => $datos['condicion'],
                'descripcion'           => $datos['descripcion'],
                'animales_domesticos'   => $datos['animales_domesticos'],
                'insectos_roedores'     => $datos['insectos_roedores'],
                'estado'                => 1,
            ]
        )
        ) {
            $this->mensaje = 1;
        } else {
            $this->mensaje = 0;
        }
        echo $this->mensaje;

        #header('location:' . constant('URL') . "Viviendas/Consultas");
        exit();
        return false;
    }

    public function Nueva_Vivienda_Habitante()
    {
        $datos = ($_POST['datos'] !== "") ? $_POST['datos'] : null;

        $this->Datos_Vivienda($datos);

        if ($this->modelo->Registrar(
            [
                'id_calle'              => $datos['id_calle'],
                'id_tipo_vivienda'      => $this->id_datos['id_tipo_vivienda'],
                'id_servicio'           => $_POST['id_servicio'],
                'direccion_vivienda'    => $datos['direccion_vivienda'],
                'numero_casa'           => $datos['numero_casa'],
                'cantidad_habitaciones' => $datos['cantidad_habitaciones'],
                'espacio_siembra'       => $datos['espacio_siembra'],
                'hacinamiento'          => $datos['hacinamiento'],
                'banio_sanitario'       => $datos['banio_sanitario'],
                'condicion'             => $datos['condicion'],
                'descripcion'           => $datos['descripcion'],
                'animales_domesticos'   => $datos['animales_domesticos'],
                'insectos_roedores'     => $datos['insectos_roedores'],
                'estado'                => 2,
            ]
        )
        ) {
            $this->mensaje = 1;
        } else {
            $this->mensaje = 0;
        }
        echo $this->mensaje;

        #header('location:' . constant('URL') . "Viviendas/Consultas");
        exit();
        return false;
    }

    public function Asignar_Servicios()
    {
        $datos = ($_POST['datos'] !== "") ? $_POST['datos'] : null;

        if ($this->modelo->Registrar_Servicios(
            [
                'agua_consumo'       => $datos['agua_consumo'],
                'aguas_negras'       => $datos['aguas_negras'],
                'residuos_solidos'   => $datos['residuos_solidos'],
                'cable_telefonico'   => $datos['cable_telefonico'],
                'internet'           => $datos['internet'],
                'servicio_electrico' => $datos['servicio_electrico'],
                'estado'             => 1,
            ]
        )
        ) {
            $this->mensaje = 1;
        } else {
            $this->mensaje = 0;
        }

        $id = $this->Ultimo_Ingresado("servicios", "id_servicio");
        foreach ($id as $i) {
            $id_servicio = $i['MAX(id_servicio)'];
        }

        echo $id_servicio;
        exit();
        return false;
    }

    public function Datos_Vivienda($datos)
    {
        $this->Establecer_Consultas();

        foreach ($this->tipo_vivienda as $key => $value) {
            if ($datos["id_tipo_vivienda"] == $value["nombre_tipo_vivienda"]) {
                $id_tipo_vivienda = $value["id_tipo_vivienda"];
            }
        }

        foreach ($this->condicion_ocupacion as $key => $value) {
            if ($datos["id_condicion_ocupacion"] == $value["condicion_vivienda"]) {
                $id_condicion_ocupacion = $value["id_condicion_ocupacion"];
            }
        }

        $id_datos = [
            'id_tipo_vivienda'       => $id_tipo_vivienda,
            'id_condicion_ocupacion' => $id_condicion_ocupacion,
        ];
        $this->id_datos = $id_datos;
    }

    public function Registrar_Servicos_Vivienda()
    {
        $datos = ($_POST['datos'] !== "") ? $_POST['datos'] : null;

        $this->Datos_Vivienda($datos);

        if ($this->modelo->Registrar_Servicios(
            [
                'id_agua_consumo'     => $datos['id_agua_consumo'],
                'id_aguas_negras'     => $datos['id_aguas_negras'],
                'id_residuos_solidos' => $datos['id_residuos_solidos'],
                'id_television'       => $datos['id_television'],
                'cable_telefonico'    => $datos['cable_telefonico'],
                'internet'            => $datos['internet'],
                'servicio_electrico'  => $datos['servicio_electrico'],
                'estado'              => 1,
            ]
        )
        ) {
            $this->vista->mensaje = 'Servicio Registrad exitosamente!.';
        } else {
            $this->vista->mensaje = 'Ha ocurrido un error.';
        }

        #header('location:' . constant('URL') . "Viviendas/Consultas");
        exit();
        return false;
    }

    public function Techo_Pared_Piso()
    {
        $this->Establecer_Consultas();

        $id = $this->Ultimo_Ingresado("vivienda", "id_vivienda");
        foreach ($id as $i) {
            $id_vivienda = $i['MAX(id_vivienda)'];
        }

        $tipo_techo = ($_POST['tipo_techo'] !== "") ? $_POST['tipo_techo'] : null;
        $tipo_pared = ($_POST['tipo_pared'] !== "") ? $_POST['tipo_pared'] : null;
        $tipo_piso  = ($_POST['tipo_piso'] !== "") ? $_POST['tipo_piso'] : null;

        foreach ($this->tipo_techo as $techo) {
            foreach ($tipo_techo as $tipo) {
                if ($techo["techo"] == $tipo) {
                    $id_tipo_techo[] = $techo["id_tipo_techo"];
                }
            }
        }

        foreach ($this->tipo_pared as $pared) {
            foreach ($tipo_pared as $tipo) {
                if ($pared["pared"] == $tipo) {
                    $id_tipo_pared[] = $pared["id_tipo_pared"];
                }
            }
        }

        foreach ($this->tipo_piso as $piso) {
            foreach ($tipo_piso as $tipo) {
                if ($piso["piso"] == $tipo) {
                    $id_tipo_piso[] = $piso["id_tipo_piso"];
                }
            }
        }

        if (isset($id_tipo_techo)) {
            for ($i = 0; $i < count($id_tipo_techo); $i++) {
                if ($this->modelo->Registrar_Techos(
                    [
                        'id_tipo_techo' => $id_tipo_techo[$i],
                        'id_vivienda'   => $id_vivienda,
                        'estado'        => 1,
                    ]
                )
                ) {
                    $this->mensaje = 1;
                } else {
                    $this->mensaje = 0;
                }
            }
        }

        if (isset($id_tipo_pared)) {
            for ($i = 0; $i < count($id_tipo_pared); $i++) {
                if ($this->modelo->Registrar_Paredes(
                    [
                        'id_tipo_pared' => $id_tipo_pared[$i],
                        'id_vivienda'   => $id_vivienda,
                        'estado'        => 1,
                    ]
                )
                ) {
                    $this->mensaje = 1;
                } else {
                    $this->mensaje = 0;
                }
            }
        }

        if (isset($id_tipo_piso)) {
            for ($i = 0; $i < count($id_tipo_piso); $i++) {
                if ($this->modelo->Registrar_Pisos(
                    [
                        'id_tipo_piso' => $id_tipo_piso[$i],
                        'id_vivienda'  => $id_vivienda,
                        'estado'       => 1,
                    ]
                )
                ) {
                    $this->mensaje = 1;
                } else {
                    $this->mensaje = 0;
                }
            }
        }

        echo $this->mensaje;

        exit();
        return false;
    }

    public function Eliminar_Vivienda()
    {

        if ($this->modelo->Eliminar($_POST['id'])) {
            $this->mensaje = 'Vvienda Eliminada Exitosamente';
        } else {
            $this->mensaje = 0;
        }

        echo $this->mensaje;
        return false;
    }

    public function Electrodomesticos_Gases()
    {

        $id = $this->Ultimo_Ingresado("vivienda", "id_vivienda");

        $gas               = $_POST['gases'];
        $electrodomesticos = $_POST['electrodomesticos'];

        foreach ($id as $i) {

            $id_vivienda = $i['MAX(id_vivienda)'];
        }

        for ($i = 0; $i < count($gas); $i++) {
            if ($gas[$i]['nuevo'] == '0') {
                echo $this->modelo->registrar_vivienda_gas([
                    "id_servicio_gas" => $gas[$i]['servicio_gas'],
                    "id_vivienda"     => $id_vivienda,
                    "tipo_bombona"    => $gas[$i]['tipo_bombona'],
                    "dias_duracion"   => $gas[$i]['tiempo_duracion'],
                ]);
            } else {
                $this->Registrar_Tablas('servicio_gas', 'nombre_servicio_gas', $gas[$i]['servicio_gas']);
                $id_gas = $this->Ultimo_Ingresado("servicio_gas", "id_servicio_gas");

                foreach ($id_gas as $ig) {

                    echo $this->modelo->registrar_vivienda_gas([
                        "id_servicio_gas" => $ig['MAX(id_servicio_gas)'],
                        "id_vivienda"     => $id_vivienda,
                        "tipo_bombona"    => $gas[$i]['tipo_bombona'],
                        "dias_duracion"   => $gas[$i]['tiempo_duracion'],
                    ]);
                }

            }
        }

        for ($i = 0; $i < count($electrodomesticos); $i++) {
            if ($electrodomesticos[$i]['nuevo'] == '0') {
                echo $this->modelo->registrar_vivienda_electrodomesticos([
                    "id_electrodomestico" => $electrodomesticos[$i]['electrodomestico'],
                    "id_vivienda"         => $id_vivienda,
                    "cantidad"            => $electrodomesticos[$i]['cantidad'],
                ]);
            } else {
                $this->Registrar_Tablas('electrodomesticos', 'nombre_electrodomestico', $electrodomesticos[$i]['electrodomestico']);
                $id_elect = $this->Ultimo_Ingresado("electrodomesticos", "id_electrodomestico");

                foreach ($id_elect as $ie) {

                    echo $this->modelo->registrar_vivienda_electrodomesticos([
                        "id_electrodomestico" => $ie['MAX(id_electrodomestico)'],
                        "id_vivienda"         => $id_vivienda,
                        "cantidad"            => $electrodomesticos[$i]['cantidad'],
                    ]);
                }

            }
        }

    }

    public function eliminacion_logica()
    {

        echo $this->Desactivar("vivienda", "id_vivienda", $_POST['id_vivienda']);

    }

    public function eliminacion_vivienda()
    {
        $ids = explode("-", $_POST['id']);

        echo $this->modelo->Eliminar($ids[0], $ids[1]);

    }

    public function activar_vivienda()
    {
        $ids = explode("-", $_POST['id_vivienda']);

        echo $this->Activar("vivienda", "id_vivienda", $ids[0]);

    }

    public function get_techos()
    {
        $techos_vivienda = $this->modelo->get_techos_vivienda($_POST['id_vivienda']);
        echo json_encode($techos_vivienda);
    }

    public function get_pisos()
    {
        $pisos_vivienda = $this->modelo->get_pisos_vivienda($_POST['id_vivienda']);
        echo json_encode($pisos_vivienda);
    }

    public function get_paredes()
    {
        $paredes_vivienda = $this->modelo->get_paredes_vivienda($_POST['id_vivienda']);
        echo json_encode($paredes_vivienda);
    }

    public function get_gases()
    {
        $gases_vivienda = $this->modelo->get_gas_vivienda($_POST['id_vivienda']);
        echo json_encode($gases_vivienda);
    }

    public function get_electrodomesticos()
    {
        $electrodomesticos_vivienda = $this->modelo->get_electrodomesticos_vivienda($_POST['id_vivienda']);
        echo json_encode($electrodomesticos_vivienda);
    }

    public function borrar_techo()
    {
        echo $this->Eliminar_Tablas("vivienda_tipo_techo", "id_vivienda_tipo_techo", $_POST['id']);
    }

    public function borrar_pared()
    {
        echo $this->Eliminar_Tablas("vivienda_tipo_pared", "id_vivienda_tipo_pared", $_POST['id']);
    }

    public function borrar_gases()
    {
        echo $this->Eliminar_Tablas("vivienda_servicio_gas", "id_vivienda_servicio_gas", $_POST['id_gas']);
    }

    public function borrar_electrodomesticos()
    {
        echo $this->Eliminar_Tablas("vivienda_electrodomesticos", "id_vivienda_electrodomestico", $_POST['id_electrodomestico']);
    }

    public function borrar_piso()
    {
        echo $this->Eliminar_Tablas("vivienda_tipo_piso", "id_vivienda_tipo_piso", $_POST['id']);
    }

    public function add_techo()
    {
        $id_vivienda  = $_POST['id'];
        $id_techo     = $_POST['id_techo'];
        $retornar     = 1;
        $tipos_techos = $this->Consultar_Columna("vivienda_tipo_techo", "id_vivienda", $id_vivienda);
        foreach ($tipos_techos as $tp) {
            if ($tp['id_tipo_techo'] == $id_techo) {
                $retornar = 0;
            }
        }

        if ($retornar != 0) {
            $this->modelo->Registrar_Techos([
                "id_tipo_techo" => $id_techo,
                "id_vivienda"   => $id_vivienda,
                "estado"        => 1,
            ]);
        }

        echo $retornar;
    }

    public function add_pared()
    {
        $id_vivienda   = $_POST['id'];
        $id_pared      = $_POST['id_pared'];
        $retornar      = 1;
        $tipos_paredes = $this->Consultar_Columna("vivienda_tipo_pared", "id_vivienda", $id_vivienda);
        foreach ($tipos_paredes as $tp) {
            if ($tp['id_tipo_pared'] == $id_pared) {
                $retornar = 0;
            }
        }

        if ($retornar != 0) {
            $this->modelo->Registrar_Paredes([
                "id_tipo_pared" => $id_pared,
                "id_vivienda"   => $id_vivienda,
                "estado"        => 1,
            ]);
        }

        echo $retornar;
    }

    public function add_piso()
    {
        $id_vivienda = $_POST['id'];
        $id_piso     = $_POST['id_piso'];
        $retornar    = 1;
        $tipos_pisos = $this->Consultar_Columna("vivienda_tipo_piso", "id_vivienda", $id_vivienda);
        foreach ($tipos_pisos as $tp) {
            if ($tp['id_tipo_piso'] == $id_piso) {
                $retornar = 0;
            }
        }

        if ($retornar != 0) {
            $this->modelo->Registrar_Pisos([
                "id_tipo_piso" => $id_piso,
                "id_vivienda"  => $id_vivienda,
                "estado"       => 1,
            ]);
        }

        echo $retornar;
    }

    public function add_gases()
    {
        $gas                = $_POST['gas'];
        $retornar           = 1;
        $id_vivienda        = $_POST['id_vivienda'];
        $existe             = "";
        $servicios_vivienda = $this->Consultar_Columna("vivienda_servicio_gas", "id_vivienda", $id_vivienda);
        $companias          = $this->Consultar_Tabla("servicio_gas", 1, "id_servicio_gas");
        if ($gas['nuevo'] == 1) {
            foreach ($companias as $c) {
                if (strtolower($c['nombre_servicio_gas']) == strtolower($gas['gas'])) {
                    $existe = $c['id_servicio_gas'];
                }
            }

            if ($existe == "") {
                $this->Registrar_Tablas("servicio_gas", "nombre_servicio_gas", $gas['gas']);
                $id = $this->Ultimo_Ingresado("servicio_gas", "id_servicio_gas");
                $this->modelo->Registrar_vivienda_gas([
                    "id_servicio_gas" => $id[0]['MAX(id_servicio_gas)'],
                    "id_vivienda"     => $id_vivienda,
                    "tipo_bombona"    => $gas['tipo_bombona'],
                    "dias_duracion"   => $gas['tiempo_duracion'],
                ]);
            } else {
                foreach ($servicios_vivienda as $sv) {
                    if ($sv['id_servicio_gas'] == $existe && $sv['tipo_bombona'] == $gas['tipo_bombona'] && $sv['dias_duracion'] == $gas['tiempo_duracion']) {
                        $retornar = 0;
                    }
                }

                if ($retornar == 1) {
                    $this->modelo->Registrar_vivienda_gas([
                        "id_servicio_gas" => $existe,
                        "id_vivienda"     => $id_vivienda,
                        "tipo_bombona"    => $gas['tipo_bombona'],
                        "dias_duracion"   => $gas['tiempo_duracion'],
                    ]);
                }
            }
        } else {
            foreach ($servicios_vivienda as $sv) {
                if ($sv['id_servicio_gas'] == $gas['gas'] && $sv['tipo_bombona'] == $gas['tipo_bombona'] && $sv['dias_duracion'] == $gas['tiempo_duracion']) {
                    $retornar = 0;
                }
            }

            if ($retornar == 1) {
                $this->modelo->Registrar_vivienda_gas([
                    "id_servicio_gas" => $gas['gas'],
                    "id_vivienda"     => $id_vivienda,
                    "tipo_bombona"    => $gas['tipo_bombona'],
                    "dias_duracion"   => $gas['tiempo_duracion'],
                ]);
            }

        }
        echo $retornar;
    }

    public function cargar_gas()
    {
        $gases = $this->Consultar_Tabla("servicio_gas", 1, "id_servicio_gas");
        $texto = "<option value='vacio'>-Compañia-</option>";
        foreach ($gases as $g) {
            $texto .= "<option value='" . $g['id_servicio_gas'] . "'>" . $g['nombre_servicio_gas'] . "</option>";
        }

        echo $texto;

    }

    public function cargar_electrodomesticos()
    {
        $electrodomesticos = $this->Consultar_Tabla("electrodomesticos", 1, "id_electrodomestico");
        $texto             = "<option value='vacio'>-Electrodoméstico-</option>";
        foreach ($electrodomesticos as $e) {
            $texto .= "<option value='" . $e['id_electrodomestico'] . "'>" . $e['nombre_electrodomestico'] . "</option>";
        }

        echo $texto;

    }

    public function add_electrodomestico()
    {
        $electrodomestico           = $_POST['inf_electrodomestico'];
        $retornar                   = 1;
        $id_vivienda                = $_POST['id_vivienda'];
        $existe                     = "";
        $electrodomesticos_vivienda = $this->Consultar_Columna("vivienda_electrodomesticos", "id_vivienda", $id_vivienda);
        $electrodomesticos_all      = $this->Consultar_Tabla("electrodomesticos", 1, "id_electrodomestico");
        if ($electrodomestico['nuevo'] == 1) {
            foreach ($electrodomesticos_all as $e) {
                if (strtolower($e['nombre_electrodomestico']) == strtolower($electrodomestico['electrodomestico'])) {
                    $existe = $e['id_electrodomestico'];
                }
            }

            if ($existe == "") {
                $this->Registrar_Tablas("electrodomesticos", "nombre_electrodomestico", $electrodomestico['electrodomestico']);
                $id = $this->Ultimo_Ingresado("electrodomesticos", "id_electrodomestico");
                $this->modelo->registrar_vivienda_electrodomesticos([
                    "id_electrodomestico" => $id[0]['MAX(id_electrodomestico)'],
                    "id_vivienda"         => $id_vivienda,
                    "cantidad"            => $electrodomestico['cantidad'],
                ]);
            } else {
                foreach ($electrodomesticos_vivienda as $ev) {
                    if ($ev['id_electrodomestico'] == $existe) {
                        $retornar = 0;
                    }
                }

                if ($retornar == 1) {
                    $this->modelo->registrar_vivienda_electrodomesticos([
                        "id_electrodomestico" => $existe,
                        "id_vivienda"         => $id_vivienda,
                        "cantidad"            => $electrodomestico['cantidad'],
                    ]);
                }
            }
        } else {
            foreach ($electrodomesticos_vivienda as $ev) {
                if ($ev['id_electrodomestico'] == $electrodomestico['electrodomestico']) {
                    $retornar = 0;
                }
            }

            if ($retornar == 1) {
                $this->modelo->registrar_vivienda_electrodomesticos([
                    "id_electrodomestico" => $electrodomestico['electrodomestico'],
                    "id_vivienda"         => $id_vivienda,
                    "cantidad"            => $electrodomestico['cantidad'],
                ]);
            }

        }
        echo $retornar;
    }

    public function modificar_vivienda()
    {
        $info_vivienda      = $_POST['vivienda'];
        $servicios_vivienda = $this->Consultar_Columna("vivienda", "id_vivienda", $info_vivienda['id_vivienda']);
        if ($this->modelo->Registrar_Servicios($info_vivienda['id_servicio'])) {
            $existe                       = 0;
            $id_servicio                  = $this->Ultimo_Ingresado("servicios", "id_servicio");
            $info_vivienda['id_servicio'] = $id_servicio[0]['MAX(id_servicio)'];
            $tipos_vivienda               = $this->Consultar_Tabla("tipo_vivienda", 1, "id_tipo_vivienda");
            foreach ($tipos_vivienda as $tv) {
                if (strtolower($tv['nombre_tipo_vivienda']) == strtolower($info_vivienda['id_tipo_vivienda'])) {
                    $existe = $tv['id_tipo_vivienda'];
                }
            }

            if ($existe == 0) {
                $this->Registrar_Tablas("tipo_vivienda", "nombre_tipo_vivienda", $info_vivienda['id_tipo_vivienda']);
                $id                                = $this->Ultimo_Ingresado("tipo_vivienda", "id_tipo_vivienda");
                $info_vivienda['id_tipo_vivienda'] = $id[0]['MAX(id_tipo_vivienda)'];
            } else {
                $info_vivienda['id_tipo_vivienda'] = $existe;
            }
            if ($this->modelo->Actualizar($info_vivienda)) {
                echo $this->Eliminar_Tablas("servicios", "id_servicio", $servicios_vivienda[0]['id_servicio']);
            }

        }
    }

}

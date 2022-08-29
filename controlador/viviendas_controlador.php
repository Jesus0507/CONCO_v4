<?php
class Viviendas extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        //    $this->Cargar_Modelo("viviendas");
    }
    public function Cargar_Vistas()
    {
        $this->Establecer_Consultas();$this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('vivienda/consultar');
    }
    // ==============================CRUD=====================================
    public function Establecer_Consultas()
    {
        $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "SQL_01");
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
        $this->Seguridad_de_Session();$this->Establecer_Consultas();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Registros':$this->vista->Cargar_Vistas('vivienda/registrar');break;
            case 'Consultas':$this->vista->Cargar_Vistas('vivienda/consultar');break;

            case 'Registrar':
                $this->modelo->__SET("SQL", "SQL_12");$this->modelo->__SET("tipo", "1");
                $this->modelo->Datos($_POST['vivienda']['id_servicio']);
                if ($this->modelo->Administrar()) {
                    $existe = 0;
                    $this->modelo->__SET("SQL", "_03_");$this->modelo->__SET("tipo", "0");
                    $this->modelo->__SET("ultimo", array("tabla" => "servicios", "id" => "id_servicio"));
                    $id_servicio                      = $this->modelo->Administrar();
                    $_POST['vivienda']['id_servicio'] = $id_servicio[0]['MAX(id_servicio)'];

                    foreach ($this->datos["tipo_vivienda"] as $tv) {
                        if (strtolower($tv['nombre_tipo_vivienda']) == strtolower($_POST['vivienda']['id_tipo_vivienda'])) {
                            $existe = $tv['id_tipo_vivienda'];
                        }
                    }
                    if ($existe == 0) {
                        $this->modelo->__SET("SQL", "_02_");$this->modelo->__SET("tipo", "1");
                        $this->modelo->__SET("registrar", array(
                            "tabla"   => "tipo_vivienda",
                            "columna" => "nombre_tipo_vivienda")
                        );
                        $this->modelo->Datos(["nombre_tipo_vivienda" => $_POST['vivienda']['id_tipo_vivienda'], "estado" => 1]);
                        if ($this->modelo->Administrar()) {
                            $this->modelo->__SET("SQL", "_03_");$this->modelo->__SET("tipo", "0");
                            $this->modelo->__SET("ultimo", array("tabla" => "tipo_vivienda", "id" => "id_tipo_vivienda"));
                            $id                                    = $this->modelo->Administrar();
                            $_POST['vivienda']['id_tipo_vivienda'] = $id[0]['MAX(id_tipo_vivienda)'];
                        }
                    } else {
                        $_POST['vivienda']['id_tipo_vivienda'] = $existe;
                    }

                    $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                    $this->modelo->Datos($_POST['vivienda']);
                    if ($this->modelo->Administrar()) {
                        $this->mensaje = 1;
                        $this->modelo->__SET("SQL", "_03_");$this->modelo->__SET("tipo", "0");
                        $this->modelo->__SET("ultimo", array("tabla" => "vivienda", "id" => "id_vivienda"));
                        $id = $this->modelo->Administrar();

                        foreach ($this->datos["tipo_techo"] as $techo) {
                            foreach ($_POST['techos'] as $tipo) {
                                if ($techo["techo"] == $tipo["id_tipo_techo"]) {$id_tipo_techo[] = $techo["id_tipo_techo"];}
                            }
                        }
                        foreach ($this->datos["tipo_pared"] as $pared) {
                            foreach ($_POST['paredes'] as $tipo) {
                                if ($pared["pared"] == $tipo["id_tipo_pared"]) { $id_tipo_pared[] = $pared["id_tipo_pared"];}
                            }
                        }
                        foreach ($this->datos["tipo_piso"] as $piso) {
                            foreach ($_POST['pisos'] as $tipo) {
                                if ($piso["piso"] == $tipo["id_tipo_piso"]) {$id_tipo_piso[] = $piso["id_tipo_piso"]; }
                            }
                        }
                        if (isset($id_tipo_techo)) {
                            for ($i = 0; $i < count($id_tipo_techo); $i++) {
                                $this->modelo->__SET("SQL", "SQL_13");$this->modelo->__SET("tipo", "1");
                                $this->modelo->Datos([
                                    'id_tipo_techo' => $id_tipo_techo[$i],
                                    'id_vivienda'   => $id[0]['MAX(id_vivienda)'],
                                    'estado'        => 1,
                                ]);
                                $this->modelo->Administrar();
                            }
                        }

                        if (isset($id_tipo_pared)) {
                            for ($i = 0; $i < count($id_tipo_pared); $i++) {
                                $this->modelo->__SET("SQL", "SQL_14");$this->modelo->__SET("tipo", "1");
                                $this->modelo->Datos([
                                    'id_tipo_pared' => $id_tipo_pared[$i],
                                    'id_vivienda'   => $id[0]['MAX(id_vivienda)'],
                                    'estado'        => 1,
                                ]);
                                $this->modelo->Administrar();
                            }
                        }
                        if (isset($id_tipo_piso)) {
                            for ($i = 0; $i < count($id_tipo_piso); $i++) {
                                $this->modelo->__SET("SQL", "SQL_15");$this->modelo->__SET("tipo", "1");
                                $this->modelo->Datos([
                                    'id_tipo_piso' => $id_tipo_piso[$i],
                                    'id_vivienda'  => $id[0]['MAX(id_vivienda)'],
                                    'estado'       => 1,
                                ]);
                                $this->modelo->Administrar();
                            }
                        }
                        for ($i = 0; $i < count($_POST['gases']); $i++) {
                            if ($_POST['gases'][$i]['nuevo'] == '0') {
                                $this->modelo->__SET("SQL", "SQL_16"); $this->modelo->__SET("tipo", "1");
                                $this->modelo->Datos([
                                    "id_servicio_gas" => $_POST['gases'][$i]['servicio_gas'],
                                    "id_vivienda"     => $id[0]['MAX(id_vivienda)'],
                                    "tipo_bombona"    => $_POST['gases'][$i]['tipo_bombona'],
                                    "dias_duracion"   => $_POST['gases'][$i]['tiempo_duracion'],
                                    "estado"          => 1,
                                ]);
                                $this->modelo->Administrar();
                            } else {
                                $this->modelo->__SET("SQL", "_02_");$this->modelo->__SET("tipo", "1");
                                $this->modelo->__SET("registrar", array(
                                    "tabla"   => "servicio_gas",
                                    "columna" => "nombre_servicio_gas")
                                );
                                $this->modelo->Datos(["nombre_servicio_gas" => $_POST['gases'][$i]['servicio_gas'], "estado" => 1]);
                                if ($this->modelo->Administrar()) {
                                    $this->modelo->__SET("SQL", "_03_");$this->modelo->__SET("tipo", "0");
                                    $this->modelo->__SET("ultimo", array("tabla" => "servicio_gas", "id" => "id_servicio_gas"));
                                    $id_gas = $this->modelo->Administrar();
                                }
                                $this->modelo->__SET("SQL", "SQL_16");$this->modelo->__SET("tipo", "1");
                                $this->modelo->Datos([
                                    "id_servicio_gas" => $id_gas[0]['MAX(id_servicio_gas)'],
                                    "id_vivienda"     => $id[0]['MAX(id_vivienda)'],
                                    "tipo_bombona"    => $_POST['gases'][$i]['tipo_bombona'],
                                    "dias_duracion"   => $_POST['gases'][$i]['tiempo_duracion'],
                                    "estado"          => 1,
                                ]);
                                $this->modelo->Administrar();
                            }
                        }
                        for ($i = 0; $i < count($_POST['electrodomesticos']); $i++) {
                            if ($_POST['electrodomesticos'][$i]['nuevo'] == '0') {
                                $this->modelo->__SET("SQL", "SQL_17"); $this->modelo->__SET("tipo", "1");
                                $this->modelo->Datos([
                                    "id_electrodomestico" => $_POST['electrodomesticos'][$i]['electrodomestico'],
                                    "id_vivienda"         => $id[0]['MAX(id_vivienda)'],
                                    "cantidad"            => $_POST['electrodomesticos'][$i]['cantidad'],
                                    "estado"              => 1,
                                ]);
                                $this->modelo->Administrar();
                            } else {
                                $this->modelo->__SET("SQL", "_02_");$this->modelo->__SET("tipo", "1");
                                $this->modelo->__SET("registrar", array(
                                    "tabla"   => "electrodomesticos",
                                    "columna" => "nombre_electrodomestico")
                                );
                                $this->modelo->Datos(["nombre_electrodomestico" => $_POST['electrodomesticos'][$i]['electrodomestico'], "estado" => 1]);
                                if ($this->modelo->Administrar()) {
                                    $this->modelo->__SET("SQL", "_03_");
                                    $this->modelo->__SET("tipo", "0");
                                    $this->modelo->__SET("ultimo", array("tabla" => "electrodomesticos", "id" => "id_electrodomestico"));
                                    $id_elect = $this->modelo->Administrar();
                                }
                                $this->modelo->__SET("SQL", "SQL_16");$this->modelo->__SET("tipo", "1");
                                $this->modelo->Datos([
                                    "id_electrodomestico" => $id_elect[0]['MAX(id_electrodomestico)'],
                                    "id_vivienda"         => $id[0]['MAX(id_vivienda)'],
                                    "cantidad"            => $_POST['electrodomesticos'][$i]['cantidad'],
                                    "estado"              => 1,
                                ]);
                                $this->modelo->Administrar();
                            }
                        }
                    }

                }
                $this->Accion($_POST['accion']);
                echo $this->mensaje;
                break;

            case 'Actualizar':
                $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
                $this->modelo->__SET("consultar", array(
                    "tabla"   => $_POST['datos']["tabla"],
                    "columna" => $_POST['datos']["columna"],
                    "data"    => $_POST['vivienda']['id_vivienda'],
                ));
                $servicios_vivienda = $this->modelo->Administrar();
                $this->modelo->__SET("SQL", "SQL_12");$this->modelo->__SET("tipo", "1");
                $this->modelo->Datos($_POST['vivienda']['id_servicio']);
                if ($this->modelo->Administrar()) {
                    $existe = 0;
                    $this->modelo->__SET("SQL", "_03_");$this->modelo->__SET("tipo", "0");
                    $this->modelo->__SET("ultimo", array("tabla" => "servicios", "id" => "id_servicio"));
                    $id_servicio                      = $this->modelo->Administrar();
                    $_POST['vivienda']['id_servicio'] = $id_servicio[0]['MAX(id_servicio)'];

                    foreach ($this->datos["tipo_vivienda"] as $tv) {
                        if (strtolower($tv['nombre_tipo_vivienda']) == strtolower($_POST['vivienda']['id_tipo_vivienda'])) {
                            $existe = $tv['id_tipo_vivienda'];
                        }
                    }
                    if ($existe == 0) {
                        $this->modelo->__SET("SQL", "_02_"); $this->modelo->__SET("tipo", "1");
                        $this->modelo->__SET("registrar", array(
                            "tabla"   => "tipo_vivienda",
                            "columna" => "nombre_tipo_vivienda")
                        );
                        $this->modelo->Datos(["nombre_tipo_vivienda" => $_POST['vivienda']['id_tipo_vivienda'], "estado" => 1]);
                        if ($this->modelo->Administrar()) {
                            $this->modelo->__SET("SQL", "_03_");$this->modelo->__SET("tipo", "0");
                            $this->modelo->__SET("ultimo", array("tabla" => "tipo_vivienda", "id" => "id_tipo_vivienda"));
                            $id                                    = $this->modelo->Administrar();
                            $_POST['vivienda']['id_tipo_vivienda'] = $id[0]['MAX(id_tipo_vivienda)'];
                        }
                    } else {
                        $_POST['vivienda']['id_tipo_vivienda'] = $existe;
                    }
                    $this->modelo->__SET("SQL", $_POST['sql']); $this->modelo->__SET("tipo", "1");
                    $this->modelo->Datos($_POST['vivienda']);

                    if ($this->modelo->Administrar()) {
                        $this->mensaje = 1;
                        $this->Accion($_POST['accion']);
                        $this->modelo->__SET("SQL", "_07_");$this->modelo->__SET("tipo", "1");
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
                    $this->modelo->__SET("SQL", "SQL_08");$gas = $this->modelo->Administrar();
                    $this->modelo->__SET("SQL", "SQL_09");$electrodomesticos = $this->modelo->Administrar();
                    $this->modelo->__SET("SQL", "SQL_03");$techos = $this->modelo->Administrar();
                    $this->modelo->__SET("SQL", "SQL_05");$pisos = $this->modelo->Administrar();
                    $this->modelo->__SET("SQL", "SQL_07");$paredes = $this->modelo->Administrar();
                    $this->modelo->__SET("SQL", "SQL_04");$familia = $this->modelo->Administrar();

                    foreach ($familia as $v) {$family = $v['nombre_familia'];}
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
                $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
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
                            if ($value["id_tipo_techo"] == $_POST["datos"]["id"]) {$this->mensaje = $mensaje;}}
                        break;
                    case 'id_tipo_pared':
                        foreach ($datos as $value) {
                            if ($value["id_tipo_pared"] == $_POST["datos"]["id"]) {$this->mensaje = $mensaje;}}
                        break;
                    case 'id_tipo_piso':
                        foreach ($datos as $value) {
                            if ($value["id_tipo_piso"] == $_POST["datos"]["id"]) {$this->mensaje = $mensaje;}}
                        break;
                }

                if ($this->mensaje == 1) {
                    $this->modelo->__SET("tipo", "1"); $this->modelo->__SET("SQL", $_POST['sql']);
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
                $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
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
                        $this->modelo->__SET("SQL", "_02_"); $this->modelo->__SET("tipo", "1");
                        $this->modelo->__SET("registrar", array(
                            "tabla"   => "servicio_gas",
                            "columna" => "nombre_servicio_gas")
                        );
                        $this->modelo->Datos(["nombre_servicio_gas" => $_POST['gas']['gas'], "estado" => 1]);
                        if ($this->modelo->Administrar()) {
                            $this->modelo->__SET("SQL", "_03_"); $this->modelo->__SET("tipo", "0");
                            $this->modelo->__SET("ultimo", array("tabla" => "servicio_gas", "id" => "id_servicio_gas"));
                            $id = $this->modelo->Administrar();

                            $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
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
                            $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
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
                        $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
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
                $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
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
                        $this->modelo->__SET("SQL", "_02_"); $this->modelo->__SET("tipo", "1");
                        $this->modelo->__SET("registrar", array(
                            "tabla"   => "electrodomesticos",
                            "columna" => "nombre_electrodomestico")
                        );
                        $this->modelo->Datos(["nombre_electrodomestico" => $_POST['electrodomestico']['electrodomestico'], "estado" => 1]);
                        if ($this->modelo->Administrar()) {
                            $this->modelo->__SET("SQL", "_03_"); $this->modelo->__SET("tipo", "0");
                            $this->modelo->__SET("ultimo", array("tabla" => "electrodomesticos", "id" => "id_electrodomestico"));
                            $id = $this->modelo->Administrar();

                            $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
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
                            $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
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
                        $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
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
                $this->modelo->__SET("tipo", "0");$this->modelo->__SET("id", $_POST['id']);
                $this->modelo->__SET("SQL", $_POST['sql']);
                $datos = $this->modelo->Administrar();
                $this->Escribir_JSON($datos);unset($datos);
                break;

            case 'Eliminar':
                $this->modelo->__SET("SQL", "_07_");$this->modelo->__SET("tipo", "1");
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
                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");

                if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

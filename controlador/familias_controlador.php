<?php

class Familias extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        //   $this->Cargar_Modelo("familias");
    }
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();$this->vista->Cargar_Vistas('familia/consultar');
    }
    // ===============================================================================
    public function Establecer_Consultas()
    {
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("SQL", "SQL_06");$this->datos["personas"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_01");$this->datos["familias"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "_01_");
        $this->modelo->__SET("consultar", array("tabla" => "vivienda", "estado" => 1, "orden" => "numero_casa"));
        $this->datos["viviendas"] = $this->modelo->Administrar();
        $this->vista->datos      = $this->datos;
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Registros':$this->vista->Cargar_Vistas('familia/registrar');break;
            case 'Consultas':$this->vista->Cargar_Vistas('familia/consultar');break;

            case 'Administrar':
                $this->modelo->__SET("SQL", $_POST['sql']);
                $this->modelo->__SET("tipo", "1");$this->modelo->Datos($_POST['datos']);
                if ($this->modelo->Administrar()) {
                    if (isset($_POST['datos']["id_familia"])) {
                        $id = $_POST['datos']["id_familia"];
                    } else {
                        $this->modelo->__SET("SQL", "_03_");$this->modelo->__SET("tipo", "0");
                        $this->modelo->__SET("ultimo", array("tabla" => "familia", "id" => "id_familia"));
                        $id = $this->modelo->Administrar();
                        $id = $id[0]['MAX(id_familia)'];
                    }
                    foreach ($_POST['integrantes'] as $inte) {
                        $this->modelo->__SET("SQL", "SQL_05");$this->modelo->__SET("tipo", "1");
                        $this->modelo->Datos([
                            "cedula_persona" => $inte,
                            "id_familia"     => $id,

                        ]);
                        if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                    }
                }
                $this->Accion($_POST['accion']);
                echo $this->mensaje;unset($_POST, $this->mensaje,$id);
                break;

            case 'Eliminar':
                $this->modelo->Estado($_POST['estado']);
                $this->modelo->Datos([
                    $_POST['estado']["id_tabla"] => $_POST['estado']["param"],
                    "estado"                     => $_POST['estado']["estado"],
                ]);
                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            case 'Consulta_Ajax':
                $retornar = [];
                foreach ($this->datos["familias"] as $f) {
                    $this->modelo->__SET("SQL", "SQL_02");$this->modelo->__SET("tipo", "0");
                    $this->modelo->__SET("id", $f['id_familia']);
                    $integrantes = $this->modelo->Administrar();

                    $retornar[] = [
                        "familia"         => $f['nombre_familia'],
                        "telefono"        => $f['telefono_familia'],
                        "direccion"       => $f['direccion_vivienda'],
                        "Nro Casa"        => $f['numero_casa'],
                        "ingreso_mensual" => $f['ingreso_mensual_aprox'],
                        "ver"             => "<button class='btn btn-primary' onclick='ver_familia(`" . json_encode($integrantes) . "`,`" . $f['nombre_familia'] . "`,`" . $f['telefono_familia'] . "`,`" . $f['direccion_vivienda'] . "`,`" . $f['numero_casa'] . "`,`" . $f['ingreso_mensual_aprox'] . "`)' type='button'><em class='fa fa-eye'></em></button>",
                        "editar"          => "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#actualizar' onclick='editar(" . $f['id_familia'] . "," . $f['id_familia_persona'] . ")'><em class='fa fa-edit'></em></button>",
                        "eliminar"        => "<button class='btn btn-danger' onclick='eliminar(`" . $f['id_familia'] . "`)' type='button'><em class='fa fa-trash'></em></button>",
                    ];
                }
                $this->Escribir_JSON($retornar);unset($integrantes, $retornar);
                break;

            case 'Datos':
                $retornar = [];
                foreach ($this->datos["familias"] as $f) {
                    if ($f['id_familia'] == $_POST['id_familia']) {
                        $this->modelo->__SET("SQL", "SQL_02");$this->modelo->__SET("tipo", "0");
                        $this->modelo->__SET("id", $_POST['id_familia']);
                        $integrantes = $this->modelo->Administrar();

                        $retornar[] = [
                            "id_familia"          => $f['id_familia'],
                            "familia"             => $f['nombre_familia'],
                            "telefono"            => $f['telefono_familia'],
                            "direccion"           => $f['direccion_vivienda'],
                            "id_vivienda"         => $f['id_vivienda'],
                            "ingreso_mensual"     => $f['ingreso_mensual_aprox'],
                            "condicion_ocupacion" => $f['condicion_ocupacion'],
                            "observacion"         => $f['observacion'],
                            "integrantes"         => json_encode($integrantes),
                        ];
                    }
                }
                $this->Escribir_JSON($retornar);unset($integrantes, $retornar);
                break;

            case 'Existente':
                $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
                $this->modelo->__SET("consultar", array(
                    "tabla"   => "personas",
                    "columna" => "cedula_persona",
                    "data"    => $_POST['cedula'],
                ));
                $consulta = $this->modelo->Administrar();
                if (count($consulta) == 0) {echo 0;} else {$this->Escribir_JSON($consulta);}
                unset($consulta);
                break;

            case 'Eliminar_Integrantes':
                $retornar = 0;
                $this->modelo->__SET("SQL", "_07_");$this->modelo->__SET("tipo", "1");
                $this->modelo->__SET("eliminar", array(
                    "tabla" => "familia_personas", "id_tabla" => "cedula_persona"));
                $this->modelo->Datos(["cedula_persona" => $_POST['cedula_persona']]);

                if ($this->modelo->Administrar()) {
                    $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
                    $this->modelo->__SET("consultar", array(
                        "tabla"   => "familia_personas",
                        "columna" => "cedula_persona",
                        "data"    => $_POST['cedula_persona'],
                    ));
                    $integrantes = $this->modelo->Administrar();
                    if (count($integrantes) != 0) {
                        $retornar = [];
                        for ($i = 0; $i < count($integrantes); $i++) {
                            $retornar[] = [
                                "cedula_persona"     => $integrantes[0]['cedula_persona'],
                                "id_familia_persona" => $integrantes[$i]['id_familia_persona'],
                            ];
                        }
                    }
                }
                echo json_encode($retornar);unset($integrantes, $retornar, $_POST);
                break;

            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

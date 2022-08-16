<?php

class Enfermos extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        //   $this->Cargar_Modelo("enfermos");
    }
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();$this->Establecer_Consultas();
        $this->vista->Cargar_Vistas('enfermos/consultar');
    }
    // ==============================================================================
    public function Establecer_Consultas()
    {
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("SQL", "SQL_06"); $this->datos["personas"]     = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_01"); $this->datos["enfermedad"]   = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_02"); $this->datos["enfermos"]     = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_03"); $this->datos["enfermedades"] = $this->modelo->Administrar();
        $this->vista->datos = $this->datos;
    }
    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();$this->Establecer_Consultas();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Registros':$this->vista->Cargar_Vistas('enfermos/registrar');break;
            case 'Consultas':$this->vista->Cargar_Vistas('enfermos/consultar');break;

            case 'Eliminar':
                $this->modelo->__SET("eliminar", array(
                    "tabla"    => $_POST['estado']["tabla"],
                    "id_tabla" => $_POST['estado']["id_tabla"]
                ));
                $this->modelo->Datos([$_POST['estado']["id_tabla"] => $_POST['estado']["param"]]);
                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");

                if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            case 'Registrar':
                for ($i = 0; $i < count($_POST['enfermedades']); $i++) {
                    if ($_POST['enfermedades'][$i]['nuevo'] == '0') {
                        $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                        $this->modelo->Datos([
                            "cedula_persona" => $_POST['cedula'],
                            "id_enfermedad"  => $_POST['enfermedades'][$i]['enfermedad'],
                            "medicamentos"   => $_POST['enfermedades'][$i]['medicamentos'],
                        ]);
                        if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                    } else {
                        $this->modelo->__SET("SQL", "_02_");$this->modelo->__SET("tipo", "1");
                        $this->modelo->__SET("registrar", array(
                            "tabla" => "enfermedades",
                            "columna" => "nombre_enfermedad")
                        );
                        $this->modelo->Datos(["nombre_enfermedad" => $_POST['enfermedades'][$i]['enfermedad'], "estado" => 1]);

                        if ($this->modelo->Administrar()) {
                            $this->modelo->__SET("SQL", "_03_");$this->modelo->__SET("tipo", "0");
                            $this->modelo->__SET("ultimo", array("tabla" => "enfermedades", "id" => "id_enfermedad"));
                            $id = $this->modelo->Administrar();
                            foreach ($id as $id_e) {
                                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                                $this->modelo->Datos([
                                    "cedula_persona" => $_POST['cedula'],
                                    "id_enfermedad"  => $id_e['MAX(id_enfermedad)'],
                                    "medicamentos"   => $_POST['enfermedades'][$i]['medicamentos'],
                                ]);
                                if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                            }
                        }
                    }
                }
                echo $this->mensaje;unset($this->mensaje, $id, $_POST);
                break;

            case 'Consulta_Ajax':
                $retornar = [];
                foreach ($this->datos["enfermos"] as $e) {
                    $enfermedades_p  = '';$medicamentos_p  = '';$id_enfermedad_p = [];
                    foreach ($this->datos["enfermedades"] as $en) {
                        if ($en['cedula_persona'] == $e['cedula_persona']) {
                            $enfermedades_p .= $en['nombre_enfermedad'] . "<hr>";
                            $medicamentos_p    = $en['medicamentos'];
                            $id_enfermedad_p[] = $en['id_persona_enfermedad'] . "/";
                        }
                    }
                    $enfermedades_p = "<div style='overflow-y:scroll;width:100%;height:100px;background:#B4DFDE;'>" . $enfermedades_p . "</div>";
                    $retornar[] = [
                        "cedula"       => $e['cedula_persona'],
                        "nombre"       => $e['primer_nombre'] . " " . $e['primer_apellido'],
                        "enfermedades" => $enfermedades_p,
                        "medicamentos" => $medicamentos_p,
                        "ver"          => "<button type='button' class='btn btn-info' data-toggle='modal' data-target='#ver_enfermos'><em class='fa fa-eye'></em></button>",
                        "editar"       => "<button type='button' class='btn btn-success editar' data-toggle='modal' data-target='#actualizar'  onclick='editar(`" . $e['cedula_persona'] . "`)'><em class='fa fa-edit'></em></button>",
                        "eliminar"     => "<button class='btn btn-danger' onclick='eliminar(`" . json_encode($id_enfermedad_p) . "`)' type='button'><em class='fa fa-trash'></em></button>",
                    ];
                }
                $this->Escribir_JSON($retornar);
                unset($retornar, $enfermedades_p, $medicamentos_p, $id_enfermedad_p);
                break;

            case 'Datos':
                $this->modelo->__SET("SQL", "SQL_04");$this->modelo->__SET("tipo", "0");
                $this->modelo->__SET("cedula", $_POST['cedula']);
                $discapacidades = $this->modelo->Administrar();
                $this->Escribir_JSON($discapacidades);unset($_POST, $discapacidades);
                break;

            case 'Eliminar_Enfermedad':
                $retornar = 0;
                $this->modelo->__SET("SQL", "_07_"); $this->modelo->__SET("tipo", "1");
                $this->modelo->__SET("eliminar", array(
                    "tabla" => "personas_enfermedades", "id_tabla" => "id_persona_enfermedad"));
                $this->modelo->Datos(["id_persona_enfermedad" => $_POST['id_persona_enfermedad']]);

                if ($this->modelo->Administrar()) {
                    $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
                    $this->modelo->__SET("consultar", array(
                        "tabla"   => "personas_enfermedades",
                        "columna" => "cedula_persona",
                        "data"    => $_POST['cedula_persona'],
                    ));
                    $enfermedades = $this->modelo->Administrar();
                    if (count($enfermedades) != 0) {
                        $retornar = [];
                        for ($i = 0; $i < count($enfermedades); $i++) {
                            $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
                            $this->modelo->__SET("consultar", array(
                                "tabla"   => "enfermedades",
                                "columna" => "id_enfermedad",
                                "data"    => $enfermedades[$i]['id_enfermedad'],
                            ));
                            $enfer      = $this->modelo->Administrar();
                            $retornar[] = [
                                "nombre_enfermedad"     => $enfer[0]['nombre_enfermedad'],
                                "id_persona_enfermedad" => $enfermedades[$i]['id_persona_enfermedad'],
                            ];
                        }
                    }
                }
                echo json_encode($retornar);unset($enfermedades, $retornar, $enfer, $_POST);
                break;

            case 'Personas':
                $this->modelo->__SET("tipo", "0");
                $this->modelo->__SET("SQL", "_05_");
                $this->modelo->__SET("consultar", array(
                    "tabla"   => "personas",
                    "columna" => "cedula_persona",
                    "data"    => $_POST['cedula'],
                ));
                $persona = $this->modelo->Administrar();
                if (count($persona) == 0) {echo 0;} else { $this->Escribir_JSON($persona);}
                unset($persona, $_POST);
                break;
                
            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

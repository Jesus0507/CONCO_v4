<?php

class Enfermos extends Controlador
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
    public $id;
    public $cedula;
    public $enfermos;
    public $retornar;
    public $persona;
    public $id_enfermedad_p;
    public $id_persona_enfermedad;
    public $enfermedades;
    private $enfermedades_p;
    private $medicamentos_p;
    private $enfer;

    // ==================ESTABLECER DATOS=========================

    public function __construct()
    {
        parent::__construct();
        $this->Validacion("enfermos");
        $this->permisos              = $_SESSION["Enfermos"];
        $this->estado                = $_POST['estado'];
        $this->datos_ejecutar        = $_POST['datos'];
        $this->sql                   = $_POST['sql'];
        $this->accion                = $_POST['accion'];
        $this->validar               = $this->validacion;
        $this->mensaje               = 1;
        $this->cedula                = $_POST['cedula'];
        $this->enfermedades          = $_POST['enfermedades'];
        $this->id_persona_enfermedad = $_POST['id_persona_enfermedad'];
        $this->estado_ejecutar       = array($this->estado["id_tabla"] => $this->estado["param"], "estado" => $this->estado["estado"]);
        //   $this->Cargar_Modelo("enfermos");
    }
    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_06");
        $this->datos_consulta["personas"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_01");
        $this->datos_consulta["enfermedad"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_02");
        $this->datos_consulta["enfermos"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_03");
        $this->datos_consulta["enfermedades"] = $this->modelo->Administrar();

        $this->vista->datos = $this->Get_Datos_Vista();
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
        $this->Establecer_Consultas();
        if ($this->permisos["consultar"] === 1) {
            $this->vista->Cargar_Vistas('enfermos/consultar');
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
                    $this->vista->Cargar_Vistas('enfermos/registrar');
                } else { $this->_403_();}
                break;
            case 'Consultas':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('enfermos/consultar');
                } else { $this->_403_();}
                break;

            case 'Eliminar':
                if ($this->permisos["eliminar"] === 1) {
                    $this->modelo->_SQL_($this->Get_Sql());
                    $this->modelo->_Tipo_(1);

                    $this->crud["eliminar"] = array(
                        "tabla"    => $this->estado["tabla"],
                        "id_tabla" => $this->estado["id_tabla"],
                    );
                    $this->id = $this->estado["param"];
                    $this->modelo->_CRUD_($this->Get_Crud_Sql());
                    $this->modelo->_Datos_(["cedula_persona" => $this->id]);
                    echo  $this->modelo->Administrar();
                    $this->Accion($this->Get_Accion());
                } else { $this->_403_();}
                break;

            case 'Registrar':
                if ($this->permisos["registrar"] === 1) {
                    for ($i = 0; $i < count($this->enfermedades); $i++) {
                        if ($this->enfermedades[$i]['nuevo'] == '0') {
                            $this->modelo->_SQL_($this->Get_Sql());
                            $this->modelo->_Tipo_(1);
                            $this->datos_ejecutar = array(
                                "cedula_persona" => $this->cedula,
                                "id_enfermedad"  => $this->enfermedades[$i]['enfermedad'],
                                "medicamentos"   => $this->enfermedades[$i]['medicamentos'],
                            );
                            $this->modelo->_Datos_($this->Get_Datos());
                            if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                        } else {
                            $this->modelo->_SQL_("_02_");
                            $this->modelo->_Tipo_(1);

                            $this->crud["registrar"] = array(
                                "tabla"   => "enfermedades",
                                "columna" => "nombre_enfermedad",
                            );
                            $this->modelo->_CRUD_($this->Get_Crud_Sql());
                            $this->modelo->_Datos_([
                                "nombre_enfermedad" => $this->enfermedades[$i]['enfermedad'],
                                "estado"            => 1,
                            ]);
                            if ($this->modelo->Administrar()) {
                                $this->modelo->_SQL_("_03_");
                                $this->modelo->_Tipo_(0);

                                $this->crud["ultimo"] = array(
                                    "tabla" => "enfermedades",
                                    "id"    => "id_enfermedad",
                                );
                                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                                $this->id = $this->modelo->Administrar();
                                $this->id = $this->id[0]['MAX(id_enfermedad)'];
                                $this->modelo->_SQL_($this->Get_Sql());
                                $this->modelo->_Tipo_(1);
                                $this->datos_ejecutar = array(
                                    "cedula_persona" => $this->cedula,
                                    "id_enfermedad"  => $this->id,
                                    "medicamentos"   => $this->enfermedades[$i]['medicamentos'],
                                );
                                $this->modelo->_Datos_($this->Get_Datos());
                                if ($this->modelo->Administrar()) {$this->mensaje = 1;}

                            }
                        }
                    }
                    $this->Accion($this->Get_Accion());
                    echo $this->Get_Mensaje();unset($this->mensaje, $id, $_POST);
                } else { $this->_403_();}
                break;

            case 'Consulta_Ajax':
                $this->retornar = [];
                foreach ($this->datos_consulta["enfermos"] as $e) {
                    $this->enfermedades_p  = '';
                    $this->medicamentos_p  = '';
                    $this->id_enfermedad_p = [];
                    foreach ($this->datos_consulta["enfermedades"] as $en) {
                        if ($en['cedula_persona'] == $e['cedula_persona']) {
                            $this->enfermedades_p .= $en['nombre_enfermedad'] . "<hr>";
                            $en['medicamentos'] != 'No posee' ? $this->medicamentos_p    .= $en['medicamentos'].'<hr>' : $this->medicamentos_p    .= '';
                            $this->id_enfermedad_p[] = $en['id_persona_enfermedad'] . "/";
                        }
                    }
                    $this->enfermedades_p = "<div style='overflow-y:scroll;width:100%;height:100px;background:#C7F2EE;'>" . $this->enfermedades_p . "</div>";
                    $this->medicamentos_p = "<div style='overflow-y:scroll;width:100%;height:100px;background:#C7F2EE;'>" . $this->medicamentos_p . "</div>";

                    $this->retornar[]     = [
                        "cedula"       => $e['cedula_persona'],
                        "nombre"       => $e['primer_nombre'] . " " . $e['primer_apellido'],
                        "enfermedades" => $this->enfermedades_p,
                        "medicamentos" => $this->medicamentos_p,
                        "ver"          => "<button style='background: #4dbdbd !important;' type='button' class='btn btn-info' data-toggle='modal' data-target='#ver_enfermos'><em class='fa fa-eye'></em></button>",
                        "editar"       => "<button type='button' class='btn btn-info editar' data-toggle='modal' data-target='#actualizar'  onclick='editar(`" . $e['cedula_persona'] . "`)'><em class='fa fa-edit'></em></button>",
                        "eliminar"     => "<button class='btn btn-danger' onclick='eliminar(`" . $e['cedula_persona'] . "`)' type='button'><em class='fa fa-trash'></em></button>",
                    ];
                }
                $this->Escribir_JSON($this->retornar);
                unset($this->retornar, $this->enfermedades_p, $this->medicamentos_p, $this->id_enfermedad_p);
                break;

            case 'Datos':
                $this->modelo->_Tipo_(0);
                $this->modelo->_ID_($this->cedula);
                $this->modelo->_SQL_("SQL_04");
                $this->enfermos = $this->modelo->Administrar();
                $this->Escribir_JSON($this->enfermos);
                break;

            case 'Eliminar_Enfermedad':
                $this->retornar = 0;
                $this->modelo->_SQL_("_07_");
                $this->modelo->_Tipo_(1);

                $this->crud["eliminar"] = array(
                    "tabla"    => "personas_enfermedades",
                    "id_tabla" => "id_persona_enfermedad",
                );

                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->modelo->_Datos_(["id_persona_enfermedad" => $this->id_persona_enfermedad]);

                if ($this->modelo->Administrar()) {
                    $this->modelo->_Tipo_(0);
                    $this->modelo->_SQL_("_05_");
                    $this->crud["consultar"] = array(
                        "tabla"   => "personas_enfermedades",
                        "columna" => "cedula_persona",
                        "data"    => $this->cedula,
                    );
                    $this->modelo->_CRUD_($this->Get_Crud_Sql());
                    $this->enfermedades = $this->modelo->Administrar();

                    if (count($this->enfermedades) != 0) {
                        $this->retornar = [];
                        for ($i = 0; $i < count($this->enfermedades); $i++) {
                            $this->modelo->_Tipo_(0);
                            $this->modelo->_SQL_("_05_");

                            $this->crud["consultar"] = array(
                                "tabla"   => "enfermedades",
                                "columna" => "id_enfermedad",
                                "data"    => $this->enfermedades[$i]['id_enfermedad'],
                            );
                            $this->modelo->_CRUD_($this->Get_Crud_Sql());
                            $this->enfer      = $this->modelo->Administrar();
                            $this->retornar[] = [
                                "nombre_enfermedad"     => $this->enfer[0]['nombre_enfermedad'],
                                "id_persona_enfermedad" => $this->enfermedades[$i]['id_persona_enfermedad'],
                            ];
                        }
                    }
                }
                echo json_encode($this->retornar);unset($this->enfermedades, $this->retornar, $this->enfer, $_POST);
                break;

            case 'Personas':
                $this->modelo->_Tipo_(0);
                $this->modelo->_SQL_("SQL_07");
                $this->modelo->_ID_($this->cedula);
                $this->persona = $this->modelo->Administrar();
                if (count($this->persona) == 0) {
                    echo 0;
                } else { 
                    $this->modelo->_SQL_("SQL_04");
                    $this->modelo->_Tipo_(0);
                    $this->modelo->_ID_($this->cedula);
                    $resultado = $this->modelo->Administrar();
                    if(count($resultado) > 0 ){
                        echo 1;
                    }
                    else{
                    $this->Escribir_JSON($this->persona);
                    }
                }
                unset($this->persona, $_POST);
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        unset($this->peticion);
        exit();
    }
}

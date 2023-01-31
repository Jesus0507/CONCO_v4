<?php

class Discapacitados extends Controlador
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
    public $retornar;
    public $cedula;
    public $persona;
    public $id_discapacidad_persona;
    public $discapacidades;
    private $discapacitados;
    private $discapacida;
    private $discapacidades_p;
    private $id_discapacidad_p;
    private $en_cama_valor;
    // ==================ESTABLECER DATOS=========================

    public function __construct()
    {
        parent::__construct();
        $this->Validacion("discapacitados");
        $this->permisos                = $_SESSION["Discapacitados"];
        $this->estado                  = $_POST['estado'];
        $this->datos_ejecutar          = $_POST['datos'];
        $this->sql                     = $_POST['sql'];
        $this->accion                  = $_POST['accion'];
        $this->validar                 = $this->validacion;
        $this->mensaje                 = 1;
        $this->cedula                  = $_POST['cedula'];
        $this->discapacitados          = $_POST['discapacidades'];
        $this->id_discapacidad_persona = $_POST['id_discapacidad_persona'];
        $this->estado_ejecutar         = array($this->estado["id_tabla"] => $this->estado["param"], "estado" => $this->estado["estado"]);
        // $this->crud["consultar"] = array("tabla" => "calles", "estado" => 1, "orden" => "nombre_calle");
        //  $this->Cargar_Modelo("discapacitados");
    }
    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_03");
        $this->datos_consulta["personas"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_01");
        $this->datos_consulta["discapacidad"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_04");
        $this->datos_consulta["discapacidades"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_02");
        $this->datos_consulta["discapacitados"] = $this->modelo->Administrar();
        $this->vista->datos                     = $this->Get_Datos_Vista();
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
            $this->vista->Cargar_Vistas('discapacitados/consultar');
        } else { $this->_403_();}
    }

    // ==============================================================================
    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Registros':
                if ($this->permisos["registrar"] === 1) {
                    $this->vista->Cargar_Vistas('discapacitados/registrar');
                } else { $this->_403_();}
                break;
            case 'Consultas':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('discapacitados/consultar');
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
                    $this->modelo->_Datos_(["id_discapacidad_persona" => $this->id]);
                    if ($this->modelo->Administrar()) {
                        $this->Accion($this->Get_Accion());
                        echo $this->Get_Mensaje();
                    }
                } else { $this->_403_();}
                break;
            case 'Administrar':
                if ($this->permisos["registrar"] === 1 || $this->permisos["modificar"] === 1) {
                    for ($i = 0; $i < count($this->discapacitados); $i++) {
                        if ($this->discapacitados[$i]['nuevo'] == '0') {
                            $this->modelo->_SQL_($this->Get_Sql());
                            $this->modelo->_Tipo_(1);
                            $this->datos_ejecutar = array(
                                "cedula_persona"           => $this->cedula,
                                "id_discapacidad"          => $this->discapacitados[$i]['discapacidad'],
                                "necesidades_discapacidad" => $this->discapacitados[$i]['necesidades'],
                                "observacion_discapacidad" => $this->discapacitados[$i]['observaciones'],
                                "en_cama"                  => $this->discapacitados[$i]['en_cama'],
                            );
                            $this->modelo->_Datos_($this->Get_Datos());
                            if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                        } else {
                            $this->modelo->_SQL_("_02_");
                            $this->modelo->_Tipo_(1);

                            $this->crud["registrar"] = array(
                                "tabla"   => "discapacidad",
                                "columna" => "nombre_discapacidad",
                            );
                            $this->modelo->_CRUD_($this->Get_Crud_Sql());
                            $this->modelo->_Datos_([
                                "nombre_discapacidad" => $this->discapacitados[$i]['discapacidad'],
                                "estado"              => 1,
                            ]);
                            if ($this->modelo->Administrar()) {
                                $this->modelo->_SQL_("_03_");
                                $this->modelo->_Tipo_(0);

                                $this->crud["ultimo"] = array(
                                    "tabla" => "discapacidad",
                                    "id"    => "id_discapacidad",
                                );
                                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                                $this->id = $this->modelo->Administrar();
                                $this->id = $this->id[0]['MAX(id_discapacidad)'];

                                $this->modelo->_SQL_($this->Get_Sql());
                                $this->modelo->_Tipo_(1);
                                $this->datos_ejecutar = array(
                                    "cedula_persona"           => $this->cedula,
                                    "id_discapacidad"          => $this->id,
                                    "necesidades_discapacidad" => $this->discapacitados[$i]['necesidades'],
                                    "observacion_discapacidad" => $this->discapacitados[$i]['observaciones'],
                                    "en_cama"                  => $this->discapacitados[$i]['en_cama'],
                                );
                                $this->modelo->_Datos_($this->Get_Datos());
                                if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                            }
                        }
                    }
                    $this->Accion($this->Get_Accion());
                    echo $this->Get_Mensaje();

                } else { $this->_403_();}
                break;
            case 'Consulta_Ajax':
                $this->retornar = [];
                foreach ($this->datos_consulta["discapacitados"] as $d) {
                    $this->discapacidades_p  = '<table style="width:100%">';
                    $this->id_discapacidad_p = [];
                    foreach ($this->datos_consulta["discapacidades"] as $dis) {
                        if ($dis['cedula_persona'] == $d['cedula_persona']) {
                            $this->en_cama_valor                          = "";
                            $dis['en_cama'] == '1' ? $this->en_cama_valor = 'Si' : $this->en_cama_valor = 'No';
                            $this->discapacidades_p .= "<tr><td>" . $dis['nombre_discapacidad'] . "</td><td>" . $this->en_cama_valor . "</td><td>" . $dis['necesidades_discapacidad'] . "</td><td>" . $dis['observacion_discapacidad'] . "</td></tr>";
                            $this->id_discapacidad_p[] = $dis['id_discapacidad_persona'] . "/";
                        }
                    }
                    $this->discapacidades_p = "<div style='overflow-y:scroll;width:100%;height:100px;background:#B4DFDE;'>" . $this->discapacidades_p . "</div></table>";

                    $this->retornar[] = [
                        "cedula"         => $d['cedula_persona'],
                        "nombre"         => $d['primer_nombre'] . " " . $d['primer_apellido'],
                        "discapacidades" => $this->discapacidades_p,
                        "editar"         => "<button type='button' class='btn btn-info editar' onclick='editar(`" . $d['cedula_persona'] . "`)' data-toggle='modal' data-target='#actualizar'><em class='fa fa-edit'></em></button>",
                        "eliminar"       => "<button class='btn btn-danger' onclick='eliminar(`" . json_encode($this->id_discapacidad_p) . "`)' type='button'><em class='fa fa-trash'></em></button>",
                    ];
                }
                $this->Escribir_JSON($this->retornar);
                unset($this->retornar, $this->discapacidades_p, $this->id_discapacidad_p, $this->en_cama_valor);
                break;

            case 'Datos':
                $this->modelo->_Tipo_(0);
                $this->modelo->_ID_($this->cedula);
                $this->modelo->_SQL_("SQL_05");
                $this->discapacidades = $this->modelo->Administrar();
                $this->Escribir_JSON($this->discapacidades);
                break;

            case 'Eliminar_Discapacidad':
                $this->retornar = 0;
                $this->modelo->_SQL_("_07_");
                $this->modelo->_Tipo_(1);

                $this->crud["eliminar"] = array(
                    "tabla"    => "discapacidad_persona",
                    "id_tabla" => "id_discapacidad_persona",
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->modelo->_Datos_(["id_discapacidad_persona" => $this->id_discapacidad_persona]);

                if ($this->modelo->Administrar()) {
                    $this->modelo->_Tipo_(0);
                    $this->modelo->_SQL_("_05_");

                    $this->crud["consultar"] = array(
                        "tabla"   => "discapacidad_persona",
                        "columna" => "cedula_persona",
                        "data"    => $this->cedula,
                    );
                    $this->modelo->_CRUD_($this->Get_Crud_Sql());
                    $this->discapacidades = $this->modelo->Administrar();

                    if (count($this->discapacidades) != 0) {
                        $this->retornar = [];
                        for ($i = 0; $i < count($this->discapacidades); $i++) {
                            $this->modelo->_Tipo_(0);
                            $this->modelo->_SQL_("_05_");
                            $this->crud["consultar"] = array(
                                "tabla"   => "discapacidades",
                                "columna" => "id_discapacidad",
                                "data"    => $this->discapacidades[$i]['id_discapacidad'],
                            );
                            $this->discapacida = $this->modelo->Administrar();
                            $this->retornar[]  = [
                                "nombre_discapacidad"     => $this->discapacida[0]['nombre_discapacidad'],
                                "id_discapacidad_persona" => $this->discapacidades[$i]['id_discapacidad_persona'],
                            ];
                        }
                    }
                }
                echo json_encode($this->retornar);
                unset($this->discapacidades, $this->retornar, $this->discapacida, $_POST);
                break;
            case 'Personas':
                $this->modelo->_Tipo_(0);
                $this->modelo->_SQL_("SQL_07");
                $this->modelo->_ID_($this->cedula);
                $this->persona = $this->modelo->Administrar();
                if (count($this->persona) == 0) {echo 0;} else { $this->Escribir_JSON($this->persona);}
                unset($this->persona, $_POST);
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        unset($this->peticion);
        exit();
    }
}

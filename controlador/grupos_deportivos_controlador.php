<?php
class Grupos_Deportivos extends Controlador
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
    public $ids;
    public $retornar;
    public $result;
    public $cedula;
    public $id_grupo_deportivo;
    private $integrantes;
    private $persona;
    private $integrantes_grupo;

    // ==================ESTABLECER DATOS=========================

    public function __construct()
    {
        parent::__construct();
        $this->Validacion("grupos_deportivos");
        $this->permisos           = $_SESSION["Grupos deportivos"];
        $this->estado             = $_POST['estado'];
        $this->datos_ejecutar     = $_POST['datos'];
        $this->sql                = $_POST['sql'];
        $this->accion             = $_POST['accion'];
        $this->validar            = $this->validacion;
        $this->mensaje            = 1;
        $this->integrantes        = $_POST['integrantes'];
        $this->id_grupo_deportivo = $_POST['id_grupo_deportivo'];
        $this->ids                = $_POST["id"];
        $this->cedula             = $_POST['cedula_persona'];
        $this->estado_ejecutar    = array($this->estado["id_tabla"] => $this->estado["param"], "estado" => $this->estado["estado"]);
        $this->crud["consultar"]  = array("tabla" => "deportes", "estado" => 1, "orden" => "nombre_deporte");
        //   $this->Cargar_Modelo("grupos_deportivos");
    }
    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_03");
        $this->datos_consulta["grupos_deportivos"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("_01_");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["deportes"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_04");
        $this->datos_consulta["integrantes"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_07");
        $this->datos_consulta["personas"] = $this->modelo->Administrar();
        $this->vista->datos               = $this->Get_Datos_Vista();
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
            $this->vista->Cargar_Vistas('grupos_deportivos/consultar');
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
                    $this->vista->Cargar_Vistas('grupos_deportivos/registrar');
                } else { $this->_403_();}
                break;
            case 'Consultas':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('grupos_deportivos/consultar');
                } else { $this->_403_();}
                break;
            case 'Consulta_Ajax':$this->Escribir_JSON($this->Get_Datos_Vista()["grupos_deportivos"]);
                break;
            case 'Deportes':$this->Escribir_JSON($this->Get_Datos_Vista()["deportes"]);
                break;

            case 'Eliminar':
                if ($this->permisos["eliminar"] === 1) {
                    $this->modelo->_Estado_($this->Get_Estado());
                    $this->modelo->_Datos_($this->Get_Estado_Ejecutar());
                    $this->modelo->_SQL_($this->Get_Sql());
                    $this->modelo->_Tipo_(1);
                    if ($this->modelo->Administrar()) {
                        $this->Accion($this->Get_Accion());
                        echo $this->Get_Mensaje();
                    }
                    unset($_POST, $this->mensaje);
                } else { $this->_403_();}
                break;

            case 'Administrar':
                if ($this->permisos["registrar"] === 1 || $this->permisos["modificar"] === 1) {
                    foreach ($this->datos_consulta["deportes"] as $key => $value) {
                        if ($value["nombre_deporte"] == $this->datos_ejecutar["id_deporte"]) {
                            $this->datos_ejecutar["id_deporte"] = $value["id_deporte"];
                        } else {
                            $deporte = false;
                        }
                    }

                    if ($deporte == false) {
                        $this->modelo->_SQL_("_02_");
                        $this->modelo->_Tipo_(1);
                        $this->crud["registrar"] = array(
                            "tabla"   => "deportes",
                            "columna" => "nombre_deporte",
                        );
                        $this->modelo->_CRUD_($this->Get_Crud_Sql());
                        $this->modelo->_Datos_(["nombre_deporte" => $this->datos_ejecutar["id_deporte"],"estado" =>1]);
                        if ($this->modelo->Administrar()) {
                            $this->modelo->_SQL_("_03_");
                        $this->modelo->_Tipo_(0);
                            $this->crud["ultimo"] = array(
                                "tabla" => "deportes",
                                "id"    => "id_deporte",
                            );
                            $this->modelo->_CRUD_($this->Get_Crud_Sql());
                            $this->id = $this->modelo->Administrar();
                            $this->datos_ejecutar["id_deporte"] = $this->id[0]['MAX(id_deporte)'];
                        }
                    }
                    
                    $this->modelo->_SQL_($this->Get_Sql());
                    $this->modelo->_Tipo_(1);
                    $this->modelo->_Datos_($this->Get_Datos());
                    if ($this->modelo->Administrar()) {
                        $this->modelo->_SQL_("_03_");
                        $this->modelo->_Tipo_(0);

                        $this->crud["ultimo"] = array(
                            "tabla" => "grupo_deportivo",
                            "id"    => "id_grupo_deportivo",
                        );
                        $this->modelo->_CRUD_($this->Get_Crud_Sql());
                        $this->id = $this->modelo->Administrar();
                        $this->id = $this->id[0]['MAX(id_grupo_deportivo)'];
                        foreach ($this->integrantes as $inte) {
                            $this->modelo->_SQL_("SQL_06");
                            $this->modelo->_Tipo_(1);
                            $this->datos_ejecutar = array(
                                "cedula_persona"     => $inte["integrantes"],
                                "id_grupo_deportivo" => $this->id,
                                "estado"             => 1,
                            );
                            $this->modelo->_Datos_($this->Get_Datos());
                            if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                        }
                    }
                    $this->Accion($this->Get_Accion());
                    echo $this->Get_Mensaje();unset($_POST, $this->mensaje);
                } else { $this->_403_();}
                break;

            case 'Datos':
                $this->retornar = [];
                foreach ($this->datos_consulta["grupos_deportivos"] as $gp) {

                    if ($gp['id_grupo_deportivo'] == $this->id_grupo_deportivo) {
                        $this->modelo->_SQL_($this->Get_Sql());
                        $this->modelo->_Tipo_(0);
                        $this->modelo->_ID_($this->id_grupo_deportivo);
                        $this->integrantes_grupo = $this->modelo->Administrar();
                        $this->retornar[]        = [
                            "id_grupo_deportivo"     => $gp['id_grupo_deportivo'],
                            "nombre_deporte"         => $gp['nombre_deporte'],
                            "nombre_grupo_deportivo" => $gp['nombre_grupo_deportivo'],
                            "descripcion"            => $gp['descripcion'],
                            "integrantes"            => json_encode($this->integrantes_grupo),
                        ];
                    }
                }
                $this->Escribir_JSON($this->retornar);unset($this->retornar, $this->integrantes_grupo);
                break;

            case 'Grupos_Deportivos_Personas':
                foreach ($this->datos_consulta["integrantes"] as $integrante) {
                    if ($this->ids == $integrante["id_grupo_deportivo"]) {$this->integrantes[] = $integrante;}
                }
                $this->Escribir_JSON($this->integrantes);unset($this->integrantes);
                break;

            case 'Obtener_Integrantes':
                $this->modelo->_Tipo_(0);
                $this->modelo->_SQL_("_05_");

                $this->crud["consultar"] = array(
                    "tabla"   => "personas_grupo_deportivo",
                    "columna" => "id_grupo_deportivo",
                    "data"    => $this->ids,
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->integrantes_grupo = $this->modelo->Administrar();
                $this->result            = [];
                foreach ($this->integrantes_grupo as $i) {
                    $this->modelo->_Tipo_(0);
                    $this->modelo->_SQL_("_05_");

                    $this->crud["consultar"] = array(
                        "tabla"   => "personas",
                        "columna" => "cedula_persona",
                        "data"    => $i['cedula_persona'],
                    );
                    $this->modelo->_CRUD_($this->Get_Crud_Sql());
                    $this->persona  = $this->modelo->Administrar();
                    $this->result[] = $this->persona[0];
                }
                echo json_encode($this->result);unset($this->integrantes_grupo, $this->result, $this->persona);
                break;
            case 'Agregar':
                $this->modelo->_Tipo_(0);
                $this->modelo->_SQL_("_05_");

                $this->crud["consultar"] = array(
                    "tabla"   => "personas_grupo_deportivo",
                    "columna" => "id_grupo_deportivo",
                    "data"    => $this->datos_ejecutar['id_grupo_deportivo'],
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->integrantes_grupo = $this->modelo->Administrar();
                $this->retornar          = 1;
                foreach ($this->integrantes_grupo as $i) {
                    if ($i['cedula_persona'] == $this->datos_ejecutar['cedula_persona']) {
                        $this->retornar = 0;
                    }
                }
                if ($this->retornar == 1) {
                    $this->modelo->_SQL_($this->Get_Sql());
                    $this->modelo->_Tipo_(1);
                    $this->modelo->_Datos_($this->Get_Datos());

                    if ($this->modelo->Administrar()) {$this->retornar = 1;}
                }
                echo $this->retornar;unset($this->retornar, $this->integrantes_grupo);
                break;

            case 'Integrantes':
                $this->modelo->_Tipo_(0);
                $this->modelo->_SQL_("_05_");
                $this->crud["consultar"] = array(
                    "tabla"   => "personas_grupo_deportivo",
                    "columna" => "id_grupo_deportivo",
                    "data"    => $this->ids,
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->integrantes_grupo = $this->modelo->Administrar();
                $this->result            = [];
                foreach ($this->integrantes_grupo as $i) {
                    $this->modelo->_Tipo_(0);
                    $this->modelo->_SQL_("_05_");
                    $this->modelo->__SET("consultar", array(
                        "tabla"   => "personas",
                        "columna" => "cedula_persona",
                        "data"    => $i['cedula_persona'],
                    ));
                    $this->persona  = $this->modelo->Administrar();
                    $this->result[] = $this->persona[0];
                }
                echo json_encode($this->result);unset($this->result, $this->integrantes_grupo, $this->persona);
                break;

            case 'Eliminar_Integrantes':
                $this->retornar = 0;
                $this->modelo->_SQL_("_07_");
                $this->modelo->_Tipo_(1);
                $this->crud["eliminar"] = array(
                    "tabla"    => "personas_grupo_deportivo",
                    "id_tabla" => "cedula_persona",
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->modelo->_Datos_(["cedula_persona" => $this->cedula]);
                if ($this->modelo->Administrar()) {
                    $this->modelo->_Tipo_(0);
                    $this->modelo->_SQL_("_05_");
                    $this->crud["consultar"] = array(
                        "tabla"   => "personas_grupo_deportivo",
                        "columna" => "id_grupo_deportivo",
                        "data"    => $this->id_grupo_deportivo,
                    );
                    $this->modelo->_CRUD_($this->Get_Crud_Sql());
                    $this->integrantes_grupo = $this->modelo->Administrar();
                    if (count($this->integrantes_grupo) != 0) {
                        $this->retornar = [];
                        for ($i = 0; $i < count($this->integrantes_grupo); $i++) {
                            $this->retornar[] = [
                                "cedula_persona"             => $this->integrantes_grupo[0]['cedula_persona'],
                                "id_persona_grupo_deportivo" => $this->integrantes_grupo[$i]['id_persona_grupo_deportivo'],
                            ];
                        }
                    }
                }
                echo json_encode($this->retornar);unset($this->integrantes_grupo, $this->retornar, $_POST);
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }

        exit();
    }
}

<?php

class Familias extends Controlador
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
    public $retornar;
    private $integrantes;
    private $id;
    private $id_familia;
    private $cedula; 
    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        //   $this->Cargar_Modelo("familias");
        $this->Validacion("negocios");
        $this->permisos          = $_SESSION["Nucleo familiar"];
        $this->estado            = $_POST['estado'];
        $this->datos_ejecutar    = $_POST['datos'];
        $this->sql               = $_POST['sql'];
        $this->accion            = $_POST['accion'];
        $this->validar           = $this->validacion;
        $this->mensaje           = 1;
        $this->integrantes       = $_POST['integrantes'];
        $this->cedula            = $_POST['cedula'];
        $this->id_familia        = $_POST['id_familia'];
        $this->estado_ejecutar   = array($this->estado["id_tabla"] => $this->estado["param"], "estado" => $this->estado["estado"]);
    }

    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_06");
        $this->datos_consulta["personas"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_01");
        $this->datos_consulta["familias"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("_01_");
        $this->crud["consultar"] = array("tabla" => "vivienda", "estado" => 1, "orden" => "numero_casa");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["viviendas"] = $this->modelo->Administrar();
        $this->vista->datos                = $this->Get_Datos_Vista();
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
            $this->vista->Cargar_Vistas('familia/consultar');
        } else { $this->_403_();}
    }
    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        $this->peticion = (isset($_POST['peticion'])) ? $_POST['peticion'] : $peticion[0];
        switch ($this->peticion) {
            case 'Registros':
                if ($this->permisos["registrar"] === 1) {
                    $this->vista->Cargar_Vistas('familia/registrar');
                } else { $this->_403_();}
                break;
            case 'Consultas':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('familia/consultar');
                } else { $this->_403_();}
                break;

            case 'Administrar':
                if ($this->permisos["registrar"] === 1) {
                    $this->Validacion("familias");
                    if ($this->validacion->Validacion_Registro()) {
                        $this->modelo->_SQL_($this->Get_Sql());
                        $this->modelo->_Tipo_(1);
                        $this->modelo->_Datos_($this->Get_Datos());
                        if ($this->modelo->Administrar()) {
                            $this->modelo->_SQL_("_03_");
                            $this->modelo->_Tipo_(0);
                            $this->crud["ultimo"] = array("tabla" => "familia", "id" => "id_familia");
                            $this->modelo->_CRUD_($this->Get_Crud_Sql());
                            $this->id = $this->modelo->Administrar();
                            $this->id = $this->id[0]['MAX(id_familia)'];
                            foreach ($this->integrantes as $inte) {
                                $this->modelo->_SQL_("SQL_05");
                                $this->modelo->_Tipo_(1);
                                $this->modelo->_Datos_([
                                    "cedula_persona" => $inte,
                                    "id_familia"     => $this->id,

                                ]);
                                if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                            }
                        }
                        $this->Accion($this->Get_Accion());
                        echo $this->Get_Mensaje();
                    } else {
                        echo $this->validacion->Fallo();
                    }
                    unset($_POST, $this->mensaje, $id);
                } else { $this->_403_();}
                break;

            case 'Editar':
                if ($this->permisos["modificar"] === 1) {
                    $this->Validacion("familias");
                    if ($this->validacion->Validacion_Registro()) {
                        $this->modelo->_SQL_($this->Get_Sql());
                        $this->modelo->_Tipo_(1);
                        $this->modelo->_Datos_($this->Get_Datos());
                        if ($this->modelo->Administrar()) {
                            foreach ($this->integrantes as $inte) {
                                $this->modelo->_SQL_("SQL_05");
                                $this->modelo->_Tipo_(1);
                                $this->datos_ejecutar = [
                                    "cedula_persona" => $inte,
                                    "id_familia"     => $this->id_familia,

                                ];
                                $this->modelo->_Datos_($this->Get_Datos());
                                if ($this->modelo->Administrar()) {
                                    $this->Accion($this->Get_Accion());
                                    echo $this->Get_Mensaje();
                                }
                            }

                            echo $this->Get_Mensaje();
                        }
                    } else {
                        echo $this->validacion->Fallo();
                    }
                    unset($_POST, $this->mensaje, $id);
                } else { $this->_403_();}
                // die(var_dump($this->Get_Datos()));
                break;

            case 'Eliminar':
                if ($this->permisos["eliminar"] === 1) {
                    $this->modelo->_Estado_($this->Get_Estado());
                    $this->modelo->_Datos_($this->Get_Estado_Ejecutar());
                    $this->modelo->_SQL_($this->Get_Sql());
                    $this->modelo->_Tipo_(1);
                    if ($this->modelo->Administrar()) {
                        $this->Accion($this->Get_Accion());
                    }
                    echo $this->Get_Mensaje();
                } else { $this->_403_();}
                break;

            case 'Consulta_Ajax':
                $this->retornar = [];
                foreach ($this->datos_consulta["familias"] as $f) {
                    $this->modelo->_SQL_("SQL_02");
                    $this->modelo->_Tipo_(0);
                    $this->modelo->_ID_($f['id_familia']);
                    $this->integrantes = $this->modelo->Administrar();

                    $this->retornar[] = [
                        "familia"         => $f['nombre_familia'],
                        "telefono"        => $f['telefono_familia'],
                        "direccion"       => $f['direccion_vivienda'],
                        "Nro Casa"        => $f['numero_casa'],
                        "ingreso_mensual" => $f['ingreso_mensual_aprox'],
                        "ver"             => "<button style='background: #4dbdbd !important;' class='btn btn-info' onclick='ver_familia(`" . json_encode($this->integrantes) . "`,`" . $f['nombre_familia'] . "`,`" . $f['telefono_familia'] . "`,`" . $f['direccion_vivienda'] . "`,`" . $f['numero_casa'] . "`,`" . $f['ingreso_mensual_aprox'] . "`)' type='button'><em class='fa fa-eye'></em></button>",
                        "editar"          => "<button type='button' class='btn btn-info' data-toggle='modal' data-target='#actualizar' onclick='editar(" . $f['id_familia'] . "," . $f['id_familia_persona'] . ")'><em class='fa fa-edit'></em></button>",
                        "eliminar"        => "<button class='btn btn-danger' onclick='eliminar(`" . $f['id_familia'] . "`)' type='button'><em class='fa fa-trash'></em></button>",
                    ];
                }
                $this->Escribir_JSON($this->retornar);unset($this->integrantes, $this->retornar);
                break;

            case 'Datos':
                $this->retornar = [];
                foreach ($this->datos_consulta["familias"] as $f) {
                    if ($f['id_familia'] == $this->id_familia) {
                        $this->modelo->_SQL_("SQL_02");
                        $this->modelo->_Tipo_(0);
                        $this->modelo->_ID_($this->id_familia);
                        $this->integrantes = $this->modelo->Administrar();

                        $this->retornar[] = [
                            "id_familia"          => $f['id_familia'],
                            "familia"             => $f['nombre_familia'],
                            "telefono"            => $f['telefono_familia'],
                            "direccion"           => $f['direccion_vivienda'],
                            "id_vivienda"         => $f['id_vivienda'],
                            "ingreso_mensual"     => $f['ingreso_mensual_aprox'],
                            "condicion_ocupacion" => $f['condicion_ocupacion'],
                            "observacion"         => $f['observacion'],
                            "integrantes"         => json_encode($this->integrantes),
                        ];
                    }
                }
                $this->Escribir_JSON($this->retornar);unset($this->integrantes, $this->retornar);
                break;

            case 'Existente':
                $this->modelo->_Tipo_(0);
                $this->modelo->_SQL_("_05_");
                $this->crud["consultar"] = array(
                    "tabla"   => "personas",
                    "columna" => "cedula_persona",
                    "data"    => $this->cedula,
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->retornar = $this->modelo->Administrar();
                if (count($this->retornar) == 0) {echo 0;} else { $this->Escribir_JSON($this->retornar);}
                unset($this->retornar);
                break;

            case 'Eliminar_Integrantes':
                if ($this->permisos["modificar"] === 1) {
                    $retornar = 0;
                    $this->modelo->_SQL_("_07_");
                    $this->modelo->_Tipo_(1);
                    $this->crud["eliminar"] = array(
                        "tabla" => "familia_personas", 
                        "id_tabla" => "cedula_persona"
                    );
                    $this->modelo->_CRUD_($this->Get_Crud_Sql());
                    $this->modelo->_Datos_(["cedula_persona" => $_POST['cedula_persona']]);

                    if ($this->modelo->Administrar()) {
                        $this->modelo->_Tipo_(0);
                        $this->modelo->_SQL_("_05_");
                        $this->crud["consultar"] = array(
                            "tabla"   => "familia_personas",
                            "columna" => "cedula_persona",
                            "data"    => $_POST['cedula_persona'],
                        );
                        $this->modelo->_CRUD_($this->Get_Crud_Sql());
                        $this->integrantes = $this->modelo->Administrar();
                        if (count($this->integrantes) != 0) {
                            $retornar = [];
                            for ($i = 0; $i < count($this->integrantes); $i++) {
                                $retornar[] = [
                                    "cedula_persona"     => $this->integrantes[0]['cedula_persona'],
                                    "id_familia_persona" => $this->integrantes[$i]['id_familia_persona'],
                                ];
                            }
                        }
                    }
                    echo json_encode($retornar);unset($integrantes, $this->retornar, $_POST);
                } else { $this->_403_();}
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

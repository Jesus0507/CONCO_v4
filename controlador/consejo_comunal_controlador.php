<?php

class Consejo_Comunal extends Controlador
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
    public $id_comite;
    public $id_comite_persona;
    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        $this->Validacion("consejo_comunal");
        $this->permisos          = $_SESSION["Comite"];
        $this->estado            = $_POST['estado'];
        $this->datos_ejecutar    = $_POST['datos'];
        $this->sql               = $_POST['sql'];
        $this->accion            = $_POST['accion'];
        $this->validar           = $this->validacion;
        $this->mensaje           = 1;
        $this->id_comite_persona = $_POST['id_comite_persona'];
        $this->estado_ejecutar   = array($this->estado["id_tabla"] => $this->estado["param"], "estado" => $this->estado["estado"]);
        $this->crud["consultar"] = array("tabla" => "comite", "estado" => 1, "orden" => "nombre_comite");
        //   $this->Cargar_Modelo("consejo_comunal");
    }
    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_01");
        $this->datos_consulta["consejo_comunal"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_04");
        $this->datos_consulta["personas"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("_01_");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["comite"] = $this->modelo->Administrar();
        $this->vista->datos             = $this->Get_Datos_Vista();
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
            $this->vista->Cargar_Vistas('consejo_comunal/consultar');
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
                    $this->vista->Cargar_Vistas('consejo_comunal/registrar');
                } else { $this->_403_();}
                break;
            case 'Consultas':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('consejo_comunal/consultar');
                } else { $this->_403_();}
                break;
            case 'Consulta_Ajax':$this->Escribir_JSON($this->Get_Datos_Vista()["consejo_comunal"]);
                break;

            case 'Registrar':
                if ($this->permisos["registrar"] === 1) {
                    if ($this->validar->Validacion_Registro()) {
                        foreach ($this->datos_consulta["comite"] as $tabla_comite) {
                            if ($tabla_comite["nombre_comite"] == $_POST["nombre_comite"]) {
                                $this->id_comite = $tabla_comite["id_comite"];
                            }
                        }
                        $this->datos_ejecutar["id_comite"] = $this->id_comite;
                        $this->modelo->_Datos_($this->Get_Datos());
                        $this->modelo->_SQL_($this->Get_Sql());
                        $this->modelo->_Tipo_(1);
                        if ($this->modelo->Administrar()) {
                            $this->Accion($this->Get_Accion());
                            echo $this->Get_Mensaje();
                        }
                    } else {
                        echo $this->validacion->Fallo();
                    }
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
                    $id = $this->estado["param"];

                    $this->modelo->_CRUD_($this->Get_Crud_Sql());
                    $this->modelo->_Datos_(["id_comite_persona" => $id]);
                    if ($this->modelo->Administrar()) {
                        $this->Accion($this->Get_Accion());
                        echo $this->Get_Mensaje();
                    }

                } else { $this->_403_();}
                break;

            case 'Editar':
                if ($this->permisos["modificar"] === 1) {
                    if ($this->validar->Validacion_Registro()) {
                        foreach ($this->datos_consulta["comite"] as $tabla_comite) {
                            if ($tabla_comite["nombre_comite"] == $_POST["nombre_comite"]) {
                                $this->id_comite = $tabla_comite["id_comite"];
                            }
                        }
                        $this->datos_ejecutar["id_comite"]         = $this->id_comite;
                        $this->datos_ejecutar["id_comite_persona"] = $this->id_comite_persona;

                        $this->modelo->_Datos_($this->Get_Datos());
                        $this->modelo->_SQL_($this->Get_Sql());
                        $this->modelo->_Tipo_(1);
                        if ($this->modelo->Administrar()) {
                            $this->Accion($this->Get_Accion());
                            echo $this->Get_Mensaje();
                        }
                    } else {
                        echo $this->validacion->Fallo();
                    }
                    unset($this->mensaje, $_POST, $this->id_comite);
                } else { $this->_403_();}
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

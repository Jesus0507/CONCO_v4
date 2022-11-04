<?php

class Inmuebles extends Controlador
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.
    private $permisos;          #permisos correspondiente del modulo
    private $peticion;          #peticion a ejecutar de la funcion administrar
    private $estado;            #array con parametros de eliminacion logica (tabla,id_tabla,param,estado)
    private $estado_ejecutar;   #array con parametro a ejecutar (id_tabla, estado)
    private $sql;               #nombre de la sentencia SQL que se ejecutara en el modelo
    private $datos_ejecutar;    #array con datos para enviar a la bd
    private $datos_consulta;    #array con los datos necesarios para el modulo (consultas)
    private $accion;            #accion para enviar a la bitacora
    private $mensaje;           #mensaje que se mandara a la vista
    private $validar;           #objeto con la clase validacion correspondiente al modulo
    private $crud;              #array con peticion generica sql

    // DATOS independientes usados para el manejo del modulo
    private $calle;
    private $cont;
    private $ultimo;
    private $tipo_inmueble;
    public  $id;

    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        $this->Validacion("inmuebles");
        $this->permisos          = $_SESSION["Inmuebles"];
        $this->estado            = $_POST['estado'];
        $this->datos_ejecutar    = $_POST['datos'];
        $this->sql               = $_POST['sql'];
        $this->accion            = $_POST['accion'];
        $this->calle             = $_POST['calle'];
        $this->validar           = $this->validacion;
        $this->mensaje           = 1;
        $this->estado_ejecutar   = array($this->estado["id_tabla"] => $this->estado["param"], "estado" => $this->estado["estado"]);
        $this->tipo_inmueble     = ["nombre_tipo" => $this->datos_ejecutar["id_tipo_inmueble"], "estado" => 1];
        //  $this->Cargar_Modelo("inmuebles");
    }

    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_01");
        $this->datos_consulta["inmueble"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("_01_");
        $this->crud["consultar"] = array("tabla" => "calles", "estado" => 1, "orden" => "nombre_calle");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["calle"] = $this->modelo->Administrar();
        $this->crud["consultar"]       = array("tabla" => "tipo_inmueble", "estado" => 1, "orden" => "nombre_tipo");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["tipo_inmueble"] = $this->modelo->Administrar();
        $this->vista->datos                    = $this->Get_Datos_Vista();
    }
    // ==================GETTERS=========================
    #getters usados para obtener la informacion de las variables privadas
    # retornan tipo string o array
    private function Get_Sql(): string              {return $this->sql;}
    private function Get_Accion(): string           {return $this->accion;}
    private function Get_Mensaje(): string          {return $this->mensaje;}
    private function Get_Datos(): array             {return $this->datos_ejecutar;}
    private function Get_Estado(): array            {return $this->estado;}
    private function Get_Estado_Ejecutar(): array   {return $this->estado_ejecutar;}
    private function Get_Datos_Vista(): array       {return $this->datos_consulta;}
    private function Get_Crud_Sql(): array          {return $this->crud;}
    private function Get_Tipo_Inmueble(): array     {return $this->tipo_inmueble;}

    // ==============================================================================
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        if ($this->permisos["consultar"] === 1) {
            $this->vista->Cargar_Vistas('inmueble/consultar');
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
                    $this->vista->Cargar_Vistas('inmueble/registrar');
                } else { $this->_403_();}
                break;
            case 'Consultas':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('inmueble/consultar');
                } else { $this->_403_();}
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
                } else { $this->_403_();}
                break;

            case 'Administrar':
                if ($this->permisos["registrar"] === 1 || $this->permisos["modificar"] === 1) {
                    $this->cont = 0;
                    if ($this->validar->Validacion_Registro()) {
                        foreach ($this->datos_consulta["tipo_inmueble"] as $datos_t) {
                            if ($datos_t["nombre_tipo"] == $this->datos_ejecutar['id_tipo_inmueble']) {
                                $this->datos_ejecutar["id_tipo_inmueble"] = $datos_t["id_tipo_inmueble"];
                                $this->modelo->_Datos_($this->Get_Datos());
                                $this->modelo->_SQL_($this->Get_Sql());
                                $this->modelo->_Tipo_(1);
                                if ($this->modelo->Administrar()) {
                                    $this->Accion($this->Get_Accion());
                                    echo $this->Get_Mensaje();
                                }
                                $this->cont++;
                            }
                        }

                        if ($this->cont == 0) {
                            $this->modelo->_SQL_("_02_");
                            $this->modelo->_Tipo_(1);
                            $this->crud["registrar"] = array("tabla" => "tipo_inmueble", "columna" => "nombre_tipo");
                            $this->modelo->_CRUD_($this->Get_Crud_Sql());
                            $this->modelo->_Datos_($this->Get_Tipo_Inmueble());

                            if ($this->modelo->Administrar()) {
                                $this->modelo->_SQL_("_03_");
                                $this->modelo->_Tipo_(0);
                                $this->crud["ultimo"] = array("tabla" => "tipo_inmueble", "id" => "id_tipo_inmueble");
                                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                                $this->ultimo = $this->modelo->Administrar();
                                foreach ($this->ultimo as $i) {
                                    $this->datos_ejecutar["id_tipo_inmueble"] = $i['MAX(id_tipo_inmueble)'];
                                    $this->modelo->_Datos_($this->Get_Datos());
                                    $this->modelo->_SQL_($this->Get_Sql());
                                    $this->modelo->_Tipo_(1);
                                    if ($this->modelo->Administrar()) {
                                        $this->Accion($this->Get_Accion());
                                        echo $this->Get_Mensaje();
                                    }
                                }
                            }
                        }

                    } else {
                        echo $this->validar->Fallo();
                    }
                } else { $this->_403_();}
                break;

            case 'Consulta_Ajax':$this->Escribir_JSON($this->datos_consulta["inmueble"]);
                break;

            case 'Consultas_Calle':
                foreach ($this->datos_consulta["calle"] as $key => $value) {
                    if ($value["nombre_calle"] == $this->calle) {$this->id = $value["id_calle"];}
                }
                echo $this->id;
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        exit();
    }
}

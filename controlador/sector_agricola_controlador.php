<?php
class Sector_Agricola extends Controlador
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
    private $id;
    public $consulta;
    // ==================ESTABLECER DATOS=========================
    public function __construct()
    { 
        parent::__construct();
        $this->Validacion("Sector_Agricola");
        $this->permisos        = $_SESSION["Sector agricola"];
        $this->estado          = $_POST['estado'];
        $this->datos_ejecutar  = $_POST['datos'];
        $this->sql             = $_POST['sql'];
        $this->accion          = $_POST['accion'];
        $this->validar         = $this->validacion;
        $this->mensaje         = 1;
        $this->id              = $_POST['id'];
        $this->estado_ejecutar = array($this->estado["id_tabla"] => $this->estado["param"], "estado" => $this->estado["estado"]);
        // $this->Cargar_Modelo("sector_agricola");
    }
    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_02");$this->datos_consulta["sector_agricola"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_04");$this->datos_consulta["personas"] = $this->modelo->Administrar();
        $this->vista->datos = $this->Get_Datos_Vista();
    }
    // ==================GETTERS=========================
    #getters usados para obtener la informacion de las variables privadas
    # retornan tipo string o array
    private function Get_Sql():string           {return $this->sql;}
    private function Get_Accion():string        {return $this->accion;}
    private function Get_Mensaje():string       {return $this->mensaje;}
    private function Get_Datos():array          {return $this->datos_ejecutar;}
    private function Get_Estado():array         {return $this->estado;}
    private function Get_Estado_Ejecutar():array{return $this->estado_ejecutar;}
    private function Get_Datos_Vista():array    {return $this->datos_consulta;}
    private function Get_Crud_Sql(): array      {return $this->crud;}
    // ==============================================================================

    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        if ($this->permisos["consultar"] === 1) {
            $this->vista->Cargar_Vistas('sector_agricola/consultar');
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
                $this->vista->Cargar_Vistas('sector_agricola/registrar');
            }else{$this->_403_();}
                break;
            case 'Consultas':
            if ($this->permisos["consultar"] === 1) {
                $this->vista->Cargar_Vistas('sector_agricola/consultar');
            }else{$this->_403_();}
                break;
            case 'Consulta_Ajax':$this->Escribir_JSON($this->Get_Datos_Vista()["sector_agricola"]);
                break; 

            case 'Administrar':
            if ($this->permisos["registrar"] === 1 || $this->permisos["modificar"] === 1) {
                
                if ($this->validacion->Validacion_Registro()) {
                    $this->modelo->_Datos_($this->Get_Datos());
                        $this->modelo->_SQL_($this->Get_Sql());
                        $this->modelo->_Tipo_(1);
                        if ($this->modelo->Administrar()) {
                            $this->Accion($this->Get_Accion());
                            echo $this->Get_Mensaje();
                        }
                }else{
                    echo $this->validacion->Fallo();
                }
                unset($_POST, $this->mensaje);
            }else{$this->_403_();}
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
            }else{$this->_403_();}
                break;

            case 'Existente':
                $this->modelo->_Tipo_(0);$this->modelo->_SQL_("_05_");
                $this->crud["consultar"] = array(
                    "tabla"   => "sector_agricola",
                    "columna" => "id_sector_agricola",
                    "data"    => $this->id,
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->consulta = $this->modelo->Administrar();
                $this->Escribir_JSON($this->consulta);unset($this->consulta);
                break;

            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

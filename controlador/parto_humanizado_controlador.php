<?php

class Parto_Humanizado extends Controlador
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
    public $retornar;
    private $id;
    private $cedula_persona;
    public $consulta;
    public $respuesta;
    // ==================ESTABLECER DATOS=========================
    public function __construct() 
    {
        parent::__construct();
        $this->Validacion("parto_humanizado");
        $this->permisos        = $_SESSION["Parto humanizado"];
        $this->estado          = $_POST['estado'];
        $this->datos_ejecutar  = $_POST['datos'];
        $this->sql             = $_POST['sql'];
        $this->accion          = $_POST['accion'];
        $this->validar         = $this->validacion;
        $this->mensaje         = 1;
        $this->id              = $_POST['id'];
        $this->cedula_persona  = $_POST['cedula_persona'];
        $this->estado_ejecutar = array($this->estado["id_tabla"] => $this->estado["param"], "estado" => $this->estado["estado"]);
        //    $this->Cargar_Modelo("parto_humanizado");
    }
    
    public function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_01");$this->datos_consulta["parto_humanizado"] = $this->modelo->Administrar();
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
            $this->vista->Cargar_Vistas('parto_humanizado/consultar');
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
               $this->vista->Cargar_Vistas('parto_humanizado/registrar');
            }else{$this->_403_();}    
                break;
            case 'Consultas':
            if ($this->permisos["consultar"] === 1) {
                $this->vista->Cargar_Vistas('parto_humanizado/consultar');
            }else{$this->_403_();} 
                break;
            case 'Consulta_Ajax':$this->Escribir_JSON($this->Get_Datos_Vista()["parto_humanizado"]);break;

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

            case 'Persona_Parto_Humanizado':
                $this->modelo->_Tipo_(0);
                $this->modelo->_SQL_($this->Get_Sql());
                $this->crud["consultar"] = array(
                    "tabla"   => "parto_humanizado",
                    "columna" => "id_parto_humanizado",
                    "data"    => $this->id,
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->retornar = $this->modelo->Administrar();
                $this->Escribir_JSON($this->retornar);
                break;

            case 'Existente':
                $this->modelo->_Tipo_(0);
                $this->modelo->_SQL_("_05_");
                
                $this->crud["consultar"] = array(
                    "tabla"   => "personas",
                    "columna" => "cedula_persona",
                    "data"    => $this->cedula_persona,
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->consulta  = $this->modelo->Administrar();$this->respuesta = "";
                if (count($this->consulta) == 0 || $this->consulta[0]['estado'] == 0 || $this->consulta[0]['estado'] == 2) {
                    $this->respuesta = "Esta persona no se encuentra registrada";
                } else {
                    if ($this-> consulta[0]['genero'] == 'M') {$this->respuesta = "Esta cédula no es válida, su propietario es masculino.";} 
                    else {$this->respuesta = 1;}
                }
                echo ($this->respuesta);unset($this->respuesta, $this->consulta);
                break;

            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }

}

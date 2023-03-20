<?php
class Notificaciones extends Controlador
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.
    private $peticion; #peticion a ejecutar de la funcion administrar
    private $sql; #nombre de la sentencia SQL que se ejecutara en el modelo
    private $datos_ejecutar; #array con datos para enviar a la bd
    private $datos_consulta; #array con los datos necesarios para el modulo (consultas)
    private $accion; #accion para enviar a la bitacora
    private $mensaje; #mensaje que se mandara a la vista
    
    // DATOS independientes usados para el manejo del modulo
    public $cedula;
    public $retornar;
    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        $this->datos_ejecutar = isset($_POST['datos']) ? $_POST['datos']: null;
        $this->sql                = isset($_POST['sql']) ? $_POST['sql']: null;
        $this->mensaje        = 1;
        $this->cedula         = $_SESSION['cedula_usuario'];
        //    $this->Cargar_Modelo("notificaciones");
    }

    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_Cedula_($this->cedula);
        $this->modelo->_SQL_("SQL_02");
        $this->datos_consulta["notificaciones"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_05");
        $this->datos_consulta["receptores"] = $this->modelo->Administrar();
        $this->vista->datos                 = $this->Get_Datos_Vista();
    }

    // ==================GETTERS=========================
    #getters usados para obtener la informacion de las variables privadas
    # retornan tipo string o array
    private function Get_Sql(): string
    {return $this->sql;}
    private function Get_Mensaje(): string
    {return $this->mensaje;}
    private function Get_Datos(): array
    {return $this->datos_ejecutar;}
    private function Get_Datos_Vista(): array
    {return $this->datos_consulta;}
    private function Get_Crud_Sql(): array          
    {return $this->crud;}
    // ==============================================================================
    public function Cargar_Vistas()
    {
        $this->Establecer_Consultas();
        $this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('notificaciones/index');
    }
    // ==============================================================================

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        $this->peticion = (isset($_POST['peticion'])) ? $_POST['peticion'] : $peticion[0];
        switch ($this->peticion) {
            case 'Listar':$this->vista->Cargar_Vistas('notificaciones/index');
                break;
            case 'Consultas':$this->vista->Cargar_Vistas('notificaciones/consultar');
                break;

            case 'Administrar':
                $this->modelo->_SQL_($this->Get_Sql());
                $this->modelo->_Tipo_(1);
                $this->modelo->_Datos_($this->Get_Datos());
                $this->modelo->Administrar();
                echo $this->Get_Mensaje();
                break;

            case 'Nueva':
                $this->modelo->_SQL_($this->Get_Sql());
                $this->modelo->_Tipo_(1);
                $accion = $this->datos_ejecutar['tipo_notificacion'] . "/" . $_SESSION['nombre'] . " " . $_SESSION['apellido'] . " " . $this->datos_ejecutar['accion'];
                $this->datos_ejecutar =  array(
                    'usuario_emisor'   => $this->cedula,
                    'usuario_receptor' => $this->datos_ejecutar['usuario_receptor'],
                    'accion'           => $accion,
                    'leido'            => 0,
                );
                $this->modelo->_Datos_($this->Get_Datos());
                if ($this->modelo->Administrar()) {
                    echo $this->Get_Mensaje();
                }
                
                break;

            case 'Receptores':
                $this->retornar = [];
                foreach ($this->datos_consulta["receptores"] as $r) {
                    $this->retornar[] = ["cedula_usuario" => $r['cedula_persona']];
                }
                $this->Escribir_JSON($this->retornar);
                break;

            case 'Consulta_Ajax':
            $this->Escribir_JSON($this->Get_Datos_Vista()["notificaciones"]);
                break;

            case 'Expirar':
                if($this->datos_ejecutar <= 0){
                   echo 0;
                }
                else {
                    echo $this->datos_ejecutar;
                }
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        unset($this->peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

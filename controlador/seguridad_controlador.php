<?php
 
class Seguridad extends Controlador
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

    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        // $this->Cargar_Modelo("seguridad");
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

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        $this->peticion = (isset($_POST['peticion'])) ? $_POST['peticion'] : $peticion[0];
        switch ($this->peticion) {
            case 'Consultas':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('negocios/consultar');
                } else { $this->_403_();}
                break;
            case 'Administrar':
                if ($this->permisos["registrar"] === 1 || $this->permisos["modificar"] === 1) {

                    if ($this->validar->Validacion_Registro()) {
                        $this->modelo->_Datos_($this->Get_Datos());
                        $this->modelo->_SQL_($this->Get_Sql());
                        $this->modelo->_Tipo_(1);
                        if ($this->modelo->Administrar()) {
                            $this->Accion($this->Get_Accion());
                            echo $this->Get_Mensaje();
                        }
                    } else {
                        echo $this->validar->Fallo();
                    }
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


            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        exit();
        
    }

    // ==============================================================================

    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('seguridad/index');
    }
    public function Roles()
    {
        $this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('seguridad/roles');
    }

    public function get_info_permisos()
    {
        $usuarios = $this->modelo->consultar_personas_seguridad();
        $retornar = [];

        foreach ($usuarios as $u) {
            $permisos = $this->modelo->get_permisos($u['cedula_persona']);

            if ($u['estado'] == '1') {
                $estado = "<em class='fa fa-minus-circle negativo' onclick='cambiar_estado_persona(`" . $u['cedula_persona'] . "`,0)'></em><span style='display:none'>Activo</span>";
            } else {
                $estado = "<em class='fa fa-plus-circle positivo' onclick='cambiar_estado_persona(`" . $u['cedula_persona'] . "`,1)'></em><span style='display:none'>Bloqueado</span>";
            }

            $retornar[] = [
                "cedula_usuario" => $u['cedula_persona'],
                "usuario"        => $u['primer_nombre'] . " " . $u['primer_apellido'],
                "estado"         => $estado,
                "rol"            => $u['rol_inicio'],
                "editar"         => "<button class='btn btn-info' title='Modificar rol o clave de usuario'><span class='fa fa-edit' type='button' onclick='modificar_rol(`" . $u['rol_inicio'] . "`,`" . $this->Decodificar($u['contrasenia']) . "`,`" . $u['cedula_persona'] . "`)'></span></button>",

            ];

        }

        $this->Escribir_JSON($retornar);
    }

    public function change_permiso()
    {

        $datos = $_POST['datos'];

        if ($this->modelo->change_permiso($datos)) {
            $this->Escribir_JSON($this->modelo->get_permisos_rol($datos['rol']));
        } else {
            echo 0;
        }

    }

    public function cambiar_roles()
    {

        $datos                = $_POST['datos'];
        $datos['contrasenia'] = $this->Codificar($datos['clave']);
        $listo                = false;

        echo $this->modelo->change_roles($datos);

    }

    public function obtener_permisos_dinamico()
    {

        $permisos = $this->modelo->get_permisos_rol($_SESSION['rol_inicio']);

        $_SESSION['Solicitudes']       = $permisos[0];
        $_SESSION['Personas']          = $permisos[1];
        $_SESSION['Agenda']            = $permisos[2];
        $_SESSION['Comite']            = $permisos[3];
        $_SESSION['Grupos deportivos'] = $permisos[4];
        $_SESSION['Parto humanizado']  = $permisos[5];
        $_SESSION['Enfermos']          = $permisos[6];
        $_SESSION['Negocios']          = $permisos[7];
        $_SESSION['Nucleo familiar']   = $permisos[8];
        $_SESSION['Sector agricola']   = $permisos[9];
        $_SESSION['Centros votacion']  = $permisos[10];
        $_SESSION['Viviendas']         = $permisos[11];
        $_SESSION['Inmuebles']         = $permisos[12];
        $_SESSION['Discapacitados']    = $permisos[13];
        $_SESSION['Vacunados COVID']   = $permisos[14];
        $_SESSION['Seguridad']         = $permisos[15];

        echo json_encode($permisos); //json_encode($permisos);
    }

    public function cambio_estado()
    {
        echo $this->modelo->cambio_estado([
            "cedula_persona" => $_POST["cedula_persona"],
            "estado"         => $_POST['estado'],
        ]);

    }

    public function get_permisos_rol()
    {
        $permisos = $this->modelo->get_permisos_rol($_POST["rol"]);
        echo json_encode($permisos);
    }

}

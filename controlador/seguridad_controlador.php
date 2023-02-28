<?php

class Seguridad extends Controlador
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.
    private $permisos; #permisos correspondiente del modulo
    private $peticion; #peticion a ejecutar de la funcion administrar
    private $sql; #nombre de la sentencia SQL que se ejecutara en el modelo
    private $datos_ejecutar; #array con datos para enviar a la bd
    private $datos_consulta; #array con los datos necesarios para el modulo (consultas)
    private $mensaje; #mensaje que se mandara a la vista
    private $crud; #array con peticion generica sql

    // DATOS independientes usados para el manejo del modulo
    private $usuarios;
    private $estado;
    private $cedula_persona;
    public $retornar;
    public $permisos_modulo;
    public $rol_inicio;
    public $rol;

    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        $this->permisos       = $_SESSION["Seguridad"];
        $this->datos_ejecutar = $_POST['datos'];
        $this->rol_inicio     = $_SESSION['rol_inicio'];
        $this->rol            = $_POST["rol"];
        $this->estado         = $_POST["estado"];
        $this->cedula_persona = $_POST["cedula_persona"];
        // $this->Cargar_Modelo("seguridad");
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
    private function Get_Crud_Sql(): array
    {return $this->crud;}
    // ==============================================================================

    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        if ($this->permisos["consultar"] === 1) {
            $this->vista->Cargar_Vistas('seguridad/index');
        } else { $this->_403_();}
    }

    // ==============================================================================
    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->peticion = (isset($_POST['peticion'])) ? $_POST['peticion'] : $peticion[0];
        switch ($this->peticion) {
            case 'Seguridad':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('seguridad/index');
                } else { $this->_403_();}
                break;

            case 'Roles':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('seguridad/roles');
                } else { $this->_403_();}
                break;

            case 'Cambiar_Permiso':

                if ($this->permisos["registrar"] === 1 || $this->permisos["modificar"] === 1) {

                    $this->modelo->_Tipo_(1);
                    $this->modelo->_ID_($this->Get_Datos()["campo"]);
                    $this->modelo->_SQL_("SQL_04");

                    $this->datos_ejecutar = [
                        $this->datos_ejecutar["campo"] => $this->datos_ejecutar["permiso"],
                        "rol"                          => $this->datos_ejecutar["rol"],
                        "id_modulo"                    => $this->datos_ejecutar["id_modulo"],
                    ];

                    $this->modelo->_Datos_($this->Get_Datos());

                    if ($this->modelo->Administrar()) {
                        $this->modelo->_Tipo_(2);
                        $this->modelo->_SQL_("SQL_01");
                        $this->modelo->_Datos_(["rol" => $this->Get_Datos()["rol"]]);
                        $this->Escribir_JSON($this->modelo->Administrar());
                    } else {
                        echo 0;
                    }

                } else { $this->_403_();}
                break;

            case 'Cambiar_Roles':

                if ($this->permisos["registrar"] === 1 || $this->permisos["modificar"] === 1) {

                    $this->modelo->_Tipo_(1);
                    $this->modelo->_SQL_("SQL_05");
                    $this->datos_ejecutar = array(
                        'rol_inicio'     => $this->datos_ejecutar["rol"],
                        'cedula_usuario' => $this->datos_ejecutar["cedula_usuario"],
                        'contrasenia'    => $this->Codificar($this->Get_Datos()['clave']),
                    );
                    $this->modelo->_Datos_($this->Get_Datos());
                    echo $this->modelo->Administrar();

                } else { $this->_403_();}
                break;

            case 'Cambiar_Estado':

                if ($this->permisos["registrar"] === 1 || $this->permisos["modificar"] === 1) {

                    $this->modelo->_Datos_($this->Get_Datos());
                    $this->modelo->_SQL_("SQL_06");
                    $this->modelo->_Tipo_(1);
                    echo $this->modelo->Administrar();

                } else { $this->_403_();}
                break;

            case 'Obtener_Permisos_Rol':

                if ($this->permisos["registrar"] === 1 || $this->permisos["modificar"] === 1) {

                    $this->modelo->_Tipo_(2);
                    $this->modelo->_SQL_("SQL_01");
                    $this->modelo->_Datos_(["rol" => $this->rol]);
                    $this->Escribir_JSON($this->modelo->Administrar());

                } else { $this->_403_();}
                break;

            case 'Obtener_Permisos':

                if ($this->permisos["consultar"] === 1) {

                    $this->modelo->_Tipo_(2);
                    $this->modelo->_SQL_("SQL_01");
                    $this->modelo->_Datos_(["rol" => $this->rol_inicio]);
                    $this->permisos_modulo = $this->modelo->Administrar();

                    $_SESSION['Solicitudes']       = $$this->permisos_modulo[0];
                    $_SESSION['Personas']          = $$this->permisos_modulo[1];
                    $_SESSION['Agenda']            = $$this->permisos_modulo[2];
                    $_SESSION['Comite']            = $$this->permisos_modulo[3];
                    $_SESSION['Grupos deportivos'] = $$this->permisos_modulo[4];
                    $_SESSION['Parto humanizado']  = $$this->permisos_modulo[5];
                    $_SESSION['Enfermos']          = $$this->permisos_modulo[6];
                    $_SESSION['Negocios']          = $$this->permisos_modulo[7];
                    $_SESSION['Nucleo familiar']   = $$this->permisos_modulo[8];
                    $_SESSION['Sector agricola']   = $$this->permisos_modulo[9];
                    $_SESSION['Centros votacion']  = $$this->permisos_modulo[10];
                    $_SESSION['Viviendas']         = $$this->permisos_modulo[11];
                    $_SESSION['Inmuebles']         = $$this->permisos_modulo[12];
                    $_SESSION['Discapacitados']    = $$this->permisos_modulo[13];
                    $_SESSION['Vacunados COVID']   = $$this->permisos_modulo[14];
                    $_SESSION['Seguridad']         = $$this->permisos_modulo[15];

                    echo json_encode($this->permisos_modulo);

                } else { $this->_403_();}
                break;

            case 'Consulta_Ajax':
                if ($this->permisos["consultar"] === 1) {
                    $this->modelo->_SQL_("SQL_02");
                    $this->modelo->_Tipo_(0);

                    $this->usuarios = $this->modelo->Administrar();
                    $this->retornar = [];

                    foreach ($this->usuarios as $u) {

                        $this->modelo->_Tipo_(2);
                        $this->modelo->_SQL_("SQL_01");
                        $this->modelo->_Datos_(["rol" => $u['rol_inicio']]);
                        $this->permisos_modulo = $this->modelo->Administrar();
                        if ($u['estado'] == '1') {
                            $this->estado = "<em class='fa fa-minus-circle negativo' onclick='cambiar_estado_persona(`" . $u['cedula_persona'] . "`,0)'></em><span style='display:none'>Activo</span>";
                        } else {
                            $this->estado = "<em class='fa fa-plus-circle positivo' onclick='cambiar_estado_persona(`" . $u['cedula_persona'] . "`,1)'></em><span style='display:none'>Bloqueado</span>";
                        }

                        $this->retornar[] = [
                            "cedula_usuario" => $u['cedula_persona'],
                            "usuario"        => $u['primer_nombre'] . " " . $u['primer_apellido'],
                            "estado"         => $this->estado,
                            "rol"            => $u['rol_inicio'],
                            "editar"         => "<button class='btn btn-info' title='Modificar rol o clave de usuario'><span class='fa fa-edit' type='button' onclick='modificar_rol(`" . $u['rol_inicio'] . "`,`" . $this->Decodificar($u['contrasenia']) . "`,`" . $u['cedula_persona'] . "`)'></span></button>",

                        ];

                    }

                    $this->Escribir_JSON($this->retornar);
                } else { $this->_403_();}
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        exit();

    }

}

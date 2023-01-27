<?php

class Login extends Controlador
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.
    private $peticion; #peticion a ejecutar de la funcion administrar
    private $sql; #nombre de la sentencia SQL que se ejecutara en el modelo
    private $datos; #array con datos para enviar a la bd
    private $accion; #accion para enviar a la bitacora
    private $mensaje; #mensaje que se mandara a la vista
    private $validar; #objeto con la clase validacion correspondiente al modulo
    private $crud; #array con peticion generica sql

    // DATOS independientes usados para el manejo del modulo
    public $resultado;
    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        $this->Validacion("Login");
        $this->sql     = $_POST['sql'];
        $this->validar = $this->validacion;
        $this->mensaje = 1;
        //   $this->Cargar_Modelo("login");
    }
    private function set_Usuario_Actual($cedula, $nombre, $apellido, $correo, $estado, $rol_inicio, $firma, $publica, $privada)
    {
        $_SESSION['cedula_usuario'] = $cedula;
        $_SESSION['nombre']         = $nombre;
        $_SESSION['apellido']       = $apellido;
        $_SESSION['correo']         = $correo;
        $_SESSION['estado']         = $estado;
        $_SESSION['rol_inicio']     = $rol_inicio;
        $_SESSION['modulo_actual']  = "Inicio";
        $_SESSION['digital_sign']   = $firma;
        $_SESSION['public_key']     = $publica;
        $_SESSION['private_key']    = $privada;
        $_SESSION['token']          = bin2hex(openssl_random_pseudo_bytes(20));

        $this->Cargar_Modelo("seguridad");
        $this->modelo->_Tipo_(2);
        $this->modelo->_SQL_("SQL_01");
        $this->modelo->_Datos_(["rol" => $rol_inicio]);
        $permisos = $this->modelo->Administrar();

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

        unset($cedula, $nombre, $apellido, $correo, $estado, $rol_inicio, $permisos);
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
    {return $this->datos;}
    private function Get_Crud_Sql(): array
    {return $this->crud;}
    // ==============================================================================

    public function Cargar_Vistas()
    {$this->vista->Cargar_Vistas('login/index');}

    public function Administrar($peticion = null)
    {
        $this->peticion = (isset($_POST['peticion'])) ? $_POST['peticion'] : $peticion[0];
        switch ($this->peticion) {

            case 'Login':$this->Cargar_Vistas();
                break;

            case 'Ingreso':

                if ($this->validar->Validacion_Registro()) {
                    $this->datos             = $this->validar->Datos_Validos();
                    $password                = $this->datos['password'];
                    $this->datos["password"] = $this->Seguridad_Password($password, 1);
                    if (isset($this->datos) && $this->datos['captcha'] !== "") {
                        session_start();

                        $fecha       = date("Y") . "-" . date("m") . "-" . date("d");
                        $hora_inicio = date("h") . ":" . date("i") . ":" . date("s") . " " . date("A");

                        switch (date("l")) {
                            case "Monday":$dia = "Lunes";
                                break;
                            case "Thuesday":$dia = "Martes";
                                break;
                            case "Wednesday":$dia = "Miercoles";
                                break;
                            case "Thursday":$dia = "Jueves";
                                break;
                            case "Friday":$dia = "Viernes";
                                break;
                            case "Saturday":$dia = "Sábado";
                                break;
                            default:$dia = "Domingo";
                                break;
                        }

                        $this->Cargar_Modelo("personas");
                        $datos_u = $this->modelo->Consultar();

                        foreach ($datos_u as $tabla_usuario) {
                            if ($tabla_usuario['cedula_persona'] == $this->datos['cedula_usuario'] && $tabla_usuario['contrasenia'] == $this->datos["password"]) {

                                $this->Cargar_Modelo("bitacora");
                                $this->modelo->_SQL_("SQL_02");
                                $this->modelo->_Tipo_(1);
                                $cedula      = $this->datos['cedula_usuario'];
                                $this->datos = array(
                                    'cedula_usuario' => $cedula,
                                    'fecha'          => $fecha,
                                    'dia'            => $dia,
                                    'hora_inicio'    => $hora_inicio,
                                    'acciones'       => "",
                                    'hora_fin'       => "Activo",
                                );

                                $this->modelo->_Datos_($this->Get_Datos());
                                if ($this->modelo->Administrar()) {$this->mensaje = 1;}

                                $this->set_Usuario_Actual(
                                    $tabla_usuario['cedula_persona'],
                                    $tabla_usuario['primer_nombre'],
                                    $tabla_usuario['primer_apellido'],
                                    $tabla_usuario['correo'],
                                    $tabla_usuario['estado'],
                                    $tabla_usuario['rol_inicio'],
                                    $tabla_usuario['digital_sign'],
                                    $tabla_usuario['public_key'],
                                    $tabla_usuario['private_key']
                                );

                                if ($tabla_usuario['rol_inicio'] != 'Habitante') {
                                    $this->vista->Cargar_Vistas('inicio/index');
                                } else {
                                    $this->vista->Cargar_Vistas('habitante/index');
                                }
                            }
                        }
                    } else {

                        session_start();
                        session_destroy();
                        $this->vista->Cargar_Vistas('login/index');
                    }
                } else {
                    echo $this->validar->Fallo();
                }
                unset($_POST, $datos, $fecha, $hora_inicio, $dia, $acciones, $hora_fin, $datos_u);
                exit();
                break;

            case 'Consultar':
                $this->modelo->_Tipo_(0);
                $this->modelo->_SQL_("SQL_01");
                $this->crud["consultar"] = array("columna" => "cedula_persona", "data" => $_POST['cedula']);
                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                $this->resultado = $this->modelo->Administrar();

                if ($this->resultado[0]['preguntas_seguridad'] != '' || $this->resultado[0]['preguntas_seguridad'] != null) {
                    $this->resultado[0]['preguntas_seguridad'] = $this->Decodificar($this->resultado[0]['preguntas_seguridad']);
                }

                if ($this->resultado[0]['digital_sign'] != '' || $this->resultado[0]['digital_sign'] != null) {
                    $this->resultado[0]['digital_sign'] = $this->Decodificar($this->resultado[0]['digital_sign']);
                }

                $this->Escribir_JSON($this->resultado);
                break;

            case 'Recuperar':
                $this->modelo->_Tipo_(1);
                $this->modelo->_SQL_("_04_");

                $this->crud["actualizar"] = array(
                    "tabla"    => "personas",
                    "columna"  => "contrasenia_nueva",
                    "id_tabla" => "cedula_persona",
                );
                $this->modelo->_CRUD_($this->Get_Crud_Sql());

                $this->datos = array(
                    "contrasenia_nueva" => $this->Seguridad_Password($_POST['clave'], 1),
                    "cedula_persona"    => $_POST['cedula'],
                );

                $this->modelo->_Datos_($this->Get_Datos());
                echo $this->modelo->Administrar();
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        unset($peticion);
        exit();
    }
    public function Salir()
    {
        session_unset();
        session_start();
        session_destroy();
        session_regenerate_id(true);
        $hora_fin = date("h") . ":" . date("i") . ":" . date("s") . " " . date("A");

        $this->Cargar_Modelo("bitacora");
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_01");
        $bitacora = $this->modelo->Administrar();
        foreach ($bitacora as $key => $value) {$id_bitacora = $value['id_bitacora'];}

        $this->modelo->_Tipo_(1);
        $this->modelo->_SQL_("SQL_03");
        $this->modelo->_Datos_(['hora_fin' => $hora_fin, 'id_bitacora' => $id_bitacora]);
        $this->modelo->Administrar();
        $this->vista->Cargar_Vistas('login/index');
        unset($hora_fin, $id_bitacora, $bitacora);
        exit();
    }
}

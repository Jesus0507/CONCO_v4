<?php

class Login extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        $this->vista->mensaje = "";
        //   $this->Cargar_Modelo("login");
    }
 
    public function Cargar_Vistas(){$this->vista->Cargar_Vistas('login/index');}

    public function set_Usuario_Actual($cedula, $nombre, $apellido, $correo, $estado, $rol_inicio, $firma, $publica, $privada)
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

        $this->Cargar_Modelo("seguridad");$permisos = $this->modelo->get_permisos_rol($rol_inicio);

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

    public function Administrar($peticion = null)
    { 
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {

            case 'Login':$this->Cargar_Vistas();break;

            case 'Ingreso':
                $this->Validacion("login");
                $_POST["datos"]["password"] = $this->Seguridad_Password($_POST["datos"]['password'], 1); 
                if ($this->validacion->Validacion_Registro()) {
                if (isset($_POST['datos']) && $_POST['datos']['captcha'] !== "") {
                    session_start();
                    
                    $fecha       = date("Y") . "-" . date("m") . "-" . date("d");
                    $hora_inicio = date("h") . ":" . date("i") . ":" . date("s") . " " . date("A");

                    switch (date("l")) {
                        case "Monday":$dia    = "Lunes";break;
                        case "Thuesday":$dia  = "Martes";break;
                        case "Wednesday":$dia = "Miercoles";break;
                        case "Thursday":$dia  = "Jueves";break;
                        case "Friday":$dia    = "Viernes";break;
                        case "Saturday":$dia  = "Sábado";break;
                        default:$dia = "Domingo";break;
                    }

                    $acciones = "";$hora_fin = "Activo";
                    $this->Cargar_Modelo("personas");$datos_u = $this->modelo->Consultar();

                    foreach ($datos_u as $tabla_usuario) {
                        if ($tabla_usuario['cedula_persona'] == $_POST['datos']['cedula_usuario'] && $tabla_usuario['contrasenia'] == $_POST["datos"]["password"]) {

                            $this->Cargar_Modelo("bitacora");
                            $this->modelo->__SET("SQL", "SQL_02");$this->modelo->__SET("tipo", "1");

                            $this->modelo->Datos([
                                'cedula_usuario' => $_POST['cedula_usuario'],
                                'fecha'          => $fecha,
                                'dia'            => $dia,
                                'hora_inicio'    => $hora_inicio,
                                'acciones'       => $acciones,
                                'hora_fin'       => $hora_fin,
                            ]);
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
                    $this->vista->mensaje = "";session_start();session_destroy();
                    $this->vista->Cargar_Vistas('login/index');
                }
                }else{
                    echo $this->validacion->Fallo();
                }
                unset($_POST, $datos, $fecha, $hora_inicio, $dia, $acciones, $hora_fin, $datos_u);
                exit();
                break;

            case 'Consultar':
                $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "SQL_01");
                $this->modelo->__SET("consultar", array("columna" => "cedula_persona","data" => $_POST['cedula']));
                $resultado = $this->modelo->Administrar();

                if ($resultado[0]['preguntas_seguridad'] != '' || $resultado[0]['preguntas_seguridad'] != null) {
                    $resultado[0]['preguntas_seguridad'] = $this->Decodificar($resultado[0]['preguntas_seguridad']);
                }

                if ($resultado[0]['digital_sign'] != '' || $resultado[0]['digital_sign'] != null) {
                    $resultado[0]['digital_sign'] = $this->Decodificar($resultado[0]['digital_sign']);
                }

                $this->Escribir_JSON($resultado);unset($resultado);
                break;

            case 'Recuperar':
                $this->modelo->__SET("tipo", "1");$this->modelo->__SET("SQL", "_04_");
                $this->modelo->__SET("actualizar", array(
                    "tabla"    => "personas",
                    "columna"  => "contrasenia_nueva",
                    "id_tabla" => "cedula_persona"));
                $this->modelo->Datos(["contrasenia_nueva" => $this->Seguridad_Password($_POST['clave'],1), "cedula_persona" => $_POST['cedula']]);

                if ($this->modelo->Administrar()) {$this->mensaje = true;}

                echo $this->mensaje;unset($this->mensaje);
                break;

            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion);
        exit();
    }
    public function Salir()
    {
        session_unset();session_start();session_destroy();session_regenerate_id(true);
        $hora_fin = date("h") . ":" . date("i") . ":" . date("s") . " " . date("A");

        $this->Cargar_Modelo("bitacora");
        $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "SQL_01");

        foreach ($this->modelo->Administrar() as $key => $value) {$id_bitacora = $value['id_bitacora'];}

        $this->modelo->__SET("tipo", "1");$this->modelo->__SET("SQL", "SQL_03");
        $this->modelo->Datos(['hora_fin' => $hora_fin, 'id_bitacora' => $id_bitacora]);

        if ($this->modelo->Administrar()) {$this->mensaje = 1;}

        $this->vista->Cargar_Vistas('login/index');
        unset($hora_fin, $id_bitacora, $this->mensaje);
        exit();
    }
}

<?php

class Seguridad extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        // $this->Cargar_Modelo("seguridad");
    }

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
                "editar"         => "<button class='btn btn-success' title='Modificar rol o clave de usuario'><span class='fa fa-edit' type='button' onclick='modificar_rol(`" . $u['rol_inicio'] . "`,`" . $this->Decodificar($u['contrasenia']) . "`,`" . $u['cedula_persona'] . "`)'></span></button>",

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

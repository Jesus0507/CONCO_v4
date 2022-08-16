<?php

class Agenda extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        $this->vista->mensaje = "";
        //   $this->Cargar_Modelo("agenda");
    }
    // ==============================================================================
    public function Establecer_Consultas()
    {
        $ubicaciones = [];
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("SQL", "SQL_01");$this->datos["agenda"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_04");$this->datos["calles"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_05");$this->datos["inmuebles"] = $this->modelo->Administrar();

        foreach ($this->datos["calles"] as $c) {$ubicaciones[] = $c['nombre_calle'];}
        foreach ($this->datos["inmuebles"] as $i) {$ubicaciones[] = $i['nombre_inmueble'];}

        $this->datos["ubicaciones"] = $ubicaciones;
        $this->vista->datos = $this->datos;
        unset($ubicaciones);
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();$this->Establecer_Consultas();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {

            case 'Registros':$this->vista->Cargar_Vistas('agenda/registrar');break;
            case 'Consultas':$this->vista->Cargar_Vistas('agenda/consultar');break;

            case 'Administrar':
                if (isset($_POST['datos'])) {

                unset($_POST['datos']["primer_nombre"],$_POST['datos']["primer_apellido"],$_POST['datos']["cedula_persona"]);
                    $this->modelo->Datos($_POST['datos']);
                } else {
                    $this->modelo->Estado($_POST['estado']);
                    $this->modelo->Datos([
                        $_POST['estado']["id_tabla"] => $_POST['estado']["param"],
                        "estado"                     => $_POST['estado']["estado"],
                    ]);
                }

                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;
            case 'Registrar':

                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");

                for ($i = 0; $i < count($_POST['datos']['fechas']); $i++) {
                    $this->modelo->Datos([
                        "tipo_evento" => $_POST['datos']['tipo_evento'],
                        "fecha"       => $_POST['datos']['fechas'][$i],
                        "creador"     => $_SESSION['cedula_usuario'],
                        "ubicacion"   => $_POST['datos']['ubicacion'],
                        "horas"       => $_POST['datos']['horas'],
                        "detalle"     => $_POST['datos']['detalle_evento'],
                    ]);
                    if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}
                }
                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            case 'Consulta_Ajax':
                $retornar = [];
                for ($i = 0; $i < count($this->datos["agenda"]); $i++) {
                    $user = $this->datos["agenda"][$i]['primer_nombre'] . " " . $this->datos["agenda"][$i]['primer_apellido'];
                    $retornar[] = [
                        "usuario"     => $user,
                        "id_agenda"   => $this->datos["agenda"][$i]['id_agenda'],
                        "tipo_evento" => $this->datos["agenda"][$i]['tipo_evento'],
                        "fecha"       => $this->datos["agenda"][$i]['fecha'],
                        "creador"     => $user,
                        "ubicacion"   => $this->datos["agenda"][$i]['ubicacion'],
                        "horas"       => $this->datos["agenda"][$i]['horas'],
                        "detalle"     => $this->datos["agenda"][$i]['detalle'],
                        'editar'      => "<button title='Editar este evento' class='btn btn-success'><em class='fas fa-edit' onclick='editar_evento(`" . json_encode($this->datos["agenda"][$i]) . "`,`" . json_encode($this->datos["agenda"]) . "`)'></em></button>",
                        'eliminar'    => "<button title='Eliminar este evento' class='btn btn-danger'><em class='fas fa-trash' onclick='eliminar_evento(`" . $this->datos["agenda"][$i]['id_agenda'] . "`)'></em></button>",
                        'ver'         => "<button class='btn btn-info' title='Ver este evento' onclick='ver_evento(`" . json_encode($this->datos["agenda"][$i]) . "`,`" . $user . "`)'  ><em class='fas fa-eye'></em></button>",
                    ];
                }
                $this->Escribir_JSON($retornar);unset($retornar, $user);
                break;
                
            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

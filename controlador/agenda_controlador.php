<?php
 
class Agenda extends Controlador
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
        $this->vista->mensaje = "";
        //   $this->Cargar_Modelo("agenda");
    }

    private function Establecer_Consultas()
    {
        $ubicaciones = [];
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_01");$this->datos["agenda"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_04");$this->datos["calles"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_05");$this->datos["inmuebles"] = $this->modelo->Administrar();

        foreach ($this->datos["calles"] as $c) {$ubicaciones[] = $c['nombre_calle'];}
        foreach ($this->datos["inmuebles"] as $i) {$ubicaciones[] = $i['nombre_inmueble'];}

        $this->datos["ubicaciones"] = $ubicaciones;
        $this->vista->datos = $this->datos;
        unset($ubicaciones);
    }
    
    // ==============================================================================
    

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();$this->Establecer_Consultas();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {

            case 'Registros':
            if ($_SESSION["Agenda"]["registrar"] === 1) {
               $this->vista->Cargar_Vistas('agenda/registrar');
            }else{$this->_403_();}
                break;
            case 'Consultas':
            if ($_SESSION["Agenda"]["consultar"] === 1) {
                $this->vista->Cargar_Vistas('agenda/consultar');
            }else{$this->_403_();}
            break;

            case 'Administrar':
            if ($_SESSION["Agenda"]["eliminar"] === 1 || $_SESSION["Agenda"]["modificar"] === 1) {
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

                $this->modelo->_SQL_($_POST['sql']);$this->modelo->_Tipo_(1);
                if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($_POST, $this->mensaje);
            }else{$this->_403_();}
                break;
            case 'Registrar':
            if ($_SESSION["Agenda"]["registrar"] === 1) {
               
                $this->modelo->_SQL_($_POST['sql']);$this->modelo->_Tipo_(1);

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
                }else{$this->_403_();}
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
                        'editar'      => "<button title='Editar este evento' class='btn btn-info'><em class='fas fa-edit' onclick='editar_evento(`" . json_encode($this->datos["agenda"][$i]) . "`,`" . json_encode($this->datos["agenda"]) . "`)'></em></button>",
                        'eliminar'    => "<button title='Eliminar este evento' class='btn btn-danger'><em class='fas fa-trash' onclick='eliminar_evento(`" . $this->datos["agenda"][$i]['id_agenda'] . "`)'></em></button>",
                        'ver'         => "<button style='background: #4dbdbd;' class='btn btn-info' title='Ver este evento' onclick='ver_evento(`" . json_encode($this->datos["agenda"][$i]) . "`,`" . $user . "`)'  ><em class='fas fa-eye'></em></button>",
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

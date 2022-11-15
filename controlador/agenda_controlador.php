<?php

class Agenda extends Controlador
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.
    private $permisos; #permisos correspondiente del modulo
    private $peticion; #peticion a ejecutar de la funcion administrar
    private $estado; #array con parametros de eliminacion logica (tabla,id_tabla,param,estado)
    private $estado_ejecutar; #array con parametro a ejecutar (id_tabla, estado)
    private $sql; #nombre de la sentencia SQL que se ejecutara en el modelo
    private $datos_ejecutar; #array con datos para enviar a la bd
    private $datos_consulta; #array con los datos necesarios para el modulo (consultas)
    private $accion; #accion para enviar a la bitacora
    private $validar; #objeto con la clase validacion correspondiente al modulo
    private $mensaje; #mensaje que se mandara a la vista

    // DATOS independientes usados para el manejo del modulo
    private $ubicaciones;
    private $cedula_usuario;
    private $user;
    public $resultado;
    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        $this->Validacion("agenda");
        $this->vista->mensaje  = "";
        $this->permisos        = $_SESSION["Agenda"];
        $this->estado          = $_POST['estado'];
        $this->datos_ejecutar  = $_POST['datos'];
        $this->sql             = $_POST['sql'];
        $this->accion          = $_POST['accion'];
        $this->mensaje         = 1;
        $this->estado_ejecutar = array($this->estado["id_tabla"] => $this->estado["param"], "estado" => $this->estado["estado"]);
        $this->cedula_usuario  = $_SESSION['cedula_usuario'];
        $this->validar         = $this->validacion;
        //   $this->Cargar_Modelo("agenda");
    }

    private function Establecer_Consultas()
    {
        $this->ubicaciones = [];
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_01");
        $this->datos_consulta["agenda"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_04");
        $this->datos_consulta["calles"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_05");
        $this->datos_consulta["inmuebles"] = $this->modelo->Administrar();

        foreach ($this->datos_consulta["calles"] as $c) {$this->ubicaciones[] = $c['nombre_calle'];}
        foreach ($this->datos_consulta["inmuebles"] as $i) {$this->ubicaciones[] = $i['nombre_inmueble'];}

        $this->datos_consulta["ubicaciones"] = $this->ubicaciones;
        $this->vista->datos                  = $this->Get_Datos_Vista();
        unset($this->ubicaciones);
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
    private function Get_Estado(): array
    {return $this->estado;}
    private function Get_Estado_Ejecutar(): array
    {return $this->estado_ejecutar;}
    private function Get_Datos_Vista(): array
    {return $this->datos_consulta;}

    // ==============================================================================

    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        if ($this->permisos["consultar"] === 1) {
            $this->vista->Cargar_Vistas('agenda/consultar');
        } else { $this->_403_();}
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        $this->peticion = (isset($_POST['peticion'])) ? $_POST['peticion'] : $peticion[0];

        switch ($this->peticion) {

            case 'Registros':
                if ($this->permisos["registrar"] === 1) {
                    $this->vista->Cargar_Vistas('agenda/registrar');
                } else { $this->_403_();}
                break;
            case 'Consultas':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('agenda/consultar');
                } else { $this->_403_();}
                break;

            case 'Administrar':
                if ($this->permisos["eliminar"] === 1 || $this->permisos["modificar"] === 1) {
                    if (isset($this->datos_ejecutar)) {
                        unset($this->datos_ejecutar["primer_nombre"], $this->datos_ejecutar["primer_apellido"], $this->datos_ejecutar["cedula_persona"]);
                        $this->modelo->_Datos_($this->Get_Datos());
                    } else {
                        $this->modelo->_Estado_($this->Get_Estado());
                        $this->modelo->_Datos_($this->Get_Estado_Ejecutar());
                    }

                    $this->modelo->_SQL_($this->Get_Sql());
                    $this->modelo->_Tipo_(1);
                    if ($this->modelo->Administrar()) {
                        $this->Accion($this->Get_Accion());
                    }
                    echo $this->Get_Mensaje();
                } else { $this->_403_();}
                break;
            case 'Registrar':
                if ($this->permisos["registrar"] === 1) {
                    if ($this->validar->Validacion_Registro()) {
                        $this->modelo->_SQL_($this->Get_Sql());
                        $this->modelo->_Tipo_(1);

                        for ($i = 0; $i < count($this->datos_ejecutar['fechas']); $i++) {
                            $this->datos_ejecutar = array(
                                "tipo_evento" => $this->datos_ejecutar['tipo_evento'],
                                "fecha"       => $this->datos_ejecutar['fechas'][$i],
                                "creador"     => $this->cedula_usuario,
                                "ubicacion"   => $this->datos_ejecutar['ubicacion'],
                                "horas"       => $this->datos_ejecutar['horas'],
                                "detalle"     => $this->datos_ejecutar['detalle_evento'],
                            );
                            $this->modelo->_Datos_($this->Get_Datos());
                            if ($this->modelo->Administrar()) {
                                $this->Accion($this->Get_Accion());
                            }
                        }
                        echo $this->Get_Mensaje();
                    } else {
                        echo $this->validar->Fallo();
                    }
                } else { $this->_403_();}
                break;

            case 'Consulta_Ajax':
                $this->resultado = [];
                for ($i = 0; $i < count($this->datos_consulta["agenda"]); $i++) {
                    $this->user        = $this->datos_consulta["agenda"][$i]['primer_nombre'] . " " . $this->datos_consulta["agenda"][$i]['primer_apellido'];
                    $this->resultado[] = [
                        "usuario"     => $this->user,
                        "id_agenda"   => $this->datos_consulta["agenda"][$i]['id_agenda'],
                        "tipo_evento" => $this->datos_consulta["agenda"][$i]['tipo_evento'],
                        "fecha"       => $this->datos_consulta["agenda"][$i]['fecha'],
                        "creador"     => $this->user,
                        "ubicacion"   => $this->datos_consulta["agenda"][$i]['ubicacion'],
                        "horas"       => $this->datos_consulta["agenda"][$i]['horas'],
                        "detalle"     => $this->datos_consulta["agenda"][$i]['detalle'],
                        'editar'      => "<button title='Editar este evento' class='btn btn-info'><em class='fas fa-edit' onclick='editar_evento(`" . json_encode($this->datos_consulta["agenda"][$i]) . "`,`" . json_encode($this->datos_consulta["agenda"]) . "`)'></em></button>",
                        'eliminar'    => "<button title='Eliminar este evento' class='btn btn-danger'><em class='fas fa-trash' onclick='eliminar_evento(`" . $this->datos_consulta["agenda"][$i]['id_agenda'] . "`)'></em></button>",
                        'ver'         => "<button style='background: #4dbdbd;' class='btn btn-info' title='Ver este evento' onclick='ver_evento(`" . json_encode($this->datos_consulta["agenda"][$i]) . "`,`" . $this->user . "`)'  ><em class='fas fa-eye'></em></button>",
                    ];
                }
                $this->Escribir_JSON($this->resultado);unset($this->resultado, $this->user);
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        unset($this->peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

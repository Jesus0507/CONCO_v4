<?php
class Grupos_Deportivos extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        //   $this->Cargar_Modelo("grupos_deportivos");
    }
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();$this->vista->Cargar_Vistas('grupos_deportivos/consultar');
    }
// ==============================CRUD=====================================
    public function Establecer_Consultas_2()
    {
        $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "SQL_03");
        $this->datos["grupos_deportivos"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "_01_");
        $this->modelo->__SET("consultar", array("tabla" => "deportes", "estado" => 1, "orden" => "nombre_deporte"));
        $this->datos["deportes"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_04");$this->datos["integrantes"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_07");$this->datos["personas"] = $this->modelo->Administrar();
        $this->vista->datos      = $this->datos;
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas_2();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Registros':$this->vista->Cargar_Vistas('grupos_deportivos/registrar');break;
            case 'Consultas':$this->vista->Cargar_Vistas('grupos_deportivos/consultar');break;
            case 'Consulta_Ajax':$this->Escribir_JSON($this->datos["grupos_deportivos"]);break;
            case 'Deportes':$this->Escribir_JSON($this->datos["deportes"]);break;

            case 'Eliminar':
                $this->modelo->Estado($_POST['estado']);
                $this->modelo->Datos([
                    $_POST['estado']["id_tabla"] => $_POST['estado']["param"],
                    "estado"                     => $_POST['estado']["estado"],
                ]);
                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");

                if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            case 'Administrar':
                foreach ($this->datos["deportes"] as $key => $value) {
                    if ($value["nombre_deporte"] == $_POST['datos']["id_deporte"]) {
                        $_POST['datos']["id_deporte"] = $value["id_deporte"];
                    }
                }
                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                $this->modelo->Datos($_POST['datos']);
                if ($this->modelo->Administrar()) {
                    $this->modelo->__SET("SQL", "_03_");$this->modelo->__SET("tipo", "0");
                    $this->modelo->__SET("ultimo", array("tabla" => "grupo_deportivo", "id" => "id_grupo_deportivo"));
                    $id = $this->modelo->Administrar();
                    foreach ($id as $i) {
                        foreach ($_POST['integrantes'] as $inte) {
                            $this->modelo->__SET("SQL", "SQL_06");$this->modelo->__SET("tipo", "1");
                            $this->modelo->Datos([
                                "cedula_persona"     => $inte["integrantes"],
                                "id_grupo_deportivo" => $i['MAX(id_grupo_deportivo)'],
                                "estado"             => 1,
                            ]);
                            if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                        }
                    }
                }
                $this->Accion($_POST['accion']);echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            case 'Datos':
                $retornar = [];
                foreach ($this->datos["grupos_deportivos"] as $gp) {

                    if ($gp['id_grupo_deportivo'] == $_POST['id_grupo_deportivo']) {
                        $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "0");
                        $this->modelo->__SET("id", $_POST['id_grupo_deportivo']);
                        $integrantes = $this->modelo->Administrar();
                        $retornar[] = [
                            "id_grupo_deportivo"     => $gp['id_grupo_deportivo'],
                            "nombre_deporte"         => $gp['nombre_deporte'],
                            "nombre_grupo_deportivo" => $gp['nombre_grupo_deportivo'],
                            "descripcion"            => $gp['descripcion'],
                            "integrantes"            => json_encode($integrantes),
                        ];
                    }
                }
                $this->Escribir_JSON($retornar);unset($retornar,$integrantes);
                break;

            case 'Grupos_Deportivos_Personas':
                foreach ($this->datos["integrantes"] as $integrante) {
                    if ($_POST["id"] == $integrante["id_grupo_deportivo"]) {$integrantes[] = $integrante;}
                }
                $this->Escribir_JSON($integrantes);unset($integrantes);
                break;

            case 'Obtener_Integrantes':
                $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
                $this->modelo->__SET("consultar", array(
                    "tabla"   => "personas_grupo_deportivo",
                    "columna" => "id_grupo_deportivo",
                    "data"    => $_POST['id'],
                ));
                $integrantes = $this->modelo->Administrar();
                $result = [];
                foreach ($integrantes as $i) {
                    $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
                    $this->modelo->__SET("consultar", array(
                        "tabla"   => "personas",
                        "columna" => "cedula_persona",
                        "data"    => $i['cedula_persona'],
                    ));
                    $persona  = $this->modelo->Administrar();
                    $result[] = $persona[0];
                }
                echo json_encode($result);unset($integrantes,$result,$persona);
                break;
            case 'Agregar':
                $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
                $this->modelo->__SET("consultar", array(
                    "tabla"   => "personas_grupo_deportivo",
                    "columna" => "id_grupo_deportivo",
                    "data"    => $_POST['datos']['id_grupo_deportivo'],
                ));
                $integrantes = $this->modelo->Administrar();
                $retornar    = 1;
                foreach ($integrantes as $i) {
                    if ($i['cedula_persona'] == $_POST['datos']['cedula_persona']) {
                        $retornar = 0;
                    }
                }
                if ($retornar == 1) {
                    $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                    $this->modelo->Datos($_POST['datos']);

                    if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                }
                echo $retornar;unset($retornar, $integrantes);
                break;

            case 'Integrantes':
                $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
                $this->modelo->__SET("consultar", array(
                    "tabla"   => "personas_grupo_deportivo",
                    "columna" => "id_grupo_deportivo",
                    "data"    => $_POST['id'],
                ));
                $integrantes = $this->modelo->Administrar();
                $result      = [];
                foreach ($integrantes as $i) {
                    $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
                    $this->modelo->__SET("consultar", array(
                        "tabla"   => "personas",
                        "columna" => "cedula_persona",
                        "data"    => $i['cedula_persona'],
                    ));
                    $persona  = $this->modelo->Administrar();
                    $result[] = $persona[0];
                }
                echo json_encode($result);unset($result, $integrantes, $persona);
                break;

            case 'Eliminar_Integrantes':
                $retornar = 0;
                $this->modelo->__SET("SQL", "_07_");$this->modelo->__SET("tipo", "1");
                $this->modelo->__SET("eliminar", array(
                    "tabla" => "personas_grupo_deportivo", "id_tabla" => "cedula_persona"));
                $this->modelo->Datos(["cedula_persona" => $_POST['cedula_persona']]);

                if ($this->modelo->Administrar()) {
                    $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
                    $this->modelo->__SET("consultar", array(
                        "tabla"   => "personas_grupo_deportivo",
                        "columna" => "id_grupo_deportivo",
                        "data"    => $_POST['id_grupo_deportivo'],
                    ));
                    $integrantes = $this->modelo->Administrar();
                    if (count($integrantes) != 0) {
                        $retornar = [];
                        for ($i = 0; $i < count($integrantes); $i++) {
                            $retornar[] = [
                                "cedula_persona"             => $integrantes[0]['cedula_persona'],
                                "id_persona_grupo_deportivo" => $integrantes[$i]['id_persona_grupo_deportivo'],
                            ];
                        }
                    }
                }
                echo json_encode($retornar);unset($integrantes, $retornar, $enfer, $_POST);
                break;

            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

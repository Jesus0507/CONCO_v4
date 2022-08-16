<?php

class Centro_Votacion extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        //  $this->Cargar_Modelo("centro_votacion");
    }
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();$this->vista->Cargar_Vistas('centro_votacion/consultar');
    }
    // ==============================================================================

    public function Establecer_Consulta()
    {
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("SQL", "SQL_01");$this->datos["centros_votacion"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_02");$this->datos["persona_centro_votacion"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "_01_");
        $this->modelo->__SET("consultar", array("tabla" => "parroquias", "estado" => 1, "orden" => "id_parroquia"));
        $this->datos["parroquias"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_06");$this->datos["personas"] = $this->modelo->Administrar();
        $this->vista->datos = $this->datos;
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();$this->Establecer_Consulta();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Registros':$this->vista->Cargar_Vistas('centro_votacion/registrar');break;
            case 'Consultas': $this->vista->Cargar_Vistas('centro_votacion/consultar');break;

            case 'Registrar':

                $cont = 0;
                foreach ($this->datos["centros_votacion"] as $cv) {
                    if (strtolower($cv['nombre_centro']) == strtolower($_POST['nombre_centro'])) {
                        $this->modelo->__SET("SQL", "SQL_03");$this->modelo->__SET("tipo", "1");
                        $this->modelo->Datos($_POST['datos']);
                        if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                        $cont++;
                    } 
                }
                if ($cont == 0) {
                    $this->modelo->__SET("SQL", "SQL_04");$this->modelo->__SET("tipo", "1");
                    $this->modelo->Datos([
                        'id_parroquia'  => $_POST['id_parroquia'],
                        'nombre_centro' => $_POST["datos"]['nombre_centro'],
                        'estado'        => $_POST["datos"]['estado'],
                    ]);

                    if ($this->modelo->Administrar()) {
                        $this->modelo->__SET("SQL", "_03_");$this->modelo->__SET("tipo", "0");
                        $this->modelo->__SET("ultimo", array("tabla" => "centros_votacion", "id" => "id_centro_votacion"));
                        $id = $this->modelo->Administrar();

                        foreach ($id as $i) {
                            $this->modelo->__SET("SQL", "SQL_03");$this->modelo->__SET("tipo", "1");
                            $this->modelo->Datos([
                                "id_centro_votacion" => $id[0]['MAX(id_centro_votacion)'],
                                "cedula_votante"     => $_POST['datos']['cedula_votante'],
                                "estado"             => $_POST['datos']['estado'],
                            ]);
                            if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                        }
                    }
                }
                echo $this->mensaje;unset($cont,$id,$this->mensaje);
                break;

            case 'Administrar':
                $this->modelo->Estado($_POST['estado']);
                $this->modelo->Datos([
                    $_POST['estado']["id_tabla"] => $_POST['estado']["param"],
                    "estado"                     => $_POST['estado']["estado"],
                ]);
                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($_POST, $this->mensaje);
                break;

            case 'Consulta_Ajax':$this->Escribir_JSON($this->datos["persona_centro_votacion"]);break;

            case 'Centro_Votacion':
                $cont = 0;
                foreach ($this->datos["centros_votacion"] as $cv) {
                    if ($cv["nombre_centro"] == $_POST['nombre_centro']) {
                        $parroquia = $cv["id_parroquia"];
                        $cont++;
                    }
                }
                if ($cont == 0) {$parroquia = "vacio";}
                echo $parroquia;unset($cont, $parroquia);
                break;

            case 'Parroquias':
                foreach ($this->datos["parroquias"] as $key => $value) {
                    if ($value["nombre_parroquia"] == $_POST['id']) { $id = $value["id_parroquia"];}
                }
                echo $id;unset($id);
                break;

            case 'Editar':
                $cont   = 0;
                $existe = 0;
                foreach ($this->datos["centros_votacion"] as $cv) {
                    if (strtolower($cv['nombre_centro']) == strtolower($_POST['nombre_centro']) && $cv['id_parroquia'] == $_POST['id_parroquia']) {
                        $existe = $cv['id_centro_votacion'];
                    }
                }
                if ($existe == 0) {
                    $this->modelo->__SET("SQL", "SQL_04");$this->modelo->__SET("tipo", "1");
                    $this->modelo->Datos([
                        "id_parroquia"  => $_POST['datos']['id_parroquia'],
                        "nombre_centro" => $_POST['datos']['nombre_centro'],
                        "estado"        => $_POST['datos']['estado'],
                    ]);

                    if ($this->modelo->Administrar()) {$this->mensaje = 1;}

                    $this->modelo->__SET("SQL", "_03_");$this->modelo->__SET("tipo", "0");
                    $this->modelo->__SET("ultimo", array("tabla" => "centros_votacion", "id" => "id_centro_votacion"));
                    $id = $this->modelo->Administrar();

                    $this->modelo->__SET("SQL", "SQL_05");$this->modelo->__SET("tipo", "1");
                    $this->modelo->Datos([
                        "id_votante_centro_votacion" => $_POST['datos']['id_votante_centro_votacion'],
                        "id_centro_votacion"         => $id[0]['MAX(id_centro_votacion)'],
                        "cedula_votante"             => $_POST['datos']['cedula_persona'],
                        "estado"                     => $_POST['datos']['estado'],
                    ]);
                    if ($this->modelo->Administrar()) {$this->mensaje = 1;}

                } else {
                    $this->modelo->__SET("SQL", "SQL_05");
                    $this->modelo->__SET("tipo", "1");
                    $this->modelo->Datos([
                        "id_votante_centro_votacion" => $_POST['datos']['id'],
                        "id_centro_votacion"         => $existe,
                        "cedula_votante"             => $_POST['datos']['cedula_persona'],
                        "estado"                     => $_POST['datos']['estado'],
                    ]);

                    if ($this->modelo->Administrar()) {$this->mensaje = 1;} 
                }
                echo $this->mensaje;
                unset($cont,$existe,$id,$this->mensaje);
                break;

            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}
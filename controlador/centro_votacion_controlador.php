<?php

class Centro_Votacion extends Controlador
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
    private $mensaje; #mensaje que se mandara a la vista
    private $validar; #objeto con la clase validacion correspondiente al modulo
    private $crud; #array con peticion generica sql

    // DATOS independientes usados para el manejo del modulo
    private $id;
    private $id_parroquia;
    private $cedula_votante;

    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        // $this->Validacion("negocios");
        $this->permisos       = $_SESSION["Centros votacion"];
        $this->estado         = isset($_POST['estado']) ? $_POST['estado'] : null;
        $this->datos_ejecutar = isset($_POST['datos']) ? $_POST['datos'] : null;
        $this->sql            = isset($_POST['sql']) ? $_POST['sql'] : null;
        $this->accion         = isset($_POST['accion']) ? $_POST['accion'] : null;
        $this->id_parroquia   = isset($_POST['id_parroquia']) ? $_POST['id_parroquia'] : null;
        $this->cedula_votante = isset($_POST['cedula_votante']) ? $_POST['datos']['cedula_votante'] : null;
        // $this->validar         = $this->validacion;
        $this->mensaje           = 1;
        $this->estado_ejecutar   = array($this->estado["id_tabla"] => $this->estado["param"], "estado" => $this->estado["estado"]);
        $this->crud["consultar"] = array("tabla" => "parroquias", "estado" => 1, "orden" => "nombre_parroquia");
        //  $this->Cargar_Modelo("centro_votacion");
    }
    private function Establecer_Consulta()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_01");
        $this->datos_consulta["centros_votacion"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_02");
        $this->datos_consulta["persona_centro_votacion"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("_01_");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["parroquias"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("SQL_06");
        $this->datos_consulta["personas"] = $this->modelo->Administrar();
        $this->vista->datos               = $this->Get_Datos_Vista();
    }
    // ==================GETTERS=========================
    #getters usados para obtener la informacion de las variables privadas
    # retornan tipo string o array
    private function Get_Sql(): string
    {
        return $this->sql;
    }
    private function Get_Accion(): string
    {
        return $this->accion;
    }
    private function Get_Mensaje(): string
    {
        return $this->mensaje;
    }
    private function Get_Datos(): array
    {
        return $this->datos_ejecutar;
    }
    private function Get_Estado(): array
    {
        return $this->estado;
    }
    private function Get_Estado_Ejecutar(): array
    {
        return $this->estado_ejecutar;
    }
    private function Get_Datos_Vista(): array
    {
        return $this->datos_consulta;
    }
    private function Get_Crud_Sql(): array
    {
        return $this->crud;
    }
    // ==============================================================================

    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consulta();
        if ($this->permisos["consultar"] === 1) {
            $this->vista->Cargar_Vistas('centro_votacion/consultar');
        } else {
            $this->_403_();
        }
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consulta();
        $this->peticion = (isset($_POST['peticion'])) ? $_POST['peticion'] : $peticion[0];
        switch ($this->peticion) {
            case 'Registros':
                if ($this->permisos["registrar"] === 1) {
                    $this->vista->Cargar_Vistas('centro_votacion/registrar');
                } else {
                    $this->_403_();
                }
                break;
            case 'Consultas':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('centro_votacion/consultar');
                } else {
                    $this->_403_();
                }
                break;

            case 'Registrar':
                if ($this->permisos["registrar"] === 1) {
                    $cont = 0;
                    foreach ($this->datos_consulta["centros_votacion"] as $cv) {
                        if (strtolower($cv['nombre_centro']) == strtolower($this->datos_ejecutar['nombre_centro'])) {
                            $cont = $cv['id_centro_votacion'];
                        }
                    }

                    if ($cont == 0 && $this->datos_ejecutar['centro_existente'] == 0) {
                        $this->modelo->_SQL_("SQL_04");
                        $this->modelo->_Tipo_(1);
                        $datos_registro = [
                            'id_parroquia' => $this->Get_Datos()['parroquia'],
                            'nombre_centro' => $this->Get_Datos()['nombre_centro'],
                            'estado' => 1
                        ];
                        $this->modelo->_Datos_($datos_registro);
                        if ($this->modelo->Administrar()) {
                            $this->modelo->_SQL_("_03_");
                            $this->modelo->_Tipo_(0);
                            $this->crud["ultimo"] = array("tabla" => "centros_votacion", "id" => "id_centro_votacion");
                            $this->modelo->_CRUD_($this->Get_Crud_Sql());
                            $this->id = $this->modelo->Administrar();
                            foreach ($this->id as $i) {
                                $this->modelo->_SQL_("SQL_03");
                                $this->modelo->_Tipo_(1);
                                $this->datos_ejecutar = array(
                                    "id_centro_votacion" => $i['MAX(id_centro_votacion)'],
                                    "cedula_votante"     => $this->Get_Datos()['persona'],
                                    "estado"             => 1,
                                );
                                $this->modelo->_Datos_($this->Get_Datos());
                                if ($this->modelo->Administrar()) {
                                    $this->Accion($this->Get_Accion());
                                    echo $this->Get_Mensaje();
                                }
                            }      
                        }
                    }
                    else {
                        $index = 0;
                        foreach ($this->datos_consulta["centros_votacion"] as $cv) {
                            if (strtolower($cv['nombre_centro']) == strtolower($this->datos_ejecutar['nombre_centro'])) {
                                if($cv['id_parroquia'] == $this->Get_Datos()['parroquia']){
                                    $index++;
                                }
                            }
                        }


                         if($index != 0) {
                            $this->modelo->_SQL_("SQL_03");
                            $this->modelo->_Tipo_(1);
                            $this->datos_ejecutar = array(
                                "id_centro_votacion" => $cont,
                                "cedula_votante"     => $this->Get_Datos()['persona'],
                                "estado"             => 1,
                            );
                            $this->modelo->_Datos_($this->Get_Datos());
                            if ($this->modelo->Administrar()) {
                                $this->Accion($this->Get_Accion());
                                echo $this->Get_Mensaje();
                            }
                         }
                          else{
                            $this->modelo->_SQL_("SQL_04");
                            $this->modelo->_Tipo_(1);
                            $datos_registro = [
                                'id_parroquia' => $this->Get_Datos()['parroquia'],
                                'nombre_centro' => $this->Get_Datos()['nombre_centro'],
                                'estado' => 1
                            ];
                            $this->modelo->_Datos_($datos_registro);
                            if ($this->modelo->Administrar()) {
                                $this->modelo->_SQL_("_03_");
                                $this->modelo->_Tipo_(0);
                                $this->crud["ultimo"] = array("tabla" => "centros_votacion", "id" => "id_centro_votacion");
                                $this->modelo->_CRUD_($this->Get_Crud_Sql());
                                $this->id = $this->modelo->Administrar();
                                foreach ($this->id as $i) {
                                    $this->modelo->_SQL_("SQL_03");
                                    $this->modelo->_Tipo_(1);
                                    $this->datos_ejecutar = array(
                                        "id_centro_votacion" => $i['MAX(id_centro_votacion)'],
                                        "cedula_votante"     => $this->Get_Datos()['persona'],
                                        "estado"             => 1,
                                    );
                                    $this->modelo->_Datos_($this->Get_Datos());
                                    if ($this->modelo->Administrar()) {
                                        $this->Accion($this->Get_Accion());
                                        echo $this->Get_Mensaje();
                                    }
                                }      
                            }
                         }
                       
                    }
                } else {
                    $this->_403_();
                }
                break;

            case 'Administrar':
                if ($this->permisos["eliminar"] === 1) {
                    $this->modelo->_Estado_($this->Get_Estado());
                    $this->modelo->_Datos_($this->Get_Estado_Ejecutar());
                    $this->modelo->_SQL_($this->Get_Sql());
                    $this->modelo->_Tipo_(1);
                    if ($this->modelo->Administrar()) {
                        $this->Accion($this->Get_Accion());
                        echo $this->Get_Mensaje();
                    }
                } else {
                    $this->_403_();
                }
                break;

            case 'Consulta_Ajax':
                $this->Escribir_JSON($this->Get_Datos_Vista()["persona_centro_votacion"]);
                break;

            case 'Centro_Votacion':
                $cont = 0;
                foreach ($this->datos_ejecutar["centros_votacion"] as $cv) {
                    if ($cv["nombre_centro"] == $_POST['nombre_centro']) {
                        $parroquia = $cv["id_parroquia"];
                        $cont++;
                    }
                }
                if ($cont == 0) {
                    $parroquia = "vacio";
                }
                echo $parroquia;
                break;

            case 'Parroquias':
                foreach ($this->datos_ejecutar["parroquias"] as $key => $value) {
                    if ($value["nombre_parroquia"] == $_POST['id']) {
                        $id = $value["id_parroquia"];
                    }
                }
                echo $id;
                unset($id);
                break;
            
            case 'Consultar_votante':
                $votante_existe = 0;
                $this->modelo->_SQL_("SQL_07");
                $this->modelo->_Tipo_(0);
                $votantes = $this->modelo->Administrar();
                foreach ($votantes as $v) {
                    if($v['cedula_votante'] == $this->datos_ejecutar){
                        $votante_existe++;
                    }
                }
                echo $votante_existe;
                break;

            case 'Editar':
                if ($this->permisos["modificar"] === 1) {
                    $cont   = 0;
                    $existe = 0;
                    foreach ($this->datos_ejecutar["centros_votacion"] as $cv) {
                        if (strtolower($cv['nombre_centro']) == strtolower($_POST['nombre_centro']) && $cv['id_parroquia'] == $_POST['id_parroquia']) {
                            $existe = $cv['id_centro_votacion'];
                        }
                    }
                    if ($existe == 0) {
                        $this->modelo->_SQL_("SQL_04");
                        $this->modelo->_Tipo_(1);
                        $this->modelo->Datos([
                            "id_parroquia"  => $this->datos_ejecutar['id_parroquia'],
                            "nombre_centro" => $this->datos_ejecutar['nombre_centro'],
                            "estado"        => $this->datos_ejecutar['estado'],
                        ]);

                        if ($this->modelo->Administrar()) {
                            $this->mensaje = 1;
                        }

                        $this->modelo->_SQL_("_03_");
                        $this->modelo->_Tipo_(0);
                        $this->modelo->__SET("ultimo", array("tabla" => "centros_votacion", "id" => "id_centro_votacion"));
                        $id = $this->modelo->Administrar();

                        $this->modelo->_SQL_("SQL_05");
                        $this->modelo->_Tipo_(1);
                        $this->modelo->Datos([
                            "id_votante_centro_votacion" => $this->datos_ejecutar['id_votante_centro_votacion'],
                            "id_centro_votacion"         => $id[0]['MAX(id_centro_votacion)'],
                            "cedula_votante"             => $this->datos_ejecutar['cedula_persona'],
                            "estado"                     => $this->datos_ejecutar['estado'],
                        ]);
                        if ($this->modelo->Administrar()) {
                            $this->mensaje = 1;
                        }
                    } else {
                        $this->modelo->_SQL_("SQL_05");
                        $this->modelo->_Tipo_(1);
                        $this->modelo->Datos([
                            "id_votante_centro_votacion" => $this->datos_ejecutar['id'],
                            "id_centro_votacion"         => $existe,
                            "cedula_votante"             => $this->datos_ejecutar['cedula_persona'],
                            "estado"                     => $this->datos_ejecutar['estado'],
                        ]);

                        if ($this->modelo->Administrar()) {
                            $this->mensaje = 1;
                        }
                    }
                    echo $this->mensaje;
                    unset($cont, $existe, $id, $this->mensaje);
                } else {
                    $this->_403_();
                }
                break;

            default:
                $this->vista->Cargar_Vistas('error/400');
                break;
        }
        unset($peticion, $this->datos_ejecutar, $this->vista->datos);
        exit();
    }
}

<?php

class Vacunados extends Controlador
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
    public $cedula;
    public $retornar;
    // ==================ESTABLECER DATOS=========================
    public function __construct()
    {
        parent::__construct();
        // $this->Validacion("negocios");
        $this->permisos        = $_SESSION["Vacunados COVID"];
        $this->estado          = $_POST['estado'];
        $this->datos_ejecutar  = $_POST['datos'];
        $this->sql             = $_POST['sql'];
        $this->accion          = $_POST['accion'];
        // $this->validar         = $this->validacion;
        $this->cedula          = $_POST['cedula'];
        $this->mensaje         = 1;
        $this->estado_ejecutar = array($this->estado["id_tabla"] => $this->estado["param"], "estado" => $this->estado["estado"]);
        $this->retornar = "";
    }
    private function Establecer_Consultas()
    {
        $this->modelo->_Tipo_(0);
        $this->modelo->_SQL_("SQL_01");
        $this->datos_consulta["vacunados"] = $this->modelo->Administrar();
        $this->modelo->_SQL_("_01_");
        $this->crud["consultar"] = array("tabla" => "vacuna_covid", "estado" => 1, "orden" => "id_vacuna_covid");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["vacunas"] = $this->modelo->Administrar();

        $this->crud["consultar"] = array("tabla" => "personas", "estado" => 1, "orden" => "cedula_persona");
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["personas"] = $this->modelo->Administrar();

        $this->vista->datos               = $this->Get_Datos_Vista();
    }
    // ==================GETTERS=========================
    #getters usados para obtener la informacion de las variables privadas
    # retornan tipo string o array
    private function Get_Sql():string           {return $this->sql;}
    private function Get_Accion():string        {return $this->accion;}
    private function Get_Mensaje():string       {return $this->mensaje;}
    private function Get_Datos():array          {return $this->datos_ejecutar;}
    private function Get_Estado():array         {return $this->estado;}
    private function Get_Estado_Ejecutar():array{return $this->estado_ejecutar;}
    private function Get_Datos_Vista():array    {return $this->datos_consulta;}
    private function Get_Crud_Sql(): array      {return $this->crud;}
    // ==============================================================================

    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        if ($this->permisos["consultar"] === 1) {
            $this->vista->Cargar_Vistas('vacuna/consultar');
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
                    $this->vista->Cargar_Vistas('vacuna/registrar');
                } else { $this->_403_();}
                break;
            case 'Consultas':
                if ($this->permisos["consultar"] === 1) {
                    $this->vista->Cargar_Vistas('vacuna/consultar');
                } else { $this->_403_();}
                break;
            case 'Administrar':
                if ($this->permisos["registrar"] === 1 || $this->permisos["modificar"] === 1) {

                    if ($this->validar->Validacion_Registro()) {
                        $this->modelo->_Datos_($this->Get_Datos());
                        $this->modelo->_SQL_($this->Get_Sql());
                        $this->modelo->_Tipo_(1);
                        if ($this->modelo->Administrar()) {
                            $this->Accion($this->Get_Accion());
                            echo $this->Get_Mensaje();
                        }
                    } else {
                        echo $this->validar->Fallo();
                    }
                } else { $this->_403_();}
                break;

            case 'Registrar':
                $dosis_array = $_POST['datos']['info_dosis'];
                  for ($i = 0; $i < count($dosis_array); $i++) {
            
                     $this->modelo->_SQL_($this->Get_Sql());
                     $this->modelo->_Tipo_(1);
                     $this->modelo->_Datos_([
                     'cedula_persona' => $this->datos_ejecutar['cedula_persona'],
                     'dosis'          => $dosis_array[$i]['dosis'],
                     'fecha_vacuna'   => $dosis_array[$i]['fecha'],
                     'estado'         => 1,
                 ]);
                 if ($this->modelo->Administrar()) {$this->mensaje = 1;}
                 }

                 $this->Accion($this->Get_Accion());
                 echo $this->Get_Mensaje();
                break;
            case 'Eliminar':
                if ($this->permisos["eliminar"] === 1) {
                    $this->modelo->_Estado_($this->Get_Estado());
                    $this->modelo->_Datos_($this->Get_Estado_Ejecutar());
                    $this->modelo->_SQL_($this->Get_Sql());
                    $this->modelo->_Tipo_(1);
                    if ($this->modelo->Administrar()) {
                        $this->Accion($this->Get_Accion());
                        echo $this->Get_Mensaje();
                    }
                } else { $this->_403_();}
                break;

            case 'Existe':
        $existe = 1;
        foreach ($this->datos_consulta['vacunas'] as $v) {
            if ($v['cedula_persona'] == $this->cedula) {
                    $existe = 0;
            }
        }

        echo $existe;
                break;

            case 'Consulta_Ajax':

             foreach ($this->datos_consulta["vacunados"] as $persona) {
                $dosis = "";
                $fecha = "";
             foreach ($this->datos_consulta["vacunas"] as  $vacuna) {
                if ($persona["cedula_persona"] == $vacuna["cedula_persona"]) {
                    $dosis .= $vacuna["dosis"] . "</br>";
                   $fecha .= $vacuna["fecha_vacuna"] . "</br>";
               }
             }

             $datos[] = [
                "cedula_persona"  => $persona["cedula_persona"],
                "nombre_apellido" => $persona["primer_nombre"] . " " . $persona["primer_apellido"],
                "dosis"           => $dosis,
                "fecha_vacuna"    => $fecha,
            ];
         }

        $this->Escribir_JSON($datos);

                break;

            case 'Vacunas':
            $this->modelo->_Tipo_(0);
            $this->modelo->_SQL_("_05_");
        $this->crud["consultar"] = array("tabla" => "vacuna_covid", "columna" => "cedula_persona", "data" => $this->cedula);
        $this->modelo->_CRUD_($this->Get_Crud_Sql());
        $this->datos_consulta["vacunas_personas"] = $this->modelo->Administrar();
            foreach ($this->datos_consulta["vacunas_personas"] as $v) {
            $this->retornar .= "<table style='width:100%'><tr><td>" . $v['dosis'] . "</td><td>(" . $v['fecha_vacuna'] . ")</td>
            <td><button type='button' class='btn btn-danger' onclick='eliminar_dosis(" . $v['id_vacuna_covid'] . "," . $this->cedula . ")'>X</button></td></tr></table><hr>";
            }

            echo $this->retornar;
                break;

            default:$this->vista->Cargar_Vistas('error/400');
                break;
        }
        exit();
    }
}

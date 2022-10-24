<?php

class Consejo_Comunal extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        //   $this->Cargar_Modelo("consejo_comunal");
    }
// ==============================VISTAS=====================================
    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();$this->vista->Cargar_Vistas('consejo_comunal/consultar');
    }
// ==============================================================================

    public function Establecer_Consultas()
    {
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("SQL", "SQL_01");$this->datos["consejo_comunal"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_04");$this->datos["personas"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "_01_");
        $this->modelo->__SET("consultar", array("tabla" => "comite", "estado" => 1, "orden" => "nombre_comite"));
        $this->datos["comite"] = $this->modelo->Administrar();
        $this->vista->datos = $this->datos;
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();$this->Establecer_Consultas();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Registros':
            if ($_SESSION["Comite"]["registrar"] === 1) {
               $this->vista->Cargar_Vistas('consejo_comunal/registrar');
            }else{$this->_403_();}
                break;
            case 'Consultas':
            if ($_SESSION["Comite"]["consultar"] === 1) {
               $this->vista->Cargar_Vistas('consejo_comunal/consultar');
            }else{$this->_403_();}
                break;
            case 'Consulta_Ajax':$this->Escribir_JSON($this->datos["consejo_comunal"]);break;

            case 'Registrar':
            if ($_SESSION["Comite"]["registrar"] === 1) {
                $this->Validacion("consejo_comunal");
                if ($this->validacion->Validacion_Registro()) {
                    foreach ($this->datos["comite"] as $tabla_comite) {
                    if ($tabla_comite["nombre_comite"] == $_POST["nombre_comite"]) {
                        $id_comite = $tabla_comite["id_comite"];
                    }
                }
                    $_POST['datos']["id_comite"] = $this->validacion->Datos_Limpios($id_comite);
                    $this->modelo->Datos($_POST['datos']);
                    $this->Ejecutar_Sentencia();
                    echo $this->mensaje;
                }else{
                    echo $this->validacion->Fallo();
                }
                unset($this->mensaje,$_POST,$id_comite);
            }else{$this->_403_();}
                break;
            case 'Eliminar':
            if ($_SESSION["Comite"]["eliminar"] === 1) {
                $this->modelo->__SET("eliminar", array(
                    "tabla"    => $_POST['estado']["tabla"],
                    "id_tabla" => $_POST['estado']["id_tabla"]));
                $this->modelo->Datos([$_POST['estado']["id_tabla"] => $_POST['estado']["param"]]);

                $this->modelo->__SET("SQL", $_POST['sql']);$this->modelo->__SET("tipo", "1");
                if ($this->modelo->Administrar()) {$this->mensaje = 1;$this->Accion($_POST['accion']);}

                echo $this->mensaje;unset($_POST, $this->mensaje);
            }else{$this->_403_();}
                break;

            case 'Editar':
            if ($_SESSION["Comite"]["modificar"] === 1) {
                $this->Validacion("consejo_comunal");
                if ($this->validacion->Validacion_Registro()) {
                foreach ($this->datos["comite"] as $tabla_comite) {
                    if ($tabla_comite["nombre_comite"] == $_POST["nombre_comite"]) {
                        $id_comite = $tabla_comite["id_comite"];
                    }
                }
                    $_POST['datos']["id_comite"] = $this->validacion->Datos_Limpios($id_comite);
                    $_POST['datos']["id_comite_persona"] = $this->validacion->Datos_Limpios($_POST["id_comite_persona"]);
                    $this->modelo->Datos($_POST['datos']);
                    $this->Ejecutar_Sentencia();
                    echo $this->mensaje;
                }else{
                    echo $this->validacion->Fallo();
                }
                unset($this->mensaje,$_POST,$id_comite);
            }else{$this->_403_();}
                break;

            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}
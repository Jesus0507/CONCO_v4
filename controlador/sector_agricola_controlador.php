<?php
class Sector_Agricola extends Controlador
{
    public function __construct()
    { 
        parent::__construct();
        // $this->Cargar_Modelo("sector_agricola");
    }
    public function Cargar_Vistas()
    {
        $this->Establecer_Consultas();$this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('sector_agricola/consultar');
    }
    // ==============================================================================
    public function Establecer_Consultas()
    {
        $this->modelo->__SET("tipo", "0");
        $this->modelo->__SET("SQL", "SQL_02");$this->datos["sector_agricola"] = $this->modelo->Administrar();
        $this->modelo->__SET("SQL", "SQL_04");$this->datos["personas"] = $this->modelo->Administrar();
        $this->vista->datos = $this->datos;
    }

    public function Administrar($peticion = null)
    {
        $this->Seguridad_de_Session();
        $this->Establecer_Consultas();
        if (isset($_POST['peticion'])) {$peticion = $_POST['peticion'];} else { $peticion = $peticion[0];}

        switch ($peticion) {
            case 'Registros':
            if ($_SESSION["Sector agricola"]["registrar"] === 1) {
                $this->vista->Cargar_Vistas('sector_agricola/registrar');
            }else{$this->_403_();}
                break;
            case 'Consultas':
            if ($_SESSION["Sector agricola"]["consultar"] === 1) {
                $this->vista->Cargar_Vistas('sector_agricola/consultar');
            }else{$this->_403_();}
                break;
            case 'Consulta_Ajax':$this->Escribir_JSON($this->datos["sector_agricola"]);
                break; 

            case 'Administrar':
            if ($_SESSION["Sector agricola"]["registrar"] === 1 || $_SESSION["Sector agricola"]["modificar"] === 1) {
                $this->Validacion("Sector_Agricola");
                if ($this->validacion->Validacion_Registro()) {
                    $this->modelo->Datos($_POST['datos']);
                    $this->Ejecutar_Sentencia();
                    echo $this->mensaje;
                }else{
                    echo $this->validacion->Fallo();
                }
                unset($_POST, $this->mensaje);
            }else{$this->_403_();}
                break;

            case 'Eliminar':
            if ($_SESSION["Sector agricola"]["eliminar"] === 1) {
                $this->modelo->Estado($_POST['estado']);
                $this->modelo->Datos([
                    $_POST['estado']["id_tabla"] => $_POST['estado']["param"],
                    "estado"                     => $_POST['estado']["estado"],
                ]);
                $this->Ejecutar_Sentencia();
                echo $this->mensaje;
                unset($_POST, $this->mensaje);
            }else{$this->_403_();}
                break;

            case 'Existente':
                $this->modelo->__SET("tipo", "0");$this->modelo->__SET("SQL", "_05_");
                $this->modelo->__SET("consultar", array(
                    "tabla"   => "sector_agricola",
                    "columna" => "id_sector_agricola",
                    "data"    => $_POST['id'],
                ));
                $consulta = $this->modelo->Administrar();
                $this->Escribir_JSON($consulta);unset($consulta);
                break;

            default:$this->vista->Cargar_Vistas('error/400');break;
        }
        unset($peticion, $this->datos, $this->vista->datos);
        exit();
    }
}

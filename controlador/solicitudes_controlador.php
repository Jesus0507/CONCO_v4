<?php
require_once 'vista/privado/securimage/securimage.php';
class Solicitudes extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        $this->vista->mensaje = "";
        //  $this->Cargar_Modelo("solicitudes");
    }
    public function Establecer_Consultas()
    {
        $solicitudes              = $this->modelo->Consultar();
        $this->vista->solicitudes = $solicitudes; //datos para mandar a la vista
        $this->datos_solicitudes  = $solicitudes; //datos para usar en el controlador
    }
// ==============================VISTAS=====================================

    public function Cargar_Vistas()
    {
        $this->Establecer_Consultas();
        $this->Seguridad_de_Session();
        $solicitud = $this->Consultar_Columna("solicitudes", "id_solicitud", $_GET['id']);

        $this->vista->Cargar_Vistas('solicitudes/index');
    }
    public function Solicitud()
    {
        $this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('solicitudes/consultar');
    }

    public function Solicitud_vivienda()
    {
        $this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('solicitudes/consultar_vivienda');
    }

    public function Solicitud_familia()
    {
        $this->Seguridad_de_Session();
        $solicitud                = $this->Consultar_Columna("solicitudes", "id_solicitud", $_GET['id']);
        $this->vista->solicitud   = $solicitud;
        $solicitante              = $this->Consultar_Columna("personas", "cedula_persona", $solicitud[0]['cedula_persona']);
        $this->vista->solicitante = $solicitante;
        $familia                  = $this->Consultar_Columna("familia", "id_familia", $solicitud[0]['observaciones']);
        $this->vista->familia     = $familia;
        $vivienda                 = $this->Consultar_Columna("vivienda", "id_vivienda", $familia[0]['id_vivienda']);
        $this->vista->vivienda    = $vivienda;
        $integrantes              = $this->Consultar_Columna("familia_personas", "id_familia", $solicitud[0]['observaciones']);
        $personas_familia         = [];
        foreach ($integrantes as $i) {
            $integrante         = $this->Consultar_Columna("personas", "cedula_persona", $i['cedula_persona']);
            $personas_familia[] = $integrante[0];
        }
        $this->vista->integrantes = $personas_familia;
        $this->vista->Cargar_Vistas('solicitudes/consultar_familia');
    }

    public function Solicitud_viewOnly()
    {
        $this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('solicitudes/consultar_only_view');
    }

    function print() {
        $this->Seguridad_de_Session();
        $solicitudes = $this->modelo->Consultar_all();

        foreach ($solicitudes as $s) {
            if ($s['id_solicitud'] == $_GET['id']) {

                $header_constancia = "";
                $body_constancia   = "";
                $footer_constancia = "";

                switch ($s['tipo_constancia']) {

                    case "Residencia":

                        $header_constancia = "<table style='width:100%'><tr><td style='width:10%'></td><td style='width:80%'>REPUBLICA BOLIVARIANA DE VENEZUELA<br>CONSEJO COMUNAL<br>PRADOS DE OCCIDENTE SECTOR III<br>RIF. J-30725585 CODIGO 13-03-04-608-0002<br>Barquisimeto Municipio Iribarren<br>Parroquia Guerrera Ana Soto Estado Lara<br><u><h4>CONSTANCIA DE RESIDENCIA</h4></u></td><td style='width:10%'></td></tr></table>";

                        break;

                    case "Buena conducta":
                        break;

                    case "No poseer vivienda":
                        break;

                }

                $this->vista->header_constancia = $header_constancia;

                $this->vista->titulo = "Constancia de " . $s['tipo_constancia'];
                $this->vista->Cargar_Vistas('solicitudes/constancia_pdf');

            }
        }

    }

    // ==============================CRUD=====================================

    public function Nueva_solicitud()
    {
        $datos                  = $_POST['datos'];
        $datos['observaciones'] = "";

        echo $this->modelo->Registrar($datos);

    }

    public function Nueva_solicitud_vivienda()
    {
        $datos  = $_POST['datos'];
        $ultimo = $this->Ultimo_Ingresado("vivienda", "id_vivienda");
        $id     = '';
        foreach ($ultimo as $i) {
            $id = $i['MAX(id_vivienda)'];

        }
        $datos['observaciones'] = $id;
        echo $this->modelo->Registrar($datos);

    }

    public function Nueva_solicitud_familia()
    {
        $datos  = $_POST['datos'];
        $ultimo = $this->Ultimo_Ingresado("familia", "id_familia");
        $id     = '';
        foreach ($ultimo as $i) {
            $id = $i['MAX(id_familia)'];

        }
        $datos['observaciones'] = $id;
        echo $this->modelo->Registrar($datos);

    }

    public function Consultar_solicitudes()
    {
        $this->Establecer_Consultas();

        $this->Escribir_JSON($this->datos_solicitudes);
    }

    public function Consultar_solicitudes_vivienda()
    {
        $solicitud                    = $this->modelo->get_solicitud_vivienda($_POST['id']);
        $solicitud[0]['servicio_gas'] = $this->modelo->get_info_vivienda_gas($solicitud[0]['observaciones']);
        $solicitud[0]['tipos_techo']  = $this->modelo->get_info_vivienda_techos($solicitud[0]['observaciones']);
        $solicitud[0]['tipos_piso']   = $this->modelo->get_info_vivienda_pisos($solicitud[0]['observaciones']);
        $solicitud[0]['tipos_pared']  = $this->modelo->get_info_vivienda_paredes($solicitud[0]['observaciones']);
        $solicitud[0]['gas_detalle']  = "<table style='width:100%'><tr><td>Tipo de Bombona</td>";
        $solicitud[0]['gas_detalle'] .= "<td>Días de duración</td></tr>";

        foreach ($solicitud[0]['servicio_gas'] as $g) {
            $solicitud[0]['gas_detalle'] .= "<td>" . $g['tipo_bombona'] . "</td><td>" . $g['dias_duracion'] . "</td></tr>";
        }

        $solicitud[0]['gas_detalle'] .= "</table>";

        $solicitud[0]['electrodomesticos'] = $this->modelo->get_info_vivienda_electrodomesticos($solicitud[0]['observaciones']);

        $this->Escribir_JSON($solicitud);
    }

    public function Consultar_solicitudes_all()
    {
        $solicitudes = $this->modelo->Consultar_all();

        $this->Escribir_JSON($solicitudes);
    }

    public function Set_status()
    {
        $data = [
            "id_solicitud"  => $_POST['id'],
            "procesada"     => $_POST['procesada'],
            "observaciones" => $_POST['observaciones'],
        ];

        $this->modelo->setStatus($data);

    }

}

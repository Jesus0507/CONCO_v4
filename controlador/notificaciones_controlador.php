<?php
require_once 'vista/privado/securimage/securimage.php';
class Notificaciones extends Controlador 
{
    public function __construct()
    {
        parent::__construct();
        $this->vista->mensaje = "";
    //    $this->Cargar_Modelo("notificaciones");
    }
    public function Establecer_Consultas()
    {
        $notificaciones = $this->modelo->Consultar($_SESSION['cedula_usuario']);
        $this->vista->notificaciones = $notificaciones; //datos para mandar a la vista
        $this->datos_notificaciones = $notificaciones; //datos para usar en el controlador
    }
// ==============================VISTAS=====================================

    public function Cargar_Vistas()
    {   
        $this->Establecer_Consultas();
        $this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('notificaciones/index');
    }
    public function Notificacion()
    {
        $this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('notificaciones/consultar');
    }



    // ==============================CRUD=====================================
    
    public function Nueva_notificacion()
    {
       $datos=$_POST['datos'];
       $this->modelo->Registrar($datos);
    }


    public function Consultar_notificaciones()
    {
        $this->Establecer_Consultas();
        
        $this->Escribir_JSON($this->datos_notificaciones);
    }





    public function Set_status(){
        $data=[
              "id_notificacion"=>$_POST['id'],
              "leido"=>1
        ];

        $this->modelo->setStatus($data);
    }



    public function Consultas_Receptores_Ajax(){
        $receptores1=$this->modelo->get_receptores_1();
         // $receptores2=$this->modelo->get_receptores_2();
        
        $retornar=[];

        foreach ($receptores1 as $r) {
            $retornar[]=[
                "cedula_usuario" => $r['cedula_persona']
            ];
        }

        // foreach ($receptores2 as $r) {
        //     $retornar[]=[
        //         "cedula_usuario" => $r['cedula_usuario']
        //     ];
        // }

        $this->Escribir_JSON($retornar);


    }




}



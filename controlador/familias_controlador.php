<?php

class Familias extends Controlador
{
    public function __construct() 
    {
        parent::__construct();
     //   $this->Cargar_Modelo("familias");
    }

    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        $this->vista->Cargar_Vistas('familia/consultar'); 
    }   
    public function Registros()
    {
        $this->Seguridad_de_Session();
        $viviendas=$this->modelo->Consultar_viviendas();
        $this->vista->viviendas=$viviendas;
        $persona=$this->modelo->Consultar_personas();
        $this->vista->personas=$persona;
        $this->vista->Cargar_Vistas('familia/registrar');
    }

    public function Consultas()
    {
        $this->Seguridad_de_Session();
        #$this->Establecer_Consultas();
         $viviendas=$this->modelo->Consultar_viviendas();
        $this->vista->viviendas=$viviendas;
        $persona=$this->modelo->Consultar_personas();
        $this->vista->personas=$persona;
        $this->vista->Cargar_Vistas('familia/consultar');
    }

    public function registrar_familia(){
        $datos_familia=$_POST['datos'];

        $resultado= $this->modelo->Registrar_Familia($datos_familia);
        
        if($resultado){
           $id=$this->Ultimo_Ingresado("familia","id_familia");
           foreach ($id as  $i) {
            foreach ($datos_familia['integrantes'] as $inte) {
             $this->modelo->Registrar_persona_familia([
                "cedula_persona"         =>  $inte,
                "id_familia"            =>   $i['MAX(id_familia)']
            ]);
         }
     }
 }
echo $resultado;

}


public function consultar_info_familia(){
     $familias=$this->modelo->get_familias();
     $retornar=[];

     foreach ($familias as $f) {
        
        $integrantes=$this->modelo->get_integrantes($f['id_familia']);
 


         $retornar[]=[
                "familia" => $f['nombre_familia'],
                "telefono" => $f['telefono_familia'],
                "direccion" => $f['direccion_vivienda'],
                "Nro Casa" => $f['numero_casa'],
                "ingreso_mensual"=> $f['ingreso_mensual_aprox'],
                "ver"  => "<button class='btn btn-primary' onclick='ver_familia(`".json_encode($integrantes)."`,`".$f['nombre_familia']."`,`".$f['telefono_familia']."`,`".$f['direccion_vivienda']."`,`".$f['numero_casa']."`,`".$f['ingreso_mensual_aprox']."`)' type='button'><em class='fa fa-eye'></em></button>",
                "editar" => "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#actualizar' onclick='editar(".$f['id_familia'].",".$f['id_familia_persona'].")'><em class='fa fa-edit'></em></button>",
                "eliminar" =>"<button class='btn btn-danger' onclick='eliminar(`".$f['id_familia']."`)' type='button'><em class='fa fa-trash'></em></button>"
         ];
     }

      


     $this->Escribir_JSON($retornar);
}

public function consultar_familia_datos(){
     
     $familias=$this->modelo->get_familias();
     $retornar=[];

     foreach ($familias as $f) {
        
        if ($f['id_familia'] == $_POST['id_familia']) {
            
            $integrantes=$this->modelo->get_integrantes($_POST['id_familia']);


         $retornar[]=[
                "id_familia" => $f['id_familia'],
                "familia" => $f['nombre_familia'],
                "telefono" => $f['telefono_familia'],
                "direccion" => $f['direccion_vivienda'],
                "id_vivienda" => $f['id_vivienda'],
                "ingreso_mensual"=> $f['ingreso_mensual_aprox'],
                "condicion_ocupacion"=> $f['condicion_ocupacion'],
                "observacion"=> $f['observacion'],
                "integrantes"  => json_encode($integrantes),
         ];
        }
     }

      


     $this->Escribir_JSON($retornar);
}


public function eliminar_logica(){
  echo $this->Desactivar("familia","id_familia",$_POST['id']);
}

public function eliminar_familia(){
   $integrantes=$this->Consultar_Columna("familia_personas","id_familia",$_POST['id']);

   foreach($integrantes as $i){
       $persona=$this->Consultar_Columna("personas","cedula_persona",$i['cedula_persona']);
       if($persona[0]['estado']==2){
        $this->Eliminar_Tablas("personas","cedula_persona",$persona[0]['cedula_persona']);
       }
   }

    echo $this->Eliminar_Tablas("familia","id_familia",$_POST['id']);
  }

  public function activar_familia(){
    $integrantes=$this->Consultar_Columna("familia_personas","id_familia",$_POST['id_familia']);

    foreach($integrantes as $i){
        $persona=$this->Consultar_Columna("personas","cedula_persona",$i['cedula_persona']);
        if($persona[0]['estado']==2){
         $this->Activar("personas","cedula_persona",$persona[0]['cedula_persona']);
        }
    }
    echo $this->Activar("familia","id_familia",$_POST['id_familia']);
  }

  public function eliminar_integrantes(){
  $retornar=0;
  
  if($this->Eliminar_Tablas("familia_personas","cedula_persona",$_POST['cedula_persona'])){
    $integrantes=$this->Consultar_Columna("familia_personas","cedula_persona",$_POST['cedula_persona']);
    if(count($integrantes)!=0){
      $retornar=[];
      for($i=0;$i<count($integrantes);$i++){

         $retornar[]=[
           "cedula_persona"=>$integrantes[0]['cedula_persona'],
           "id_familia_persona"=>$integrantes[$i]['id_familia_persona']
         ];
      }
    }
  }

  echo json_encode($retornar);

}

  public function actualizar_familia(){
        $datos_familia=$_POST['datos'];

        $resultado= $this->modelo->Actualizar_Familia($datos_familia);
        
        if($resultado){
           $id=$this->Ultimo_Ingresado("familia","id_familia");
           foreach ($id as  $i) {
            foreach ($datos_familia['integrantes'] as $inte) {
             $this->modelo->Registrar_persona_familia([
                "cedula_persona"         =>  $inte,
                "id_familia"            =>   $i['MAX(id_familia)']
            ]);
         }
     }
 }
echo $resultado;

}


}

?> 
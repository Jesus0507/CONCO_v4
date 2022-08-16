<?php

class Solicitudes_Class extends Modelo 
{

    public function __construct()
    {   
        parent::__construct();
    }

    public function Registrar($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO solicitudes (
                cedula_persona, 
                tipo_constancia, 
                procesada, 
                motivo_constancia,
                observaciones
                ) VALUES (
                :cedula_persona,
                :tipo_constancia, 
                :procesada, 
                :motivo_constancia,
                :observaciones
                )');

            $datos->execute([
                'cedula_persona'      => $data['cedula_persona'],
                'tipo_constancia'    => $data['tipo_constancia'],
                'procesada'      => 0,
                'motivo_constancia'     => $data['motivo_constancia'],
                'observaciones'    => $data['observaciones']
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }


    public function Consultar()
      {

        $tabla            = "SELECT S.*, P.* FROM solicitudes S, personas P WHERE S.procesada = 0 AND P.cedula_persona = S.cedula_persona AND P.estado=1";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }

    }

    public function Consultar_all()
      {

        $tabla            = "SELECT S.*, P.* FROM solicitudes S, personas P WHERE  P.cedula_persona = S.cedula_persona AND P.estado=1";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }

    }


    public function get_solicitud_vivienda($id)
      {

        $tabla  = "SELECT S.*, V.*, P.*, C.*, TV.*, SE.* FROM solicitudes S, personas P, vivienda V, calles C, tipo_vivienda TV, servicios SE 
        WHERE  P.cedula_persona = S.cedula_persona AND S.id_solicitud='$id' AND C.id_calle=V.id_calle 
        AND TV.id_tipo_vivienda=V.id_tipo_vivienda AND V.id_servicio=SE.id_servicio AND V.id_vivienda=S.observaciones";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }

    }

    public function get_info_vivienda_gas($id)
    {

      $tabla  = "SELECT VSG.*, SG.* FROM vivienda_servicio_gas VSG, servicio_gas SG
      WHERE  VSG.id_vivienda = '$id' AND SG.id_servicio_gas=VSG.id_servicio_gas";
      $respuesta_arreglo = '';
      try {
          $datos = $this->conexion->prepare($tabla);
          $datos->execute();
          $datos->setFetchMode(PDO::FETCH_ASSOC);
          $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
          return $respuesta_arreglo;
      } catch (PDOException $e) {

          return $this->Capturar_Error($e);
      }

  }

  public function get_info_vivienda_techos($id)
    {

      $tabla  = "SELECT VTT.*, TT.* FROM vivienda_tipo_techo VTT, tipo_techo TT
      WHERE  VTT.id_vivienda = '$id' AND TT.id_tipo_techo=VTT.id_tipo_techo";
      $respuesta_arreglo = '';
      try {
          $techos="";
          $datos = $this->conexion->prepare($tabla);
          $datos->execute();
          $datos->setFetchMode(PDO::FETCH_ASSOC);
          foreach($datos->fetchAll(PDO::FETCH_ASSOC) as $v){
             $techos.=$v['techo']."<hr>";
          }
          return $techos;
      } catch (PDOException $e) {

          return $this->Capturar_Error($e);
      }

  }

  public function get_info_vivienda_pisos($id)
  {

    $tabla  = "SELECT VTP.*, TP.* FROM vivienda_tipo_piso VTP, tipo_piso TP
    WHERE  VTP.id_vivienda = '$id' AND TP.id_tipo_piso=VTP.id_tipo_piso";
    $respuesta_arreglo = '';
    try {
        $pisos="";
        $datos = $this->conexion->prepare($tabla);
        $datos->execute();
        $datos->setFetchMode(PDO::FETCH_ASSOC);
        foreach($datos->fetchAll(PDO::FETCH_ASSOC) as $v){
           $pisos.=$v['piso']."<hr>";
        }
        return $pisos;
    } catch (PDOException $e) {

        return $this->Capturar_Error($e);
    }

}

public function get_info_vivienda_paredes($id)
{

  $tabla  = "SELECT VTP.*, TP.* FROM vivienda_tipo_pared VTP, tipo_pared TP
  WHERE  VTP.id_vivienda = '$id' AND TP.id_tipo_pared=VTP.id_tipo_pared";
  $respuesta_arreglo = '';
  try {
      $pared="";
      $datos = $this->conexion->prepare($tabla);
      $datos->execute();
      $datos->setFetchMode(PDO::FETCH_ASSOC);
      foreach($datos->fetchAll(PDO::FETCH_ASSOC) as $v){
         $pared.=$v['pared']."<hr>";
      }
      return $pared;
  } catch (PDOException $e) {

      return $this->Capturar_Error($e);
  }

}

public function get_info_vivienda_electrodomesticos($id)
{

  $tabla  = "SELECT VE.*, E.* FROM vivienda_electrodomesticos VE, electrodomesticos E
  WHERE  VE.id_vivienda = '$id' AND E.id_electrodomestico=VE.id_electrodomestico";
  try {
      $electrodomestico="<table style='width:100%'><tr><td>Electrodoméstico</td><td>Cantidad</td></tr>";
      $datos = $this->conexion->prepare($tabla);
      $datos->execute();
      $datos->setFetchMode(PDO::FETCH_ASSOC);
      foreach($datos->fetchAll(PDO::FETCH_ASSOC) as $v){
         $electrodomestico.="<tr><td>".$v['nombre_electrodomestico']."</td><td>".$v['cantidad']."</td></tr>";
      }
      $electrodomestico.="</table>";
      return $electrodomestico;
  } catch (PDOException $e) {

      return $this->Capturar_Error($e);
  }

}


     public function setStatus($data)
    { 

        $sql     = 'UPDATE solicitudes SET procesada =:procesada, observaciones=:observaciones WHERE id_solicitud = :id_solicitud'; 
        $arreglo = '';

        try {

            $datos = $this->conexion->prepare($sql);

            $datos->execute([
                'procesada'     => $data['procesada'],
                'id_solicitud'     => $data['id_solicitud'],
                'observaciones'=>$data['observaciones']
             ]);

            return true;

        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }



    //=======================================================================


}

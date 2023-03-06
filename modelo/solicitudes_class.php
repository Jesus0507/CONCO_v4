<?php

class Solicitudes_Class extends Modelo
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.

    private $SQL;           #nombre de la sentencia SQL que se ejecutara en el modelo
    private $tipo;          #tipo de peticion que usaremos 1/0
    private $PDO;           #sentecia sql iniciada con prepare
    private $sentencia;     #sentencia sql que se ejecutara
    private $datos;         #datos a ejecutar para enviar a la bd
    public  $resultado;     #resultado de consultas de la bd
    private $id;

    public function __construct(){parent::__construct();}

    // SETTER estaablece los datos a usar en el modelo (tipo void no retornan un valor)
    public function _SQL_(string $SQL): void        {$this->SQL = $SQL;}
    public function _Tipo_(int $tipo): void         {$this->tipo = $tipo;}
    public function _Datos_(array $datos): void     {$this->datos = $datos;}
    public function _Estado_(array $estado): void   {$this->estado = $estado;}
    public function _ID_(string $id): void          {$this->id = $id;}
    
    public function Administrar()
    {
        $this->sentencia = $this->{$this->SQL}(); #funcion anonima en espera de asignar nombre
        try {
            switch ($this->tipo) {
                case '0':           #tipo 0 trae consultas de la bd retorna a un array con los datos 
                    $this->conexion->beginTransaction(); # Inicia una transacción
                    $this->PDO = $this->conexion->prepare($this->sentencia);
                    $this->PDO->execute();
                    $this->conexion->commit(); #Consigna una transacción
                    $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
                    $this->resultado = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
                    return $this->resultado;
                    break;
                case '1':       #tipo 1 ejecuta un INSERT , UPDATE, DELETE  retorna a true (si no hay falla)
                    $this->conexion->beginTransaction();
                    $this->PDO = $this->conexion->prepare($this->sentencia);
                    $this->PDO->execute($this->datos);
                    $this->conexion->commit();
                    return true;
                    break;
                default:        # mensaje error si la peticion fue incorrecta
                    die('[Error 400] => "La Peticion es Incorrecta, solo se permite peticion de tipo 0/1."');
                    break;
            }
        } catch (PDOException $e) { #capturamos el error y se envia la respuesta(ubicacion MODELO)
            return $this->Capturar_Error($e, "Solicitudes"); 
        }
    }

    // ===============================================================================

    #sentecias sql en espera de ser llamadas retornan string
    
    private function SQL_01():string
    {
        return "INSERT INTO solicitudes (cedula_persona,tipo_constancia,procesada,motivo_constancia,observaciones) VALUES (:cedula_persona,:tipo_constancia,:procesada,:motivo_constancia,:observaciones)";
    }

    private function SQL_02():string
    {
        return "SELECT S.*, P.* FROM solicitudes S, personas P WHERE S.procesada = 0 OR S.procesada=3 AND P.cedula_persona = S.cedula_persona AND P.estado=1";
    }

    private function SQL_03():string
    {
        return "SELECT S.*, P.* FROM solicitudes S, personas P WHERE  P.cedula_persona = S.cedula_persona AND P.estado=1";
    }

    private function SQL_04():string
    {
        return "SELECT S.*, V.*, P.*, C.*, TV.*, SE.* FROM solicitudes S, personas P, vivienda V, calles C, tipo_vivienda TV, servicios SE
        WHERE  P.cedula_persona = S.cedula_persona AND S.id_solicitud = $this->id AND C.id_calle=V.id_calle
        AND TV.id_tipo_vivienda=V.id_tipo_vivienda AND V.id_servicio=SE.id_servicio AND V.id_vivienda=S.observaciones";
    }

    private function SQL_05():string
    {
        return "SELECT VSG.*, SG.* FROM vivienda_servicio_gas VSG, servicio_gas SG WHERE  VSG.id_vivienda = $this->id AND SG.id_servicio_gas=VSG.id_servicio_gas";
    }

    private function SQL_06():string
    {
        return "SELECT VTT.*, TT.* FROM vivienda_tipo_techo VTT, tipo_techo TT WHERE  VTT.id_vivienda = $this->id AND TT.id_tipo_techo=VTT.id_tipo_techo";
    }

    private function SQL_07():string
    {
        return "SELECT VTP.*, TP.* FROM vivienda_tipo_piso VTP, tipo_piso TP WHERE  VTP.id_vivienda = $this->id AND TP.id_tipo_piso=VTP.id_tipo_piso";
    }

    private function SQL_08():string
    {
        return "SELECT VTP.*, TP.* FROM vivienda_tipo_pared VTP, tipo_pared TP WHERE  VTP.id_vivienda = $this->id AND TP.id_tipo_pared=VTP.id_tipo_pared";
    }

    private function SQL_09():string
    {
        return "SELECT VE.*, E.* FROM vivienda_electrodomesticos VE, electrodomesticos E
            WHERE  VE.id_vivienda = $this->id AND E.id_electrodomestico=VE.id_electrodomestico";
    }

    private function SQL_10():string
    {
        return "UPDATE solicitudes SET procesada =:procesada, observaciones=:observaciones WHERE id_solicitud = :id_solicitud";
    }

    public function SQL_11():string
    {
        return "SELECT S.* , P.*  FROM solicitudes S, personas P WHERE S.id_solicitud = $this->id AND S.procesada = 0 AND P.cedula_persona = S.cedula_persona AND P.estado = 1";
    }



    // public function Registrar($data)
    // {
    //     try {
    //         $datos = $this->conexion->prepare('INSERT INTO solicitudes (
    //             cedula_persona,
    //             tipo_constancia,
    //             procesada,
    //             motivo_constancia,
    //             observaciones
    //             ) VALUES (
    //             :cedula_persona,
    //             :tipo_constancia,
    //             :procesada,
    //             :motivo_constancia,
    //             :observaciones
    //             )');

    //         $datos->execute([
    //             'cedula_persona'    => $data['cedula_persona'],
    //             'tipo_constancia'   => $data['tipo_constancia'],
    //             'procesada'         => 0,
    //             'motivo_constancia' => $data['motivo_constancia'],
    //             'observaciones'     => $data['observaciones'],
    //         ]);

    //         return true;

    //     } catch (PDOException $e) {
    //         return $this->Capturar_Error($e,"Solicitudes");
    //     }
    // }

    // public function Consultar()
    // {

    //     $tabla             = "SELECT S.*, P.* FROM solicitudes S, personas P WHERE S.procesada = 0 OR S.procesada=3 AND P.cedula_persona = S.cedula_persona AND P.estado=1";
    //     $respuesta_arreglo = '';
    //     try {
    //         $datos = $this->conexion->prepare($tabla);
    //         $datos->execute();
    //         $datos->setFetchMode(PDO::FETCH_ASSOC);
    //         $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
    //         return $respuesta_arreglo;
    //     } catch (PDOException $e) {

    //         return $this->Capturar_Error($e,"Solicitudes");
    //     }

    // }

    // public function Consultar_all()
    // {

    //     $tabla             = "SELECT S.*, P.* FROM solicitudes S, personas P WHERE  P.cedula_persona = S.cedula_persona AND P.estado=1";
    //     $respuesta_arreglo = '';
    //     try {
    //         $datos = $this->conexion->prepare($tabla);
    //         $datos->execute();
    //         $datos->setFetchMode(PDO::FETCH_ASSOC);
    //         $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
    //         return $respuesta_arreglo;
    //     } catch (PDOException $e) {

    //         return $this->Capturar_Error($e,"Solicitudes");
    //     }

    // }

    // public function get_solicitud_vivienda($id)
    // {

    //     $tabla = "SELECT S.*, V.*, P.*, C.*, TV.*, SE.* FROM solicitudes S, personas P, vivienda V, calles C, tipo_vivienda TV, servicios SE
    //     WHERE  P.cedula_persona = S.cedula_persona AND S.id_solicitud='$id' AND C.id_calle=V.id_calle
    //     AND TV.id_tipo_vivienda=V.id_tipo_vivienda AND V.id_servicio=SE.id_servicio AND V.id_vivienda=S.observaciones";
    //     $respuesta_arreglo = '';
    //     try {
    //         $datos = $this->conexion->prepare($tabla);
    //         $datos->execute();
    //         $datos->setFetchMode(PDO::FETCH_ASSOC);
    //         $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
    //         return $respuesta_arreglo;
    //     } catch (PDOException $e) {

    //         return $this->Capturar_Error($e,"Solicitudes");
    //     }

    // }

    // public function get_info_vivienda_gas($id)
    // {

    //     $tabla = "SELECT VSG.*, SG.* FROM vivienda_servicio_gas VSG, servicio_gas SG
    //   WHERE  VSG.id_vivienda = '$id' AND SG.id_servicio_gas=VSG.id_servicio_gas";
    //     $respuesta_arreglo = '';
    //     try {
    //         $datos = $this->conexion->prepare($tabla);
    //         $datos->execute();
    //         $datos->setFetchMode(PDO::FETCH_ASSOC);
    //         $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
    //         return $respuesta_arreglo;
    //     } catch (PDOException $e) {

    //         return $this->Capturar_Error($e,"Solicitudes");
    //     }

    // }

    // public function get_info_vivienda_techos($id)
    // {

    //     $tabla = "SELECT VTT.*, TT.* FROM vivienda_tipo_techo VTT, tipo_techo TT
    //   WHERE  VTT.id_vivienda = '$id' AND TT.id_tipo_techo=VTT.id_tipo_techo";
    //     $respuesta_arreglo = '';
    //     try {
    //         $techos = "";
    //         $datos  = $this->conexion->prepare($tabla);
    //         $datos->execute();
    //         $datos->setFetchMode(PDO::FETCH_ASSOC);
    //         foreach ($datos->fetchAll(PDO::FETCH_ASSOC) as $v) {
    //             $techos .= $v['techo'] . "<hr>";
    //         }
    //         return $techos;
    //     } catch (PDOException $e) {

    //         return $this->Capturar_Error($e,"Solicitudes");
    //     }

    // }

    // public function get_info_vivienda_pisos($id)
    // {

    //     $tabla = "SELECT VTP.*, TP.* FROM vivienda_tipo_piso VTP, tipo_piso TP
    //     WHERE  VTP.id_vivienda = '$id' AND TP.id_tipo_piso=VTP.id_tipo_piso";
    //     $respuesta_arreglo = '';
    //     try {
    //         $pisos = "";
    //         $datos = $this->conexion->prepare($tabla);
    //         $datos->execute();
    //         $datos->setFetchMode(PDO::FETCH_ASSOC);
    //         foreach ($datos->fetchAll(PDO::FETCH_ASSOC) as $v) {
    //             $pisos .= $v['piso'] . "<hr>";
    //         }
    //         return $pisos;
    //     } catch (PDOException $e) {

    //         return $this->Capturar_Error($e,"Solicitudes");
    //     }

    // }

    // public function get_info_vivienda_paredes($id)
    // {

    //     $tabla = "SELECT VTP.*, TP.* FROM vivienda_tipo_pared VTP, tipo_pared TP
    //      WHERE  VTP.id_vivienda = '$id' AND TP.id_tipo_pared=VTP.id_tipo_pared";
    //     $respuesta_arreglo = '';
    //     try {
    //         $pared = "";
    //         $datos = $this->conexion->prepare($tabla);
    //         $datos->execute();
    //         $datos->setFetchMode(PDO::FETCH_ASSOC);
    //         foreach ($datos->fetchAll(PDO::FETCH_ASSOC) as $v) {
    //             $pared .= $v['pared'] . "<hr>";
    //         }
    //         return $pared;
    //     } catch (PDOException $e) {

    //         return $this->Capturar_Error($e,"Solicitudes");
    //     }

    // }

    // public function get_info_vivienda_electrodomesticos($id)
    // {

    //     $tabla = "SELECT VE.*, E.* FROM vivienda_electrodomesticos VE, electrodomesticos E
    //         WHERE  VE.id_vivienda = '$id' AND E.id_electrodomestico=VE.id_electrodomestico";
    //     try {
    //         $electrodomestico = "<table style='width:100%'><tr><td>Electrodoméstico</td><td>Cantidad</td></tr>";
    //         $datos            = $this->conexion->prepare($tabla);
    //         $datos->execute();
    //         $datos->setFetchMode(PDO::FETCH_ASSOC);
    //         foreach ($datos->fetchAll(PDO::FETCH_ASSOC) as $v) {
    //             $electrodomestico .= "<tr><td>" . $v['nombre_electrodomestico'] . "</td><td>" . $v['cantidad'] . "</td></tr>";
    //         }
    //         $electrodomestico .= "</table>";
    //         return $electrodomestico;
    //     } catch (PDOException $e) {

    //         return $this->Capturar_Error($e,"Solicitudes");
    //     }

    // }

    // public function setStatus($data)
    // {

    //     $sql     = 'UPDATE solicitudes SET procesada =:procesada, observaciones=:observaciones WHERE id_solicitud = :id_solicitud';
    //     $arreglo = '';

    //     try {

    //         $datos = $this->conexion->prepare($sql);

    //         $datos->execute([
    //             'procesada'     => $data['procesada'],
    //             'id_solicitud'  => $data['id_solicitud'],
    //             'observaciones' => $data['observaciones'],
    //         ]);

    //         return true;

    //     } catch (PDOException $e) {

    //         return $this->Capturar_Error($e,"Solicitudes");
    //     }
    // }

}

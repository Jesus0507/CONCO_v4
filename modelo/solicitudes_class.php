<?php

class Solicitudes_Class extends Modelo
{
    public function __construct()
    {parent::__construct();}

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
                'cedula_persona'    => $data['cedula_persona'],
                'tipo_constancia'   => $data['tipo_constancia'],
                'procesada'         => 0,
                'motivo_constancia' => $data['motivo_constancia'],
                'observaciones'     => $data['observaciones'],
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    public function Consultar()
    {

        $tabla             = "SELECT S.*, P.* FROM solicitudes S, personas P WHERE S.procesada = 0 AND P.cedula_persona = S.cedula_persona AND P.estado=1";
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

        $tabla             = "SELECT S.*, P.* FROM solicitudes S, personas P WHERE  P.cedula_persona = S.cedula_persona AND P.estado=1";
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

        $tabla = "SELECT S.*, V.*, P.*, C.*, TV.*, SE.* FROM solicitudes S, personas P, vivienda V, calles C, tipo_vivienda TV, servicios SE
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

        $tabla = "SELECT VSG.*, SG.* FROM vivienda_servicio_gas VSG, servicio_gas SG
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

        $tabla = "SELECT VTT.*, TT.* FROM vivienda_tipo_techo VTT, tipo_techo TT
      WHERE  VTT.id_vivienda = '$id' AND TT.id_tipo_techo=VTT.id_tipo_techo";
        $respuesta_arreglo = '';
        try {
            $techos = "";
            $datos  = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($datos->fetchAll(PDO::FETCH_ASSOC) as $v) {
                $techos .= $v['techo'] . "<hr>";
            }
            return $techos;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }

    }

    public function get_info_vivienda_pisos($id)
    {

        $tabla = "SELECT VTP.*, TP.* FROM vivienda_tipo_piso VTP, tipo_piso TP
        WHERE  VTP.id_vivienda = '$id' AND TP.id_tipo_piso=VTP.id_tipo_piso";
        $respuesta_arreglo = '';
        try {
            $pisos = "";
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($datos->fetchAll(PDO::FETCH_ASSOC) as $v) {
                $pisos .= $v['piso'] . "<hr>";
            }
            return $pisos;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }

    }

    public function get_info_vivienda_paredes($id)
    {

        $tabla = "SELECT VTP.*, TP.* FROM vivienda_tipo_pared VTP, tipo_pared TP
         WHERE  VTP.id_vivienda = '$id' AND TP.id_tipo_pared=VTP.id_tipo_pared";
        $respuesta_arreglo = '';
        try {
            $pared = "";
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($datos->fetchAll(PDO::FETCH_ASSOC) as $v) {
                $pared .= $v['pared'] . "<hr>";
            }
            return $pared;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }

    }

    public function get_info_vivienda_electrodomesticos($id)
    {

        $tabla = "SELECT VE.*, E.* FROM vivienda_electrodomesticos VE, electrodomesticos E
            WHERE  VE.id_vivienda = '$id' AND E.id_electrodomestico=VE.id_electrodomestico";
        try {
            $electrodomestico = "<table style='width:100%'><tr><td>Electrodoméstico</td><td>Cantidad</td></tr>";
            $datos            = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($datos->fetchAll(PDO::FETCH_ASSOC) as $v) {
                $electrodomestico .= "<tr><td>" . $v['nombre_electrodomestico'] . "</td><td>" . $v['cantidad'] . "</td></tr>";
            }
            $electrodomestico .= "</table>";
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
                'id_solicitud'  => $data['id_solicitud'],
                'observaciones' => $data['observaciones'],
            ]);

            return true;

        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    //=======================================================================

    public function Administrar()
    {
        $this->sentencia = $this->{$this->SQL}();
        try {
            switch ($this->tipo) {
                case '0':
                    return $this->Resultado_Consulta();
                    break;
                case '1':
                    return $this->Ejecutar_Tarea();
                    break;
                default:
                    die('[Error 400] => "La Peticion es Incorrecta, solo se permite peticion de tipo 0/1."');
                    break;
            }
        } catch (PDOException $e) {
            return $this->Capturar_Error($e, "Solicitudes");
        }
    }
    //=======================================================================

    private function SQL_01()
    {
        return "INSERT INTO solicitudes (cedula_persona, tipo_constancia, procesada, motivo_constancia, observaciones) VALUES (:cedula_persona, :tipo_constancia, :procesada, :motivo_constancia, :observaciones)";
    }

    private function SQL_02()
    {
        return "SELECT S.*, P.* FROM solicitudes S, personas P WHERE S.procesada = 0 AND P.cedula_persona = S.cedula_persona AND P.estado=1";
    }

    private function SQL_03()
    {
        return "SELECT S.*, P.* FROM solicitudes S, personas P WHERE  P.cedula_persona = S.cedula_persona AND P.estado=1";
    }

    private function SQL_04()
    {
        return "SELECT S.*, V.*, P.*, C.*, TV.*, SE.* FROM solicitudes S, personas P, vivienda V, calles C, tipo_vivienda TV, servicios SE WHERE  P.cedula_persona = S.cedula_persona AND S.id_solicitud='$id' AND C.id_calle=V.id_calle AND TV.id_tipo_vivienda=V.id_tipo_vivienda AND V.id_servicio=SE.id_servicio AND V.id_vivienda=S.observaciones";
    }

    private function SQL_05()
    {
        return "SELECT VSG.*, SG.* FROM vivienda_servicio_gas VSG, servicio_gas SG WHERE  VSG.id_vivienda = $this->id AND SG.id_servicio_gas=VSG.id_servicio_gas";
    }

    private function SQL_06()
    {
        return "SELECT VTT.*, TT.* FROM vivienda_tipo_techo VTT, tipo_techo TT WHERE  VTT.id_vivienda = $this->id AND TT.id_tipo_techo=VTT.id_tipo_techo";
    }
    private function SQL_07()
    {
        return "SELECT VTP.*, TP.* FROM vivienda_tipo_piso VTP, tipo_piso TP WHERE  VTP.id_vivienda = $this->id AND TP.id_tipo_piso=VTP.id_tipo_piso";
    }
    private function SQL_08()
    {
        return "SELECT VTP.*, TP.* FROM vivienda_tipo_pared VTP, tipo_pared TP WHERE  VTP.id_vivienda = $this->id AND TP.id_tipo_pared=VTP.id_tipo_pared";
    }

    private function SQL_09()
    {
        return "SELECT VE.*, E.* FROM vivienda_electrodomesticos VE, electrodomesticos E WHERE  VE.id_vivienda = $this->id AND E.id_electrodomestico=VE.id_electrodomestico";
    }
    private function SQL_10()
    {
        return "UPDATE solicitudes SET procesada =:procesada, observaciones=:observaciones WHERE id_solicitud = :id_solicitud";
    }

}

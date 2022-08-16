<?php

class Viviendas_Class extends Modelo
{

    public function __construct()
    {
        parent::__construct();
    }

    public function Consultar()
    {

        $tabla             = "SELECT V.*, C.*, T.*, S.* FROM vivienda V, calles C, tipo_vivienda T, servicios S WHERE V.estado = 1 AND V.id_calle = c.id_calle AND V.id_tipo_vivienda = T.id_tipo_vivienda AND V.id_servicio = S.id_servicio   ORDER BY V.numero_casa ASC";
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

    public function Consultar_Servicios()
    {

        $tabla             = "SELECT s.id_servicio, s.id_agua_consumo, ac.nombre_agua_consumo, s.id_aguas_negras, an.nombre_aguas_negras, s.id_residuos_solidos, rs.nombre_residuos, s.id_television, tv.nombre_television, cable_telefonico, internet, servicio_electrico, s.estado FROM servicios s INNER JOIN agua_consumo ac, aguas_negras an, residuos_solidos rs, television tv WHERE s.estado = 1 AND s.id_agua_consumo = ac.id_agua_consumo AND s.id_aguas_negras = an.id_aguas_negras AND s.id_residuos_solidos = rs.id_residuos_solidos AND s.id_television = tv.id_television";
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

    public function get_techos_vivienda($id)
    {

        $tabla            = "SELECT TT.*,VT.id_vivienda_tipo_techo FROM  vivienda_tipo_techo VT, tipo_techo TT WHERE VT.id_vivienda = $id AND VT.id_tipo_techo = TT.id_tipo_techo AND VT.estado = 1";
        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function get_familia($id)
    {

        $tabla            = "SELECT * FROM  familia WHERE id_vivienda = $id AND  estado = 1";
        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function get_pisos_vivienda($id)
    {

        $tabla            = "SELECT TP.*,VP.id_vivienda_tipo_piso FROM  vivienda_tipo_piso VP, tipo_piso TP WHERE VP.id_vivienda = $id AND VP.id_tipo_piso = TP.id_tipo_piso AND VP.estado = 1";
        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function get_paredes_vivienda($id)
    {

        $tabla            = "SELECT TPA.*, VPA.id_vivienda_tipo_pared FROM  vivienda_tipo_pared VPA, tipo_pared TPA WHERE VPA.id_vivienda = $id AND VPA.id_tipo_pared = TPA.id_tipo_pared AND VPA.estado = 1";
        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function get_gas_vivienda($id)
    {

        $tabla            = "SELECT SG.*, VSG.* FROM  vivienda_servicio_gas VSG, servicio_gas SG WHERE VSG.id_vivienda = $id AND VSG.id_servicio_gas = SG.id_servicio_gas AND VSG.estado = 1";
        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function get_electrodomesticos_vivienda($id)
    {

        $tabla            = "SELECT E.*,VE.* FROM vivienda_electrodomesticos VE, electrodomesticos E WHERE VE.id_vivienda = $id AND VE.id_electrodomestico = E.id_electrodomestico AND VE.estado = 1";
        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function Registrar($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO vivienda (
            id_calle,
            id_tipo_vivienda,
            id_servicio,
            direccion_vivienda,
            numero_casa ,
            cantidad_habitaciones,
            espacio_siembra,
            hacinamiento,
            banio_sanitario,
            condicion,
            descripcion,
            animales_domesticos,
            insectos_roedores,
            estado
            ) VALUES (
            :id_calle,
            :id_tipo_vivienda,
            :id_servicio,
            :direccion_vivienda,
            :numero_casa    ,
            :cantidad_habitaciones,
            :espacio_siembra,
            :hacinamiento,
            :banio_sanitario,
            :condicion,
            :descripcion,
            :animales_domesticos,
            :insectos_roedores,
            :estado
        )');

            $datos->execute([
                'id_calle'              => $data['id_calle'],
                'id_tipo_vivienda'      => $data['id_tipo_vivienda'],
                'id_servicio'           => $data['id_servicio'],
                'direccion_vivienda'    => $data['direccion_vivienda'],
                'numero_casa'           => $data['numero_casa'],
                'cantidad_habitaciones' => $data['cantidad_habitaciones'],
                'espacio_siembra'       => $data['espacio_siembra'],
                'hacinamiento'          => $data['hacinamiento'],
                'banio_sanitario'       => $data['banio_sanitario'],
                'condicion'             => $data['condicion'],
                'descripcion'           => $data['descripcion'],
                'animales_domesticos'   => $data['animales_domesticos'],
                'insectos_roedores'     => $data['insectos_roedores'],
                'estado'                => $data['estado'],
            ]);

            return true;
        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    public function Actualizar($data)
    {

        try {
            $datos = $this->conexion->prepare('UPDATE vivienda SET
           id_calle                 = :id_calle,
           id_tipo_vivienda         = :id_tipo_vivienda,
           id_servicio              = :id_servicio,
           direccion_vivienda       = :direccion_vivienda,
           numero_casa              = :numero_casa,
           cantidad_habitaciones    = :cantidad_habitaciones,
           espacio_siembra          = :espacio_siembra,
           hacinamiento             = :hacinamiento,
           banio_sanitario          = :banio_sanitario,
           condicion                = :condicion,
           descripcion              = :descripcion,
           animales_domesticos      = :animales_domesticos,
           insectos_roedores        = :insectos_roedores
           WHERE id_vivienda        = :id_vivienda');

            $datos->execute([
                'id_calle'              => $data['id_calle'],
                'id_tipo_vivienda'      => $data['id_tipo_vivienda'],
                'id_servicio'           => $data['id_servicio'],
                'direccion_vivienda'    => $data['direccion_vivienda'],
                'numero_casa'           => $data['numero_casa'],
                'cantidad_habitaciones' => $data['cantidad_habitaciones'],
                'espacio_siembra'       => $data['espacio_siembra'],
                'hacinamiento'          => $data['hacinamiento'],
                'banio_sanitario'       => $data['banio_sanitario'],
                'condicion'             => $data['condicion'],
                'descripcion'           => $data['descripcion'],
                'animales_domesticos'   => $data['animales_domesticos'],
                'insectos_roedores'     => $data['insectos_roedores'],
                'id_vivienda'           => $data['id_vivienda'],
            ]);

            return true;
        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    public function Registrar_Servicios($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO servicios(
            agua_consumo,
            aguas_negras,
            residuos_solidos,
            cable_telefonico,
            internet,
            servicio_electrico,
            estado
            ) VALUES (
            :agua_consumo,
            :aguas_negras,
            :residuos_solidos,
            :cable_telefonico,
            :internet,
            :servicio_electrico,
            :estado
        )');

            $datos->execute([
                'agua_consumo'       => $data['agua_consumo'],
                'aguas_negras'       => $data['aguas_negras'],
                'residuos_solidos'   => $data['residuos_solidos'],
                'cable_telefonico'   => $data['cable_telefonico'],
                'internet'           => $data['internet'],
                'servicio_electrico' => $data['servicio_electrico'],
                'estado'             => $data['estado'],
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    public function Registrar_Techos($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO vivienda_tipo_techo(
            id_tipo_techo,
            id_vivienda,
            estado
            ) VALUES (
            :id_tipo_techo,
            :id_vivienda,
            :estado
        )');

            $datos->execute([
                'id_tipo_techo' => $data['id_tipo_techo'],
                'id_vivienda'   => $data['id_vivienda'],
                'estado'        => $data['estado'],
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    public function Registrar_Paredes($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO vivienda_tipo_pared(
            id_tipo_pared,
            id_vivienda,
            estado
            ) VALUES (
            :id_tipo_pared,
            :id_vivienda,
            :estado
        )');

            $datos->execute([
                'id_tipo_pared' => $data['id_tipo_pared'],
                'id_vivienda'   => $data['id_vivienda'],
                'estado'        => $data['estado'],
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    public function Registrar_Pisos($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO vivienda_tipo_piso(
            id_tipo_piso,
            id_vivienda,
            estado
            ) VALUES (
            :id_tipo_piso,
            :id_vivienda,
            :estado
        )');

            $datos->execute([
                'id_tipo_piso' => $data['id_tipo_piso'],
                'id_vivienda'  => $data['id_vivienda'],
                'estado'       => $data['estado'],
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    public function registrar_vivienda_gas($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO vivienda_servicio_gas(
            id_servicio_gas,
            id_vivienda,
            tipo_bombona,
            dias_duracion,
            estado
            ) VALUES (
            :id_servicio_gas,
            :id_vivienda,
            :tipo_bombona,
            :dias_duracion,
            :estado
        )');

            $datos->execute([
                'id_servicio_gas' => $data['id_servicio_gas'],
                'id_vivienda'     => $data['id_vivienda'],
                'tipo_bombona'    => $data['tipo_bombona'],
                'dias_duracion'   => $data['dias_duracion'],
                'estado'          => 1,
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    public function registrar_vivienda_electrodomesticos($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO vivienda_electrodomesticos(
            id_electrodomestico,
            id_vivienda,
            cantidad,
            estado
            ) VALUES (
            :id_electrodomestico,
            :id_vivienda,
            :cantidad,
            :estado
        )');

            $datos->execute([
                'id_electrodomestico' => $data['id_electrodomestico'],
                'id_vivienda'         => $data['id_vivienda'],
                'cantidad'            => $data['cantidad'],
                'estado'              => 1,
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    public function Eliminar($param, $param2)
    {
        try {

            $query = $this->conexion->prepare('DELETE FROM vivienda WHERE id_vivienda = :id_vivienda;
        DELETE FROM servicios WHERE id_servicio=:id_servicio');
            $query->execute([
                'id_vivienda' => $param,
                'id_servicio' => $param2,
            ]);

            return true;

        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }
    // ===============================================================================
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
            return $this->Capturar_Error($e);
        }
    }

    // ===============================================================================

    private function SQL_01()
    {
        return "SELECT V.*, C.*, T.*, S.* FROM vivienda V, calles C, tipo_vivienda T, servicios S WHERE V.estado = 1 AND V.id_calle = c.id_calle AND V.id_tipo_vivienda = T.id_tipo_vivienda AND V.id_servicio = S.id_servicio   ORDER BY V.numero_casa ASC";
    }

    private function SQL_02()
    {
        return "SELECT s.id_servicio, s.id_agua_consumo, ac.nombre_agua_consumo, s.id_aguas_negras, an.nombre_aguas_negras, s.id_residuos_solidos, rs.nombre_residuos, s.id_television, tv.nombre_television, cable_telefonico, internet, servicio_electrico, s.estado FROM servicios s INNER JOIN agua_consumo ac, aguas_negras an, residuos_solidos rs, television tv WHERE s.estado = 1 AND s.id_agua_consumo = ac.id_agua_consumo AND s.id_aguas_negras = an.id_aguas_negras AND s.id_residuos_solidos = rs.id_residuos_solidos AND s.id_television = tv.id_television";
    }

    private function SQL_03()
    {
        return "SELECT TT.*,VT.id_vivienda_tipo_techo FROM  vivienda_tipo_techo VT, tipo_techo TT WHERE VT.id_vivienda = $this->id AND VT.id_tipo_techo = TT.id_tipo_techo AND VT.estado = 1";
    }

    private function SQL_04()
    {
        return "SELECT * FROM  familia WHERE id_vivienda = $this->id AND  estado = 1";
    }

    private function SQL_05()
    {
        return "SELECT TP.*,VP.id_vivienda_tipo_piso FROM  vivienda_tipo_piso VP, tipo_piso TP WHERE VP.id_vivienda = $this->id AND VP.id_tipo_piso = TP.id_tipo_piso AND VP.estado = 1";
    }

    private function SQL_07()
    {
        return "SELECT TPA.*, VPA.id_vivienda_tipo_pared FROM  vivienda_tipo_pared VPA, tipo_pared TPA WHERE VPA.id_vivienda = $this->id AND VPA.id_tipo_pared = TPA.id_tipo_pared AND VPA.estado = 1";
    }

    private function SQL_08()
    {
        return "SELECT SG.*, VSG.* FROM  vivienda_servicio_gas VSG, servicio_gas SG WHERE VSG.id_vivienda = $this->id AND VSG.id_servicio_gas = SG.id_servicio_gas AND VSG.estado = 1";
    }

    private function SQL_09()
    {
        return "SELECT E.*,VE.* FROM vivienda_electrodomesticos VE, electrodomesticos E WHERE VE.id_vivienda = $this->id AND VE.id_electrodomestico = E.id_electrodomestico AND VE.estado = 1";
    }
    private function SQL_10()
    {
        return "INSERT INTO vivienda (id_calle, id_tipo_vivienda, id_servicio, direccion_vivienda, numero_casa , cantidad_habitaciones, espacio_siembra, hacinamiento, banio_sanitario, condicion, descripcion, animales_domesticos, insectos_roedores, estado) VALUES (:id_calle, :id_tipo_vivienda, :id_servicio, :direccion_vivienda, :numero_casa    , :cantidad_habitaciones, :espacio_siembra, :hacinamiento, :banio_sanitario, :condicion, :descripcion, :animales_domesticos, :insectos_roedores, :estado)";
    }
    private function SQL_11()
    {
        return "UPDATE vivienda SET id_calle = :id_calle, id_tipo_vivienda = :id_tipo_vivienda, id_servicio = :id_servicio, direccion_vivienda = :direccion_vivienda, numero_casa = :numero_casa, cantidad_habitaciones = :cantidad_habitaciones, espacio_siembra = :espacio_siembra, hacinamiento = :hacinamiento, banio_sanitario = :banio_sanitario, condicion = :condicion, descripcion = :descripcion, animales_domesticos = :animales_domesticos, insectos_roedores = :insectos_roedores WHERE id_vivienda = :id_vivienda";
    }
    private function SQL_12()
    {
        return "INSERT INTO servicios (agua_consumo, aguas_negras, residuos_solidos, cable_telefonico, internet, servicio_electrico, estado) VALUES (:agua_consumo, :aguas_negras, :residuos_solidos, :cable_telefonico, :internet, :servicio_electrico, :estado)";
    }
    private function SQL_13()
    {
        return "INSERT INTO vivienda_tipo_techo (id_tipo_techo, id_vivienda, estado) VALUES (:id_tipo_techo, :id_vivienda, :estado)";
    }
    private function SQL_14()
    {
        return "INSERT INTO vivienda_tipo_pared (id_tipo_pared, id_vivienda, estado) VALUES (:id_tipo_pared, :id_vivienda, :estado)";
    }
    private function SQL_15()
    {
        return "INSERT INTO vivienda_tipo_piso (id_tipo_piso, id_vivienda, estado) VALUES (:id_tipo_piso, :id_vivienda, :estado)";
    }
    private function SQL_16()
    {
        return "INSERT INTO vivienda_servicio_gas (id_servicio_gas, id_vivienda, tipo_bombona, dias_duracion, estado) VALUES (:id_servicio_gas, :id_vivienda, :tipo_bombona, :dias_duracion, :estado)";
    }
    private function SQL_17()
    {
        return "INSERT INTO vivienda_electrodomesticos (id_electrodomestico, id_vivienda, cantidad, estado) VALUES (:id_electrodomestico, :id_vivienda, :cantidad, :estado)";
    }
    private function SQL_18()
    {
        return "DELETE FROM vivienda WHERE id_vivienda = :id_vivienda;DELETE FROM servicios WHERE id_servicio =:id_servicio";
    }

}

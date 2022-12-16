<?php
 
class Viviendas_Class extends Modelo
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.

    private $SQL;           #nombre de la sentencia SQL que se ejecutara en el modelo
    private $tipo;          #tipo de peticion que usaremos 1/0
    private $PDO;           #sentecia sql iniciada con prepare
    private $sentencia;     #sentencia sql que se ejecutara
    private $datos;         #datos a ejecutar para enviar a la bd
    private $id;
    public  $resultado;     #resultado de consultas de la bd

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
            return $this->Capturar_Error($e, "Viviendas"); 
        }
    }

    // ===============================================================================
    #sentecias sql en espera de ser llamadas retornan string
    private function SQL_01():string
    {
        return "SELECT V.*, C.*, T.*, S.* FROM vivienda V, calles C, tipo_vivienda T, servicios S WHERE V.estado = 1 AND V.id_calle = c.id_calle AND V.id_tipo_vivienda = T.id_tipo_vivienda AND V.id_servicio = S.id_servicio   ORDER BY V.numero_casa ASC";
    }

    private function SQL_02():string
    {
        return "SELECT s.id_servicio, s.id_agua_consumo, ac.nombre_agua_consumo, s.id_aguas_negras, an.nombre_aguas_negras, s.id_residuos_solidos, rs.nombre_residuos, s.id_television, tv.nombre_television, cable_telefonico, internet, servicio_electrico, s.estado FROM servicios s INNER JOIN agua_consumo ac, aguas_negras an, residuos_solidos rs, television tv WHERE s.estado = 1 AND s.id_agua_consumo = ac.id_agua_consumo AND s.id_aguas_negras = an.id_aguas_negras AND s.id_residuos_solidos = rs.id_residuos_solidos AND s.id_television = tv.id_television";
    }

    private function SQL_03():string
    {
        return "SELECT TT.*,VT.id_vivienda_tipo_techo FROM  vivienda_tipo_techo VT, tipo_techo TT WHERE VT.id_vivienda = $this->id AND VT.id_tipo_techo = TT.id_tipo_techo AND VT.estado = 1";
    }

    private function SQL_04():string
    {
        return "SELECT * FROM  familia WHERE id_vivienda = $this->id AND  estado = 1";
    }

    private function SQL_05():string
    {
        return "SELECT TP.*,VP.id_vivienda_tipo_piso FROM  vivienda_tipo_piso VP, tipo_piso TP WHERE VP.id_vivienda = $this->id AND VP.id_tipo_piso = TP.id_tipo_piso AND VP.estado = 1";
    }

    private function SQL_07():string
    {
        return "SELECT TPA.*, VPA.id_vivienda_tipo_pared FROM  vivienda_tipo_pared VPA, tipo_pared TPA WHERE VPA.id_vivienda = $this->id AND VPA.id_tipo_pared = TPA.id_tipo_pared AND VPA.estado = 1";
    }

    private function SQL_08():string
    {
        return "SELECT SG.*, VSG.* FROM  vivienda_servicio_gas VSG, servicio_gas SG WHERE VSG.id_vivienda = $this->id AND VSG.id_servicio_gas = SG.id_servicio_gas AND VSG.estado = 1";
    }

    private function SQL_09():string
    {
        return "SELECT E.*,VE.* FROM vivienda_electrodomesticos VE, electrodomesticos E WHERE VE.id_vivienda = $this->id AND VE.id_electrodomestico = E.id_electrodomestico AND VE.estado = 1";
    }
    private function SQL_10():string
    {
        return "INSERT INTO vivienda (id_calle, id_tipo_vivienda, id_servicio, direccion_vivienda, numero_casa , cantidad_habitaciones, espacio_siembra, hacinamiento, banio_sanitario, condicion, descripcion, animales_domesticos, insectos_roedores, estado) VALUES (:id_calle, :id_tipo_vivienda, :id_servicio, :direccion_vivienda, :numero_casa    , :cantidad_habitaciones, :espacio_siembra, :hacinamiento, :banio_sanitario, :condicion, :descripcion, :animales_domesticos, :insectos_roedores, :estado)";
    }
    private function SQL_11():string
    {
        return "UPDATE vivienda SET id_calle = :id_calle, id_tipo_vivienda = :id_tipo_vivienda, id_servicio = :id_servicio, direccion_vivienda = :direccion_vivienda, numero_casa = :numero_casa, cantidad_habitaciones = :cantidad_habitaciones, espacio_siembra = :espacio_siembra, hacinamiento = :hacinamiento, banio_sanitario = :banio_sanitario, condicion = :condicion, descripcion = :descripcion, animales_domesticos = :animales_domesticos, insectos_roedores = :insectos_roedores WHERE id_vivienda = :id_vivienda";
    }
    private function SQL_12():string
    {
        return "INSERT INTO servicios (agua_consumo, aguas_negras, residuos_solidos, cable_telefonico, internet, servicio_electrico, estado) VALUES (:agua_consumo, :aguas_negras, :residuos_solidos, :cable_telefonico, :internet, :servicio_electrico, :estado)";
    }
    private function SQL_13():string
    {
        return "INSERT INTO vivienda_tipo_techo (id_tipo_techo, id_vivienda, estado) VALUES (:id_tipo_techo, :id_vivienda, :estado)";
    }
    private function SQL_14():string
    {
        return "INSERT INTO vivienda_tipo_pared (id_tipo_pared, id_vivienda, estado) VALUES (:id_tipo_pared, :id_vivienda, :estado)";
    }
    private function SQL_15():string
    {
        return "INSERT INTO vivienda_tipo_piso (id_tipo_piso, id_vivienda, estado) VALUES (:id_tipo_piso, :id_vivienda, :estado)";
    }
    private function SQL_16():string
    {
        return "INSERT INTO vivienda_servicio_gas (id_servicio_gas, id_vivienda, tipo_bombona, dias_duracion, estado) VALUES (:id_servicio_gas, :id_vivienda, :tipo_bombona, :dias_duracion, :estado)";
    }
    private function SQL_17():string
    {
        return "INSERT INTO vivienda_electrodomesticos (id_electrodomestico, id_vivienda, cantidad, estado) VALUES (:id_electrodomestico, :id_vivienda, :cantidad, :estado)";
    }
    private function SQL_18():string
    {
        return "DELETE FROM vivienda WHERE id_vivienda = :id_vivienda;DELETE FROM servicios WHERE id_servicio =:id_servicio";
    }

}

<?php
use PHPUnit\Framework\TestCase;

class ViviendasTest extends TestCase
{
    public function test_Consultar()
    {
        $modelo = new Viviendas_Class();
        $data = $modelo->Consultar();
        $this->assertEquals(count($data), true);
    }
    public function test_Consultar_Servicios()
    {
        $modelo = new Viviendas_Class();
        $data = $modelo->Consultar_Servicios();
        $this->assertEquals(count($data), true);
    }
    public function test_get_techos_vivienda()
    {
        $modelo = new Viviendas_Class();
        $id_vivienda = 2;
        $data = $modelo->get_techos_vivienda($id_vivienda);
        $this->assertEquals(count($data), true);
    }
    public function test_get_familia()
    {
        $modelo = new Viviendas_Class();
        $id_vivienda = 3;
        $data = $modelo->get_familia($id_vivienda);
        $this->assertEquals(count($data), true);
    }
    public function test_get_paredes_vivienda()
    {
        $modelo = new Viviendas_Class();
        $id_vivienda = 2;
        $data = $modelo->get_paredes_vivienda($id_vivienda);
        $this->assertEquals(count($data), true);
    }
    public function test_get_gas_vivienda()
    {
        $modelo = new Viviendas_Class();
        $id_vivienda = 2;
        $data = $modelo->get_gas_vivienda($id_vivienda);
        $this->assertEquals(count($data), true);
    }
    public function test_get_electrodomesticos_vivienda()
    {
        $modelo = new Viviendas_Class();
        $id_vivienda = 2;
        $data = $modelo->get_electrodomesticos_vivienda($id_vivienda);
        $this->assertEquals(count($data), true);
    }
    public function test_Registrar()
    {
        $modelo = new Viviendas_Class();
        $datos = [
            'id_calle' => "3",
            'id_tipo_vivienda' => "2",
            'id_servicio' => "2",
            'direccion_vivienda' => "carrera 2 y 3",
            'numero_casa' => "48-B",
            'cantidad_habitaciones' => "2",
            'espacio_siembra' => "0",
            'hacinamiento' => "0",
            'banio_sanitario' => "1",
            'condicion' => "TERRRIBLE",
            'descripcion' => "MAL ESTADO",
            'animales_domesticos' => "0",
            'insectos_roedores' => "0",];
        $data = $modelo->Registrar([
                'id_calle' => $datos['id_calle'],
                'id_tipo_vivienda' => $datos['id_tipo_vivienda'],
                'id_servicio' => $datos['id_servicio'],
                'direccion_vivienda' => $datos['direccion_vivienda'],
                'numero_casa' => $datos['numero_casa'],
                'cantidad_habitaciones' => $datos['cantidad_habitaciones'],
                'espacio_siembra' => $datos['espacio_siembra'],
                'hacinamiento' => $datos['hacinamiento'],
                'banio_sanitario' => $datos['banio_sanitario'],
                'condicion' => $datos['condicion'],
                'descripcion' => $datos['descripcion'],
                'animales_domesticos' => $datos['animales_domesticos'],
                'insectos_roedores' => $datos['insectos_roedores'],
                'estado' => 1,]);
        $this->assertEquals(count($data), true);
    }
    public function test_Registrar_Servicios()
    {
        $modelo = new Viviendas_Class();
        $datos = [
            'agua_consumo' => "Pipas",
            'aguas_negras' => "pozo septico",
            'residuos_solidos' => "aire libre",
            'cable_telefonico' => "0",
            'internet' => "0",
            'servicio_electrico' => "1",
        ];
        $data = $modelo->Registrar_Servicios(
            [
                'agua_consumo' => $datos['agua_consumo'],
                'aguas_negras' => $datos['aguas_negras'],
                'residuos_solidos' => $datos['residuos_solidos'],
                'cable_telefonico' => $datos['cable_telefonico'],
                'internet' => $datos['internet'],
                'servicio_electrico' => $datos['servicio_electrico'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }
    public function test_Registrar_Techos()
    {
        $modelo = new Viviendas_Class();
        $datos = [
            'id_tipo_techo' => "2",
            'id_vivienda' => "2",
        ];
        $data = $modelo->Registrar_Techos(
            [
                'id_tipo_techo' => $datos['id_tipo_techo'],
                'id_vivienda' => $datos['id_vivienda'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }
    public function test_Registrar_Paredes()
    {
        $modelo = new Viviendas_Class();
        $datos = [
            'id_tipo_pared' => "4",
            'id_vivienda' => "2",
        ];
        $data = $modelo->Registrar_Paredes(
            [
                'id_tipo_pared' => $datos['id_tipo_pared'],
                'id_vivienda' => $datos['id_vivienda'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }
    public function test_Registrar_Pisos()
    {
        $modelo = new Viviendas_Class();
        $datos = [
            'id_tipo_piso' => "3",
            'id_vivienda' => "2",
        ];
        $data = $modelo->Registrar_Pisos(
            [
                'id_tipo_piso' => $datos['id_tipo_piso'],
                'id_vivienda' => $datos['id_vivienda'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }
    public function test_registrar_vivienda_gas()
    {
        $modelo = new Viviendas_Class();
        $datos = [
            'id_servicio_gas' => "1",
            'id_vivienda' => "2",
            'tipo_bombona' => "18 kg",
            'dias_duracion' => "7 dias",
        ];
        $data = $modelo->registrar_vivienda_gas(
            [
                'id_servicio_gas' => $datos['id_servicio_gas'],
                'id_vivienda' => $datos['id_vivienda'],
                'tipo_bombona' => $datos['tipo_bombona'],
                'dias_duracion' => $datos['dias_duracion'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }
    public function test_registrar_vivienda_electrodomesticos()
    {
        $modelo = new Viviendas_Class();
        $datos = [
            'id_electrodomestico' => "1",
            'id_vivienda' => "2",
            'cantidad' => "1",
        ];
        $data = $modelo->registrar_vivienda_electrodomesticos(
            [
                'id_electrodomestico' => $datos['id_electrodomestico'],
                'id_vivienda' => $datos['id_vivienda'],
                'cantidad' => $datos['cantidad'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }
    
}

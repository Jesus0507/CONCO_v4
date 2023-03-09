<?php

require_once "modelo/viviendas_class.php";

use PHPUnit\Framework\TestCase;

class ViviendasTest extends TestCase
{
    private $viviendas;

    public $datos = array(
        'INSERT_1' => [
            'id_calle'              => 1,
            'id_tipo_vivienda'      => 2,
            'id_servicio'           => 3,
            'direccion_vivienda'    => 'Calle 17',
            'numero_casa'           => 4,
            'cantidad_habitaciones' => 3,
            'espacio_siembra'       => '1',
            'hacinamiento'          => '1',
            'banio_sanitario'       => '1',
            'condicion'             => 'Buena',
            'descripcion'           => 'Casa grande con jardín',
            'animales_domesticos'   => '0',
            'insectos_roedores'     => '0',
            'estado'                => '1',
        ],
        'INSERT_2' => [
            'agua_consumo'       => 'acueducto',
            'aguas_negras'       => 'letrina',
            'residuos_solidos'   => 'quema',
            'cable_telefonico'   => '0',
            'internet'           => '0',
            'servicio_electrico' => '1',
            'estado'             => '1',
        ],
        'INSERT_3' => [
            'id_tipo_techo' => 2,
            'id_vivienda'   => 2,
            'estado'        => '1',
        ],
        'INSERT_4' => [
            'id_tipo_pared' => 1,
            'id_vivienda'   => 2,
            'estado'        => '1',
        ],
        'INSERT_5' => [
            'id_tipo_piso' => 2,
            'id_vivienda'  => 2,
            'estado'       => '1',
        ],
        'INSERT_6' => [
            'id_servicio_gas' => 2,
            'id_vivienda'     => 2,
            'tipo_bombona'    => '15 kg',
            'dias_duracion'   => "2 semanas",
            'estado'          => '1',
        ],
        'INSERT_7' => [
            'id_electrodomestico' => 1,
            'id_vivienda'         => 2,
            'cantidad'            => 3,
            'estado'              => '1',
        ],
        'UPDATE'   => [
            'id_calle'              => 1,
            'id_tipo_vivienda'      => 2,
            'id_servicio'           => 3,
            'direccion_vivienda'    => 'Calle 16',
            'numero_casa'           => 4,
            'cantidad_habitaciones' => 3,
            'espacio_siembra'       => '1',
            'hacinamiento'          => '0',
            'banio_sanitario'       => '1',
            'condicion'             => 'Bueno',
            'descripcion'           => 'Casa de dos pisos',
            'animales_domesticos'   => '1',
            'insectos_roedores'     => '0',
            'id_vivienda'           => 5,
        ],
        'DELETE'   => [
            'id_vivienda'           => 19,
        ],
    );

    protected function setUp(): void
    {$this->viviendas = new Viviendas_Class();}

    protected function tearDown(): void
    {$this->viviendas = null;}

    public function test_SQL_01_SELECT_1()
    {
        $this->viviendas->_SQL_("SQL_01");
        $this->viviendas->_Tipo_(0);
        $result = $this->viviendas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_SELECT_2()
    {
        $this->viviendas->_SQL_("SQL_02");
        $this->viviendas->_Tipo_(0);
        $result = $this->viviendas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_03_SELECT_3()
    {
        $this->viviendas->_ID_(2);
        $this->viviendas->_SQL_("SQL_03");
        $this->viviendas->_Tipo_(0);
        $result = $this->viviendas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_04_SELECT_4()
    {
        $this->viviendas->_ID_(2);
        $this->viviendas->_SQL_("SQL_04");
        $this->viviendas->_Tipo_(0);
        $result = $this->viviendas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_05_SELECT_5()
    {
        $this->viviendas->_ID_(2);
        $this->viviendas->_SQL_("SQL_05");
        $this->viviendas->_Tipo_(0);
        $result = $this->viviendas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_07_SELECT_7()
    {
        $this->viviendas->_ID_(2);
        $this->viviendas->_SQL_("SQL_07");
        $this->viviendas->_Tipo_(0);
        $result = $this->viviendas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_08_SELECT_8()
    {
        $this->viviendas->_ID_(2);
        $this->viviendas->_SQL_("SQL_08");
        $this->viviendas->_Tipo_(0);
        $result = $this->viviendas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_09_SELECT_9()
    {
        $this->viviendas->_ID_(11);
        $this->viviendas->_SQL_("SQL_09");
        $this->viviendas->_Tipo_(0);
        $result = $this->viviendas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_10_INSERT_1()
    {
        $this->viviendas->_SQL_("SQL_10");
        $this->viviendas->_Tipo_(1);
        $this->viviendas->_Datos_($this->datos["INSERT_1"]);
        $result = $this->viviendas->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_11_UPDATE_1()
    {
        $this->viviendas->_SQL_("SQL_11");
        $this->viviendas->_Tipo_(1);
        $this->viviendas->_Datos_($this->datos["UPDATE"]);
        $result = $this->viviendas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_12_INSERT_2()
    {
        $this->viviendas->_SQL_("SQL_12");
        $this->viviendas->_Tipo_(1);
        $this->viviendas->_Datos_($this->datos["INSERT_2"]);
        $result = $this->viviendas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_13_INSERT_2()
    {
        $this->viviendas->_SQL_("SQL_13");
        $this->viviendas->_Tipo_(1);
        $this->viviendas->_Datos_($this->datos["INSERT_3"]);
        $result = $this->viviendas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_14_INSERT_3()
    {
        $this->viviendas->_SQL_("SQL_14");
        $this->viviendas->_Tipo_(1);
        $this->viviendas->_Datos_($this->datos["INSERT_4"]);
        $result = $this->viviendas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_15_INSERT_4()
    {
        $this->viviendas->_SQL_("SQL_15");
        $this->viviendas->_Tipo_(1);
        $this->viviendas->_Datos_($this->datos["INSERT_5"]);
        $result = $this->viviendas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_16_INSERT_5()
    {
        $this->viviendas->_SQL_("SQL_16");
        $this->viviendas->_Tipo_(1);
        $this->viviendas->_Datos_($this->datos["INSERT_6"]);
        $result = $this->viviendas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_17_INSERT_6()
    {
        $this->viviendas->_SQL_("SQL_17");
        $this->viviendas->_Tipo_(1);
        $this->viviendas->_Datos_($this->datos["INSERT_7"]);
        $result = $this->viviendas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_18_DELETE_1()
    {
        $this->viviendas->_SQL_("SQL_18");
        $this->viviendas->_Tipo_(1);
        $this->viviendas->_Datos_($this->datos["DELETE"]);
        $result = $this->viviendas->Administrar();
        $this->assertTrue($result);
    }
}
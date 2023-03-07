<?php

require_once "modelo/familias_class.php";

use PHPUnit\Framework\TestCase;

class FamiliasTest extends TestCase
{

    private $familia;

    public $datos = array(
        'INSERT_1' => [
            'id_vivienda'           => 1,
            'condicion_ocupacion'   => 'propia',
            'nombre_familia'        => 'Familia García',
            'observacion'           => 'Sin observaciones',
            'telefono_familia'      => '04165551234',
            'ingreso_mensual_aprox' => "200",
            'estado'                => '0',
        ],
        'INSERT_2' => [
            'id_familia'     => 5,
            'cedula_persona' => '7654321',
        ],
        'UPDATE'   => [
            'id_vivienda'           => 2,
            'condicion_ocupacion'   => 'propia',
            'nombre_familia'        => 'González',
            'observacion'           => 'Sin observaciones',
            'telefono_familia'      => '04165333234',
            'ingreso_mensual_aprox' => "5000",
            'estado'                => 1,
            'id_familia'            => 1,
        ],
        'DELETE'   => [

        ],
    );

    protected function setUp(): void
    {$this->familia = new Familias_Class();}

    protected function tearDown(): void
    {$this->familia = null;}

    public function test_SQL_01_SELECT_1()
    {
        $this->familia->_SQL_("SQL_01");
        $this->familia->_Tipo_(0);
        $result = $this->familia->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_SELECT_2()
    {
        $this->familia->_ID_(8);
        $this->familia->_SQL_("SQL_02");
        $this->familia->_Tipo_(0);
        $result = $this->familia->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_03_INSERT_1()
    {
        $this->familia->_SQL_("SQL_03");
        $this->familia->_Tipo_(1);
        $this->familia->_Datos_($this->datos["INSERT_1"]);
        $result = $this->familia->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_04_UPDATE()
    {
        $this->familia->_SQL_("SQL_04");
        $this->familia->_Tipo_(1);
        $this->familia->_Datos_($this->datos["UPDATE"]);
        $result = $this->familia->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_05_INSERT_2()
    {
        $this->familia->_SQL_("SQL_05");
        $this->familia->_Tipo_(1);
        $this->familia->_Datos_($this->datos["INSERT_2"]);
        $result = $this->familia->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_06_SELECT_3()
    {
        $this->familia->_SQL_("SQL_06");
        $this->familia->_Tipo_(0);
        $result = $this->familia->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

}

<?php

require_once "modelo/solicitudes_class.php";

use PHPUnit\Framework\TestCase;

class SolicitudesTest extends TestCase
{
    private $solicitudes;

    public $datos = array(
        'INSERT' => [
            'cedula_persona'    => '7654321',
            'tipo_constancia'   => 'constancia de residencia',
            'procesada'         => '0',
            'motivo_constancia' => 'para tramite',
            'observaciones'     => 'ninguna',
        ],
        'UPDATE' => [
            'id_solicitud'  => "27",
            'procesada'     => "1",
            'observaciones' => 'La solicitud ha sido procesada correctamente.',
        ],
    );

    protected function setUp(): void
    {$this->solicitudes = new Solicitudes_Class();}

    protected function tearDown(): void
    {$this->solicitudes = null;}

    public function test_SQL_01_INSERT()
    {
        $this->solicitudes->_SQL_("SQL_01");
        $this->solicitudes->_Tipo_(1);
        $this->solicitudes->_Datos_($this->datos["INSERT"]);
        $this->assertEquals($this->solicitudes->Administrar(), true);
    }

    public function test_SQL_02_SELECT_1()
    {
        $this->solicitudes->_SQL_("SQL_02");
        $this->solicitudes->_Tipo_(0);
        $result = $this->solicitudes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_03_SELECT_2()
    {
        $this->solicitudes->_SQL_("SQL_03");
        $this->solicitudes->_Tipo_(0);
        $result = $this->solicitudes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_04_SELECT_3()
    {
    	$this->solicitudes->_ID_("27");
        $this->solicitudes->_SQL_("SQL_03");
        $this->solicitudes->_Tipo_(0);
        $result = $this->solicitudes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_05_SELECT_4()
    {
    	$this->solicitudes->_ID_("19");
        $this->solicitudes->_SQL_("SQL_05");
        $this->solicitudes->_Tipo_(0);
        $result = $this->solicitudes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_06_SELECT_5()
    {
    	$this->solicitudes->_ID_("2");
        $this->solicitudes->_SQL_("SQL_06");
        $this->solicitudes->_Tipo_(0);
        $result = $this->solicitudes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_07_SELECT_6()
    {
    	$this->solicitudes->_ID_("2");
        $this->solicitudes->_SQL_("SQL_07");
        $this->solicitudes->_Tipo_(0);
        $result = $this->solicitudes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_08_SELECT_7()
    {
    	$this->solicitudes->_ID_("2");
        $this->solicitudes->_SQL_("SQL_08");
        $this->solicitudes->_Tipo_(0);
        $result = $this->solicitudes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_09_SELECT_7()
    {
    	$this->solicitudes->_ID_("11");
        $this->solicitudes->_SQL_("SQL_09");
        $this->solicitudes->_Tipo_(0);
        $result = $this->solicitudes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_10_UPDATE()
    {
        $this->solicitudes->_SQL_("SQL_10");
        $this->solicitudes->_Tipo_(1);
        $this->solicitudes->_Datos_($this->datos["UPDATE"]);
        $this->assertEquals($this->solicitudes->Administrar(), true);
    }

    public function test_SQL_11_SELECT_8()
    {
    	$this->solicitudes->_ID_("32");
        $this->solicitudes->_SQL_("SQL_11");
        $this->solicitudes->_Tipo_(0);
        $result = $this->solicitudes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}

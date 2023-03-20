<?php

require_once "modelo/discapacitados_class.php";

use PHPUnit\Framework\TestCase; 

class DiscapacitadosTest extends TestCase
{ 
 	private $discapacitados;

    public $datos = array(
        'INSERT' => [
    		'cedula_persona' => '7654321',
    		'id_discapacidad' => 2,
    		'necesidades_discapacidad' => 'Necesita silla de ruedas',
    		'observacion_discapacidad' => 'No puede caminar largas distancias',
    		'en_cama' => "no"
        ],
        'UPDATE' => [
    		'cedula_persona' => '7654321',
    		'id_discapacidad' => 2,
    		'necesidades_discapacidad' => 'Necesita silla de ruedas',
    		'observacion_discapacidad' => 'No puede caminar',
    		'en_cama' => "si"
        ]
    );

    protected function setUp(): void       {$this->discapacitados = new Discapacitados_Class();}

    protected function tearDown(): void    {$this->discapacitados = null;}

    public function test_SQL_01_SELECT_1()
    {
        $this->discapacitados->_SQL_("SQL_01");
        $this->discapacitados->_Tipo_(0);
        $result = $this->discapacitados->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_SELECT_2()
    {
        $this->discapacitados->_SQL_("SQL_02");
        $this->discapacitados->_Tipo_(0);
        $result = $this->discapacitados->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_03_SELECT_3()
    {
        $this->discapacitados->_SQL_("SQL_03");
        $this->discapacitados->_Tipo_(0);
        $result = $this->discapacitados->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_04_SELECT_4()
    {
        $this->discapacitados->_SQL_("SQL_04");
        $this->discapacitados->_Tipo_(0);
        $result = $this->discapacitados->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_05_SELECT_5()
    {
    	$this->discapacitados->_ID_("7654321");
        $this->discapacitados->_SQL_("SQL_05");
        $this->discapacitados->_Tipo_(0);
        $result = $this->discapacitados->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_06_INSERT()
    {
        $this->discapacitados->_SQL_("SQL_06");
        $this->discapacitados->_Tipo_(1);
        $this->discapacitados->_Datos_($this->datos["INSERT"]);
        $result = $this->discapacitados->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_07_SELECT_6()
    {
    	$this->discapacitados->_ID_("7654321");
        $this->discapacitados->_SQL_("SQL_07");
        $this->discapacitados->_Tipo_(0);
        $result = $this->discapacitados->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}

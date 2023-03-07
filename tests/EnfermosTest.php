<?php

require_once "modelo/enfermos_class.php";

use PHPUnit\Framework\TestCase; 

class EnfermosTest extends TestCase
{ 

    private $enfermos;

    public $datos = array(
        'INSERT' => [
    		'cedula_persona' => '7654321',
			'id_enfermedad' => 1,
			'medicamentos' => 'Paracetamol',
        ],
        'UPDATE' => [
    		'cedula_persona' => '7654321',
			'id_enfermedad' => 2,
			'medicamentos' => 'Acetaminofen',
        ]
    );

    protected function setUp(): void       {$this->enfermos = new Enfermos_Class();}

    protected function tearDown(): void    {$this->enfermos = null;}

    public function test_SQL_01_SELECT_1()
    {
        $this->enfermos->_SQL_("SQL_01");
        $this->enfermos->_Tipo_(0);
        $result = $this->enfermos->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_SELECT_2()
    {
        $this->enfermos->_SQL_("SQL_02");
        $this->enfermos->_Tipo_(0);
        $result = $this->enfermos->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_03_SELECT_3()
    {
        $this->enfermos->_SQL_("SQL_03");
        $this->enfermos->_Tipo_(0);
        $result = $this->enfermos->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_04_SELECT_4()
    {
    	$this->enfermos->_ID_("7654321");
        $this->enfermos->_SQL_("SQL_04");
        $this->enfermos->_Tipo_(0);
        $result = $this->enfermos->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_05_INSERT()
    {
        $this->enfermos->_SQL_("SQL_05");
        $this->enfermos->_Tipo_(1);
        $this->enfermos->_Datos_($this->datos["INSERT"]);
        $result = $this->enfermos->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_06_SELECT_5()
    {
        $this->enfermos->_SQL_("SQL_06");
        $this->enfermos->_Tipo_(0);
        $result = $this->enfermos->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_07_SELECT_6()
    {
    	$this->enfermos->_ID_("7654321");
        $this->enfermos->_SQL_("SQL_07");
        $this->enfermos->_Tipo_(0);
        $result = $this->enfermos->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

}

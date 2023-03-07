<?php

require_once "modelo/habitante_class.php";

use PHPUnit\Framework\TestCase;

class HabitanteTest extends TestCase
{

    private $habitante;

    protected function setUp(): void
    {$this->habitante = new Habitante_Class();}

    protected function tearDown(): void
    {$this->habitante = null;}

    public function test_SQL_01_SELECT_1()
    {
        $this->habitante->_SQL_("SQL_01");
        $this->habitante->_Tipo_(0);
        $result = $this->habitante->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_SELECT_2()
    {
        $this->habitante->_SQL_("SQL_02");
        $this->habitante->_Tipo_(0);
        $result = $this->habitante->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_03_SELECT_3()
    {
        $this->habitante->_SQL_("SQL_03");
        $this->habitante->_Tipo_(0);
        $result = $this->habitante->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_04_SELECT_4()
    {
        $this->habitante->_SQL_("SQL_04");
        $this->habitante->_Tipo_(0);
        $result = $this->habitante->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_05_SELECT_5()
    {
        $this->habitante->_SQL_("SQL_05");
        $this->habitante->_Tipo_(0);
        $result = $this->habitante->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_06_SELECT_6()
    {
        $this->habitante->_SQL_("SQL_06");
        $this->habitante->_Tipo_(0);
        $result = $this->habitante->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_06_SELECT_6()
    {
        $this->habitante->_SQL_("SQL_06");
        $this->habitante->_Tipo_(0);
        $result = $this->habitante->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_07_SELECT_7()
    {
        $this->habitante->_SQL_("SQL_07");
        $this->habitante->_Tipo_(0);
        $result = $this->habitante->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_08_SELECT_8()
    {
        $this->habitante->_SQL_("SQL_08");
        $this->habitante->_Tipo_(0);
        $result = $this->habitante->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_09_SELECT_9()
    {
        $this->habitante->_SQL_("SQL_09");
        $this->habitante->_Tipo_(0);
        $result = $this->habitante->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}

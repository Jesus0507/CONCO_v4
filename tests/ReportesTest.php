<?php

require_once "modelo/reportes_class.php";

use PHPUnit\Framework\TestCase;

class ReportesTest extends TestCase
{
    private $reportes;

    protected function setUp(): void       {$this->reportes = new Reportes_Class();}

    protected function tearDown(): void    {$this->reportes = null;}

    public function test_SQL_01_SELECT_1()
    {
        $this->reportes->_ID_("10");
        $this->reportes->_SQL_("SQL_01");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_SELECT_2()
    {
        $this->reportes->_SQL_("SQL_02");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_03_SELECT_3()
    {
        $this->reportes->_SQL_("SQL_03");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_04_SELECT_4()
    {
        $this->reportes->_SQL_("SQL_04");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_05_SELECT_5()
    {
        $this->reportes->_SQL_("SQL_05");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_06_SELECT_6()
    {
        $this->reportes->_SQL_("SQL_06");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_07_SELECT_7()
    {
        $this->reportes->_SQL_("SQL_07");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_08_SELECT_8()
    {
        $this->reportes->_SQL_("SQL_08");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_09_SELECT_9()
    {
        $this->reportes->_SQL_("SQL_09");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_10_SELECT_10()
    {
        $this->reportes->_SQL_("SQL_10");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_11_SELECT_11()
    {
        $this->reportes->_SQL_("SQL_11");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_12_SELECT_12()
    {
        $this->reportes->_SQL_("SQL_12");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_13_SELECT_13()
    {
        $this->reportes->_SQL_("SQL_13");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_14_SELECT_14()
    {
        $this->reportes->_SQL_("SQL_14");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_15_SELECT_15()
    {
        $this->reportes->_SQL_("SQL_15");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_16_SELECT_16()
    {
        $this->reportes->_SQL_("SQL_16");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_17_SELECT_17()
    {
        $this->reportes->_SQL_("SQL_17");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_18_SELECT_18()
    {
        $this->reportes->_SQL_("SQL_18");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_19_SELECT_19()
    {
        $this->reportes->_SQL_("SQL_19");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_20_SELECT_20()
    {
        $this->reportes->_ID_("2");
        $this->reportes->_SQL_("SQL_20");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_21_SELECT_21()
    {
        $this->reportes->_ID_("2");
        $this->reportes->_SQL_("SQL_21");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_22_SELECT_22()
    {
        $this->reportes->_ID_("2");
        $this->reportes->_SQL_("SQL_22");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_23_SELECT_23()
    {
        $this->reportes->_ID_("2");
        $this->reportes->_SQL_("SQL_23");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_24_SELECT_24()
    {
        $this->reportes->_ID_("8");
        $this->reportes->_SQL_("SQL_24");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_25_SELECT_25()
    {
        $this->reportes->_ID_("7654321");
        $this->reportes->_SQL_("SQL_25");
        $this->reportes->_Tipo_(0);
        $result = $this->reportes->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}

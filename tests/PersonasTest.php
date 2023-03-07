<?php 

require_once "modelo/personas_class.php";

use PHPUnit\Framework\TestCase;

class PersonasTest extends TestCase
{
    private $personas;

    protected function setUp(): void       {$this->personas = new Personas_Class();}

    protected function tearDown(): void    {$this->personas = null;}

    public function test_SQL_01_SELECT_1()
    {
        $this->personas->_SQL_("SQL_01");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_SELECT_2()
    {
        $this->personas->_SQL_("SQL_02");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }


    public function test_SQL_03_INSERT_1()
    {
        $this->personas->_SQL_("SQL_03");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_04_INSERT_2()
    {
        $this->personas->_SQL_("SQL_04");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_05_INSERT_3()
    {
        $this->personas->_SQL_("SQL_05");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_06_INSERT_4()
    {
        $this->personas->_SQL_("SQL_06");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_07_INSERT_5()
    {
        $this->personas->_SQL_("SQL_07");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_08_INSERT_6()
    {
        $this->personas->_SQL_("SQL_08");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_09_INSERT_7()
    {
        $this->personas->_SQL_("SQL_09");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_10_INSERT_8()
    {
        $this->personas->_SQL_("SQL_10");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_11_INSERT_9()
    {
        $this->personas->_SQL_("SQL_11");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_12_INSERT_9()
    {
        $this->personas->_SQL_("SQL_12");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_13_INSERT_10()
    {
        $this->personas->_SQL_("SQL_13");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_14_SELECT_3()
    {
        $this->personas->_SQL_("SQL_14");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_15_UPDATE_1()
    {
        $this->personas->_SQL_("SQL_16");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["UPDATE"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_16_UPDATE_2()
    {
        $this->personas->_SQL_("SQL_16");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["UPDATE"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_17_DELETE_1()
    {
        $this->personas->_SQL_("SQL_17");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["DELETE"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_17_SELECT_4()
    {
        $this->personas->_SQL_("SQL_17");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_18_SELECT_5()
    {
        $this->personas->_SQL_("SQL_18");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_19_SELECT_6()
    {
        $this->personas->_SQL_("SQL_19");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_20_SELECT_7()
    {
        $this->personas->_SQL_("SQL_20");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_21_SELECT_8()
    {
        $this->personas->_SQL_("SQL_21");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_22_SELECT_9()
    {
        $this->personas->_SQL_("SQL_22");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_23_SELECT_10()
    {
        $this->personas->_SQL_("SQL_23");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_24_SELECT_11()
    {
        $this->personas->_SQL_("SQL_24");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_25_SELECT_11()
    {
        $this->personas->_SQL_("SQL_25");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_26_SELECT_12()
    {
        $this->personas->_SQL_("SQL_26");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_27_SELECT_13()
    {
        $this->personas->_SQL_("SQL_27");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_28_SELECT_14()
    {
        $this->personas->_SQL_("SQL_28");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_29_SELECT_13()
    {
        $this->personas->_SQL_("SQL_29");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_30_SELECT_14()
    {
        $this->personas->_SQL_("SQL_30");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_31_SELECT_15()
    {
        $this->personas->_SQL_("SQL_31");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_32_SELECT_16()
    {
        $this->personas->_SQL_("SQL_32");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_33_SELECT_16()
    {
        $this->personas->_SQL_("SQL_33");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_34_SELECT_17()
    {
        $this->personas->_SQL_("SQL_34");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_35_SELECT_18()
    {
        $this->personas->_SQL_("SQL_35");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_36_SELECT_19()
    {
        $this->personas->_SQL_("SQL_36");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_37_SELECT_20()
    {
        $this->personas->_SQL_("SQL_37");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_38_SELECT_21()
    {
        $this->personas->_SQL_("SQL_38");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_39_SELECT_22()
    {
        $this->personas->_SQL_("SQL_39");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_40_SELECT_23()
    {
        $this->personas->_SQL_("SQL_40");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_41_SELECT_24()
    {
        $this->personas->_SQL_("SQL_41");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_42_SELECT_25()
    {
        $this->personas->_SQL_("SQL_42");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}
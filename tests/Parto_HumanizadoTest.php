<?php

require_once "modelo/parto_humanizado_class.php";

use PHPUnit\Framework\TestCase;

class Parto_HumanizadoTest extends TestCase
{

    private $parto_humanizado;

    public $datos = array(
        'INSERT' => [
            'cedula_persona'         => '7654321',
            'recibe_micronutrientes' => true,
            'tiempo_gestacion'       => "32 dias",
            'fecha_aprox_parto'      => '2023-03-15',
            'estado'                 => '1',
        ],
        'UPDATE' => [
            'cedula_persona'         => '7654321',
            'recibe_micronutrientes' => true,
            'tiempo_gestacion'       => "280 dias",
            'fecha_aprox_parto'      => '2023-05-01',
            'estado'                 => '1',
            'id_parto_humanizado'    => 5,
        ],
    );

    protected function setUp(): void
    {$this->parto_humanizado = new Parto_Humanizado_Class();}

    protected function tearDown(): void
    {$this->parto_humanizado = null;}

    public function test_SQL_01_SELECT_1()
    {
        $this->parto_humanizado->_SQL_("SQL_01");
        $this->parto_humanizado->_Tipo_(0);
        $result = $this->parto_humanizado->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_INSERT()
    {
        $this->parto_humanizado->_SQL_("SQL_02");
        $this->parto_humanizado->_Tipo_(1);
        $this->parto_humanizado->_Datos_($this->datos["INSERT"]);
        $result = $this->parto_humanizado->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_03_UPDATE()
    {
        $this->parto_humanizado->_SQL_("SQL_03");
        $this->parto_humanizado->_Tipo_(1);
        $this->parto_humanizado->_Datos_($this->datos["UPDATE"]);
        $result = $this->parto_humanizado->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_04_SELECT_2()
    {
        $this->parto_humanizado->_SQL_("SQL_04");
        $this->parto_humanizado->_Tipo_(0);
        $result = $this->parto_humanizado->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}

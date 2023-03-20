<?php

require_once "modelo/vacunados_class.php";

use PHPUnit\Framework\TestCase;

class VacunadosTest extends TestCase
{
    private $vacunados;

    public $datos = array(
        'INSERT' => [
            'cedula_persona' => "7654321",
            'dosis'          => "Primera dosis",
            'fecha_vacuna'   => '2022-01-01',
            'estado'         => '1',
        ],
    );

    protected function setUp(): void
    {$this->vacunados = new Vacunados_Class();}

    protected function tearDown(): void
    {$this->vacunados = null;}

    public function test_SQL_01_SELECT()
    {
        $this->vacunados->_SQL_("SQL_01");
        $this->vacunados->_Tipo_(0);
        $result = $this->vacunados->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_INSERT()
    {
        $this->vacunados->_SQL_("SQL_02");
        $this->vacunados->_Tipo_(1);
        $this->vacunados->_Datos_($this->datos["INSERT"]);
        $result = $this->vacunados->Administrar();
        $this->assertTrue($result);
    }
}

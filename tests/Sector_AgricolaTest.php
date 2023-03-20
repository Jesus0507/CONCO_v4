<?php

require_once "modelo/sector_agricola_class.php";

use PHPUnit\Framework\TestCase;

class Sector_AgricolaTest extends TestCase
{
    private $sector_agricola;

    public $datos = array(
        'INSERT' => [
            'cedula_persona'       => '1234567890',
            'area_produccion'      => 'Campo abierto',
            'anios_experiencia'    => "5",
            'rubro_principal'      => 'Café',
            'rubro_alternativo'    => 'Cacao',
            'registro_INTI'        => "123456789",
            'constancia_productor' => "si",
            'senial_hierro'        => "si",
            'financiado'           => 'No',
            'agua_riego'           => "si",
            'produccion_actual'    => "tomate",
            'org_agricola'         => 'Asociación de Caficultores',
            'estado'               => 1,
        ],
        'UPDATE' => [
            'id_sector_agricola'   => 1,
            'cedula_persona'       => '1234567890',
            'area_produccion'      => '2500 m2',
            'anios_experiencia'    => "5",
            'rubro_principal'      => 'Café',
            'rubro_alternativo'    => 'Plátano',
            'registro_INTI'        => "si",
            'constancia_productor' => "no",
            'senial_hierro'        => "si",
            'financiado'           => 'No',
            'agua_riego'           => "si",
            'produccion_actual'    => "ninguna",
            'org_agricola'         => 'Asociación de productores',
            'estado'               => 1,
        ],
    );

    protected function setUp(): void
    {$this->sector_agricola = new Sector_Agricola_Class();}

    protected function tearDown(): void
    {$this->sector_agricola = null;}

    public function test_SQL_01_INSERT()
    {
        $this->sector_agricola->_SQL_("SQL_01");
        $this->sector_agricola->_Tipo_(1);
        $this->sector_agricola->_Datos_($this->datos["INSERT"]);
        $result = $this->sector_agricola->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_02_SELECT_1()
    {
        $this->sector_agricola->_SQL_("SQL_02");
        $this->sector_agricola->_Tipo_(0);
        $result = $this->sector_agricola->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_03_UPDATE()
    {
        $this->sector_agricola->_SQL_("SQL_03");
        $this->sector_agricola->_Tipo_(1);
        $this->sector_agricola->_Datos_($this->datos["UPDATE"]);
        $result = $this->sector_agricola->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_04_SELECT_2()
    {
        $this->sector_agricola->_SQL_("SQL_04");
        $this->sector_agricola->_Tipo_(0);
        $result = $this->sector_agricola->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}

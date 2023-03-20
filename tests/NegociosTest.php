<?php

require_once "modelo/negocios_class.php";

use PHPUnit\Framework\TestCase;

class NegociosTest extends TestCase
{

    private $negocios;

    public $datos = array(
        'INSERT' => [
            "id_calle"           => 1,
            "nombre_negocio"     => "LA GUADALUPE",
            "direccion_negocio"  => "CALLE 16 ENTRE 2 Y 3",
            "cedula_propietario" => "7654321",
            "rif_negocio"        => "J261423266",
            "estado"             => 1,
        ],
        'UPDATE' => [
            "id_negocio"         => 2,
            "id_calle"           => 2,
            "nombre_negocio"     => "LA bodega",
            "direccion_negocio"  => "CALLE 3 ENTRE 1 Y 1",
            "cedula_propietario" => "11442199",
            "rif_negocio"        => "J261723255",
            "estado"             => 1,
        ],
    );

    protected function setUp(): void
    {$this->negocios = new Negocios_Class();}

    protected function tearDown(): void
    {$this->negocios = null;}

    public function test_SQL_01_SELECT_1()
    {
        $this->negocios->_SQL_("SQL_01");
        $this->negocios->_Tipo_(0);
        $result = $this->negocios->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_INSERT()
    {
        $this->negocios->_SQL_("SQL_02");
        $this->negocios->_Tipo_(1);
        $this->negocios->_Datos_($this->datos["INSERT"]);
        $result = $this->negocios->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_03_UPDATE()
    {
        $this->negocios->_SQL_("SQL_03");
        $this->negocios->_Tipo_(1);
        $this->negocios->_Datos_($this->datos["UPDATE"]);
        $result = $this->negocios->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_04_SELECT_2()
    {
        $this->negocios->_SQL_("SQL_04");
        $this->negocios->_Tipo_(0);
        $result = $this->negocios->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}

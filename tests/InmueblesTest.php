<?php

require_once "modelo/inmuebles_class.php";

use PHPUnit\Framework\TestCase;

class InmueblesTest extends TestCase
{

    private $inmuebles;

    public $datos = array(
        'INSERT' => [
            'id_calle'           => 1,
            'nombre_inmueble'    => 'Cancha',
            'direccion_inmueble' => 'Calle Principal #456',
            'id_tipo_inmueble'   => 2,
            'estado'             => '1',
        ],
        'UPDATE' => [
            'id_inmueble'        => 2,
            'id_calle'           => 1,
            'nombre_inmueble'    => 'Cancha',
            'direccion_inmueble' => 'Calle Principal #456',
            'id_tipo_inmueble'   => 2,
            'estado'             => '1',
        ],
    );

    protected function setUp(): void
    {$this->inmuebles = new Inmuebles_Class();}

    protected function tearDown(): void
    {$this->inmuebles = null;}

    public function test_SQL_01_SELECT()
    {
        $this->inmuebles->_SQL_("SQL_01");
        $this->inmuebles->_Tipo_(0);
        $result = $this->inmuebles->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_INSERT()
    {
        $this->inmuebles->_SQL_("SQL_02");
        $this->inmuebles->_Tipo_(1);
        $this->inmuebles->_Datos_($this->datos["INSERT"]);
        $result = $this->inmuebles->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_03_UPDATE()
    {
        $this->inmuebles->_SQL_("SQL_03");
        $this->inmuebles->_Tipo_(1);
        $this->inmuebles->_Datos_($this->datos["UPDATE"]);
        $result = $this->inmuebles->Administrar();
        $this->assertTrue($result);
    }
}

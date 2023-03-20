<?php

require_once "modelo/seguridad_class.php";

use PHPUnit\Framework\TestCase;

class SeguridadTest extends TestCase
{

    public $datos = array(
        'UPDATE_1' => [
            'rol'       => 'Administrador',
            'id_modulo' => 9,
        ],
        'UPDATE_2' => [
            'rol_inicio'     => 'Administrador',
            'contrasenia'    => '123456',
            'cedula_usuario' => '1234567',
        ],
        'UPDATE_3' => [
            'cedula_persona' => '10716033',
            'estado'         => '1',
        ],
        'UPDATE_4' => [
            'registrar'      => 1,
            'consultar'      => 1,
            'modificar'      => 1,
            'eliminar'       => 1,
            'cedula_usuario' => '1234567',
            'id_modulo'      => 2,
        ],
    );

    protected function setUp(): void
    {$this->seguridad = new Seguridad_Class();}

    protected function tearDown(): void
    {$this->seguridad = null;}

    public function test_SQL_01_SELECT_1()
    {
        $this->seguridad->_SQL_("SQL_01");
        $this->seguridad->_Tipo_(2);
        $this->seguridad->_Datos_(["rol" => "Administrador"]);
        $result = $this->seguridad->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_SELECT_2()
    {
        $this->seguridad->_SQL_("SQL_02");
        $this->seguridad->_Tipo_(0);
        $result = $this->seguridad->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_03_SELECT_3()
    {
        $this->seguridad->_SQL_("SQL_02");
        $this->seguridad->_Tipo_(0);
        $result = $this->seguridad->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL04_UPDATE_1(): void
    {
        $this->seguridad->_Tipo_(1);
        $this->seguridad->_SQL_("SQL_06");
        $this->seguridad->_Datos_($this->datos["UPDATE_3"]);
        $this->assertEquals($this->seguridad->Administrar(), true);
    }

    public function test_SQL05_UPDATE_2(): void
    {
        $this->seguridad->_SQL_('SQL_05');
        $this->seguridad->_Tipo_(1);
        $this->seguridad->_Datos_($this->datos["UPDATE_2"]);
        $this->assertEquals($this->seguridad->Administrar(), true);
    }

    public function test_SQL06_UPDATE_3(): void
    {
        $this->seguridad->_SQL_('SQL_06');
        $this->seguridad->_Tipo_(1);
        $this->seguridad->_Datos_($this->datos["UPDATE_3"]);
        $this->assertEquals($this->seguridad->Administrar(), true);
    }

    public function test_SQL07_UPDATE_4(): void
    {
        $this->seguridad->_SQL_("SQL_06");
        $this->seguridad->_Datos_($this->datos["UPDATE_3"]);
        $this->seguridad->_Tipo_(1);
        $this->assertEquals($this->seguridad->Administrar(), true);
    }
}

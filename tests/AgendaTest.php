<?php
require_once "modelo/agenda_class.php";

use PHPUnit\Framework\TestCase;

class AgendaTest extends TestCase
{
    private $agenda;

    public $datos = array(
        'INSERT' => [
            'tipo_evento' => 'evento de prueba',
            'fecha'       => '2023-02-10',
            'creador'     => '7654321',
            'ubicacion'   => 'ubicacion de prueba',
            'horas'       => 1,
            'detalle'     => 'detalle de prueba',
        ],
        'UPDATE' => [
            'id_agenda'   => 1,
            'tipo_evento' => 'evento actualizado',
            'fecha'       => '2023-02-11',
            'creador'     => '7654321',
            'ubicacion'   => 'ubicacion actualizada',
            'horas'       => 2,
            'detalle'     => 'detalle actualizado',
        ],
        'DELETE' => ['id_agenda' => 1],  
    );

    protected function setUp(): void       {$this->agenda = new Agenda_Class();}

    protected function tearDown(): void    {$this->agenda = null;}

    public function test_SQL_01_SELECT()
    {
        $this->agenda->_SQL_("SQL_01");
        $this->agenda->_Tipo_(0);
        $result = $this->agenda->Administrar();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_INSERT()
    {
        $this->agenda->_SQL_("SQL_02");
        $this->agenda->_Tipo_(1);
        $this->agenda->_Datos_($this->datos["INSERT"]);
        $result = $this->agenda->Administrar();

        $this->assertTrue($result);
    }

    public function test_SQL_03_UPDATE()
    {
        $this->agenda->_SQL_("SQL_03");
        $this->agenda->_Tipo_(1);
        $this->agenda->_Datos_($this->datos["UPDATE"]);
        $result = $this->agenda->Administrar();

        $this->assertTrue($result);
    }

    public function test_SQL_04_SELECT()
    {
        $this->agenda->_SQL_("SQL_04");
        $this->agenda->_Tipo_(0);
        $result = $this->agenda->Administrar();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_05_SELECT_WHERE()
    {
        $this->agenda->_SQL_("SQL_05");
        $this->agenda->_Tipo_(0);
        $result = $this->agenda->Administrar();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_06_DELETE()
    {
        $this->agenda->_SQL_("SQL_06");
        $this->agenda->_Tipo_(1);
        $this->agenda->_Datos_($this->datos["DELETE"]);
        $result = $this->agenda->Administrar();

        $this->assertTrue($result);
    }
}

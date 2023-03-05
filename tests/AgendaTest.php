<?php
require_once "modelo/agenda_class.php";
use PHPUnit\Framework\TestCase;
use Modelo\Agenda_Class;

class AgendaTest extends TestCase
{
    private $agenda;

    protected function setUp(): void
    {
        $this->agenda = new Agenda_Class();
    }

    protected function tearDown(): void
    {
        $this->agenda = null;
    }

    public function test_SQL_01()
    {
        $this->agenda->_SQL_("SQL_01");
        $this->agenda->_Tipo_(0);
        $result = $this->agenda->Administrar();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02()
    {
        $this->agenda->_SQL_("SQL_02");
        $this->agenda->_Tipo_(1);
        $this->agenda->_Datos_([
            'tipo_evento' => 'evento de prueba',
            'fecha'       => '2023-02-10',
            'creador'     => '123456789',
            'ubicacion'   => 'ubicacion de prueba',
            'horas'       => 1,
            'detalle'     => 'detalle de prueba',
        ]);
        $result = $this->agenda->Administrar();

        $this->assertTrue($result);
    }

    public function test_SQL_03()
    {
        $this->agenda->_SQL_("SQL_03");
        $this->agenda->_Tipo_(1);
        $this->agenda->_Datos_([
            'id_agenda'   => 1,
            'tipo_evento' => 'evento actualizado',
            'fecha'       => '2023-02-11',
            'creador'     => '123456789',
            'ubicacion'   => 'ubicacion actualizada',
            'horas'       => 2,
            'detalle'     => 'detalle actualizado',
        ]);
        $result = $this->agenda->Administrar();

        $this->assertTrue($result);
    }

    public function test_SQL_04()
    {
        $this->agenda->_SQL_("SQL_04");
        $this->agenda->_Tipo_(0);
        $result = $this->agenda->Administrar();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_05()
    {
        $this->agenda->_SQL_("SQL_05");
        $this->agenda->_Tipo_(0);
        $result = $this->agenda->Administrar();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_06()
    {
        $this->agenda->_SQL_("SQL_06");
        $this->agenda->_Tipo_(1);
        $this->agenda->_Datos_(['id_agenda' => 1]);
        $result = $this->agenda->Administrar();

        $this->assertTrue($result);
    }
}

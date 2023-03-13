<?php

require_once "controlador/agenda_controlador.php";
require_once "modelo/agenda_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Agenda']         = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado'   => [
        "tabla"  => "agenda",
        "id"     => "id_agenda",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'    => [
        'tipo_evento' => 'evento de prueba',
        'fecha'       => '2023-02-10',
        'creador'     => '7654321',
        'ubicacion'   => 'ubicacion de prueba',
        'horas'       => 1,
        'detalle'     => 'detalle de prueba',
    ],
    'sql'      => 'SQL_1',
    'accion'   => 'registro exitoso',
];

class AgendaTestControlador extends TestCase
{
    private $Agenda;

    protected function setUp(): void
    {
        $this->Agenda = new Agenda();
    }

    protected function tearDown(): void
    {$this->Agenda = null;}

    // AGENDA
    public function test_Cargar_Vistas()
    {
        $this->Agenda->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Agenda->vista->expects($this->once())->method('Cargar_Vistas')->with('agenda/consultar');
        $this->Agenda->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Agenda->Establecer_Consultas();
        $this->assertNotEmpty($this->Agenda->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Agenda->Get_Sql());
        $this->assertIsString($this->Agenda->Get_Accion());
        $this->assertIsString($this->Agenda->Get_Mensaje());
        $this->assertIsArray($this->Agenda->Get_Datos());
        $this->assertIsArray($this->Agenda->Get_Estado());
        $this->assertIsArray($this->Agenda->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Agenda->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Agenda->vista->expects($this->once())->method('Cargar_Vistas')->with('agenda/consultar');
        $this->Agenda->Administrar("Consultas");
        $this->Agenda->vista->expects($this->once())->method('Cargar_Vistas')->with('agenda/registrar');
        $this->Agenda->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar()
    {
        $this->Agenda->modelo  = $this->getMockBuilder(Agenda_Class::class)->disableOriginalConstructor()->getMock();
        $this->Agenda->validacion = $this->getMockBuilder(Agenda_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Agenda->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Agenda->Administrar();
        $this->assertTrue(true);
    }
    // =================================================================
}

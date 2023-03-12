<?php
require_once "controlador/agenda_controlador.php";
require_once "modelo/agenda_class.php";

use PHPUnit\Framework\TestCase;

class AgendaTestControlador extends TestCase
{
    private $Agenda;

    protected function setUp(): void
    {
        $_SESSION['cedula_usuario'] = "7654321"; 
        $_SESSION['Agenda'] = [
            "consultar" => 1,
            "registrar" => 1,
            "eliminar"  => 1,
            "modificar" => 1,
        ];
        $this->Agenda       = new Agenda();
        $this->Agenda->modelo = new Agenda_Class();
        $this->Agenda->vista = new Vista();
    }

    protected function tearDown(): void
    {$this->Agenda = null;}

    // AGENDA
    public function test_Cargar_Vistas()
    {
        ob_start();
        $this->Agenda->Cargar_Vistas();
        $contenido_vista = ob_get_clean();
        $this->assertNotEmpty($contenido_vista);
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Agenda->Establecer_Consultas();
        $this->assertNotEmpty($this->Agenda->Get_Datos_Vista()['agenda']);
        $this->assertNotEmpty($this->Agenda->Get_Datos_Vista()['calle']);
        $this->assertNotEmpty($this->Agenda->Get_Datos_Vista()['inmuebles']);
    }

    public function test_Getters()
    {
        $this->Agenda->setPost([
            'peticion' => 'Consultas',
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
        ]);

        $this->assertIsString($this->Agenda->Get_Sql());
        $this->assertIsString($this->Agenda->Get_Accion());
        $this->assertIsInt($this->Agenda->Get_Mensaje());
        $this->assertIsArray($this->Agenda->Get_Datos());
        $this->assertIsArray($this->Agenda->Get_Estado());
        $this->assertIsArray($this->Agenda->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Agenda->Get_Datos_Vista());
    }

    public function test_Administrar_Consultas()
    {
        $this->Agenda->setPost(['peticion' => 'Consultas']);
        $this->Agenda->$vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('agenda/consultar'));
        ob_start();
        $this->Agenda->Administrar();
        $contenido_vista = ob_get_clean();
        $this->assertNotEmpty($contenido_vista);
        $this->assertTrue(true);
    }
    // =================================================================
}

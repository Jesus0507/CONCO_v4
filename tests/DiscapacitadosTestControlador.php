<?php

require_once "controlador/discapacitados_controlador.php";
require_once "modelo/discapacitados_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Discapacitados']         = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado'   => [
        "tabla"  => "discapacitados",
        "id"     => "id_discapacitados",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'    => [
        'cedula_persona' => '7654321',
            'id_discapacidad' => 2,
            'necesidades_discapacidad' => 'Necesita silla de ruedas',
            'observacion_discapacidad' => 'No puede caminar largas distancias',
            'en_cama' => "no"
    ],
    'sql'      => 'SQL_1',
    'accion'   => 'registro exitoso',
];

class DiscapacitadosTestControlador extends TestCase
{
    private $Discapacitados;

    protected function setUp(): void  {$this->Discapacitados = new Discapacitados();}

    protected function tearDown(): void
    {$this->Discapacitados = null;}

    public function test_Cargar_Vistas()
    {
        $this->Discapacitados->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Discapacitados->vista->expects($this->once())->method('Cargar_Vistas')->with('Discapacitados/consultar');
        $this->Discapacitados->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Discapacitados->Establecer_Consultas();
        $this->assertNotEmpty($this->Discapacitados->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Discapacitados->Get_Sql());
        $this->assertIsString($this->Discapacitados->Get_Accion());
        $this->assertIsString($this->Discapacitados->Get_Mensaje());
        $this->assertIsArray($this->Discapacitados->Get_Datos());
        $this->assertIsArray($this->Discapacitados->Get_Estado());
        $this->assertIsArray($this->Discapacitados->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Discapacitados->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Discapacitados->vista->expects($this->once())->method('Cargar_Vistas')->with('Discapacitados/consultar');
        $this->Discapacitados->Administrar("Consultas");
        $this->Discapacitados->vista->expects($this->once())->method('Cargar_Vistas')->with('Discapacitados/registrar');
        $this->Discapacitados->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Discapacitados->modelo     = $this->getMockBuilder(Discapacitados_Class::class)->disableOriginalConstructor()->getMock();
        $this->Discapacitados->validacion = $this->getMockBuilder(Discapacitados_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Discapacitados->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Discapacitados->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Discapacitados->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Discapacitados->modelo = $this->getMockBuilder(Bitoacora_Class::class)->disableOriginalConstructor()->getMock();
        $result                  = $this->Bitoacora->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Discapacitados->modelo     = $this->getMockBuilder(Discapacitados_Class::class)->disableOriginalConstructor()->getMock();
        $this->Discapacitados->validacion = $this->getMockBuilder(Discapacitados_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Discapacitados->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Discapacitados->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Discapacitados->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Discapacitados->modelo     = $this->getMockBuilder(Discapacitados_Class::class)->disableOriginalConstructor()->getMock();
        $this->Discapacitados->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Discapacitados->Administrar("Eliminar");
        $this->assertTrue(true);
    }
    // =================================================================
}

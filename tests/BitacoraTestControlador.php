<?php

require_once "controlador/bitacora_controlador.php";
require_once "modelo/bitacora_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Bitacora']       = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "bitacora",
        "id"     => "id_bitacora",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'cedula_usuario' => '7654321',
        'fecha'          => '2023-02-10',
        'dia'            => 'Miércoles',
        'hora_inicio'    => '12:00:00',
        'acciones'       => 'Inicio de sesión',
        'hora_fin'       => '12:30:00',
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class BitacoraTestControlador extends TestCase
{
    private $Bitacora;

    protected function setUp(): void      {$this->Bitacora = new Bitacora();}

    protected function tearDown(): void   {$this->Bitacora = null;}

    // Bitacora
    public function test_Cargar_Vistas()
    {
        $this->Bitacora->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Bitacora->vista->expects($this->once())->method('Cargar_Vistas')->with('bitacora/consultar');
        $this->Bitacora->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Bitacora->Establecer_Consultas();
        $this->assertNotEmpty($this->Bitacora->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Bitacora->Get_Sql());
        $this->assertIsString($this->Bitacora->Get_Accion());
        $this->assertIsString($this->Bitacora->Get_Mensaje());
        $this->assertIsArray($this->Bitacora->Get_Datos());
        $this->assertIsArray($this->Bitacora->Get_Estado());
        $this->assertIsArray($this->Bitacora->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Vistas()
    {
        $this->Bitacora->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Bitacora->vista->expects($this->once())->method('Cargar_Vistas')->with('bitacora/consultar');
        $this->Bitoacora->Administrar("Consultas");
        $this->Bitoacora->vista->expects($this->once())->method('Cargar_Vistas')->with('bitacora/registrar');
        $this->Bitoacora->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar()
    {
        $this->Bitoacora->modelo     = $this->getMockBuilder(Bitoacora_Class::class)->disableOriginalConstructor()->getMock();
        $this->Bitoacora->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Bitoacora->Administrar();
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Bitoacora->modelo = $this->getMockBuilder(Bitoacora_Class::class)->disableOriginalConstructor()->getMock();
        $result                  = $this->Bitoacora->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }
}

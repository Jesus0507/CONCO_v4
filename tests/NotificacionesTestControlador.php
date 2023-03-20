<?php

require_once "controlador/notificaciones_controlador.php";
require_once "modelo/notificaciones_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Notificaciones'] = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "notificaciones",
        "id"     => "id_notificaciones",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        'usuario_emisor'   => 'juan123',
        'usuario_receptor' => 'maria456',
        'accion'           => 'nueva_mensaje',
        'leido'            => 0,
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class NotificacionesTestControlador extends TestCase
{
    private $Notificaciones;

    protected function setUp(): void
    {
        $this->Notificaciones = new Notificaciones();
    }

    protected function tearDown(): void
    {$this->Notificaciones = null;}

    // =================================================================

    public function test_Cargar_Vistas()
    {
        $this->Notificaciones->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Notificaciones->vista->expects($this->once())->method('Cargar_Vistas')->with('Notificaciones/consultar');
        $this->Notificaciones->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Notificaciones->Establecer_Consultas();
        $this->assertNotEmpty($this->Notificaciones->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Notificaciones->Get_Sql());
        $this->assertIsString($this->Notificaciones->Get_Accion());
        $this->assertIsString($this->Notificaciones->Get_Mensaje());
        $this->assertIsArray($this->Notificaciones->Get_Datos());
        $this->assertIsArray($this->Notificaciones->Get_Estado());
    }

    public function test_Administrar_Registrar()
    {
        $this->Notificaciones->modelo = $this->getMockBuilder(Notificaciones_Class::class)->disableOriginalConstructor()->getMock();
        $this->Notificaciones->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Notificaciones->Administrar("Nueva");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Notificaciones->modelo = $this->getMockBuilder(Notificaciones_Class::class)->disableOriginalConstructor()->getMock();
        $result                       = $this->Notificaciones->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }
}

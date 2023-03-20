<?php

require_once "controlador/login_controlador.php";
require_once "modelo/login_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";

$_POST = [
    'datos'  => [
        'cedula_usuario' => '7654321',
        'contrasenia'    => 'clave',
        'captcha'        => 'akj12ba',
    ],
    'sql'    => 'SQL_1',
    'accion' => '',
];

class LoginTestControlador extends TestCase
{
    private $Login;

    protected function setUp(): void
    {$this->Login = new Login();}

    protected function tearDown(): void
    {$this->Login = null;}

    // =================================================================

    public function test_Cargar_Vistas()
    {
        $this->Login->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Login->vista->expects($this->once())->method('Cargar_Vistas')->with('Login/consultar');
        $this->Login->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Login->Get_Sql());
        $this->assertIsString($this->Login->Get_Accion());
        $this->assertIsString($this->Login->Get_Mensaje());
        $this->assertIsArray($this->Login->Get_Datos());
    }

    public function test_Administrar_Ingreso()
    {
        $this->Login->modelo     = $this->getMockBuilder(Login_Class::class)->disableOriginalConstructor()->getMock();
        $this->Login->validacion = $this->getMockBuilder(Login_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Login->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Login->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Login->Administrar("Ingresar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Salir()
    {
        $this->Login->modelo     = $this->getMockBuilder(Login_Class::class)->disableOriginalConstructor()->getMock();
        $this->Login->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Login->Administrar("Salir");
        $this->assertTrue(true);
    }

    public function test_Administrar_Recuperar()
    {
        $this->Login->modelo = $this->getMockBuilder(Login_Class::class)->disableOriginalConstructor()->getMock();
        $this->Login->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Login->Administrar("Recuperar");
        $this->assertTrue(true);
    }
}

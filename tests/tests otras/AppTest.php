<?php
use PHPUnit\Framework\TestCase;

class IniciarSistemaTest extends TestCase
{
    public function testConstructor()
    {
        // Arrange
        $_GET['url'] = 'Plantas/Consultas';

        // Act
        $iniciarSistema = new Iniciar_Sistema();

        // Assert
        $this->assertInstanceOf(Iniciar_Sistema::class, $iniciarSistema);
        // Verificar que la propiedad url se haya inicializado correctamente
        $this->assertEquals(['Plantas', 'Consultas'], $iniciarSistema->getUrl());
    }

    public function testControladorPorDefecto()
    {
        // Arrange
        $_GET['url'] = '';

        // Act
        $iniciarSistema = new Iniciar_Sistema();

        // Assert
        $this->assertInstanceOf(Iniciar_Sistema::class, $iniciarSistema);
        // Verificar que se haya cargado el controlador por defecto (Plantas_Controlador)
        $this->assertInstanceOf(Plantas_Controlador::class, $iniciarSistema->getControlador());
    }

    public function testControladorEspecifico()
    {
        // Arrange
        $_GET['url'] = 'Usuarios/Perfil';

        // Act
        $iniciarSistema = new Iniciar_Sistema();

        // Assert
        $this->assertInstanceOf(Iniciar_Sistema::class, $iniciarSistema);
        // Verificar que se haya cargado el controlador específico (Usuarios_Controlador)
        $this->assertInstanceOf(Usuarios_Controlador::class, $iniciarSistema->getControlador());
        // Verificar que se haya llamado a la función específica (Perfil)
        $this->assertEquals('Perfil', $iniciarSistema->getControlador()->getFuncionEspecifica());
    }

    public function testParametros()
    {
        // Arrange
        $_GET['url'] = 'Plantas/Editar/123';

        // Act
        $iniciarSistema = new Iniciar_Sistema();

        // Assert
        $this->assertInstanceOf(Iniciar_Sistema::class, $iniciarSistema);
        // Verificar que se hayan pasado los parámetros correctamente a la función específica (Editar)
        $this->assertEquals(['123'], $iniciarSistema->getParametros());
    }

    public function testCargar_Controladores()
    {
        $this->assertTrue($this->iniciarSistema->Cargar_Controladores());
    }

    public function testCargar_Funciones()
    {
        $this->assertTrue($this->iniciarSistema->Cargar_Funciones());
    }

    public function testValidar_Archivos()
    {
        $this->assertTrue($this->iniciarSistema->Validar_Archivos());
    }

    public function testValidar_Controlador()
    {
        $this->assertTrue($this->iniciarSistema->Validar_Controlador());
    }

    public function testValidar_Modelo()
    {
        $this->assertTrue($this->iniciarSistema->Validar_Modelo());
    }

    public function testValidar_Funcion()
    {
        $this->assertTrue($this->iniciarSistema->Validar_Funcion());
    }

    public function testValidar_URL()
    {
        $_GET['url'] = 'test/url';
        $this->assertTrue($this->iniciarSistema->Validar_URL());
    }

    public function testValidar_Conexion()
    {
        $this->assertTrue($this->iniciarSistema->Validar_Conexion());
    }

    public function testGuardar_Error()
    {
        $this->expectOutputRegex('/stdClass/');
        $this->iniciarSistema->Guardar_Error();
    }
}

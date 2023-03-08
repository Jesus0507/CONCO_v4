<?php

require_once 'Componentes.php';

class ComponentesTest extends PHPUnit_Framework_TestCase
{
    use Componentes;

    public function testConexion()
    {
        $conexion = $this->Conexion();

        $this->assertArrayHasKey('Mysql', $conexion);
        $this->assertArrayHasKey('ByHost', $conexion);

        $this->assertArrayHasKey('Servidor', $conexion['Mysql']);
        $this->assertArrayHasKey('Host', $conexion['Mysql']);
        $this->assertArrayHasKey('Base_Datos', $conexion['Mysql']);
        $this->assertArrayHasKey('Puerto', $conexion['Mysql']);
        $this->assertArrayHasKey('Usuario', $conexion['Mysql']);
        $this->assertArrayHasKey('Contraseña', $conexion['Mysql']);

        $this->assertArrayHasKey('Servidor', $conexion['ByHost']);
        $this->assertArrayHasKey('Host', $conexion['ByHost']);
        $this->assertArrayHasKey('Base_Datos', $conexion['ByHost']);
        $this->assertArrayHasKey('Puerto', $conexion['ByHost']);
        $this->assertArrayHasKey('Usuario', $conexion['ByHost']);
        $this->assertArrayHasKey('Contraseña', $conexion['ByHost']);
    }

    public function testSistema()
    {
        $sistema = $this->Sistema();

        $this->assertArrayHasKey('SISTEMA', $sistema);
        $this->assertArrayHasKey('URL', $sistema);
        $this->assertArrayHasKey('PUBLICO', $sistema);
        $this->assertArrayHasKey('PRIVADO', $sistema);
        $this->assertArrayHasKey('ATAJO', $sistema);
    }

    public function testDirecciones()
    {
        $direcciones = $this->Direcciones();

        $this->assertArrayHasKey('Inicio', $direcciones);
        $this->assertArrayHasKey('Contacto', $direcciones);
        $this->assertArrayHasKey('Solicitudes', $direcciones);
        $this->assertArrayHasKey('Notificaciones', $direcciones);
        $this->assertArrayHasKey('Login', $direcciones);
        $this->assertArrayHasKey('Agenda', $direcciones);
        $this->assertArrayHasKey('Personas', $direcciones);
        $this->assertArrayHasKey('Familias', $direcciones);
        $this->assertArrayHasKey('Viviendas', $direcciones);
        $this->assertArrayHasKey('Vacunados', $direcciones);
        $this->assertArrayHasKey('Enfermos', $direcciones);
        $this->assertArrayHasKey('Discapacitados', $direcciones);
        $this->assertArrayHasKey('Parto_Humanizado', $direcciones);
        $this->assertArrayHasKey('Sector_Agricola', $direcciones);
        $this->assertArrayHasKey('Grupos_Deportivos', $direcciones);
        $this->assertArrayHasKey('Negocios', $direcciones);
        $this->assertArrayHasKey('Inmuebles', $direcciones);
        $this->assertArrayHasKey('Consejo_Comunal', $direcciones);
        $this->assertArrayHasKey('Centro_Votacion', $direcciones);
        $this->assertArrayHasKey('Seguridad', $direcciones);
    }
}

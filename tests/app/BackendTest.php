<?php

require_once 'controlador/backend/centro_votacion_validacion.php';
require_once 'controlador/backend/agenda_validacion.php';
require_once 'controlador/backend/consejo_comunal_validacion.php';
require_once 'controlador/backend/discapacitados_validacion.php';
require_once 'controlador/backend/enfermos_validacion.php';
require_once 'controlador/backend/familias_validacion.php';
require_once 'controlador/backend/grupos_deportivos_validacion.php';
require_once 'controlador/backend/inmuebles_validacion.php';
require_once 'controlador/backend/login_validacion.php';
require_once 'controlador/backend/negocios_validacion.php';
require_once 'controlador/backend/parto_humanizado_validacion.php';
require_once 'controlador/backend/sector_agricola_validacion.php';
require_once 'controlador/backend/usuario_validacion.php';
require_once 'controlador/backend/vacunados_validacion.php';
require_once 'controlador/backend/viviendas_validacion.php';

use PHPUnit\Framework\TestCase;

class BackendTest extends TestCase
{
    public function test_Agenda_Validacion_Backend()
    {
        $validacion = new Agenda_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Centro_Votacion_Validacion_Backend()
    {
        $validacion = new Centro_Votacion_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Consejo_Comunal_Validacion_Validacion_Backend()
    {
        $validacion = new Consejo_Comunal_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Discapacitados_Validacion_Backend()
    {
        $validacion = new Discapacitados_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Enfermos_Validacion_Backend()
    {
        $validacion = new Enfermos_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Familias_Validacion_Backend()
    {
        $validacion = new Familias_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Grupos_Deportivos_Validacion_Backend()
    {
        $validacion = new Grupos_Deportivos_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Inmuebles_Validacion_Backend()
    {
        $validacion = new Inmuebles_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Login_Validacion_Backend()
    {
        $validacion = new Login_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Negocios_Validacion_Backend()
    {
        $validacion = new Negocios_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Parto_Humanizado_Validacion_Backend()
    {
        $validacion = new Parto_Humanizado_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Sector_Agricola_Validacion_Backend()
    {
        $validacion = new Sector_Agricola_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Vacunados_Validacion_Backend()
    {
        $validacion = new Vacunados_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Usuario_Validacion_Backend()
    {
        $validacion = new Usuario_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }

    public function test_Viviendas_Validacion_Backend()
    {
        $validacion = new Viviendas_Validacion();
        $resultado  = $validacion->Validacion_Registro();
        $this->assertFalse($resultado);
        $this->assertEquals('["Debe llenar los datos del formulario"]', $validacion->Fallo());
    }
}

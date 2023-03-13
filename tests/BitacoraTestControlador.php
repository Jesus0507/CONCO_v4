<?php

require_once "controlador/bitacora_controlador.php";

use PHPUnit\Framework\TestCase;


class BitacoraTestControlador extends TestCase
{
    private $vista;

    protected function setUp(): void
    {
        $this->vista = new Vista();
    }

    protected function tearDown(): void
    {$this->Agenda = null;}

    // AGENDA
    public function test_Cargar_Vistas()
    {
        ob_start();
        $this->vista->Cargar_Vistas('inicio/index');
        $contenido_vista = ob_get_clean();
        $this->assertNotEmpty($contenido_vista);
    }

    public function test_Establecer_Consultas()
    {
        ob_start();
        $this->vista->Cargar_Vistas('inicio/index');
        $contenido_vista = ob_get_clean();
        $this->assertNotEmpty($contenido_vista);
    }

    public function test_Getters()
    {
       ob_start();
        $this->vista->Cargar_Vistas('inicio/index');
        $contenido_vista = ob_get_clean();
        $this->assertNotEmpty($contenido_vista);
    }

    public function test_Administrar_Vistas_Consultas()
    {
       ob_start();
        $this->vista->Cargar_Vistas('inicio/index');
        $contenido_vista = ob_get_clean();
        $this->assertNotEmpty($contenido_vista);
    }

    public function test_Administrar()
    {
       ob_start();
        $this->vista->Cargar_Vistas('inicio/index');
        $contenido_vista = ob_get_clean();
        $this->assertNotEmpty($contenido_vista);
    }

    public function test_Administrar_Consulta_Ajax()
    {
       ob_start();
        $this->vista->Cargar_Vistas('inicio/index');
        $contenido_vista = ob_get_clean();
        $this->assertNotEmpty($contenido_vista);
    }

    // =================================================================
}

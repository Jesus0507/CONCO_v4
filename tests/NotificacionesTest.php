<?php

require_once "modelo/notificaciones_class.php";

use PHPUnit\Framework\TestCase;

class NotificacionesTest extends TestCase
{
    private $notificaciones;

    public $datos = array(
        'INSERT' => [
            'usuario_emisor'   => 'juan123',
            'usuario_receptor' => 'maria456',
            'accion'           => 'nueva_mensaje',
            'leido'            => 0,
        ],
        'UPDATE' => [
            'leido'           => 1,
            'id_notificacion' => 1,
        ],
        'DELETE' => [
            'id_notificacion' => 2,
        ],
    );

    protected function setUp(): void
    {$this->notificaciones = new Notificaciones_Class();}

    protected function tearDown(): void
    {$this->notificaciones = null;}

    public function test_SQL_01_INSERT()
    {
        $this->notificaciones->_SQL_("SQL_01");
        $this->notificaciones->_Tipo_(1);
        $this->notificaciones->_Datos_($this->datos["INSERT"]);
        $result = $this->notificaciones->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_02_SELECT_1()
    {
        $this->notificaciones->_Cedula_("7654321");
        $this->notificaciones->_SQL_("SQL_02");
        $this->notificaciones->_Tipo_(0);
        $result = $this->notificaciones->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_03_UPDATE()
    {
        $this->notificaciones->_SQL_("SQL_03");
        $this->notificaciones->_Tipo_(1);
        $this->notificaciones->_Datos_($this->datos["UPDATE"]);
        $result = $this->notificaciones->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_04_DELETE()
    {
        $this->notificaciones->_SQL_("SQL_04");
        $this->notificaciones->_Tipo_(1);
        $this->notificaciones->_Datos_($this->datos["DELETE"]);
        $result = $this->notificaciones->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_05_SELECT_2()
    {
        $this->notificaciones->_SQL_("SQL_05");
        $this->notificaciones->_Tipo_(0);
        $result = $this->notificaciones->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

}

<?php
require_once "modelo/bitacora_class.php";

use PHPUnit\Framework\TestCase; 

class BitacoraTest extends TestCase
{
    private $bitacora;

    public $datos = array(
        'INSERT' => [
        	'cedula_usuario' => '7654321',
            'fecha' => '2023-02-10',
            'dia' => 'Miércoles',
            'hora_inicio' => '12:00:00',
            'acciones' => 'Inicio de sesión',
            'hora_fin' => '12:30:00'
        ],
        'UPDATE_1' => [
        	'id_bitacora' => '2',
            'hora_fin' => '13:00:00'
        ],
        'UPDATE_2' => [
        	'id_bitacora' => '2',
            'acciones' => 'Cambio de contraseña'
        ],  
    );

    protected function setUp(): void       {$this->bitacora = new Bitacora_Class();}

    protected function tearDown(): void    {$this->bitacora = null;}

    public function test_SQL01_SELECT()
    {
        $this->bitacora->_SQL_('SQL_01');
        $this->bitacora->_Tipo_(0);
        $resultado = $this->bitacora->Administrar();
        $this->assertIsArray($resultado);
        $this->assertGreaterThan(0, count($resultado));
    }

    public function test_SQL02_INSERT()
    {
        $this->bitacora->_SQL_('SQL_02');
        $this->bitacora->_Tipo_(1);
        $this->bitacora->_Datos_($this->datos["INSERT"]);
        $resultado = $this->bitacora->Administrar();
        $this->assertTrue($resultado);
    }

    public function test_SQL03_UPDATE_1()
    {
        $this->bitacora->_SQL_('SQL_03');
        $this->bitacora->_Tipo_(1);
        $this->bitacora->_Datos_($this->datos["UPDATE_1"]);
        $resultado = $this->bitacora->Administrar();
        $this->assertTrue($resultado);
    }

    public function test_SQL04_UPDATE_2()
    {
        $this->bitacora->_SQL_('SQL_04');
        $this->bitacora->_Tipo_(1);
        $this->bitacora->_Datos_($this->datos["UPDATE_2"]);
        $resultado = $this->bitacora->Administrar();
        $this->assertTrue($resultado);
    }
}

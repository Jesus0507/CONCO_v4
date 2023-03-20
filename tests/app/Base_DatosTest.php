<?php

use PHPUnit\Framework\TestCase;

class Base_DatosTest extends TestCase
{
    private $BD;
    
    protected function setUp(): void       {$this->BD = new BASE_DATOS();}

    protected function tearDown(): void    {$this->BD = null;}

    public function test_Conexion()
    {
        $this->assertInstanceOf('PDO', $this->BD->Conectar());
        $this->assertEquals(1, $this->BD->Probar_Conexion());
        $this->assertEquals("No se han encontrado errores.", $this->BD->Error_Conexion());
    }
} 

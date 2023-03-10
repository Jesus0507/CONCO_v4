<?php

use PHPUnit\Framework\TestCase;

class MetodosTest extends TestCase
{
    protected $metodos;

    protected function setUp(): void
    {
        $this->metodos = $this->getMockForTrait(Metodos::class);
    }

    public function test_SQL()
    {
        $SQL = 'SELECT * FROM usuarios';
        $this->metodos->_SQL_($SQL);
        $this->expectOutputString('');
    }

    public function test_Tipo()
    {
        $tipo = 1;
        $this->metodos->_Tipo_($tipo);
        $this->expectOutputString('');
    }

    public function test_Datos()
    {
        $datos = ['nombre' => 'Juan', 'apellido' => 'Pérez'];
        $this->metodos->_Datos_($datos);
        $this->expectOutputString('');
    }

    public function test_Estado()
    {
        $estado = ['activo' => true, 'nivel' => 2];
        $this->metodos->_Estado_($estado);
        $this->expectOutputString('');
    }

    public function test_Administrar()
    {
        $this->expectException(Error::class);
        $this->metodos->Administrar();
    }
}

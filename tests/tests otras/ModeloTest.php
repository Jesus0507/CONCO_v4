<?php

use PHPUnit\Framework\TestCase;

class ModeloTest extends TestCase
{
    private $modelo;

    public function setUp(): void
    {
        $this->modelo = new Modelo();
    }

    public function testDesconectarBD(): void
    {
        $this->assertTrue($this->modelo->Desconectar_BD());
    }

    public function testCRUD(): void
    {
        // Asignar valores a la propiedad $estado
        $estado = array(
            'tabla' => 'mi_tabla',
            'id_tabla' => 'mi_id_tabla',
            'estado' => 'mi_estado',
            'columna' => 'mi_columna',
            'orden' => 'mi_orden'
        );
        $modelo->__SET('estado', $estado);
        
        $crud = array(
            'consultar' => array(
                'tabla' => 'mi_tabla',
                'estado' => 'mi_estado',
                'columna' => 'mi_columna',
                'data' => 'mi_data',
                'orden' => 'mi_orden'
            ),
            'registrar' => array(
                'tabla' => 'mi_tabla',
                'columna' => 'mi_columna'
            ),
            'ultimo' => array(
                'tabla' => 'mi_tabla',
                'id' => 'mi_id'
            ),
            'actualizar' => array(
                'tabla' => 'mi_tabla',
                'columna' => 'mi_columna',
                'id_tabla' => 'mi_id_tabla'
            ),
            'eliminar' => array(
                'tabla' => 'mi_tabla',
                'id_tabla' => 'mi_id_tabla'
            )
        );

        $this->modelo->_CRUD_($crud);

        // Verificar que las funciones protegidas devuelvan el resultado esperado
        $this->assertEquals("UPDATE mi_tabla SET estado = :estado WHERE mi_id_tabla = :mi_id_tabla", $modelo->ACT_DES());
        $this->assertEquals("SELECT * FROM mi_tabla WHERE estado = mi_estado ORDER BY mi_orden ASC", $modelo->_01_());
        $this->assertEquals('INSERT INTO mi_tabla (mi_columna, estado) VALUES (:mi_columna, :estado)', $modelo->_02_());
        $this->assertEquals("SELECT MAX(mi_id) FROM mi_tabla", $modelo->_03_());
        $this->assertEquals("UPDATE mi_tabla SET mi_columna = :mi_columna WHERE mi_id_tabla =:mi_id_tabla", $modelo->_04_());
        $this->assertEquals("SELECT * FROM mi_tabla WHERE mi_columna=mi_data", $modelo->_05_());
        $this->assertEquals("SELECT * FROM mi_tabla ORDER BY mi_orden ASC", $modelo->_06_());
        $this->assertEquals("DELETE FROM mi_tabla WHERE mi_id_tabla = :mi_id_tabla", $modelo->_07_());
        $this->assertEquals("SELECT COUNT(*) AS count FROM mi_tabla WHERE mi_columna = :mi_data AND estado = 1", $modelo->_08_());
        
        $this->assertEquals($crud, $this->modelo->__GET('crud'));
    }

    public function testCapturarError(): void
    {
        $exception = new Exception('Test Exception');

        $error_log = new stdClass();
        $error_log->Modulo = "------" . 'testModulo' . "------";
        $error_log->Fecha = $GLOBALS['fecha_larga'];
        $error_log->Hora = date('h:i:s A');
        $error_log->Archivo = $exception->getFile();
        $error_log->Linea = $exception->getLine();
        $error_log->Mensaje = $exception->getMessage();

        $expected_error = 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: </br>' .
            "[ Archivo ] => " . $exception->getFile() . "</br>" .
            "[ Linea ]   => (" . $exception->getLine() . ")</br>" .
            "[ Codigo ]   => (" . $exception->getCode() . ")</br>" .
            "[ Error PHP]   => (" . $exception->getMessage() . ")</br>";

        $this->expectOutputString($expected_error);

        $this->assertFalse($this->modelo->Capturar_Error($exception, 'testModulo'));
    }

    public function testACTDES(): void
    {
        $this->modelo->__SET('estado', array(
            'tabla' => 'tabla',
            'id_tabla' => 'id_tabla',
        ));

        $expected_query = "UPDATE tabla SET estado = :estado WHERE id_tabla = :id_tabla";

        $this->assertEquals($expected_query, $this->modelo->ACT_DES());
    }

    public function test01(): void
    {
        $this->modelo->_CRUD_(array(
            'consultar' => array(
                'tabla' => 'tabla',
                'estado' => 'estado',
                'orden' => 'orden',
            ),
        ));

        $expected_query = "SELECT * FROM tabla WHERE estado = estado ORDER BY orden ASC";

        $this->assertEquals($expected_query, $this->modelo->_01_());
    }

}
<?php

require_once "modelo/grupos_deportivos_class.php";

use PHPUnit\Framework\TestCase;

class Grupos_DeportivosTest extends TestCase
{

    public $datos = array(
        'INSERT_1' => [
            'id_deporte'             => 1,
            'nombre_grupo_deportivo' => "BLUES",
            'descripcion'            => "EQUIPO DE FOOTBALL",
            'estado'                 => 1,
        ],
        'INSERT_2' => [
            'cedula_persona'     => "7654321",
            'id_grupo_deportivo' => 2,
            'estado'             => 1,

        ],
        'UPDATE'   => [
            'id_grupo_deportivo'     => 2,
            'id_deporte'             => 2,
            'nombre_grupo_deportivo' => "REDS",
            'descripcion'            => "EQUIPO DE BASEBALL",
            'estado'                 => 1,
        ],

    );

    protected function setUp(): void
    {$this->grupos_deportivos = new Grupos_Deportivos_Class();}

    protected function tearDown(): void
    {$this->grupos_deportivos = null;}

    public function test_SQL_01_INSERT_1()
    {
        $this->grupos_deportivos->_SQL_("SQL_01");
        $this->grupos_deportivos->_Tipo_(1);
        $this->grupos_deportivos->_Datos_($this->datos["INSERT_1"]);
        $result = $this->grupos_deportivos->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_02_UPDATE()
    {
        $this->grupos_deportivos->_SQL_("SQL_02");
        $this->grupos_deportivos->_Tipo_(1);
        $this->grupos_deportivos->_Datos_($this->datos["UPDATE"]);
        $result = $this->grupos_deportivos->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_03_SELECT_1()
    {
        $this->grupos_deportivos->_SQL_("SQL_03");
        $this->grupos_deportivos->_Tipo_(0);
        $result = $this->grupos_deportivos->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_04_SELECT_2()
    {
        $this->grupos_deportivos->_SQL_("SQL_04");
        $this->grupos_deportivos->_Tipo_(0);
        $result = $this->grupos_deportivos->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_05_SELECT_3()
    {
        $this->grupos_deportivos->_ID_(2);
        $this->grupos_deportivos->_SQL_("SQL_05");
        $this->grupos_deportivos->_Tipo_(0);
        $result = $this->grupos_deportivos->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_06_INSERT_2()
    {
        $this->grupos_deportivos->_SQL_("SQL_06");
        $this->grupos_deportivos->_Tipo_(1);
        $this->grupos_deportivos->_Datos_($this->datos["INSERT_2"]);
        $result = $this->grupos_deportivos->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_07_SELECT_4()
    {
        $this->grupos_deportivos->_SQL_("SQL_07");
        $this->grupos_deportivos->_Tipo_(0);
        $result = $this->grupos_deportivos->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

}

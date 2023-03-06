<?php

require_once "modelo/centro_votacion_class.php";

use PHPUnit\Framework\TestCase; 

class Centro_VotacionTest extends TestCase
{
 	private $centro_votacion;

    public $datos = array(
        'INSERT_1' =>  [
        	'id_centro_votacion' => 1,
        	'cedula_votante' => "7654321",
        	'estado' => 1, 
        ],
        'INSERT_2' =>  [
        	'id_parroquia' => 1,
        	'nombre_centro' => "La Milagrosa",
        	'estado' => 1, 
        ],
        'UPDATE' =>  [
        	"id_centro_votacion" => 1,
    		"cedula_votante" => "7654321",
    		"estado" => 1,
    		"id_votante_centro_votacion" => 1
        ],
        'SELECT' =>  [
        	'cedula_votante' => "7654321",
        ],    
    );

    protected function setUp(): void       {$this->centro_votacion = new Centro_Votacion_Class();}

    protected function tearDown(): void    {$this->centro_votacion = null;}

    public function test_SQL_01_SELECT()
    {
        $this->centro_votacion->_SQL_("SQL_01");
        $this->centro_votacion->_Tipo_(0);
        $result = $this->centro_votacion->Administrar();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_01_SELECT_2()
    {
        $this->centro_votacion->_SQL_("SQL_02");
        $this->centro_votacion->_Tipo_(0);
        $result = $this->centro_votacion->Administrar();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_03_INSERT()
    {
        $this->centro_votacion->_SQL_("SQL_03");
        $this->centro_votacion->_Tipo_(1);
        $this->centro_votacion->_Datos_($this->datos["INSERT_1"]);
        $result = $this->centro_votacion->Administrar();

        $this->assertTrue($result);
    }

    public function test_SQL_04_INSERT()
    {
        $this->centro_votacion->_SQL_("SQL_04");
        $this->centro_votacion->_Tipo_(1);
        $this->centro_votacion->_Datos_($this->datos["INSERT_2"]);
        $result = $this->centro_votacion->Administrar();

        $this->assertTrue($result);
    }
    public function test_SQL_05_UPDATE()
    {
        $this->centro_votacion->_SQL_("SQL_05");
        $this->centro_votacion->_Tipo_(1);
        $this->centro_votacion->_Datos_($this->datos["UPDATE"]);
        $result = $this->centro_votacion->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_06_SELECT_3()
    {
        $this->centro_votacion->_SQL_("SQL_06");
        $this->centro_votacion->_Tipo_(0);
        $result = $this->centro_votacion->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_07_SELECT_4()
    {
        $this->centro_votacion->_SQL_("SQL_07");
        $this->centro_votacion->_Tipo_(2);
        $this->centro_votacion->_Datos_($this->datos["SELECT"]);
        $result = $this->centro_votacion->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}

<?php

require_once "modelo/consejo_comunal_class.php";

use PHPUnit\Framework\TestCase; 

class Consejo_ComunalTest extends TestCase
{ 
	private $consejo_comunal;

    public $datos = array(
        'INSERT' => [
        	'id_comite' => 1,
    		'cedula_persona' => '7654321',
    		'cargo_persona' => 'Presidente',
    		'fecha_ingreso' => '2023-02-10',
    		'fecha_salida' => '2024-02-10'
        ],
        'UPDATE' => [
        	':id_comite' => 2,
    		':cedula_persona' => '7654321',
    		':cargo_persona' => 'Secretario',
    		':fecha_ingreso' => '2022-01-01',
    		':fecha_salida' => null, 
    		':id_comite_persona' => 1
        ],  
    );

    protected function setUp(): void       {$this->consejo_comunal = new Consejo_Comunal_Class();}

    protected function tearDown(): void    {$this->consejo_comunal = null;}
      
    public function test_SQL_01_SELECT()
    {
        $this->consejo_comunal->_SQL_("SQL_01");
        $this->consejo_comunal->_Tipo_(0);
        $result = $this->consejo_comunal->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_INSERT()
    {
        $this->consejo_comunal->_SQL_("SQL_02");
        $this->consejo_comunal->_Tipo_(1);
        $this->consejo_comunal->_Datos_($this->datos["INSERT"]);
        $result = $this->consejo_comunal->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_03_UPDATE()
    {
        $this->consejo_comunal->_SQL_("SQL_03");
        $this->consejo_comunal->_Tipo_(1);
        $this->consejo_comunal->_Datos_($this->datos["UPDATE"]);
        $result = $this->consejo_comunal->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_04_SELECT()
    {
        $this->consejo_comunal->_SQL_("SQL_04");
        $this->consejo_comunal->_Tipo_(0);
        $result = $this->consejo_comunal->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}

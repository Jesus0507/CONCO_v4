<?php

require_once "modelo/login_class.php";

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    
   private $login;

   protected function setUp(): void       {$this->login = new Login_Class();}

    protected function tearDown(): void    {$this->login = null;}

    public function test_SQL_01_SELECT()
    {
        $this->login->_SQL_("SQL_01");
        $this->crud["consultar"] = array("columna" => "cedula_persona", "data" =>"7654321");
        $this->login->_CRUD_($this->crud);
        $this->login->_Tipo_(0);
        $result = $this->login->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    } 
}

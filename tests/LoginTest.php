<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    
    public function test_Usuario_Existe()
    {
        $Login       = new Login_Class();
        $cedula      = '654321';
        $contrasenia = 'clave';
        $data        = $Login->Usuario_Existe($cedula, $contrasenia);
        $this->assertEquals(count($data), true);
    }

    public function test_Cerrar_Session()
    {
        $Login = new Login_Class();
        $data  = $Login->Cerrar_Session();
        $this->assertEquals(count($data), false);
    }
}

<?php
use PHPUnit\Framework\TestCase;

class ReportesTest extends TestCase
{
    public function test_Familia_Vivienda()
    {
        $modelo = new Reportes_Class();
        $id_familia = 8;
        $data = $modelo->Familia_Vivienda($id_familia);
        $this->assertEquals(count($data), true);
    }
    public function test_Techo()
    {
        $modelo = new Reportes_Class();
        $id_techo = 2;
        $data = $modelo->Techo($id_techo);
        $this->assertEquals(count($data), true);
    }
    public function test_Pared()
    {
        $modelo = new Reportes_Class();
        $id_Pared = 2;
        $data = $modelo->Pared($id_Pared);
        $this->assertEquals(count($data), true);
    }
    public function test_Piso()
    {
        $modelo = new Reportes_Class();
        $id_Piso = 2;
        $data = $modelo->Piso($id_Piso);
        $this->assertEquals(count($data), true);
    }
    public function test_GAS()
    {
        $modelo = new Reportes_Class();
        $id_GAS = 11;
        $data = $modelo->GAS($id_GAS);
        $this->assertEquals(count($data), true);
    }
    public function test_Integranres()
    {
        $modelo = new Reportes_Class();
        $id_Integranres = 8;
        $data = $modelo->Integranres($id_Integranres);
        $this->assertEquals(count($data), true);
    }
    public function test_Personas_Proyecto()
    {
        $modelo = new Reportes_Class();
        $cedula = "26142326";
        $data = $modelo->Personas_Proyecto($cedula);
        $this->assertEquals(count($data), true);
    }
}

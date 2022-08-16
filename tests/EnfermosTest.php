<?php
use PHPUnit\Framework\TestCase; 

class EnfermosTest extends TestCase
{ 

    public function test_Consultar_personas()
    {
        $modelo = new Enfermos_Class();
        $data = $modelo->Consultar_personas();
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar_enfermedades()
    {
        $modelo = new Enfermos_Class();
        $data = $modelo->Consultar_enfermedades();
        $this->assertEquals(count($data), true);
    }

    public function test_get_enfermos()
    {
        $modelo = new Enfermos_Class();
        $data = $modelo->get_enfermos();
        $this->assertEquals(count($data), true);
    }

    public function test_get_enfermedades()
    {
        $modelo = new Enfermos_Class();
        $data = $modelo->get_enfermedades();
        $this->assertEquals(count($data), true);
    }

    public function test_registrar_enfermedad_persona()
    {
        $modelo = new Enfermos_Class();
        $datos = [
            'cedula_persona'      => "26142326",
            'id_enfermedad'       => 1,
            'medicamentos'        => "Salbutamol"
        ];
        $data = $modelo->registrar_enfermedad_persona(
            [
                'cedula_persona' =>  $datos['cedula_persona'],
                'id_enfermedad'  =>  $datos['id_enfermedad'],
                'medicamentos'   =>  $datos['medicamentos']
            ]
        );
        $this->assertEquals(count($data), true);
    }

}

<?php
use PHPUnit\Framework\TestCase; 

class DiscapacitadosTest extends TestCase
{ 

    public function test_Consultar_personas()
    {
        $modelo = new Discapacitados_Class();
        $data = $modelo->Consultar_personas();
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar_discapacidades()
    {
        $modelo = new Discapacitados_Class();
        $data = $modelo->Consultar_discapacidades();
        $this->assertEquals(count($data), true);
    }

    public function test_get_discapacitados()
    {
        $modelo = new Discapacitados_Class();
        $data = $modelo->get_discapacitados();
        $this->assertEquals(count($data), true);
    }

    public function test_get_discapacidades()
    {
        $modelo = new Discapacitados_Class();
        $data = $modelo->get_discapacidades();
        $this->assertEquals(count($data), true);
    }

    public function test_registrar_discapacidad_persona()
    {
        $modelo = new Discapacitados_Class();
        $datos = [
            'cedula_persona'             => "26142326",
            'id_discapacidad'            => 1,
            'necesidades_discapacidad'   => "silla de ruedas",
            'observacion_discapacidad'   => "No posee",
            'en_cama'                    => 1
        ];
        $data = $modelo->registrar_discapacidad_persona(
            [
                'cedula_persona'             => $datos["cedula_persona"],
                'id_discapacidad'            => $datos["id_discapacidad"],
                'necesidades_discapacidad'   => $datos["necesidades"],
                'observacion_discapacidad'   => $datos["observaciones"],
                'en_cama'                    => $datos["en_cama"]
            ]
        );
        $this->assertEquals(count($data), true);
    }

}

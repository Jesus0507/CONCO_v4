<?php
use PHPUnit\Framework\TestCase; 

class Consejo_ComunalTest extends TestCase
{ 

    public function test_Registrar()
    {
        $modelo = new Consejo_Comunal_Class();
        $datos = [
            'id_comite'      => 1,
            'cedula_persona'   => "26142326",
            'cargo_persona'   => "Vocero Principal",
            'fecha_ingreso'   => "2021-11-13",
            'fecha_salida'   => "2025-01-03"
        ];
        $data = $modelo->Registrar(
            [
                'id_comite'      => $datos['id_comite'],
                'cedula_persona'   => $datos['cedula_persona'],
                'cargo_persona'   => $datos['cargo_persona'],
                'fecha_ingreso'   => $datos['fecha_ingreso'],
                'fecha_salida'   => $datos['fecha_salida']
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar()
    {
        $modelo = new Consejo_Comunal_Class();
        $data = $modelo->Consultar();
        $this->assertEquals(count($data), true);
    }

    public function test_Actualizar()
    {
        $modelo = new Consejo_Comunal_Class();
        $datos = [
            'id_comite_persona'  => 1,
            'id_comite'      => 1,
            'cedula_persona'   => "26142326",
            'cargo_persona'   => "Vocero Supelte",
            'fecha_ingreso'   => "2021-11-13",
            'fecha_salida'   => "2025-01-03"
        ];
        $data = $modelo->Actualizar(
            [
                'id_comite_persona'      => $datos['id_comite_persona'],
                'id_comite'      => $datos['id_comite'],
                'cedula_persona'   => $datos['cedula_persona'],
                'cargo_persona'   => $datos['cargo_persona'],
                'fecha_ingreso'   => $datos['fecha_ingreso'],
                'fecha_salida'   => $datos['fecha_salida']
            ]
        );
        $this->assertEquals(count($data), true);
    }

}

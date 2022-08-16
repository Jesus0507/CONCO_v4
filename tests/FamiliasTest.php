<?php
use PHPUnit\Framework\TestCase;

class FamiliasTest extends TestCase
{

    public function test_Consultar_viviendas()
    {
        $modelo = new Familias_Class();
        $data = $modelo->Consultar_viviendas();
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar_personas()
    {
        $modelo = new Familias_Class();
        $data = $modelo->Consultar_personas();
        $this->assertEquals(count($data), true);
    }

    public function test_get_familias()
    {
        $modelo = new Familias_Class();
        $data = $modelo->get_familias();
        $this->assertEquals(count($data), true);
    }

    public function test_get_integrantes()
    {
        $modelo = new Familias_Class();
        $id_familia = 8;
        $data = $modelo->get_integrantes($id_familia);
        $this->assertEquals(count($data), true);
    }

    public function test_Registrar_Familia()
    {
        $modelo = new Familias_Class();
        $datos = [
            'id_vivienda' => 2,
            'condicion_ocupacion' => "Adjudicada",
            'nombre_familia' => "Perez",
            'observacion' => "Sin observaciones",
            'telefono_familia' => "0251784633",
            'ingreso_mensual_aprox' => "60 Bs",
        ];
        $data = $modelo->Registrar_Familia(
            [
                'id_vivienda' => $datos['id_vivienda'],
                'condicion_ocupacion' => $datos["condicion_ocupacion"],
                'nombre_familia' => $datos['nombre_familia'],
                'observacion' => $datos['observacion'],
                'telefono_familia' => $datos['telefono_familia'],
                'ingreso_mensual_aprox' => $datos['ingreso_mensual_aprox'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Registrar_persona_familia()
    {
        $modelo = new Familias_Class();
        $datos = [
            'id_familia' => 6,
            'cedula_persona' => "26142326"
        ];
        $data = $modelo->Registrar_persona_familia(
            [
                'id_familia'      => $datos['id_familia'],
                'cedula_persona'   => $datos['cedula_persona']
            ]
        );
        $this->assertEquals(count($data), true);
    }

}

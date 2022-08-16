<?php
use PHPUnit\Framework\TestCase; 

class PartoHumanizadoTest extends TestCase
{
    public function test_Consultar()
    {
        $modelo = new Parto_Humanizado_Class();
        
        $data = $modelo->Consultar();
        $this->assertEquals(count($data), true);
    }

    public function test_Registrar()
    {
        $modelo = new Parto_Humanizado_Class();
        $datos = [
            'cedula_persona' => "030201",
            'recibe_micronutrientes' => 1,
            'tiempo_gestacion' => "7 semanas",
            'fecha_aprox_parto' => "2022-07-28",
        ];
        $data = $modelo->Registrar(
            [
                'cedula_persona' => $datos['cedula_persona'],
                'recibe_micronutrientes' => $datos['recibe_micronutrientes'],
                'tiempo_gestacion' => $datos['tiempo_gestacion'],
                'fecha_aprox_parto' => $datos['fecha_aprox_parto'],
                'estado'   => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Actualizar()
    {
        $modelo = new Parto_Humanizado_Class();
        $datos = [
            'id_parto_humanizado' => 1,
            'cedula_persona' => "030201",
            'recibe_micronutrientes' => 1,
            'tiempo_gestacion' => "12 semanas",
            'fecha_aprox_parto' => "2022-07-28",
        ];
        
        $data = $modelo->Actualizar(
            [
                'id_parto_humanizado' => $datos['id_parto_humanizado'],
                'cedula_persona' => $datos['cedula_persona'],
                'recibe_micronutrientes' => $datos['recibe_micronutrientes'],
                'tiempo_gestacion' => $datos['tiempo_gestacion'],
                'fecha_aprox_parto' => $datos['fecha_aprox_parto'],
                'estado'   => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }

    

}

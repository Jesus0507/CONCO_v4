<?php
use PHPUnit\Framework\TestCase; 

class SolicitudesTest extends TestCase
{
    
    public function test_Registrar()
    {
        $modelo = new Solicitudes_Class();
        $datos = [
            'cedula_persona' => "26142326   ",
            'tipo_constancia' => "Residencia",
            'motivo_constancia' => "Requerido para proceso universitario",
        ];
        $data = $modelo->Registrar(
            [
                'cedula_persona' => $datos['cedula_persona'],
                'tipo_constancia' => $datos['tipo_constancia'],
                'procesada' => 0,
                'motivo_constancia' => $datos['motivo_constancia'],
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar()
    {
        $modelo = new Solicitudes_Class();
        
        $data = $modelo->Consultar();
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar_all()
    {
        $modelo = new Solicitudes_Class();
        
        $data = $modelo->Consultar_all();
        $this->assertEquals(count($data), true);
    }

    public function test_setStatus()
    {
        $modelo = new Solicitudes_Class();
        $datos = [
            'procesada' => "1",
            'id_solicitud' => "1",
            'observaciones' => "Rechazada el 1-11-2021/No cumple los requisitos",
        ];
        
        $data = $modelo->setStatus(
            [
                'procesada' => $datos['procesada'],
                'id_solicitud' => $datos['id_solicitud'],
                'observaciones' => $datos['observaciones'],
            ]
        );
        $this->assertEquals(count($data), true);
    }

    

}

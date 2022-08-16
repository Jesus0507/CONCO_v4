<?php
use PHPUnit\Framework\TestCase; 

class CallesTest extends TestCase
{
    
    public function test_Registrar()
    {
        $modelo = new Calles_Class();
        $datos = [
            'nombre_calle'      => "Calle 16",
            'condicion_calle'   => "Mal Estado",
        ];
        $data = $modelo->Registrar(
            [
                'nombre_calle'      => $datos['nombre_calle'],
                'condicion_calle'   => $datos['condicion_calle'], 
                'estado'   => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Actualizar()
    {
        $modelo = new Calles_Class();
        $datos = [
            'id_calle'      => 1,
            'nombre_calle'      => "Calle 16",
            'condicion_calle'   => "Mal Estado"
        ];
        
        $data = $modelo->Actualizar(
            [
                'id_calle'      => $datos['id_calle'],
                'nombre_calle'      => $datos['nombre_calle'],
                'condicion_calle'   => $datos['condicion_calle'], 
                'estado'   => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Eliminar()
    {
        $modelo = new Calles_Class();
        $id_calle = 1;
        
        $data = $modelo->Eliminar($id_calle);
        $this->assertEquals(count($data), true);
    }

}

<?php
use PHPUnit\Framework\TestCase; 

class InmueblesTest extends TestCase
{
    
    public function test_Registrar()
    {
        $modelo = new Inmuebles_Class();
        $datos = [
            'id_calle' => 3,
            'nombre_inmueble' => "U.E La Milagrosa",
            'direccion_inmueble' => "Carrera 2 y 3",
            'id_tipo_inmueble' => 3,
        ];
        $data = $modelo->Registrar(
            [
                'id_calle' => $datos['id_calle'],
                'nombre_inmueble' => $datos['nombre_inmueble'],
                'direccion_inmueble' => $datos['direccion_inmueble'],
                'id_tipo_inmueble' => $datos['id_tipo_inmueble'],
                'estado'   => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar()
    {
        $modelo = new Inmuebles_Class();
        
        $data = $modelo->Consultar();
        $this->assertEquals(count($data), true);
    }

    public function test_Actualizar()
    {
        $modelo = new Inmuebles_Class();
        $datos = [
            'id_inmueble'      => 1,
            'id_calle' => 3,
            'nombre_inmueble' => "U.E La Milagrosa 2",
            'direccion_inmueble' => "Carrera 2 y 3",
            'id_tipo_inmueble' => 3,
        ];
        
        $data = $modelo->Actualizar(
            [
                'id_inmueble' => $datos['id_inmueble'],
                'id_calle' => $datos['id_calle'],
                'nombre_inmueble' => $datos['nombre_inmueble'],
                'direccion_inmueble' => $datos['direccion_inmueble'],
                'id_tipo_inmueble' => $datos['id_tipo_inmueble'],
                'estado'   => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }

    

}

<?php
use PHPUnit\Framework\TestCase; 

class NegociosTest extends TestCase
{
    
    public function test_Registrar()
    {
        $modelo = new Negocios_Class();
        $datos = [
            'id_calle' => 2,
            'nombre_negocio' => "Rodriguez Carniceria",
            'direccion_negocio' => "Carrera 1 y 2",
            'cedula_propietario' => "26142326",
            'rif_negocio' => "004-123-567-1",
        ];
        $data = $modelo->Registrar(
            [
                'id_calle' => $datos['id_calle'],
                'nombre_negocio' => $datos['nombre_negocio'],
                'direccion_negocio' => $datos['direccion_negocio'],
                'cedula_propietario' => $datos['cedula_propietario'],
                'rif_negocio' => $datos['rif_negocio'],
                'estado'   => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar()
    {
        $modelo = new Negocios_Class();
        
        $data = $modelo->Consultar();
        $this->assertEquals(count($data), true);
    }

    public function test_Actualizar()
    {
        $modelo = new Negocios_Class();
        $datos = [
            'id_negocio'      => 3,
            'nombre_negocio' => "Rodriguez Carniceria",
            'direccion_negocio' => "Carrera 1 y 2",
            'cedula_propietario' => "26142326",
            'rif_negocio' => "004-123-567-1",
        ];
        
        $data = $modelo->Actualizar(
            [
                'id_negocio' => $datos['id_negocio'],
                'id_calle' => $datos['id_calle'],
                'nombre_negocio' => $datos['nombre_negocio'],
                'direccion_negocio' => $datos['direccion_negocio'],
                'cedula_propietario' => $datos['cedula_propietario'],
                'rif_negocio' => $datos['rif_negocio'],
                'estado'   => 1,
            ]
        );
        $this->assertEquals(count($data), true);
    }

}

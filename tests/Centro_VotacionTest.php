<?php
use PHPUnit\Framework\TestCase; 

class Centro_VotacionTest extends TestCase
{
 
    public function test_Registrar_Votantes()
    {
        $modelo = new Centro_Votacion_Class();
        $datos = [
            'id_centro_votacion'      => 1,
            'cedula_votante'   => "26142326", 
        ];
        $data = $modelo->Registrar_Votantes(
            [
                'id_centro_votacion'      => $datos['id_centro_votacion'],
                'cedula_votante'   => $datos['cedula_votante'], 
                'estado'   => 1
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Registrar_Centro_Votacion()
    {
        $modelo = new Centro_Votacion_Class();
        $datos = [
            'id_parroquia'      => 1,
            'nombre_centro'   => "U.E La Milagrosa", 
        ];
        $data = $modelo->Registrar_Centro_Votacion(
            [
                'id_parroquia'      => $datos['id_parroquia'],
                'nombre_centro'   => $datos['nombre_centro'], 
                'estado'   => 1
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Actualizar_Votantes()
    {
        $modelo = new Centro_Votacion_Class();
        $datos = [
            'id_votante_centro_votacion'      => 2,
            'id_centro_votacion'      => 1,
            'cedula_votante'   => "26142326", 
        ];
        $data = $modelo->Actualizar_Votantes(
            [
                'id_votante_centro_votacion'      => $datos['id_votante_centro_votacion'],
                'id_centro_votacion'      => $datos['id_centro_votacion'],
                'cedula_votante'   => $datos['cedula_votante'], 
                'estado'   => 1
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Centro_Votacion()
    {
        $modelo = new Centro_Votacion_Class();
        $data = $modelo->Centro_Votacion();
        $this->assertEquals(count($data), true);
    }

    public function test_Persona_Centro_Votacion()
    {
        $modelo = new Centro_Votacion_Class();
        $data = $modelo->Persona_Centro_Votacion();
        $this->assertEquals(count($data), true);
    }

    
}

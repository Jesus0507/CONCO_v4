<?php
use PHPUnit\Framework\TestCase;

class Grupos_DeportivosTest extends TestCase
{

    public function test_Registrar()
    {
        $modelo = new Grupos_Deportivos_Class();
        $datos = [
            'id_deporte'      => 1,
            'nombre_grupo_deportivo'   => "YAYAJU",
            'descripcion'   => "Equipo de Football"
        ];
        $data = $modelo->Registrar(
            [
                'id_deporte'      => $datos['id_deporte'],
                'nombre_grupo_deportivo'   => $datos['nombre_grupo_deportivo'],
                'descripcion'   => $datos['descripcion'], 
                'estado' => 1
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Actualizar()
    {
        $modelo = new Grupos_Deportivos_Class();
        $datos = [
            'id_grupo_deportivo'      => 1,
            'id_deporte'      => 1,
            'nombre_grupo_deportivo'   => "YAYAJU",
            'descripcion'   => "Equipo de Football"
        ];
        $data = $modelo->Actualizar(
            [
                'id_grupo_deportivo'      => $datos['id_grupo_deportivo'],
                'id_deporte'      => $datos['id_deporte'],
                'nombre_grupo_deportivo'   => $datos['nombre_grupo_deportivo'],
                'descripcion'   => $datos['descripcion'], 
                'estado' => 1
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar()
    {
        $modelo = new Grupos_Deportivos_Class();
        $data = $modelo->Consultar();
        $this->assertEquals(count($data), true);
    }

    public function test_Grupo_Deportivo_Persona()
    {
        $modelo = new Grupos_Deportivos_Class();
        $id_grupo_deportivo = 1;
        $data = $modelo->Grupo_Deportivo_Persona($id_grupo_deportivo);
        $this->assertEquals(count($data), true);
    }

    public function test_Registrar_Personas_Grupo_Deportivo()
    {
        $modelo = new Grupos_Deportivos_Class();
        $datos = [
            'cedula_persona'   => "26142326",
            'id_grupo_deportivo'      => 1,
        ];
        $data = $modelo->Registrar_Personas_Grupo_Deportivo(
            [
                'cedula_persona'      => $datos['cedula_persona'],
                'id_grupo_deportivo'   => $datos['id_grupo_deportivo'],
                'estado' => 1
            ]
        );
        $this->assertEquals(count($data), true);
    }

}

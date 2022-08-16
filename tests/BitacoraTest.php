<?php
use PHPUnit\Framework\TestCase; 

class AgendaTest extends TestCase
{
 
    public function test_Registro_De_Inicio()
    {
        $modelo = new Bitacora_Class();
        $datos = [
            'cedula_usuario'  => "26142326",
            'fecha'           => "2021-11-03",
            'dia'             => "Miercoles",
            'hora_inicio'     => "04:27:16 PM",
            'acciones'        => "Ingresó al módulo Consultar eventos a las 7 de la mañana con 58 minutos",
            'hora_fin'        => "10:20:58 AM",
        ];
        $data = $modelo->Registro_De_Inicio(
            [
                'cedula_usuario'  => $datos['cedula_usuario'],
                'fecha'           => $datos['fecha'],
                'dia'             => $datos['dia'],
                'hora_inicio'     => $datos['hora_inicio'],
                'acciones'        => $datos['acciones'],
                'hora_fin'        => $datos['hora_fin'],
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Registro_De_Salida()
    {
        $modelo = new Bitacora_Class();
        $datos = [
            'id_bitacora'        => 18,
            'hora_fin'        => "11:30:58 AM",
        ];
        $data = $modelo->Registro_De_Salida(
            [
                'id_bitacora'        => $datos['id_bitacora'],
                'hora_fin'        => $datos['hora_fin'],
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Nueva_Accion()
    {
        $modelo = new Bitacora_Class();
        $datos = [
            'id_bitacora'        => 18,
            'acciones'        => "Salió del módulo Inicio a las 9 de la mañana con 15 minutos",
        ];
        $data = $modelo->Nueva_Accion(
            [
                'id_bitacora'        => $datos['id_bitacora'],
                'acciones'        => $datos['acciones'],
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar_Bitacora()
    {
        $modelo = new Bitacora_Class();
        $data = $modelo->Consultar_Bitacora();
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar_Bitacora_ID()
    {
        $modelo = new Bitacora_Class();
        $id_bitacora = 18;
        $data = $modelo->Consultar_Bitacora_ID($id_bitacora);
        $this->assertEquals(count($data), true);
    }

}

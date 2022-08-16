<?php
use PHPUnit\Framework\TestCase; 

class NotificacionesTest extends TestCase
{
    
    public function test_Registrar()
    {
        $modelo = new Notificaciones_Class();
        $datos = [
            'usuario_emisor'      => "26142326",
            'usuario_receptor'      => "654321",
            'accion'      => "3/Armando Paredes Creó el evento ``Jornada de Cedulacion´´ para la(s) fecha(s) : 2021-11-11 en Calle 15 De 08:00 AM hasta 10:00 AM",
        ];
        $data = $modelo->Registrar(
            [
                'usuario_emisor'      => $datos['cedula_usuario'],
                'usuario_receptor'      => $datos['usuario_receptor'],
                'accion'      => $datos["accion"],
                'leido'     => 0
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar()
    {
        $modelo = new Notificaciones_Class();
        $cedula_receptor = "26142326";
        $data = $modelo->Consultar($cedula_receptor);
        $this->assertEquals(count($data), true);
    }

    public function test_get_receptores_1()
    {
        $modelo = new Notificaciones_Class();
        $data = $modelo->get_receptores_1();
        $this->assertEquals(count($data), true);
    }

    public function test_get_receptores_2()
    {
        $modelo = new Notificaciones_Class();
        $data = $modelo->get_receptores_2();
        $this->assertEquals(count($data), true);
    }

    public function test_setStatus()
    {
        $modelo = new Notificaciones_Class();
        $datos = [
            'leido'     => 1,
            'id_notificacion'     => 6
        ];
        $data = $modelo->setStatus(
            [
                'leido'     => $datos['leido'],
                'id_notificacion'     => $datos['id_notificacion'],
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Eliminar()
    {
        $modelo = new Notificaciones_Class();
        $id_notificacion = 9;
        $data = $modelo->Eliminar($id_notificacion);
        $this->assertEquals(count($data), true);
    }
    
}

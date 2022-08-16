<?php
 
use PHPUnit\Framework\TestCase; 
 
class AgendaTest extends TestCase
{
  
    public function test_Registrar()
    {
        $modelo = new Agenda_Class();
        $datos = [
                'tipo_evento'  => "Jornada de Cedulacion",
                'fecha'        => "2021-12-30",
                'creador'      => "654321",
                'ubicacion'    => "Calle 15",
                'horas'        => "De 08:00 AM hasta 10:00 AM",
                'detalle'      => "Sin especificaciones"
        ];
        $data = $modelo->Registrar(
            [
                'tipo_evento'  => $datos['tipo_evento'],
                'fecha'        => $datos['fecha'],
                'creador'      => $datos['creador'],
                'ubicacion'    =>$datos['ubicacion'],
                'horas'        =>$datos['horas'],
                'detalle'      => $datos['detalle']
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar()
    {
        $modelo = new Agenda_Class();
        $data = $modelo->Consultar();
        $this->assertEquals(count($data), true);
    }

    public function test_get_calles()
    {
        $modelo = new Agenda_Class();
        $data = $modelo->get_calles();
        $this->assertEquals(count($data), true);
    }

    public function test_get_inmuebles()
    {
        $modelo = new Agenda_Class();
        $data = $modelo->get_inmuebles();
        $this->assertEquals(count($data), true);
    }

    public function test_Actualizar()
    {
        $modelo = new Agenda_Class();
        $datos = [
                'id_agenda'    => 6,
                'tipo_evento'  => "Jornada de Cedulacion",
                'fecha'        => "2021-12-15",
                'creador'      => "654321",
                'ubicacion'    => "Calle 17",
                'horas'        => "De 08:00 AM hasta 10:00 AM",
                'detalle'      => "Sin especificaciones"
        ];
        $data = $modelo->Actualizar(
            [
                'id_agenda'  => $datos['id_agenda'],
                'tipo_evento'  => $datos['tipo_evento'],
                'fecha'        => $datos['fecha'],
                'creador'      => $datos['creador'],
                'ubicacion'    =>$datos['ubicacion'],
                'horas'        =>$datos['horas'],
                'detalle'      => $datos['detalle']
            ]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Eliminar()
    {
        $modelo = new Agenda_Class();
        $id_agenda = 9;
        
        $data = $modelo->Eliminar($id_agenda);
        $this->assertEquals(count($data), true);
    }
 
}

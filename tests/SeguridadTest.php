<?php
use PHPUnit\Framework\TestCase;

class SeguridadTest extends TestCase
{
    public function test_consulta_seguridad()
    {
        $modelo = new Seguridad_Class();

        $data = $modelo->consulta_seguridad();
        $this->assertEquals(count($data), true);
    }

    public function test_get_permisos()
    {
        $modelo = new Seguridad_Class();

        $cedula = "26142326";
        $data = $modelo->get_permisos($cedula);
        $this->assertEquals(count($data), true);
    }

    public function test_change_permiso()
    {
        $modelo = new Seguridad_Class();
        $datos = [
            "campo" => "id_modulo",
            'permiso' => "registrar",
            'id_permiso_usuario_modulo' => "agricola",
        ];
        $data = $modelo->change_permiso([
            'campo' => $datos['campo'],
            'permiso' => $datos['permiso'],
            'id_permiso_usuario_modulo' => $datos['id_permiso_usuario_modulo'],
        ]);
        $this->assertEquals(count($data), true);
    }

    public function test_change_roles()
    {
        $modelo = new Seguridad_Class();
        $datos = [
            'rol_inicio' => "Habitante",
            'cedula_usuario' => "26142326",
            'contrasenia' => "0123456789",
        ];
        $data = $modelo->change_roles([
            'rol_inicio' => $datos['rol_inicio'],
            'cedula_usuario' => $datos['cedula_usuario'],
            'contrasenia' => $datos['contrasenia'],
        ]);
        $this->assertEquals(count($data), true);
    }

    public function test_cambio_estado()
    {
        $modelo = new Seguridad_Class();
        $datos = [
            'cedula_usuario' => "26142326",
            'estado' => "1",
        ];
        $data = $modelo->cambio_estado([
            'cedula_persona' => $datos['cedula_persona'],
            'estado' => $datos['estado'],
        ]);
        $this->assertEquals(count($data), true);
    }

    public function test_cambiar_permisos_rol()
    {
        $modelo = new Seguridad_Class();
        $datos = [
            'cedula_usuario' => "26142326",
            'rol' => "Super Usuario",
        ];
        $data = $modelo->cambiar_permisos_rol([
            'cedula_persona' => $datos['cedula_persona'],
            'rol' => $datos['rol']
        ]);
        $this->assertEquals(count($data), true);
    }
}

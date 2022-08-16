<?php 
use PHPUnit\Framework\TestCase;

class PersonasTest extends TestCase
{
    public function test_Consultar_Vacuna()
    {
        $modelo = new Personas_Class();

        $data = $modelo->Consultar_Vacuna();
        $this->assertEquals(count($data), true);}
    public function test_Registrar_Vacuna()
    {
        $modelo = new Personas_Class();
        $datos = [
            'cedula_persona' => "26142326",
            'dosis' => "Primera Dosis",
            'fecha_vacuna' => "2021-11-17",
        ];
        $data = $modelo->Registrar_Vacuna(
            [
                'cedula_persona' => $datos['cedula_persona'],
                'dosis' => $datos['dosis'],
                'fecha_vacuna' => $datos['fecha_vacuna'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);}
    public function test_Registrar()
    {
        $modelo = new Personas_Class();
        $datos = ['cedula_persona' => "27142345", 'primer_nombre' => "jose", 'segundo_nombre' => "manuel", 'primer_apellido' => "perez", 'segundo_apellido' => "jimenez", 'nacionalidad' => "Venezolano", 'jefe_familia' => 1, 'propietario_vivienda' => 1, 'afrodescendencia' => 0, 'sexualidad' => "Heterosexual", 'fecha_nacimiento' => "2021-11-01", 'telefono' => "04145555555", 'correo' => "JesusCuiGo@gmail.com", 'estado_civil' => "Casado", 'privado_libertad' => 1, 'genero' => "M", 'whatsapp' => 1, 'miliciano' => 0, 'antiguedad_comunidad' => "2021-11-01", 'jefe_calle' => 1, 'nivel_educativo' => "UNIVERSITARIO", 'contrasenia' => "123456", 'rol_inicio' => "Habitante", 'preguntas_seguridad' => "010", 'estado' => 1,
        ];
        $data = $modelo->Registrar([
            'cedula_persona' => $datos['cedula_persona'],
            'primer_nombre' => $datos['primer_nombre'],
            'segundo_nombre' => $datos['segundo_nombre'],
            'primer_apellido' => $datos['primer_apellido'],
            'segundo_apellido' => $datos['segundo_apellido'],
            'nacionalidad' => $datos['nacionalidad'],
            'jefe_familia' => $datos['jefe_familia'],
            'propietario_vivienda' => $datos['propietario_vivienda'],
            'afrodescendencia' => $datos['afrodescendencia'],
            'sexualidad' => $datos['sexualidad'],
            'fecha_nacimiento' => $datos['fecha_nacimiento'],
            'telefono' => $datos['telefono'],
            'correo' => $datos['correo'],
            'estado_civil' => $datos['estado_civil'],
            'privado_libertad' => $datos['privado_libertad'],
            'genero' => $datos['genero'],
            'whatsapp' => $datos['whatsapp'],
            'miliciano' => $datos['miliciano'],
            'antiguedad_comunidad' => $datos['antiguedad_comunidad'],
            'jefe_calle' => $datos['jefe_calle'],
            'nivel_educativo' => $datos['nivel_educativo'],
            'contrasenia' => $datos['contrasenia'],
            'rol_inicio' => $datos['rol_inicio'],
            'preguntas_seguridad' => $datos['preguntas_seguridad'],
            'estado' => 1,
        ]);
        $this->assertEquals(count($data), true);}
    public function test_Registrar_transporte()
    {
        $modelo = new Personas_Class();
        $datos = [
            'cedula_propietario' => "26142326",
            'descripcion_transporte' => "FIATT",
        ];
        $data = $modelo->Registrar_transporte(
            [
                'cedula_propietario' => $datos['cedula_propietario'],
                'descripcion_transporte' => $datos['descripcion_transporte'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);}
    public function test_Registrar_persona_ocupacion()
    {
        $modelo = new Personas_Class();
        $datos = [
            'cedula_persona' => "26142326",
            'id_ocupacion' => 1,
        ];
        $data = $modelo->Registrar_persona_ocupacion(
            [
                'cedula_persona' => $datos['cedula_persona'],
                'id_ocupacion' => $datos['id_ocupacion'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);}
    public function test_registrar_permisos()
    {
        $modelo = new Personas_Class();
        $datos = [
            'cedula_usuario' => "26142326",
            'id_modulo' => 7,
        ];
        $data = $modelo->registrar_permisos(
            [
                'cedula_usuario' => $datos['cedula_persona'],
                'id_modulo' => $datos['id_modulo'],
                'registrar' => 1,
                'consultar' => 1,
                'modificar' => 1,
                'eliminar' => 1,
            ]
        );
        $this->assertEquals(count($data), true);}
    public function test_registrar_carnet()
    {
        $modelo = new Personas_Class();
        $datos = [
            'cedula_persona' => "26142326",
            'serial_carnet' => "01040503",
            'codigo_carnet' => "21242523",
            'tipo_carnet' => 1,
        ];
        $data = $modelo->Registrar_persona_ocupacion(
            [
                'cedula_persona' => $datos['cedula_persona'],
                'serial_carnet' => $datos['serial_carnet'],
                'codigo_carnet' => $datos['codigo_carnet'],
                'tipo_carnet' => $datos['tipo_carnet'],
            ]
        );
        $this->assertEquals(count($data), true);}
    public function test_Registrar_persona_proyecto()
    {
        $modelo = new Personas_Class();
        $datos = [
            'cedula_persona' => "26142326",
            'id_proyecto' => 1,
        ];
        $data = $modelo->Registrar_persona_proyecto(
            [
                'cedula_persona' => $datos['cedula_persona'],
                'id_proyecto' => $datos['id_proyecto'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);}
    public function test_Registrar_persona_comunidad()
    {
        $modelo = new Personas_Class();
        $datos = [
            'cedula_persona' => "26142326",
            'id_comunidad_indigena' => 2,
        ];
        $data = $modelo->Registrar_persona_comunidad(
            [
                'cedula_persona' => $datos['cedula_persona'],
                'id_comunidad_indigena' => $datos['id_comunidad_indigena'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);}
    public function test_Registrar_persona_organizacion()
    {
        $modelo = new Personas_Class();
        $datos = [
            'cedula_persona' => "26142326",
            'id_org_politica' => 1,
        ];
        $data = $modelo->Registrar_persona_organizacion(
            [
                'cedula_persona' => $datos['cedula_persona'],
                'id_org_politica' => $datos['id_org_politica'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);}
    public function test_Registrar_persona_bono()
    {
        $modelo = new Personas_Class();
        $datos = [
            'cedula_persona' => "26142326",
            'id_bono' => 1,
        ];
        $data = $modelo->Registrar_persona_bono(
            [
                'cedula_persona' => $datos['cedula_persona'],
                'id_bono' => $datos['id_bono'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);}
    public function test_Registrar_proyecto()
    {
        $modelo = new Personas_Class();
        $datos = [
            'nombre_proyecto' => "proyecto socio tecnologico",
            'area_proyecto' => "informatica",
            'estado_proyecto' => "Acabado",
        ];
        $data = $modelo->Registrar_proyecto(
            [
                'nombre_proyecto' => $datos['nombre_proyecto'],
                'area_proyecto' => $datos['area_proyecto'],
                'estado_proyecto' => $datos['estado_proyecto'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);}
    public function test_Registrar_persona_mision()
    {
        $modelo = new Personas_Class();
        $datos = [
            'id_mision' => 1,
            'cedula_persona' => "26142326",
            'recibe_actualmente' => 1,
            'fecha' => "01-01-2020",
        ];
        $data = $modelo->Registrar_persona_mision(
            [
                'id_mision' => $datos['id_mision'],
                'cedula_persona' => $datos['cedula_persona'],
                'recibe_actualmente' => $datos['recibe_actualmente'],
                'fecha' => $datos['fecha'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);}
    public function test_Registrar_cond_laboral()
    {
        $modelo = new Personas_Class();
        $datos = [
            'cedula_persona' => "26142326",
            'nombre_cond_laboral' => "Enpresa",
            'sector_laboral' => 1,
            'pertenece' => 1,
        ];
        $data = $modelo->Registrar_cond_laboral(
            [
                'cedula_persona' => $datos['cedula_persona'],
                'nombre_cond_laboral' => $datos['nombre_cond_laboral'],
                'sector_laboral' => $datos['sector_laboral'],
                'pertenece' => $datos['pertenece'],
                'estado' => 1,
            ]
        );
        $this->assertEquals(count($data), true);}
    public function test_Consultar()
    {
        $modelo = new Personas_Class();
        $data = $modelo->Consultar();
        $this->assertEquals(count($data), true);}
    public function test_Actualizar()
    {
        $modelo = new Personas_Class();
        $datos = ['cedula_persona' => "27142345", 'primer_nombre' => "jose", 'segundo_nombre' => "manuel", 'primer_apellido' => "perez", 'segundo_apellido' => "jimenez", 'nacionalidad' => "Venezolano", 'jefe_familia' => 0, 'propietario_vivienda' => 1, 'afrodescendencia' => 0, 'sexualidad' => "Heterosexual", 'fecha_nacimiento' => "2021-11-01", 'telefono' => "04145555555", 'correo' => "JesusCuiGo@gmail.com", 'estado_civil' => "Casado", 'privado_libertad' => 0, 'genero' => "M", 'whatsapp' => 0, 'miliciano' => 0, 'antiguedad_comunidad' => "2021-11-01", 'jefe_calle' => 0, 'nivel_educativo' => "UNIVERSITARIO", 'contrasenia' => "123456", 'rol_inicio' => "Habitante", 'preguntas_seguridad' => "010", 'estado' => 1,
        ];
        $data = $modelo->Actualizar([
            'cedula_persona' => $datos['cedula_persona'],
            'primer_nombre' => $datos['primer_nombre'],
            'segundo_nombre' => $datos['segundo_nombre'],
            'primer_apellido' => $datos['primer_apellido'],
            'segundo_apellido' => $datos['segundo_apellido'],
            'nacionalidad' => $datos['nacionalidad'],
            'jefe_familia' => $datos['jefe_familia'],
            'propietario_vivienda' => $datos['propietario_vivienda'],
            'afrodescendencia' => $datos['afrodescendencia'],
            'sexualidad' => $datos['sexualidad'],
            'fecha_nacimiento' => $datos['fecha_nacimiento'],
            'telefono' => $datos['telefono'],
            'correo' => $datos['correo'],
            'estado_civil' => $datos['estado_civil'],
            'privado_libertad' => $datos['privado_libertad'],
            'genero' => $datos['genero'],
            'whatsapp' => $datos['whatsapp'],
            'miliciano' => $datos['miliciano'],
            'antiguedad_comunidad' => $datos['antiguedad_comunidad'],
            'jefe_calle' => $datos['jefe_calle'],
            'nivel_educativo' => $datos['nivel_educativo'],
            'contrasenia' => $datos['contrasenia'],
            'rol_inicio' => $datos['rol_inicio'],
            'preguntas_seguridad' => $datos['preguntas_seguridad'],
            'estado' => 1,
        ]);
        $this->assertEquals(count($data), true);}
    public function test_Eliminar()
    {
        $modelo = new Personas_Class();
        $cedula_persona = "010203";

        $data = $modelo->Eliminar($cedula_persona);
        $this->assertEquals(count($data), true);}
    public function test_Buscar_Persona()
    {
        $modelo = new Personas_Class();
        $cedula_persona = "26142326";

        $data = $modelo->Buscar_Persona($cedula_persona);
        $this->assertEquals(count($data), true);}

    public function test_get_serial_carnet()
    {
        $modelo = new Personas_Class();
        $serial = "00000PP122";
        $tipo = 1;
        $data = $modelo->get_serial_carnet($serial, $tipo);
        $this->assertEquals(count($data), true);}
    public function test_get_codigo_carnet()
    {
        $modelo = new Personas_Class();
        $codigo = "0000123456";
        $tipo = 1;
        $data = $modelo->get_codigo_carnet($codigo, $tipo);
        $this->assertEquals(count($data), true);}
    public function test_get_transportes()
    {
        $modelo = new Personas_Class();
        $data = $modelo->get_transportes();
        $this->assertEquals(count($data), true);}
    public function test_get_comunidades()
    {
        $modelo = new Personas_Class();
        $data = $modelo->get_comunidades();
        $this->assertEquals(count($data), true);}
    public function test_get_organizaciones()
    {
        $modelo = new Personas_Class();
        $data = $modelo->get_organizaciones();
        $this->assertEquals(count($data), true);}
    public function test_get_centros()
    {
        $modelo = new Personas_Class();
        $data = $modelo->get_centros();
        $this->assertEquals(count($data), true);}
    public function test_get_parroquias()
    {
        $modelo = new Personas_Class();
        $data = $modelo->get_parroquias();
        $this->assertEquals(count($data), true);}
    public function test_get_bonos()
    {
        $modelo = new Personas_Class();
        $data = $modelo->get_bonos();
        $this->assertEquals(count($data), true);}
    public function test_get_misiones()
    {
        $modelo = new Personas_Class();
        $data = $modelo->get_misiones();
        $this->assertEquals(count($data), true);}
    public function test_get_enfermedades()
    {
        $modelo = new Personas_Class();
        $data = $modelo->get_enfermedades();
        $this->assertEquals(count($data), true);}
    public function test_get_discapacidad()
    {
        $modelo = new Personas_Class();
        $data = $modelo->get_discapacidad();
        $this->assertEquals(count($data), true);}
    public function test_get_ocupaciones()
    {
        $modelo = new Personas_Class();
        $data = $modelo->get_ocupaciones();
        $this->assertEquals(count($data), true);}
    public function test_get_condiciones()
    {
        $modelo = new Personas_Class();
        $data = $modelo->get_condiciones();
        $this->assertEquals(count($data), true);}
    public function test_get_proyectos()
    {
        $modelo = new Personas_Class();
        $data = $modelo->get_proyectos();
        $this->assertEquals(count($data), true);}
    public function test_get_ocupacion_persona()
    {
        $modelo = new Personas_Class();
        $cedula = "26142326";
        $data = $modelo->get_ocupacion_persona($cedula);
        $this->assertEquals(count($data), true);}
    public function test_get_cond_laboral_persona()
    {
        $modelo = new Personas_Class();
        $cedula = "26142326";
        $data = $modelo->get_cond_laboral_persona($cedula);
        $this->assertEquals(count($data), true);}
    public function test_get_transporte_persona()
    {
        $modelo = new Personas_Class();
        $cedula = "26142326";
        $data = $modelo->get_transporte_persona($cedula);
        $this->assertEquals(count($data), true);}
    public function test_get_bonos_persona()
    {
        $modelo = new Personas_Class();
        $cedula = "26142326";
        $data = $modelo->get_bonos_persona($cedula);
        $this->assertEquals(count($data), true);}
    public function test_get_misiones_persona()
    {
        $modelo = new Personas_Class();
        $cedula = "010203";
        $data = $modelo->get_misiones_persona($cedula);
        $this->assertEquals(count($data), true);}
    public function test_get_proyectos_persona()
    {
        $modelo = new Personas_Class();
        $cedula = "26142326";
        $data = $modelo->get_proyectos_persona($cedula);
        $this->assertEquals(count($data), true);}
    public function test_get_comunidad_indigena_persona()
    {
        $modelo = new Personas_Class();
        $cedula = "26142326";
        $data = $modelo->get_comunidad_indigena_persona($cedula);
        $this->assertEquals(count($data), true);}
    public function test_get_org_politica_persona()
    {
        $modelo = new Personas_Class();
        $cedula = "26142326";
        $data = $modelo->get_org_politica_persona($cedula);
        $this->assertEquals(count($data), true);}
}

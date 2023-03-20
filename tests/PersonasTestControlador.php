<?php

require_once "controlador/personas_controlador.php";
require_once "modelo/personas_class.php";

use PHPUnit\Framework\TestCase;

$_SESSION['cedula_usuario'] = "7654321";
$_SESSION['Personas']       = [
    "consultar" => 1,
    "registrar" => 1,
    "eliminar"  => 1,
    "modificar" => 1,
];
$_POST = [
    'estado' => [
        "tabla"  => "personas",
        "id"     => "id_personas",
        "data"   => 1,
        "estado" => 1,
    ],
    'datos'  => [
        "cedula_persona"       => "27333222",
        "primer_nombre"        => "Juan",
        "segundo_nombre"       => "Carlos",
        "primer_apellido"      => "Pérez",
        "segundo_apellido"     => "Gómez",
        "nacionalidad"         => "Venezolano",
        "jefe_familia"         => 1,
        "propietario_vivienda" => 1,
        "afrodescendencia"     => 0,
        "sexualidad"           => "Heterosexual",
        "fecha_nacimiento"     => "1990-01-01",
        "telefono"             => "04241234567",
        "correo"               => "juan.perez@example.com",
        "estado_civil"         => "Soltero",
        "privado_libertad"     => "No",
        "genero"               => "M",
        "whatsapp"             => 1,
        "miliciano"            => 0,
        "antiguedad_comunidad" => "2010-01-01",
        "jefe_calle"           => 0,
        "nivel_educativo"      => "Universitario",
        "contrasenia"          => "contrasena123",
        "rol_inicio"           => "Usuario",
        "preguntas_seguridad"  => "¿Cuál es el nombre de tu madre?",
        "user_locked"          => "No",
        "digital_sign"         => "Firma digital",
        "public_key"           => "Llave pública",
        "private_key"          => "Llave privada",
        "estado"               => 1,
    ],
    'sql'    => 'SQL_1',
    'accion' => 'registro exitoso',
];

class PersonasTestControlador extends TestCase
{
    private $Personas;

    protected function setUp(): void
    {
        $this->Personas = new Personas();
    }

    protected function tearDown(): void
    {$this->Personas = null;}

    public function test_Cargar_Vistas()
    {
        $this->Personas->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Personas->vista->expects($this->once())->method('Cargar_Vistas')->with('Personas/consultar');
        $this->Personas->Cargar_Vistas();
        $this->assertTrue(true);
    }

    public function test_Establecer_Consultas()
    {
        $this->Personas->Establecer_Consultas();
        $this->assertNotEmpty($this->Personas->Get_Datos_Vista());
    }

    public function test_Getters()
    {
        $this->assertIsString($this->Personas->Get_Sql());
        $this->assertIsString($this->Personas->Get_Accion());
        $this->assertIsString($this->Personas->Get_Mensaje());
        $this->assertIsArray($this->Personas->Get_Datos());
        $this->assertIsArray($this->Personas->Get_Estado());
        $this->assertIsArray($this->Personas->Get_Estado_Ejecutar());
    }

    public function test_Administrar_Consultas_Registros_Vistas()
    {
        $this->Personas->vista = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Personas->vista->expects($this->once())->method('Cargar_Vistas')->with('Personas/consultar');
        $this->Personas->Administrar("Consultas");
        $this->Personas->vista->expects($this->once())->method('Cargar_Vistas')->with('Personas/registrar');
        $this->Personas->Administrar("Registros");
        $this->assertTrue(true);
    }

    public function test_Administrar_Registrar()
    {
        $this->Personas->modelo     = $this->getMockBuilder(Personas_Class::class)->disableOriginalConstructor()->getMock();
        $this->Personas->validacion = $this->getMockBuilder(Personas_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Personas->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Personas->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Personas->Administrar("Registrar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Consulta_Ajax()
    {
        $this->Personas->modelo = $this->getMockBuilder(Personas_Class::class)->disableOriginalConstructor()->getMock();
        $result                 = $this->Personas->Administrar("Consulta_Ajax");
        $this->expectOutputString($result);
    }

    public function test_Administrar_Editar()
    {
        $this->Personas->modelo     = $this->getMockBuilder(Personas_Class::class)->disableOriginalConstructor()->getMock();
        $this->Personas->validacion = $this->getMockBuilder(Personas_Validacion::class)->disableOriginalConstructor()->getMock();
        $this->Personas->validacion->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $this->Personas->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Personas->Administrar("Editar");
        $this->assertTrue(true);
    }

    public function test_Administrar_Eliminar()
    {
        $this->Personas->modelo = $this->getMockBuilder(Personas_Class::class)->disableOriginalConstructor()->getMock();
        $this->Personas->modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $this->Personas->Administrar("Eliminar");
        $this->assertTrue(true);
    }
    // =================================================================
}

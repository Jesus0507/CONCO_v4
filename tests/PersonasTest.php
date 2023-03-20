<?php

require_once "modelo/personas_class.php";

use PHPUnit\Framework\TestCase;

class PersonasTest extends TestCase
{
    private $personas;

    public $datos = array(
        'INSERT_1'  => [
            'cedula_persona' => "7654321",
            'dosis'          => "Primera dosis",
            'fecha_vacuna'   => '2022-01-01',
            'estado'         => '1',
        ],
        'INSERT_2'  => [
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
        'INSERT_3'  => [
            'cedula_propietario'     => '27333222',
            'descripcion_transporte' => 'Carro',
            'estado'                 => 1,
        ],
        'INSERT_4'  => [
            'cedula_persona' => '27333222',
            'id_ocupacion'   => 3,
            'estado'         => 1,
        ],
        'INSERT_5'  => [
            'cedula_persona' => '27333222',
            'serial_carnet'  => "0000AP2341",
            'codigo_carnet'  => "0000123456",
            'tipo_carnet'    => 1,
        ],
        'INSERT_6'  => [
            'cedula_persona' => "27333222",
            'id_proyecto'    => 1,
            'estado'         => "1",
        ],
        'INSERT_7'  => [
            'id_comunidad_indigena' => 1,
            'cedula_persona'        => '27333222',
            'estado'                => '1',
        ],
        'INSERT_8'  => [
            'cedula_persona'  => '27333222',
            'id_org_politica' => 1,
            'estado'          => '1',
        ],
        'INSERT_9'  => [
            'cedula_persona' => '27333222',
            'id_bono'        => 1,
        ],
        'INSERT_10' => [
            'nombre_proyecto' => 'Proyecto A',
            'area_proyecto'   => 'Marketing',
            'estado_proyecto' => 'En progreso',
            'estado'          => '1',
        ],
        'INSERT_11' => [
            'cedula_persona'      => '18135393',
            'nombre_cond_laboral' => 'Tecnico',
            'sector_laboral'      => '1',
            'pertenece'           => '2',
            'estado'              => '1',
        ],
        'UPDATE_1'  => [
            'primer_nombre'        => 'Juan',
            'segundo_nombre'       => 'Pablo',
            'primer_apellido'      => 'Pérez',
            'segundo_apellido'     => 'García',
            'nacionalidad'         => 'Venezolano',
            'jefe_familia'         => '1',
            'propietario_vivienda' => '1',
            'afrodescendencia'     => '1',
            'sexualidad'           => 'Heterosexual',
            'fecha_nacimiento'     => '1990-01-01',
            'telefono'             => '04121234567',
            'correo'               => 'juanperez@gmail.com',
            'estado_civil'         => 'Soltero',
            'privado_libertad'     => '1',
            'genero'               => 'M',
            'whatsapp'             => '1',
            'miliciano'            => '0',
            'antiguedad_comunidad' => '2010-01-01',
            'jefe_calle'           => '0',
            'nivel_educativo'      => 'Universitario',
            'cedula_persona'       => '17639628',
        ],
        'UPDATE_2'  => [
            'cedula_persona'      => '27333222',
            'nombre_cond_laboral' => 'Empleado',
            'sector_laboral'      => 'Privado',
            'pertenece'           => '1',
            'id_cond_laboral'     => 1,
        ],
        'DELETE_1'  => [
            'cedula_persona' => '27333222',
        ],
    );

    protected function setUp(): void
    {$this->personas = new Personas_Class();}

    protected function tearDown(): void
    {$this->personas = null;}

    public function test_SQL_01_SELECT_1()
    {
        $this->personas->_SQL_("SQL_01");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_02_SELECT_2()
    {
        $this->personas->_SQL_("SQL_02");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_(["cedula" => "7654321"]);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_03_INSERT_1()
    {
        $this->personas->_SQL_("SQL_03");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT_1"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_04_INSERT_2()
    {
        $this->personas->_SQL_("SQL_04");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT_2"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_05_INSERT_3()
    {
        $this->personas->_SQL_("SQL_05");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT_3"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_06_INSERT_4()
    {
        $this->personas->_SQL_("SQL_06");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT_4"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_07_INSERT_5()
    {
        $this->personas->_SQL_("SQL_07");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT_5"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_08_INSERT_6()
    {
        $this->personas->_SQL_("SQL_08");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT_6"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_09_INSERT_7()
    {
        $this->personas->_SQL_("SQL_09");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT_7"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_10_INSERT_8()
    {
        $this->personas->_SQL_("SQL_10");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT_8"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_11_INSERT_9()
    {
        $this->personas->_SQL_("SQL_11");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT_9"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_12_INSERT_10()
    {
        $this->personas->_SQL_("SQL_12");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT_10"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_13_INSERT_11()
    {
        $this->personas->_SQL_("SQL_13");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["INSERT_11"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_14_SELECT_3()
    {
        $this->personas->_SQL_("SQL_14");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_15_UPDATE_1()
    {
        $this->personas->_SQL_("SQL_15");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["UPDATE_1"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }
    public function test_SQL_16_UPDATE_2()
    {
        $this->personas->_SQL_("SQL_16");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["UPDATE_2"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_17_DELETE_1()
    {
        $this->personas->_SQL_("SQL_17");
        $this->personas->_Tipo_(1);
        $this->personas->_Datos_($this->datos["DELETE_1"]);
        $result = $this->personas->Administrar();
        $this->assertTrue($result);
    }

    public function test_SQL_18_SELECT_5()
    {
        $this->personas->_SQL_("SQL_18");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_(['cedula' => '7654321']);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_19_SELECT_6()
    {
        $this->personas->_SQL_("SQL_19");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_([
            'serial_carnet' => '0000AP2341',
            'tipo_carnet'   => '1',
        ]);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_20_SELECT_7()
    {
        $this->personas->_SQL_("SQL_20");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_([
            'codigo' => '0000123456',
            'tipo'   => '1',
        ]);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_21_SELECT_8()
    {
        $this->personas->_SQL_("SQL_21");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_22_SELECT_9()
    {
        $this->personas->_SQL_("SQL_22");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_23_SELECT_10()
    {
        $this->personas->_SQL_("SQL_23");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_24_SELECT_11()
    {
        $this->personas->_SQL_("SQL_24");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_25_SELECT_11()
    {
        $this->personas->_SQL_("SQL_25");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_26_SELECT_12()
    {
        $this->personas->_SQL_("SQL_26");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_27_SELECT_13()
    {
        $this->personas->_SQL_("SQL_27");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_28_SELECT_14()
    {
        $this->personas->_SQL_("SQL_28");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_29_SELECT_13()
    {
        $this->personas->_SQL_("SQL_29");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_30_SELECT_14()
    {
        $this->personas->_SQL_("SQL_30");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_31_SELECT_15()
    {
        $this->personas->_SQL_("SQL_31");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_32_SELECT_16()
    {
        $this->personas->_SQL_("SQL_32");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_([
            'cedula' => '27333222',
        ]);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_33_SELECT_16()
    {
        $this->personas->_SQL_("SQL_33");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_([
            'cedula' => '22268477',
        ]);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_34_SELECT_17()
    {
        $this->personas->_SQL_("SQL_34");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_([
            'cedula' => '22222222',
        ]);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_35_SELECT_18()
    {
        $this->personas->_SQL_("SQL_35");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_([
            'cedula' => '22268477',
        ]);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_36_SELECT_19()
    {
        $this->personas->_SQL_("SQL_36");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_([
            'cedula' => '7654321',
        ]);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_37_SELECT_20()
    {
        $this->personas->_SQL_("SQL_37");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_([
            'cedula' => '7654321',
        ]);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_38_SELECT_21()
    {
        $this->personas->_SQL_("SQL_38");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_([
            'cedula' => '7654321',
        ]);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_39_SELECT_22()
    {
        $this->personas->_SQL_("SQL_39");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_([
            'cedula' => '27333222 ',
        ]);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_40_SELECT_23()
    {
        $this->personas->_SQL_("SQL_40");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_([
            'cedula' => '7654321',
        ]);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
    public function test_SQL_41_SELECT_24()
    {
        $this->personas->_SQL_("SQL_41");
        $this->personas->_Tipo_(2);
        $this->personas->_Datos_([
            'cedula' => '27333222 ',
        ]);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_SQL_42_SELECT_25()
    {
        $this->personas->_SQL_("SQL_42");
        $this->personas->_Tipo_(0);
        $result = $this->personas->Administrar();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}

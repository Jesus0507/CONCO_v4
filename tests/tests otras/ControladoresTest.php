<?php

require_once 'controlador/agenda_controlador.php';
require_once 'controlador/bitacora_controlador.php';
require_once 'controlador/centro_votacion_controlador.php';
require_once 'controlador/consejo_comunal_controlador.php';
require_once 'controlador/discapacitados_controlador.php';
require_once 'controlador/enfermos_controlador.php';
require_once 'controlador/familias_controlador.php';
require_once 'controlador/grupos_deportivos_controlador.php';
require_once 'controlador/habitante_controlador.php';
require_once 'controlador/inicio_controlador.php';
require_once 'controlador/inmuebles_controlador.php';
require_once 'controlador/login_controlador.php';
require_once 'controlador/negocios_controlador.php';
require_once 'controlador/notificaciones_controlador.php';
require_once 'controlador/parto_humanizado_controlador.php';
require_once 'controlador/personas_controlador.php';
require_once 'controlador/reportes_controlador.php';
require_once 'controlador/sector_agricola_controlador.php';
require_once 'controlador/seguridad_controlador.php';
require_once 'controlador/solicitudescontrolador.php';
require_once 'controlador/vacunados_controlador.php';
require_once 'controlador/viviendas_controlador.php';

use PHPUnit\Framework\TestCase;

class ControladoresTest extends PHPUnit\Framework\TestCase
{

    private $agenda;
    private $bitacora;
    private $centro_votacion;
    private $consejo_comunal;
    private $discapacitados;
    private $enfermos;
    private $familias;
    private $grupos_deportivos;
    private $habitante;
    private $inico;
    private $inmuebles;
    private $login;
    private $negocios;
    private $notificaciones;
    private $parto_humanizado;
    private $personas;
    private $reportes;
    private $sector_agricola;
    private $seguridad;
    private $solicitudes;
    private $vacunados;
    private $viviendas;

    private $controladores = array(
        'agenda',
        'bitacora',
        'centro_votacion',
        'consejo_comunal',
        'discapacitados',
        'enfermos',
        'familias',
        'grupos_deportivos',
        'habitante',
        'inico',
        'inmuebles',
        'login',
        'negocios',
        'notificaciones',
        'parto_humanizado',
        'personas',
        'reportes',
        'sector_agricola',
        'seguridad',
        'solicitudes',
        'vacunados',
        'viviendas',
    );
    protected function setUp(): void
    {
        $this->controladores['agenda']            = new Agenda();
        $this->controladores['bitacora']          = new Bitacora();
        $this->controladores['centro_votacion']   = new Centro_votacion();
        $this->controladores['consejo_comunal']   = new Consejo_comunal();
        $this->controladores['discapacitados']    = new Discapacitados();
        $this->controladores['enfermos']          = new Enfermos();
        $this->controladores['familias']          = new Familias();
        $this->controladores['grupos_deportivos'] = new Grupos_Deportivos();
        $this->controladores['habitante']         = new Habitante();
        $this->controladores['inico']             = new Inico();
        $this->controladores['inmuebles']         = new Inmuebles();
        $this->controladores['login']             = new Login();
        $this->controladores['negocios']          = new Negocios();
        $this->controladores['notificaciones']    = new Notificaciones();
        $this->controladores['parto_humanizado']  = new Parto_Humanizado();
        $this->controladores['personas']          = new Personas();
        $this->controladores['reportes']          = new Reportes();
        $this->controladores['sector_agricola']   = new Sector_agricola();
        $this->controladores['seguridad']         = new Seguridad();
        $this->controladores['solicitudes']       = new Solicitudes();
        $this->controladores['vacunados']         = new Vacunados();
        $this->controladores['viviendas']         = new Viviendas();
    }

    protected function tearDown(): void
    {
        foreach ($this->controladores as &$controlador) {
            $controlador = null;
        }
    }

    // ===================================================================
    // AGENDA
    public function test_Agenda_CargarVistas()
    {

        $vista               = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->controladores['agenda']vista = $vista;
        $this->controladores['agenda']Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Agenda/consultar');
        $this->assertTrue(true);
    }
    public function test_Agenda_EstablecerConsultas()
    {
        $this->controladores['agenda']Establecer_Consultas();
        $this->assertNotEmpty($this->controladores['agenda']Get_Datos_Vista()['Agenda']);
        $this->assertNotEmpty($this->controladores['agenda']Get_Datos_Vista()['calle']);
        $this->assertNotEmpty($this->controladores['agenda']Get_Datos_Vista()['inmuebles']);
    }

    public function test_Agenda_Getters()
    {
        $this->assertEquals('consultar', $this->controladores['agenda']Get_Sql());
        $this->assertEquals('consultar', $this->controladores['agenda']Get_Accion());
        $this->assertEquals('1', $this->controladores['agenda']Get_Mensaje());
        $this->assertIsArray($this->controladores['agenda']Get_Datos());
        $this->assertIsArray($this->controladores['agenda']Get_Estado());
        $this->assertIsArray($this->controladores['agenda']Get_Estado_Ejecutar());
        $this->assertIsArray($this->controladores['agenda']Get_Datos_Vista());
    }

    public function test_Agenda_Administrar()
    {

        $modelo               = $this->getMockBuilder(Agenda_Class::class)->disableOriginalConstructor()->getMock();
        $vista                = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->controladores['agenda']modelo = $modelo;
        $this->controladores['agenda']vista  = $vista;
        $entrada              = ['peticion' => 'Administrar'];
        $this->controladores['agenda']setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Agenda/administrar'));
        $this->controladores['agenda']Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Evento creado correctamente"}');
    }
    // =================================================================

    // ===================================================================
    // BITACORA
    public function test_Bitacora_CargarVistas()
    {

        $vista                 = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->controladores['bitacora']->vista = $vista;
        $this->controladores['bitacora']->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Bitacora/consultar');
        $this->assertTrue(true);
    }
    public function test_Bitacora_EstablecerConsultas()
    {
        $this->controladores['bitacora']->Establecer_Consultas();
        $this->assertNotEmpty($this->controladores['bitacora']->Get_Datos_Vista()['bitacoras']);

    }

    public function test_Bitacora_Getters()
    {
        $this->assertEquals('consultar', $this->controladores['bitacora']->Get_Sql());

        $this->assertEquals('1', $this->controladores['bitacora']->Get_Mensaje());
        $this->assertIsArray($this->controladores['bitacora']->Get_Datos());

        $this->assertIsArray($this->controladores['bitacora']->Get_Datos_Vista());
    }

    public function test_Bitacora_Administrar()
    {

        $modelo                 = $this->getMockBuilder(Bitacora_Class::class)->disableOriginalConstructor()->getMock();
        $vista                  = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->controladores['bitacora']->modelo = $modelo;
        $this->controladores['bitacora']->vista  = $vista;
        $entrada                = ['peticion' => 'Administrar'];
        $this->controladores['bitacora']->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Bitacora/administrar'));
        $this->controladores['bitacora']->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Bitacora creado correctamente"}');
    }
    // =================================================================

    // ===================================================================
    // CENTRO_VOTACION
    public function test_Centro_Votacion_CargarVistas()
    {

        $vista                        = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->controladores['centro_votacion']->vista = $vista;
        $this->controladores['centro_votacion']->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Centro_Votacion/consultar');
        $this->assertTrue(true);
    }
    public function test_Centro_Votacion_EstablecerConsultas()
    {
        $this->controladores['centro_votacion']->Establecer_Consultas();
        $this->assertNotEmpty($this->controladores['centro_votacion']->Get_Datos_Vista()['centro_Votacion']);
        $this->assertNotEmpty($this->controladores['centro_votacion']->Get_Datos_Vista()['persona_centro_votacion']);
        $this->assertNotEmpty($this->controladores['centro_votacion']->Get_Datos_Vista()['parroquias']);
        $this->assertNotEmpty($this->controladores['centro_votacion']->Get_Datos_Vista()['personas']);
    }

    public function test_Centro_Votacion_Getters()
    {
        $this->assertEquals('consultar', $this->controladores['centro_votacion']->Get_Sql());
        $this->assertEquals('consultar', $this->controladores['centro_votacion']->Get_Accion());
        $this->assertEquals('1', $this->controladores['centro_votacion']->Get_Mensaje());
        $this->assertIsArray($this->controladores['centro_votacion']->Get_Datos());
        $this->assertIsArray($this->controladores['centro_votacion']->Get_Estado());
        $this->assertIsArray($this->controladores['centro_votacion']->Get_Estado_Ejecutar());
        $this->assertIsArray($this->controladores['centro_votacion']->Get_Datos_Vista());
        $this->assertIsArray($this->controladores['centro_votacion']->Get_Crud_Sql());
    }

    public function test_Centro_Votacion_Administrar()
    {

        $modelo                        = $this->getMockBuilder(Centro_Votacion_Class::class)->disableOriginalConstructor()->getMock();
        $vista                         = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->controladores['centro_votacion']->modelo = $modelo;
        $this->controladores['centro_votacion']->vista  = $vista;
        $entrada                       = ['peticion' => 'Administrar'];
        $this->controladores['centro_votacion']->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Centro_Votacion/administrar'));
        $this->controladores['centro_votacion']->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Centro de votacion registrado correctamente"}');
    }
    // =================================================================

    // ===================================================================
    // CONSEJO_COMUNAL
    public function test_Consejo_Comunal_CargarVistas()
    {

        $vista                        = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Consejo_Comunal->vista = $vista;
        $this->Consejo_Comunal->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Consejo_Comunal/consultar');
        $this->assertTrue(true);
    }
    public function test_Consejo_Comunal_EstablecerConsultas()
    {
        $this->Consejo_Comunal->Establecer_Consultas();
        $this->assertNotEmpty($this->Consejo_Comunal->Get_Datos_Vista()['Consejo_Comunal']);
        $this->assertNotEmpty($this->Consejo_Comunal->Get_Datos_Vista()['personas']);
        $this->assertNotEmpty($this->Consejo_Comunal->Get_Datos_Vista()['comite']);
    }

    public function test_Consejo_Comunal_Getters()
    {
        $this->assertEquals('consultar', $this->Consejo_Comunal->Get_Sql());
        $this->assertEquals('consultar', $this->Consejo_Comunal->Get_Accion());
        $this->assertEquals('1', $this->Consejo_Comunal->Get_Mensaje());
        $this->assertIsArray($this->Consejo_Comunal->Get_Datos());
        $this->assertIsArray($this->Consejo_Comunal->Get_Estado());
        $this->assertIsArray($this->Consejo_Comunal->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Consejo_Comunal->Get_Datos_Vista());
        $this->assertIsArray($this->Consejo_Comunal->Get_Crud_Sql());
    }

    public function test_Consejo_Comunal_Administrar()
    {

        $modelo                        = $this->getMockBuilder(Consejo_Comunal_Class::class)->disableOriginalConstructor()->getMock();
        $vista                         = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Consejo_Comunal->modelo = $modelo;
        $this->Consejo_Comunal->vista  = $vista;
        $entrada                       = ['peticion' => 'Administrar'];
        $this->Consejo_Comunal->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Consejo_Comunal/administrar'));
        $this->Consejo_Comunal->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Consejo Comunal registrado correctamente"}');
    }
    // =================================================================

    // ===================================================================
    // DISCAPACITADOS
    public function test_Discapacitados_CargarVistas()
    {

        $vista                       = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Discapacitados->vista = $vista;
        $this->Discapacitados->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Discapacitados/consultar');
        $this->assertTrue(true);
    }
    public function test_Discapacitados_EstablecerConsultas()
    {
        $this->Discapacitados->Establecer_Consultas();
        $this->assertNotEmpty($this->Discapacitados->Get_Datos_Vista()['personas']);
        $this->assertNotEmpty($this->Discapacitados->Get_Datos_Vista()['discapacidad']);
        $this->assertNotEmpty($this->Discapacitados->Get_Datos_Vista()['discapacidades']);
        $this->assertNotEmpty($this->Discapacitados->Get_Datos_Vista()['discapacitados']);
    }

    public function test_Discapacitados_Getters()
    {
        $this->assertEquals('consultar', $this->Discapacitados->Get_Sql());
        $this->assertEquals('consultar', $this->Discapacitados->Get_Accion());
        $this->assertEquals('1', $this->Discapacitados->Get_Mensaje());
        $this->assertIsArray($this->Discapacitados->Get_Datos());
        $this->assertIsArray($this->Discapacitados->Get_Estado());
        $this->assertIsArray($this->Discapacitados->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Discapacitados->Get_Datos_Vista());
        $this->assertIsArray($this->Discapacitados->Get_Crud_Sql());
    }

    public function test_Discapacitados_Administrar()
    {

        $modelo                       = $this->getMockBuilder(Discapacitados_Class::class)->disableOriginalConstructor()->getMock();
        $vista                        = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Discapacitados->modelo = $modelo;
        $this->Discapacitados->vista  = $vista;
        $entrada                      = ['peticion' => 'Administrar'];
        $this->Discapacitados->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Discapacitados/administrar'));
        $this->Discapacitados->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Persona discapcitada registrado correctamente"}');
    }
    // =================================================================

    // ===================================================================
    // Enfermos
    public function test_Enfermos_CargarVistas()
    {

        $vista                 = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Enfermos->vista = $vista;
        $this->Enfermos->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Enfermos/consultar');
        $this->assertTrue(true);
    }
    public function test_Enfermos_EstablecerConsultas()
    {
        $this->Enfermos->Establecer_Consultas();
        $this->assertNotEmpty($this->Enfermos->Get_Datos_Vista()['personas']);
        $this->assertNotEmpty($this->Enfermos->Get_Datos_Vista()['enfermedad']);
        $this->assertNotEmpty($this->Enfermos->Get_Datos_Vista()['enfermos']);
        $this->assertNotEmpty($this->Enfermos->Get_Datos_Vista()['enfermedades']);
    }

    public function test_Enfermos_Getters()
    {
        $this->assertEquals('consultar', $this->Enfermos->Get_Sql());
        $this->assertEquals('consultar', $this->Enfermos->Get_Accion());
        $this->assertEquals('1', $this->Enfermos->Get_Mensaje());
        $this->assertIsArray($this->Enfermos->Get_Datos());
        $this->assertIsArray($this->Enfermos->Get_Estado());
        $this->assertIsArray($this->Enfermos->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Enfermos->Get_Datos_Vista());
        $this->assertIsArray($this->Enfermos->Get_Crud_Sql());
    }

    public function test_Enfermos_Administrar()
    {

        $modelo                 = $this->getMockBuilder(Enfermos_Class::class)->disableOriginalConstructor()->getMock();
        $vista                  = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Enfermos->modelo = $modelo;
        $this->Enfermos->vista  = $vista;
        $entrada                = ['peticion' => 'Administrar'];
        $this->Enfermos->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Enfermos/administrar'));
        $this->Enfermos->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Persona patologica registrado correctamente"}');
    }
    // =================================================================

    // Familias
    public function test_Familias_CargarVistas()
    {

        $vista                 = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Familias->vista = $vista;
        $this->Familias->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Familias/consultar');
        $this->assertTrue(true);
    }
    public function test_Familias_EstablecerConsultas()
    {
        $this->Familias->Establecer_Consultas();
        $this->assertNotEmpty($this->Familias->Get_Datos_Vista()['personas']);
        $this->assertNotEmpty($this->Familias->Get_Datos_Vista()['familias']);
        $this->assertNotEmpty($this->Familias->Get_Datos_Vista()['viviendas']);
    }

    public function test_Familias_Getters()
    {
        $this->assertEquals('consultar', $this->Familias->Get_Sql());
        $this->assertEquals('consultar', $this->Familias->Get_Accion());
        $this->assertEquals('1', $this->Familias->Get_Mensaje());
        $this->assertIsArray($this->Familias->Get_Datos());
        $this->assertIsArray($this->Familias->Get_Estado());
        $this->assertIsArray($this->Familias->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Familias->Get_Datos_Vista());
        $this->assertIsArray($this->Familias->Get_Crud_Sql());
    }

    public function test_Familias_Administrar()
    {

        $modelo                 = $this->getMockBuilder(Familias_Class::class)->disableOriginalConstructor()->getMock();
        $vista                  = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Familias->modelo = $modelo;
        $this->Familias->vista  = $vista;
        $entrada                = ['peticion' => 'Administrar'];
        $this->Familias->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Familias/administrar'));
        $this->Familias->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Familia registrada correctamente"}');
    }
    // =================================================================

    // Grupos_Deportivos
    public function test_Grupos_Deportivos_CargarVistas()
    {

        $vista                          = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Grupos_Deportivos->vista = $vista;
        $this->Grupos_Deportivos->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Grupos_Deportivos/consultar');
        $this->assertTrue(true);
    }
    public function test_Grupos_Deportivos_EstablecerConsultas()
    {
        $this->Grupos_Deportivos->Establecer_Consultas();
        $this->assertNotEmpty($this->Grupos_Deportivos->Get_Datos_Vista()['grupos_deportivos']);
        $this->assertNotEmpty($this->Grupos_Deportivos->Get_Datos_Vista()['deportes']);
        $this->assertNotEmpty($this->Grupos_Deportivos->Get_Datos_Vista()['integrantes']);
        $this->assertNotEmpty($this->Grupos_Deportivos->Get_Datos_Vista()['personas']);
    }

    public function test_Grupos_Deportivos_Getters()
    {
        $this->assertEquals('consultar', $this->Grupos_Deportivos->Get_Sql());
        $this->assertEquals('consultar', $this->Grupos_Deportivos->Get_Accion());
        $this->assertEquals('1', $this->Grupos_Deportivos->Get_Mensaje());
        $this->assertIsArray($this->Grupos_Deportivos->Get_Datos());
        $this->assertIsArray($this->Grupos_Deportivos->Get_Estado());
        $this->assertIsArray($this->Grupos_Deportivos->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Grupos_Deportivos->Get_Datos_Vista());
        $this->assertIsArray($this->Grupos_Deportivos->Get_Crud_Sql());
    }

    public function test_Grupos_Deportivos_Administrar()
    {

        $modelo                          = $this->getMockBuilder(Grupos_Deportivos_Class::class)->disableOriginalConstructor()->getMock();
        $vista                           = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Grupos_Deportivos->modelo = $modelo;
        $this->Grupos_Deportivos->vista  = $vista;
        $entrada                         = ['peticion' => 'Administrar'];
        $this->Grupos_Deportivos->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Grupos_Deportivos/administrar'));
        $this->Grupos_Deportivos->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Grupos Deportivos registrado correctamente"}');
    }
    // =================================================================

    // Habitante
    public function test_Habitante_CargarVistas()
    {

        $vista                  = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Habitante->vista = $vista;
        $this->Habitante->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Habitante/consultar');
        $this->assertTrue(true);
    }

    public function test_Habitante_Getters()
    {

        $this->assertIsArray($this->Habitante->Get_Datos_Vista());

    }

    // =================================================================

    // Inicio
    public function test_Inicio_CargarVistas()
    {

        $vista               = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Inicio->vista = $vista;
        $this->Inicio->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Inicio/consultar');
        $this->assertTrue(true);
    }

    public function test_Inicio_Getters()
    {

        $this->assertIsArray($this->Inicio->Get_Datos_Vista());

    }
    // =================================================================

    // Inmuebles
    public function test_Inmuebles_CargarVistas()
    {

        $vista                  = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Inmuebles->vista = $vista;
        $this->Inmuebles->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Inmuebles/consultar');
        $this->assertTrue(true);
    }
    public function test_Inmuebles_EstablecerConsultas()
    {
        $this->Inmuebles->Establecer_Consultas();
        $this->assertNotEmpty($this->Inmuebles->Get_Datos_Vista()['inmueble']);
        $this->assertNotEmpty($this->Inmuebles->Get_Datos_Vista()['calle']);
        $this->assertNotEmpty($this->Inmuebles->Get_Datos_Vista()['tipo_inmueble']);
    }

    public function test_Inmuebles_Getters()
    {
        $this->assertEquals('consultar', $this->Inmuebles->Get_Sql());
        $this->assertEquals('consultar', $this->Inmuebles->Get_Accion());
        $this->assertEquals('1', $this->Inmuebles->Get_Mensaje());
        $this->assertIsArray($this->Inmuebles->Get_Datos());
        $this->assertIsArray($this->Inmuebles->Get_Estado());
        $this->assertIsArray($this->Inmuebles->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Inmuebles->Get_Datos_Vista());
        $this->assertIsArray($this->Inmuebles->Get_Crud_Sql());
        $this->assertIsArray($this->Inmuebles->Get_Tipo_Inmueble());
    }

    public function test_Inmuebles_Administrar()
    {

        $modelo                  = $this->getMockBuilder(Inmuebles_Class::class)->disableOriginalConstructor()->getMock();
        $vista                   = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Inmuebles->modelo = $modelo;
        $this->Inmuebles->vista  = $vista;
        $entrada                 = ['peticion' => 'Administrar'];
        $this->Inmuebles->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Inmuebles/administrar'));
        $this->Inmuebles->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Inmueble registrado correctamente"}');
    }
    // =================================================================

    // Login
    public function test_Login_CargarVistas()
    {

        $vista              = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Login->vista = $vista;
        $this->Login->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Login/consultar');
        $this->assertTrue(true);
    }

    public function test_Login_Getters()
    {
        $this->assertEquals('consultar', $this->Login->Get_Sql());
        $this->assertEquals('consultar', $this->Login->Get_Accion());
        $this->assertEquals('1', $this->Login->Get_Mensaje());
        $this->assertIsArray($this->Login->Get_Datos());
        $this->assertIsArray($this->Login->Get_Crud_Sql());

    }

    public function test_Login_Administrar()
    {

        $modelo              = $this->getMockBuilder(Login_Class::class)->disableOriginalConstructor()->getMock();
        $vista               = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Login->modelo = $modelo;
        $this->Login->vista  = $vista;
        $entrada             = ['peticion' => 'Administrar'];
        $this->Login->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Login/administrar'));
        $this->Login->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Khe registrado correctamente"}');
    }
    // =================================================================

    // Negocios
    public function test_Negocios_CargarVistas()
    {

        $vista                 = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Negocios->vista = $vista;
        $this->Negocios->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Negocios/consultar');
        $this->assertTrue(true);
    }
    public function test_Negocios_EstablecerConsultas()
    {
        $this->Negocios->Establecer_Consultas();
        $this->assertNotEmpty($this->Negocios->Get_Datos_Vista()['negocios']);
        $this->assertNotEmpty($this->Negocios->Get_Datos_Vista()['calle']);
        $this->assertNotEmpty($this->Negocios->Get_Datos_Vista()['personas']);
    }

    public function test_Negocios_Getters()
    {
        $this->assertEquals('consultar', $this->Negocios->Get_Sql());
        $this->assertEquals('consultar', $this->Negocios->Get_Accion());
        $this->assertEquals('1', $this->Negocios->Get_Mensaje());
        $this->assertIsArray($this->Negocios->Get_Datos());
        $this->assertIsArray($this->Negocios->Get_Estado());
        $this->assertIsArray($this->Negocios->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Negocios->Get_Datos_Vista());
        $this->assertIsArray($this->Negocios->Get_Crud_Sql());

    }

    public function test_Negocios_Administrar()
    {

        $modelo                 = $this->getMockBuilder(Negocios_Class::class)->disableOriginalConstructor()->getMock();
        $vista                  = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Negocios->modelo = $modelo;
        $this->Negocios->vista  = $vista;
        $entrada                = ['peticion' => 'Administrar'];
        $this->Negocios->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Negocios/administrar'));
        $this->Negocios->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Negocio registrado correctamente"}');
    }
    // =================================================================

    // Notificaciones
    public function test_Notificaciones_CargarVistas()
    {

        $vista                       = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Notificaciones->vista = $vista;
        $this->Notificaciones->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Notificaciones/consultar');
        $this->assertTrue(true);
    }
    public function test_Notificaciones_EstablecerConsultas()
    {
        $this->Notificaciones->Establecer_Consultas();
        $this->assertNotEmpty($this->Notificaciones->Get_Datos_Vista()['notificaciones']);
        $this->assertNotEmpty($this->Notificaciones->Get_Datos_Vista()['receptores']);
    }

    public function test_Notificaciones_Getters()
    {
        $this->assertEquals('consultar', $this->Notificaciones->Get_Sql());
        $this->assertEquals('1', $this->Notificaciones->Get_Mensaje());
        $this->assertIsArray($this->Notificaciones->Get_Datos());
        $this->assertIsArray($this->Notificaciones->Get_Datos_Vista());
        $this->assertIsArray($this->Notificaciones->Get_Crud_Sql());

    }

    public function test_Notificaciones_Administrar()
    {

        $modelo                       = $this->getMockBuilder(Notificaciones_Class::class)->disableOriginalConstructor()->getMock();
        $vista                        = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Notificaciones->modelo = $modelo;
        $this->Notificaciones->vista  = $vista;
        $entrada                      = ['peticion' => 'Administrar'];
        $this->Notificaciones->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Notificaciones/administrar'));
        $this->Notificaciones->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Notificacion registrado correctamente"}');
    }
    // =================================================================

    // Parto_Humanizado
    public function test_Parto_Humanizado_CargarVistas()
    {

        $vista                         = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Parto_Humanizado->vista = $vista;
        $this->Parto_Humanizado->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Parto_Humanizado/consultar');
        $this->assertTrue(true);
    }
    public function test_Parto_Humanizado_EstablecerConsultas()
    {
        $this->Parto_Humanizado->Establecer_Consultas();
        $this->assertNotEmpty($this->Parto_Humanizado->Get_Datos_Vista()['parto_humanizado']);
        $this->assertNotEmpty($this->Parto_Humanizado->Get_Datos_Vista()['personas']);
    }

    public function test_Parto_Humanizado_Getters()
    {
        $this->assertEquals('consultar', $this->Parto_Humanizado->Get_Sql());
        $this->assertEquals('consultar', $this->Parto_Humanizado->Get_Accion());
        $this->assertEquals('1', $this->Parto_Humanizado->Get_Mensaje());
        $this->assertIsArray($this->Parto_Humanizado->Get_Datos());
        $this->assertIsArray($this->Parto_Humanizado->Get_Estado());
        $this->assertIsArray($this->Parto_Humanizado->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Parto_Humanizado->Get_Datos_Vista());
        $this->assertIsArray($this->Parto_Humanizado->Get_Crud_Sql());

    }

    public function test_Parto_Humanizado_Administrar()
    {

        $modelo                         = $this->getMockBuilder(Parto_Humanizado_Class::class)->disableOriginalConstructor()->getMock();
        $vista                          = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Parto_Humanizado->modelo = $modelo;
        $this->Parto_Humanizado->vista  = $vista;
        $entrada                        = ['peticion' => 'Administrar'];
        $this->Parto_Humanizado->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Parto_Humanizado/administrar'));
        $this->Parto_Humanizado->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Persona Embarazada registrada correctamente"}');
    }
    // =================================================================

    // Personas
    public function test_Personas_CargarVistas()
    {

        $vista                 = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Personas->vista = $vista;
        $this->Personas->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Personas/consultar');
        $this->assertTrue(true);
    }
    public function test_Personas_EstablecerConsultas()
    {
        $this->Personas->Establecer_Consultas();
        $this->assertNotEmpty($this->Personas->Get_Datos_Vista()['personas']);
        $this->assertNotEmpty($this->Personas->Get_Datos_Vista()['transportes']);
    }

    public function test_Personas_Getters()
    {
        $this->assertEquals('consultar', $this->Personas->Get_Sql());
        $this->assertEquals('consultar', $this->Personas->Get_Accion());
        $this->assertEquals('1', $this->Personas->Get_Mensaje());
        $this->assertIsArray($this->Personas->Get_Datos());
        $this->assertIsArray($this->Personas->Get_Estado());
        $this->assertIsArray($this->Personas->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Personas->Get_Datos_Vista());
        $this->assertIsArray($this->Personas->Get_Crud_Sql());

    }

    public function test_Personas_Administrar()
    {

        $modelo                 = $this->getMockBuilder(Personas_Class::class)->disableOriginalConstructor()->getMock();
        $vista                  = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Personas->modelo = $modelo;
        $this->Personas->vista  = $vista;
        $entrada                = ['peticion' => 'Administrar'];
        $this->Personas->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Personas/administrar'));
        $this->Personas->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Persona registrada correctamente"}');
    }
    // =================================================================

    // Reportes
    public function test_Reportes_CargarVistas()
    {

        $vista                 = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Reportes->vista = $vista;
        $this->Reportes->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Reportes/consultar');
        $this->assertTrue(true);
    }
    public function test_Reportes_EstablecerConsultas()
    {
        $this->Reportes->Establecer_Consultas();
        $this->assertNotEmpty($this->Reportes->Get_Datos_Vista()['personas']);
        $this->assertNotEmpty($this->Reportes->Get_Datos_Vista()['parto_humanizado']);
        $this->assertNotEmpty($this->Reportes->Get_Datos_Vista()['votantes']);
        $this->assertNotEmpty($this->Reportes->Get_Datos_Vista()['vacunados']);
        $this->assertNotEmpty($this->Reportes->Get_Datos_Vista()['discapacitados']);
        $this->assertNotEmpty($this->Reportes->Get_Datos_Vista()['personas_bonos']);
    }

    public function test_Reportes_Getters()
    {
        $this->assertEquals('consultar', $this->Reportes->Get_Sql());
        $this->assertIsArray($this->Reportes->Get_Datos_Vista());
        $this->assertIsArray($this->Reportes->Get_Crud_Sql());

    }

    public function test_Reportes_Administrar()
    {

        $modelo                 = $this->getMockBuilder(Reportes_Class::class)->disableOriginalConstructor()->getMock();
        $vista                  = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Reportes->modelo = $modelo;
        $this->Reportes->vista  = $vista;
        $entrada                = ['peticion' => 'Administrar'];
        $this->Reportes->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Reportes/administrar'));
        $this->Reportes->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Khe2 Embarazada registrada correctamente"}');
    }
    // =================================================================

    // Sector_Agricola
    public function test_Sector_Agricola_CargarVistas()
    {

        $vista                        = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Sector_Agricola->vista = $vista;
        $this->Sector_Agricola->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Sector_Agricola/consultar');
        $this->assertTrue(true);
    }
    public function test_Sector_Agricola_EstablecerConsultas()
    {
        $this->Sector_Agricola->Establecer_Consultas();
        $this->assertNotEmpty($this->Sector_Agricola->Get_Datos_Vista()['sector_agricola']);
        $this->assertNotEmpty($this->Sector_Agricola->Get_Datos_Vista()['personas']);
    }

    public function test_Sector_Agricola_Getters()
    {
        $this->assertEquals('consultar', $this->Sector_Agricola->Get_Sql());
        $this->assertEquals('consultar', $this->Sector_Agricola->Get_Accion());
        $this->assertEquals('1', $this->Sector_Agricola->Get_Mensaje());
        $this->assertIsArray($this->Sector_Agricola->Get_Datos());
        $this->assertIsArray($this->Sector_Agricola->Get_Estado());
        $this->assertIsArray($this->Sector_Agricola->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Sector_Agricola->Get_Datos_Vista());
        $this->assertIsArray($this->Sector_Agricola->Get_Crud_Sql());

    }

    public function test_Sector_Agricola_Administrar()
    {

        $modelo                        = $this->getMockBuilder(Sector_Agricola_Class::class)->disableOriginalConstructor()->getMock();
        $vista                         = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Sector_Agricola->modelo = $modelo;
        $this->Sector_Agricola->vista  = $vista;
        $entrada                       = ['peticion' => 'Administrar'];
        $this->Sector_Agricola->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Sector_Agricola/administrar'));
        $this->Sector_Agricola->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Sector Agricola registrado correctamente"}');
    }
    // =================================================================

    // Seguridad
    public function test_Seguridad_CargarVistas()
    {

        $vista                  = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Seguridad->vista = $vista;
        $this->Seguridad->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Seguridad/consultar');
        $this->assertTrue(true);
    }

    public function test_Seguridad_Getters()
    {
        $this->assertEquals('consultar', $this->Seguridad->Get_Sql());
        $this->assertEquals('consultar', $this->Seguridad->Get_Accion());
        $this->assertEquals('1', $this->Seguridad->Get_Mensaje());
        $this->assertIsArray($this->Seguridad->Get_Datos());
        $this->assertIsArray($this->Seguridad->Get_Crud_Sql());

    }

    public function test_Seguridad_Administrar()
    {

        $modelo                  = $this->getMockBuilder(Seguridad_Class::class)->disableOriginalConstructor()->getMock();
        $vista                   = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Seguridad->modelo = $modelo;
        $this->Seguridad->vista  = $vista;
        $entrada                 = ['peticion' => 'Administrar'];
        $this->Seguridad->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Seguridad/administrar'));
        $this->Seguridad->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Khe3 registrado correctamente"}');
    }
    // =================================================================

    // Solicitudes
    public function test_Solicitudes_CargarVistas()
    {

        $vista                    = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Solicitudes->vista = $vista;
        $this->Solicitudes->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Solicitudes/consultar');
        $this->assertTrue(true);
    }
    public function test_Solicitudes_EstablecerConsultas()
    {
        $this->Solicitudes->Establecer_Consultas();
        $this->assertNotEmpty($this->Solicitudes->Get_Datos_Vista()['solicitudes']);
        $this->assertNotEmpty($this->Solicitudes->Get_Datos_Vista()['solicitudes_todas']);
    }

    public function test_Solicitudes_Getters()
    {
        $this->assertEquals('consultar', $this->Solicitudes->Get_Sql());
        $this->assertEquals('consultar', $this->Solicitudes->Get_Accion());
        $this->assertEquals('1', $this->Solicitudes->Get_Mensaje());
        $this->assertIsArray($this->Solicitudes->Get_Datos());
        $this->assertIsArray($this->Solicitudes->Get_Estado());
        $this->assertIsArray($this->Solicitudes->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Solicitudes->Get_Datos_Vista());
        $this->assertIsArray($this->Solicitudes->Get_Crud_Sql());

    }

    public function test_Solicitudes_Administrar()
    {

        $modelo                    = $this->getMockBuilder(Solicitudes_Class::class)->disableOriginalConstructor()->getMock();
        $vista                     = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Solicitudes->modelo = $modelo;
        $this->Solicitudes->vista  = $vista;
        $entrada                   = ['peticion' => 'Administrar'];
        $this->Solicitudes->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Solicitudes/administrar'));
        $this->Solicitudes->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Solicitud registrada correctamente"}');
    }
    // =================================================================

    // Vacunados
    public function test_Vacunados_CargarVistas()
    {

        $vista                  = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Vacunados->vista = $vista;
        $this->Vacunados->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Vacunados/consultar');
        $this->assertTrue(true);
    }
    public function test_Vacunados_EstablecerConsultas()
    {
        $this->Vacunados->Establecer_Consultas();
        $this->assertNotEmpty($this->Vacunados->Get_Datos_Vista()['vacunados']);
        $this->assertNotEmpty($this->Vacunados->Get_Datos_Vista()['vacunas']);
        $this->assertNotEmpty($this->Vacunados->Get_Datos_Vista()['personas']);
    }

    public function test_Vacunados_Getters()
    {
        $this->assertEquals('consultar', $this->Vacunados->Get_Sql());
        $this->assertEquals('consultar', $this->Vacunados->Get_Accion());
        $this->assertEquals('1', $this->Vacunados->Get_Mensaje());
        $this->assertIsArray($this->Vacunados->Get_Datos());
        $this->assertIsArray($this->Vacunados->Get_Estado());
        $this->assertIsArray($this->Vacunados->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Vacunados->Get_Datos_Vista());
        $this->assertIsArray($this->Vacunados->Get_Crud_Sql());

    }

    public function test_Vacunados_Administrar()
    {

        $modelo                  = $this->getMockBuilder(Vacunados_Class::class)->disableOriginalConstructor()->getMock();
        $vista                   = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Vacunados->modelo = $modelo;
        $this->Vacunados->vista  = $vista;
        $entrada                 = ['peticion' => 'Administrar'];
        $this->Vacunados->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Vacunados/administrar'));
        $this->Vacunados->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Persona vacunada registrada correctamente"}');
    }
    // =================================================================

    // Viviendas
    public function test_Viviendas_CargarVistas()
    {

        $vista                  = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Viviendas->vista = $vista;
        $this->Viviendas->Cargar_Vistas();
        $vista->expects($this->once())->method('Cargar_Vistas')->with('Viviendas/consultar');
        $this->assertTrue(true);
    }
    public function test_Viviendas_EstablecerConsultas()
    {
        $this->Viviendas->Establecer_Consultas();
        $this->assertNotEmpty($this->Viviendas->Get_Datos_Vista()['viviendas']);
        $this->assertNotEmpty($this->Viviendas->Get_Datos_Vista()['tipo_vivienda']);
        $this->assertNotEmpty($this->Viviendas->Get_Datos_Vista()['calle']);
        $this->assertNotEmpty($this->Viviendas->Get_Datos_Vista()['tipo_techo']);
        $this->assertNotEmpty($this->Viviendas->Get_Datos_Vista()['tipo_pared']);
        $this->assertNotEmpty($this->Viviendas->Get_Datos_Vista()['tipo_piso']);
        $this->assertNotEmpty($this->Viviendas->Get_Datos_Vista()['servicios_gas']);
        $this->assertNotEmpty($this->Viviendas->Get_Datos_Vista()['electrodomesticos']);

    }

    public function test_Viviendas_Getters()
    {
        $this->assertEquals('consultar', $this->Viviendas->Get_Sql());
        $this->assertEquals('consultar', $this->Viviendas->Get_Accion());
        $this->assertEquals('1', $this->Viviendas->Get_Mensaje());
        $this->assertIsArray($this->Viviendas->Get_Datos());
        $this->assertIsArray($this->Viviendas->Get_Estado());
        $this->assertIsArray($this->Viviendas->Get_Estado_Ejecutar());
        $this->assertIsArray($this->Viviendas->Get_Datos_Vista());
        $this->assertIsArray($this->Viviendas->Get_Crud_Sql());

    }

    public function test_Viviendas_Administrar()
    {

        $modelo                  = $this->getMockBuilder(Viviendas_Class::class)->disableOriginalConstructor()->getMock();
        $vista                   = $this->getMockBuilder(Vista::class)->disableOriginalConstructor()->getMock();
        $this->Viviendas->modelo = $modelo;
        $this->Viviendas->vista  = $vista;
        $entrada                 = ['peticion' => 'Administrar'];
        $this->Viviendas->setPost($entrada);
        $modelo->expects($this->once())->method('Validacion_Registro')->willReturn(true);
        $modelo->expects($this->once())->method('Administrar')->willReturn(true);
        $vista->expects($this->once())->method('Cargar_Vistas')->with($this->equalTo('Viviendas/administrar'));
        $this->Viviendas->Administrar();
        $this->expectOutputString('{"tipo":"success","mensaje":"Viviendas registrada correctamente"}');
    }
    // =================================================================

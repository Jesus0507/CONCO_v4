<?php
use PHPUnit\Framework\TestCase;

class Sector_AgricolaTest extends TestCase
{
    public function test_Registrar()
    {
        $modelo = new Sector_Agricola_Class();
        $datos = [
            'cedula_persona' => "26142326",
            'area_produccion' => "agricola",
            'anios_experiencia' => "20",
            'rubro_principal' => "pimentones",
            'rubro_alternativo' => "aji",
            'registro_INTI' => "1",
            'constancia_productor' => "1",
            'senial_hierro' => "1",
            'financiado' => "20,00",
            'agua_riego' => "1",
            'produccion_actual' => "1",
            'org_agricola' => "Ninguna"];
        $data = $modelo->Registrar([
            'cedula_persona' => $datos['cedula_persona'],
            'area_produccion' => $datos['area_produccion'],
            'anios_experiencia' => $datos['anios_experiencia'],
            'rubro_principal' => $datos['rubro_principal'],
            'rubro_alternativo' => $datos['rubro_alternativo'],
            'registro_INTI' => $datos['registro_INTI'],
            'constancia_productor' => $datos['constancia_productor'],
            'senial_hierro' => $datos['senial_hierro'],
            'financiado' => $datos['financiado'],
            'agua_riego' => $datos['agua_riego'],
            'produccion_actual' => $datos['produccion_actual'],
            'org_agricola' => $datos['org_agricola'],
            'estado' => 1]
        );
        $this->assertEquals(count($data), true);
    }

    public function test_Consultar()
    {
        $modelo = new Sector_Agricola_Class();

        $data = $modelo->Consultar();
        $this->assertEquals(count($data), true);
    }

    public function test_Actualizar()
    {
        $modelo = new Sector_Agricola_Class();
        $datos = [
            'cedula_persona' => "1",
            'cedula_persona' => "26142326",
            'area_produccion' => "agricola",
            'anios_experiencia' => "25",
            'rubro_principal' => "pimentones",
            'rubro_alternativo' => "aji",
            'registro_INTI' => "1",
            'constancia_productor' => "1",
            'senial_hierro' => "1",
            'financiado' => "50,00",
            'agua_riego' => "1",
            'produccion_actual' => "0",
            'org_agricola' => "Ninguna"];
        $data = $modelo->Actualizar([
            'id_sector_agricola' => $datos['id_sector_agricola'],
            'cedula_persona' => $datos['cedula_persona'],
            'area_produccion' => $datos['area_produccion'],
            'anios_experiencia' => $datos['anios_experiencia'],
            'rubro_principal' => $datos['rubro_principal'],
            'rubro_alternativo' => $datos['rubro_alternativo'],
            'registro_INTI' => $datos['registro_INTI'],
            'constancia_productor' => $datos['constancia_productor'],
            'senial_hierro' => $datos['senial_hierro'],
            'financiado' => $datos['financiado'],
            'agua_riego' => $datos['agua_riego'],
            'produccion_actual' => $datos['produccion_actual'],
            'org_agricola' => $datos['org_agricola'],
            'estado' => 1]);
        $this->assertEquals(count($data), true);
    }

}

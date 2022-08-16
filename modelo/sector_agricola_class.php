<?php
 
class Sector_Agricola_Class extends Modelo
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function Administrar()
    {
        $this->sentencia = $this->{$this->SQL}();
        try {
            switch ($this->tipo) {
                case '0':
                    return $this->Resultado_Consulta();
                    break;
                case '1':
                    return $this->Ejecutar_Tarea();
                    break;
                default:
                    die('[Error 400] => "La Peticion es Incorrecta, solo se permite peticion de tipo 0/1."');
                    break;
            }
        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    //=======================================================================

    private function SQL_01()
    {
        return 'INSERT INTO sector_agricola (cedula_persona, area_produccion, anios_experiencia, rubro_principal, rubro_alternativo, registro_INTI, constancia_productor, senial_hierro, financiado, agua_riego, produccion_actual, org_agricola, estado) VALUES (:cedula_persona, :area_produccion, :anios_experiencia, :rubro_principal, :rubro_alternativo, :registro_INTI, :constancia_productor, :senial_hierro, :financiado, :agua_riego, :produccion_actual, :org_agricola, :estado)';
    }

    private function SQL_02()
    {
        return 'SELECT id_sector_agricola, s.cedula_persona, p.primer_nombre, p.primer_apellido, area_produccion, anios_experiencia, rubro_principal, rubro_alternativo, registro_INTI, constancia_productor, senial_hierro, financiado, agua_riego, produccion_actual, org_agricola FROM sector_agricola s, personas p WHERE s.estado =1 and s.cedula_persona = p.cedula_persona AND p.estado = 1 ORDER BY `p`.`primer_nombre` ASC';
    }

    private function SQL_03()
    {
        return 'UPDATE sector_agricola  SET cedula_persona = :cedula_persona, area_produccion = :area_produccion, anios_experiencia = :anios_experiencia, rubro_principal = :rubro_principal, rubro_alternativo = :rubro_alternativo, registro_INTI = :registro_INTI, constancia_productor = :constancia_productor, senial_hierro = :senial_hierro, financiado = :financiado, agua_riego = :agua_riego, produccion_actual = :produccion_actual, org_agricola = :org_agricola, estado = :estado WHERE id_sector_agricola =:id_sector_agricola';
    }
    private function SQL_04()
    {
        return "SELECT p.cedula_persona,p.primer_nombre,p.primer_apellido FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }
}

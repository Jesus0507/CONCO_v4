 <?php

    class Reportes extends Controlador
    {
        public function __construct()
        {
            parent::__construct();
            //    $this->Cargar_Modelo("reportes");
        }

        public function Establecer_Consultas()
        {
            $personas = $this->Consultar_Tabla("personas", 1, "cedula_persona");
            $parto_humanizado = $this->Consultar_Tabla("parto_humanizado", 1, "cedula_persona");
            $votantes = $this->Consultar_Tabla("votantes_centro_votacion", 1, "cedula_votante");
            $vacunados = $this->Consultar_Tabla("vacuna_covid", 1, "cedula_persona");
            $discapacitados = $this->Consultar_Tabla_sin_estado("discapacidad_persona", 1, "cedula_persona");
            $personas_bonos = $this->Consultar_Tabla_sin_estado("persona_bonos", 1, "cedula_persona");
            $milicianos = $this->modelo->Milicianos();
            $jefes_familia = $this->modelo->Jefes_Calle();
            $inmuebles = $this->modelo->Inmuebles();
            $negocios = $this->modelo->Negocios();
            $nivel_educativo = $this->modelo->Nivel_Educativo();
            $carnet_personas = $this->modelo->Carnet_Personas();
            $viviendas = $this->modelo->Viviendas();
            $discapacitados = $this->modelo->Discapacitados();
            $discapacidades = $this->modelo->Discapacidades();
            $comites_personas = $this->modelo->Comites_Personas();
            $personas_familia = $this->modelo->Personas_Familia();
            $persona_centro_votacion = $this->modelo->Persona_Centro_Votacion();
            $enfermos = $this->modelo->Enfermos();
            $enfermedades = $this->modelo->Enfermedades();
            $grupos_deportivos = $this->modelo->Grupos_Deportivos();
            $grupos_deportivos_personas = $this->modelo->Grupo_Deportivo_Persona();
            $embarazadas = $this->modelo->Embarazadas();


            $poblacion_edades = $this->modelo->Poblacion_Edades();

            $this->vista->personas = $personas;
            $this->personas = $personas;

            $this->vista->parto_humanizado = $parto_humanizado;
            $this->parto_humanizado = $parto_humanizado;

            $this->vista->votantes = $votantes;
            $this->votantes = $votantes;

            $this->vista->vacunados = $vacunados;
            $this->vacunados = $vacunados;

            $this->vista->discapacitados = $discapacitados;
            $this->discapacitados = $discapacitados;

            $this->vista->personas_bonos = $personas_bonos;
            $this->personas_bonos = $personas_bonos;

            $this->vista->milicianos = $milicianos;
            $this->milicianos = $milicianos;

            $this->vista->jefes_familia = $jefes_familia;
            $this->jefes_familia = $jefes_familia;

            $this->vista->inmuebles = $inmuebles;
            $this->inmuebles = $inmuebles;

            $this->vista->negocios = $negocios;
            $this->negocios = $negocios;

            $this->vista->nivel_educativo = $nivel_educativo;
            $this->nivel_educativo = $nivel_educativo;

            $this->vista->carnet_personas = $carnet_personas;
            $this->carnet_personas = $carnet_personas;

            $this->vista->viviendas = $viviendas;
            $this->viviendas = $viviendas;

            $this->vista->discapacitados = $discapacitados;
            $this->discapacitados = $discapacitados;

            $this->vista->discapacidades = $discapacidades;
            $this->discapacidades = $discapacidades;

            $this->vista->comites_personas = $comites_personas;
            $this->comites_personas = $comites_personas;

            $this->vista->personas_familia = $personas_familia;
            $this->personas_familia = $personas_familia;

            $this->vista->persona_centro_votacion = $persona_centro_votacion;
            $this->persona_centro_votacion = $persona_centro_votacion;

            $this->vista->enfermos = $enfermos;
            $this->enfermos = $enfermos;

            $this->vista->enfermedades = $enfermedades;
            $this->enfermedades = $enfermedades;

            $this->vista->grupos_deportivos = $grupos_deportivos;
            $this->grupos_deportivos = $grupos_deportivos;

            $this->vista->grupos_deportivos_personas = $grupos_deportivos_personas;
            $this->grupos_deportivos_personas = $grupos_deportivos_personas;

            $this->vista->embarazadas = $embarazadas;
            $this->embarazadas = $embarazadas;

            $this->vista->poblacion_edades = $poblacion_edades;
            $this->poblacion_edades = $poblacion_edades;
        }

        public function Datos_Poblacional()
        {
            $familia = $this->Consultar_Columna("familia", "id_familia", 9);

            foreach ($familia as $key => $value) {

                $viviendas = $this->Consultar_Columna("vivienda", "id_vivienda", $value["id_vivienda"]);

                $integrantes = $this->modelo->Integranres($value["id_familia"]);

                foreach ($integrantes as $key => $int) {
                    $persona_proyecto = $this->modelo->Personas_Proyecto($int["cedula_persona"]);
                }

                foreach ($viviendas as $key => $v) {
                    $calle = $this->Consultar_Columna("calles", "id_calle", $v["id_calle"]);
                    $tipo_vivienda = $this->Consultar_Columna("tipo_vivienda", "id_tipo_vivienda", $v["id_tipo_vivienda"]);
                    $tipo_techo = $this->modelo->Techo($v["id_vivienda"]);
                    $tipo_pared = $this->modelo->Pared($v["id_vivienda"]);
                    $tipo_piso = $this->modelo->Piso($v["id_vivienda"]);
                    $gas = $this->modelo->GAS($v["id_vivienda"]);
                }
            }

            // $tabla[]=[
            //     "id_familia"=> $value["id_familia"],
            //     "id_vivienda"=> $value["id_vivienda"],
            //     "condicion_ocupacion"=> $value["condicion_ocupacion"],
            //     "nombre_familia"=> $value["nombre_familia"],
            // ];
            echo json_encode($persona_proyecto);
        }

        public function Cargar_Vistas()
        {
            $this->Seguridad_de_Session();
            $this->vista->Cargar_Vistas('reportes/index');
        }
        public function Constancias()
        {
            $this->Establecer_Consultas();
            $this->Seguridad_de_Session();
            $this->vista->Cargar_Vistas('reportes/constancias');
        }

        public function Listados()
        {
            $this->Establecer_Consultas();
            $this->Seguridad_de_Session();
            $this->vista->Cargar_Vistas('reportes/listados');
        }

        public function Estadisticas()
        {
            $this->Establecer_Consultas();
            $this->Seguridad_de_Session();

            $embarazadas = count($this->parto_humanizado);
            $personas = count($this->personas);

            //------------------Calculo de edades----------------------------------//

            $menores_edad = 0;
            $mayores_edad = 0;
            $adulto_mayor = 0;

            foreach ($this->personas as $persona) {
                $anio = explode('-', $persona["fecha_nacimiento"]);
                $edad = date("Y") - $anio[0];

                if ($edad <= 17) {
                    $menores_edad++;
                }

                if ($edad >= 18 && $edad <= 55) {
                    $mayores_edad++;
                }

                if ($edad > 55) {
                    $adulto_mayor++;
                }
            }

            $percent_menores = ($menores_edad * 100) / count($this->personas);

            $percent_mayores = ($mayores_edad * 100) / count($this->personas);

            $percent_adultos = ($adulto_mayor * 100) / count($this->personas);


            $datos_edades = array(
                array("label" => "Menores de Edad (" . $menores_edad . ")", "symbol" => "Menores de 17 ", "y" => $percent_menores),
                array("label" => "Mayores de Edad (" . $mayores_edad . ")", "symbol" => "Mayores de 18", "y" => $percent_mayores),
                array("label" => "Adulto Mayor (" . $adulto_mayor . ")", "symbol" => "Mayores de 55", "y" => $percent_adultos)

            );

            $this->vista->datos_edades = $datos_edades;


            //---------------------------------Calculo de embarazadas------------------------------------//

            $cant_embarazadas_actual = 0;
            $cant_mujeres = 0;

            for ($i = 0; $i < $embarazadas; $i++) {

                $fecha_actual = strtotime("now");
                $fecha_parto = strtotime($this->parto_humanizado[$i]['fecha_aprox_parto']);

                if ($fecha_parto >= $fecha_actual) {
                    $cant_embarazadas_actual++;
                }
            }

            foreach ($this->personas as $p) {
                if ($p['genero'] == "F") {
                    $cant_mujeres++;
                }
            }



            $calculo_embarazadas = ($cant_embarazadas_actual * 100) / $cant_mujeres;
            $mujeres = $cant_mujeres - $cant_embarazadas_actual;
            $calculo_mujeres = ($mujeres * 100) / $cant_mujeres;

            $datos_embarazadas = array(
                array("label" => "Mujeres Embarazadas (" . $cant_embarazadas_actual . ")", "symbol" => "Mujeres Embarazadas", "y" => $calculo_embarazadas),
                array("label" => "Mujeres no embarazadas (" . $mujeres . ")", "symbol" => "Mujeres no embarazadas", "y" => $calculo_mujeres)
            );


            $this->vista->datos_embarazadas = $datos_embarazadas;

            //-----------------------------Población votante------------------------------------//

            $cant_votantes_total = $mayores_edad + $adulto_mayor;
            $cant_votantes_inscritos = count($this->votantes);
            $cant_votantes_sin_inscribir = $cant_votantes_total - $cant_votantes_inscritos;

            $calculo_no_inscritos = ($cant_votantes_sin_inscribir * 100) / $cant_votantes_total;
            $calculo_inscritos = ($cant_votantes_inscritos * 100) / $cant_votantes_total;

            $datos_votantes = array(
                array("label" => "Votantes sin inscribir CNE (" . $cant_votantes_sin_inscribir . ")", "symbol" => "Votantes sin inscribir CNE", "y" => $calculo_no_inscritos),
                array("label" => "Votantes inscritos CNE (" . $cant_votantes_inscritos . ")", "symbol" => "Votantes inscritos CNE", "y" => $calculo_inscritos)
            );


            $this->vista->datos_votantes = $datos_votantes;

            //_--------------------------Niveles educativos---------------------------------//
            $cant_preescolar = 0;
            $cant_bachiller = 0;
            $cant_basico = 0;
            $cant_superior = 0;

            foreach ($this->personas as $p) {
                switch ($p['nivel_educativo']) {
                    case 'Superior':
                        $cant_superior++;
                        break;

                    case 'Medio diversificado':
                        $cant_bachiller++;
                        break;

                    case 'Preescolar':
                        $cant_preescolar++;
                        break;

                    default:
                        $cant_basico++;
                        break;
                }
            }


            $calculo_superior = ($cant_superior * 100) / count($this->personas);
            $calculo_bachiller = ($cant_bachiller * 100) / count($this->personas);
            $calculo_preescolar = ($cant_preescolar * 100) / count($this->personas);
            $calculo_basico = ($cant_basico * 100) / count($this->personas);


            $datos_educacion = array(
                array("label" => "Superior (" . $cant_superior . ")", "symbol" => "Superior", "y" => $calculo_superior),
                array("label" => "Medio diversificado (" . $cant_bachiller . ")", "symbol" => "Medio diversificado", "y" => $calculo_bachiller),
                array("label" => "Preescolar (" . $cant_preescolar . ")", "symbol" => "Preescolar", "y" => $calculo_preescolar),
                array("label" => "Básico (" . $cant_basico . ")", "symbol" => "Básico", "y" => $calculo_basico)
            );


            $this->vista->datos_educacion = $datos_educacion;


            //---------------------Población vacunada------------------------------------------------//

            $vacunados = [];

            foreach ($this->vacunados as $v) {
                if (count($vacunados) == 0) {
                    $vacunados[] = $v['cedula_persona'];
                } else {

                    $existe = false;
                    for ($i = 0; $i < count($vacunados); $i++) {
                        if ($vacunados[$i] == $v['cedula_persona']) {
                            $existe = true;
                        }
                    }

                    if ($existe == false) {
                        $vacunados[] = $v['cedula_persona'];
                    }
                }
            }

            $cant_vacunados = count($vacunados);
            $cant_no_vacunados = count($this->personas) - $cant_vacunados;
            $calculo_vacunados = ($cant_vacunados * 100) / count($this->personas);
            $calculo_no_vacunados = ($cant_no_vacunados * 100) / count($this->personas);


            $datos_vacuna = array(
                array("label" => "Vacunados (" . $cant_vacunados . ")", "symbol" => "Vacunados", "y" => $calculo_vacunados),
                array("label" => "No vacunados (" . $cant_no_vacunados . ")", "symbol" => "No vacunados", "y" => $calculo_no_vacunados)

            );


            $this->vista->datos_vacuna = $datos_vacuna;

            //------------------Población de discapacitados---------------------------------//

            $cantidad_discapacitados_en_cama = [];
            $cantidad_discapacitados = [];
            $cant_total = [];


            foreach ($this->discapacitados as $d) {

                if ($d['en_cama'] == 1) {
                    if (count($cantidad_discapacitados_en_cama) == 0) {
                        $cantidad_discapacitados_en_cama[] = $d;
                    } else {
                        $existe = 0;
                        for ($i = 0; $i < count($cantidad_discapacitados_en_cama); $i++) {
                            if ($cantidad_discapacitados_en_cama[$i]['cedula_persona'] == $d['cedula_persona']) {
                                $existe++;
                            }
                        }

                        if ($existe == 0) {
                            $cantidad_discapacitados_en_cama[] = $d;
                        }
                    }
                }
            }


            foreach ($this->discapacitados as $d) {
                if ($d['en_cama'] == 0) {
                    $existe = false;
                    for ($i = 0; $i < count($cantidad_discapacitados_en_cama); $i++) {
                        if ($cantidad_discapacitados_en_cama[$i]['cedula_persona'] == $d['cedula_persona']) {
                            $existe = true;
                        }
                    }


                    if ($existe == false) {

                        if (count($cantidad_discapacitados) == 0) {
                            $cantidad_discapacitados[] = $d;
                        } else {
                            $existe2 = 0;
                            for ($j = 0; $j < count($cantidad_discapacitados); $j++) {
                                if ($cantidad_discapacitados[$j]['cedula_persona'] == $d['cedula_persona']) {
                                    $existe2++;
                                }
                            }

                            if ($existe2 == 0) {
                                $cantidad_discapacitados[] = $d;
                            }
                        }
                    }
                }
            }



            foreach ($this->discapacitados as $d) {
                if (count($cant_total) == 0) {
                    $cant_total[] = $d;
                } else {
                    $existe = false;
                    for ($i = 0; $i < count($cant_total); $i++) {
                        if ($cant_total[$i]['cedula_persona'] == $d['cedula_persona']) {
                            $existe = true;
                        }
                    }

                    if ($existe == false) {
                        $cant_total[] = $d;
                    }
                }
            }




            $cant_en_cama = count($cantidad_discapacitados_en_cama);
            $cant_disc = count($cantidad_discapacitados);
            $cant_total_discapacitados = count($cant_total);

            $calculo_encama = ($cant_en_cama * 100) / $cant_total_discapacitados;
            $calculo_disc = ($cant_disc * 100) / $cant_total_discapacitados;


            $datos_discapacitados = array(
                array("label" => "En cama (" . $cant_en_cama . ")", "symbol" => "En cama", "y" => $calculo_encama),
                array("label" => "Discapacitados (" . $cant_disc . ")", "symbol" => "Discapacitados", "y" => $calculo_disc)

            );


            $this->vista->datos_discapacitados = $datos_discapacitados;


            //----------------Personas bonificadas---------------------------------------//

            $cant_bonos = [];

            foreach ($this->personas_bonos as $pb) {
                if (count($cant_bonos) == 0) {
                    $cant_bonos[] = $pb;
                } else {
                    $existe = false;
                    for ($i = 0; $i < count($cant_bonos); $i++) {
                        if ($cant_bonos[$i]['cedula_persona'] == $pb['cedula_persona']) {
                            $existe = true;
                        }
                    }

                    if ($existe == false) {
                        $cant_bonos[] = $pb;
                    }
                }
            }

            $cant_bonos_num = count($cant_bonos);
            $cant_personas = count($this->personas) - $cant_bonos_num;

            $calculo_personas_bonos = ($cant_bonos_num * 100) / count($this->personas);
            $calculo_personas = ($cant_personas * 100) / count($this->personas);

            $datos_bonos = array(
                array("label" => "Personas bonificadas (" . $cant_bonos_num . ")", "symbol" => "Personas bonificadas", "y" => $calculo_personas_bonos),
                array("label" => "Personas no bonificadas (" . $cant_personas . ")", "symbol" => "Personas no bonificadas", "y" => $calculo_personas)

            );


            $this->vista->datos_bonos = $datos_bonos;



            $this->vista->Cargar_Vistas('reportes/estadisticas');
        }

        /* ===============================PDF================================== */


        /* CONSTANCIAS */

        public function Constancias_PDF()
        {
            $this->Establecer_Consultas();
            $this->Seguridad_de_Session();

            switch ($_POST["constancias"]) {
                case '1':
                    $this->vista->Cargar_Vistas('reportes/PDF/residencia');
                    break;

                case '2':
                    $this->Seguridad_de_Session();
                    break;

                case '3':
                    $this->vista->Cargar_Vistas('reportes/PDF/no_vivienda');
                    break;

                default:
                    echo "REPORTE NO ENCONTRADO";
                    break;
            }
        }
        public function Censos()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/censos');
        }
        public function Reporte_Ninos()
        {
            $this->Seguridad_de_Session();
            $personas=$this->Consultar_Tabla("personas",1,"cedula_persona");
            $menores=[];
            $menos_dos_anios=[
                "masculino"=>0,
                "femenino"=>0
            ];

            $dos_a_cinco_anios=[
                "masculino"=>0,
                "femenino"=>0
            ];

            $seis_a_diez_anios=[
                "masculino"=>0,
                "femenino"=>0
            ];

            $once_doce_anios=[
                "masculino"=>0,
                "femenino"=>0
            ];

            foreach($personas as $p){
                $anio = explode('-', $p["fecha_nacimiento"]);
                $edad = date("Y") - $anio[0];
                if($edad<=2){
                   $p['genero']=='M'?$menos_dos_anios['masculino']++:$menos_dos_anios['femenino']++;
                }

                if($edad>=3 && $edad <=5){
                    $p['genero']=='M'?$dos_a_cinco_anios['masculino']++:$dos_a_cinco_anios['femenino']++; 
                }

                if($edad>=6 && $edad<=10){
                    $p['genero']=='M'?$seis_a_diez_anios['masculino']++:$seis_a_diez_anios['femenino']++;
                }

                if($edad==11 || $edad==12){
                    $p['genero']=='M'?$once_doce_anios['masculino']++:$once_doce_anios['femenino']++;
                }

                if($edad<=12){
                    $menores[]=$p;
                }
                
            }


            for($i=0;$i<count($menores);$i++){
                $anio = explode('-', $menores[$i]["fecha_nacimiento"]);
                $edad = date("Y") - $anio[0];
                $menores[$i]['edad']=$edad;
                
                $familia=$this->Consultar_Columna("familia_personas","cedula_persona",$menores[$i]['cedula_persona']);
                $integrantes=$this->Consultar_Columna("familia_personas","id_familia",$familia[0]['id_familia']);
                $get_familia=$this->Consultar_Columna("familia","id_familia",$familia[0]['id_familia']);
                foreach($integrantes as $in){
                    $persona=$this->Consultar_Columna("personas","cedula_persona",$in['cedula_persona']);
                    if($persona[0]['jefe_familia']==1){
                        $menores[$i]['representante']=$persona[0]['primer_nombre']." ".$persona[0]['primer_apellido'];
                        $menores[$i]['contacto']=$persona[0]['telefono'];
                    }
                }

                $vivienda=$this->Consultar_Columna("vivienda","id_vivienda",$get_familia[0]['id_vivienda']);
                $calle=$this->Consultar_Columna("calles","id_calle",$vivienda[0]['id_calle']);
                $menores[$i]['calle']=$calle[0]['nombre_calle'];


            }
            
            $this->vista->menos_dos_anios=$menos_dos_anios;
            $this->vista->dos_a_cinco_anios=$dos_a_cinco_anios;
            $this->vista->seis_a_diez_anios=$seis_a_diez_anios;
            $this->vista->once_doce_anios=$once_doce_anios;
            $this->vista->menores=$menores;


            $this->vista->Cargar_Vistas('reportes/PDF/censo_niños');
        }

        public function Censo_Poblacional()
        {
            $this->Seguridad_de_Session();
            $this->vista->Cargar_Vistas('reportes/PDF/censo_poblacional');
        }

        public function Parto_Humanizado()
        {
            $this->Seguridad_de_Session();
            $this->vista->Cargar_Vistas('reportes/PDF/parto_humanizado');
        }

        public function Historial_Clinico()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();



            foreach ($this->jefes_familia as $key => $value) {
                if ($value["nombre_familia"] ==  $_GET['id']) {
                    $id = $value["id_familia"];
                }
            }

            $familia_vivienda = $this->modelo->Familia_Vivienda($id);
            $this->vista->familia_vivienda = $familia_vivienda;

            $techo = $this->modelo->Techo($id);
            $this->vista->techo = $techo;

            $pared = $this->modelo->Pared($id);
            $this->vista->pared = $pared;

            $piso = $this->modelo->Piso($id);
            $this->vista->piso = $piso;

            $this->vista->Cargar_Vistas('reportes/PDF/historial_clinico');
        }

        public function Milicianos()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/miliciano');
        }

        public function Jefe_Familias()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/jefes_familia');
        }

        public function Inmuebles()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/inmuebles');
        }

        public function Negocios()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/negocios');
        }

        public function Nivel_Educativo()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/nivel_educativo');
        }

        public function Carnet_Personas()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/personas_carnet');
        }

        public function Personas_Discapacidad()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/personas_discapacidad');
        }

        public function Viviendas()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/viviendas');
        }

        public function Consejo_Comunal()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/consejo_comunal');
        }

        public function Sexo_Diverso()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/sexo_diverso');
        }

        public function Votantes()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/votantes');
        }

        public function Personas_Enfermedades()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/personas_enfermedades');
        }

        public function Grupos_Deportivos()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/grupos_deportivos');
        }

        public function Embarazadas()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/embarazadas');
        }

        public function Poblacion_Edades()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/PDF/poblacion_edades');
        }

        public function Historial_Familiar()
        {
            $this->Seguridad_de_Session();
            $this->Establecer_Consultas();
            $this->vista->Cargar_Vistas('reportes/historial_familiar');
        }

        public function info_censo_poblacional()
        {
            $familias_all = $this->Consultar_Tabla("familia", 1, "id_familia");
            $id = "";
            foreach ($familias_all as $fall) {
                if (strtolower($fall['nombre_familia']) == strtolower($_POST['familia'])) {
                    $id = $fall['id_familia'];
                }
            }
            $familia = $this->Consultar_Columna("familia", "id_familia", $id);
            $vivienda = $this->Consultar_Columna("vivienda", "id_vivienda", $familia[0]['id_vivienda']);
            $tipo_vivienda = $this->Consultar_Columna("tipo_vivienda", "id_tipo_vivienda", $vivienda[0]['id_tipo_vivienda']);
            $techo = $this->Consultar_Columna("vivienda_tipo_techo", "id_vivienda", $vivienda[0]['id_vivienda']);
            $pared = $this->Consultar_Columna("vivienda_tipo_pared", "id_vivienda", $vivienda[0]['id_vivienda']);
            $piso = $this->Consultar_Columna("vivienda_tipo_piso", "id_vivienda", $vivienda[0]['id_vivienda']);
            $servicios = $this->Consultar_Columna("servicios", "id_servicio", $vivienda[0]['id_servicio']);
            $servicio_gas = $this->Consultar_Columna("vivienda_servicio_gas", "id_vivienda", $vivienda[0]['id_vivienda']);
            $integrantes = $this->Consultar_Columna("familia_personas", "id_familia", $id);
            $electrodomesticos = $this->Consultar_Columna("vivienda_electrodomesticos", "id_vivienda", $vivienda[0]['id_vivienda']);
            $jefe_familia = "";
            $fam_sexo_diverso = 0;
            $privado_libertad = 0;
            $cant_trabajando = 0;
            $cant_menor_17_trabajando = 0;
            $proyecto_socio = 0;
            $sector_agricola = 0;
            $org_politica = "";
            $cant_integrantes = 1;
            $tabla_integrantes = "";




            for ($i = 0; $i < count($techo); $i++) {
                $t = $this->Consultar_Columna("tipo_techo", "id_tipo_techo", $techo[$i]['id_tipo_techo']);
                $techo[$i]['id_tipo_techo'] = $t[0]['techo'];
            }

            for ($i = 0; $i < count($pared); $i++) {
                $p = $this->Consultar_Columna("tipo_pared", "id_tipo_pared", $pared[$i]['id_tipo_pared']);
                $pared[$i]['id_tipo_pared'] = $p[0]['pared'];
            }

            for ($i = 0; $i < count($piso); $i++) {
                $p = $this->Consultar_Columna("tipo_piso", "id_tipo_piso", $piso[$i]['id_tipo_piso']);
                $piso[$i]['id_tipo_piso'] = $p[0]['piso'];
            }

            for ($i = 0; $i < count($servicio_gas); $i++) {
                $ser_gas = $this->Consultar_Columna("servicio_gas", "id_servicio_gas", $servicio_gas[$i]['id_servicio_gas']);
                $servicio_gas[$i]['servicio'] = $ser_gas[0]['nombre_servicio_gas'];
            }

            for ($i = 0; $i < count($electrodomesticos); $i++) {
                $e = $this->Consultar_Columna("electrodomesticos", "id_electrodomestico", $electrodomesticos[$i]['id_electrodomestico']);
                $electrodomesticos[$i]['nombre'] = $e[0]['nombre_electrodomestico'];
            }

            for ($i = 0; $i < count($integrantes); $i++) {
                $persona = $this->Consultar_Columna("personas", "cedula_persona", $integrantes[$i]['cedula_persona']);
                $cond_lab = $this->Consultar_Columna("condicion_laboral", "cedula_persona", $integrantes[$i]['cedula_persona']);
                $proyecto = $this->Consultar_Columna("persona_proyecto", "cedula_persona", $integrantes[$i]['cedula_persona']);
                $sector_agricola = $this->Consultar_Columna("sector_agricola", "cedula_persona", $integrantes[$i]['cedula_persona']);
                $org_politica = $this->Consultar_Columna("org_politica_persona", "cedula_persona", $integrantes[$i]['cedula_persona']);
                $anio = explode('-', $persona[0]["fecha_nacimiento"]);
                $edad = date("Y") - $anio[0];
                $ocupacion_persona = $this->Consultar_Columna("ocupacion_persona", "cedula_persona", $integrantes[$i]['cedula_persona']);
                $condicion_laboral_persona = $this->Consultar_Columna("condicion_laboral", "cedula_persona", $integrantes[$i]['cedula_persona']);
                $enfermedades_persona=$this->Consultar_Columna("personas_enfermedades","cedula_persona",$integrantes[$i]['cedula_persona']);
                $misiones_persona=$this->Consultar_Columna("persona_misiones","cedula_persona",$integrantes[$i]['cedula_persona']);
                if ($persona[0]['jefe_familia'] == 1) {
                    $jefe_familia = $persona[0];
                    $ocupacion = $this->Consultar_Columna("ocupacion_persona", "cedula_persona", $jefe_familia['cedula_persona']);
                    $cant = count($ocupacion);
                    $cant == 0 ? $ocupacion = "No posee" : $ocupacion = $this->Consultar_Columna("ocupacion", "id_ocupacion", $ocupacion[0]['id_ocupacion']);
                    $cant != 0 ? $jefe_familia['ocupacion'] = $ocupacion[0]['nombre_ocupacion'] : $jefe_familia['ocupacion'] = 'No posee';
                    $condicion_laboral = $this->Consultar_Columna("condicion_laboral", "cedula_persona", $jefe_familia['cedula_persona']);
                    count($condicion_laboral) == 0 ? $jefe_familia['condicion_laboral'] = "No posee" : $jefe_familia['condicion_laboral'] = $condicion_laboral[0];
                    $comunidad_indigena = $this->Consultar_Columna("comunidad_indigena_personas", "cedula_persona", $jefe_familia['cedula_persona']);
                    if (count($comunidad_indigena) == 0) {
                        $jefe_familia['comunidad_indigena'] = 0;
                    } else {
                        $comunidad = $this->Consultar_Columna("comunidad_indigena", "id_comunidad_indigena", $comunidad_indigena[0]['id_comunidad_indigena']);
                        $jefe_familia['comunidad_indigena'] = $comunidad[0]['nombre_comunidad'];
                    }
                }

                if ($persona[0]['sexualidad'] != "Heterosexual") {
                    $fam_sexo_diverso = 1;
                }

                if ($persona[0]['privado_libertad'] == 1) {
                    $privado_libertad = 1;
                }

                if (count($cond_lab) != 0) {
                    $cant_trabajando++;
                    if ($edad < 17) {
                        $cant_menor_17_trabajando++;
                    }
                }

                if (count($proyecto) != 0) {
                    $pro = $this->Consultar_Columna("proyecto", "id_proyecto", $proyecto[0]['id_proyecto']);
                    $proyecto_socio = $pro[0];
                }

                if (count($sector_agricola) == 0) {
                    $sector_agricola = 0;
                } else {
                    $sector_agricola = $sector_agricola[0];
                }

                if (count($org_politica) == 0) {
                    $org_politica = 0;
                } else {
                    $org = $this->Consultar_Columna("org_politica", "id_org_politica", $org_politica[0]['id_org_politica']);
                    $org_politica = $org[0];
                }

            $ocup="";
            if(count($ocupacion_persona)==0){
                $ocup="No posee";
            }
            else{
            $ocupa= $this->Consultar_Columna("ocupacion", "id_ocupacion", $ocupacion_persona[0]['id_ocupacion']);
            $ocup=$ocupa[0]['nombre_ocupacion'];
            }

            $cond_lab_persona="";
            if(count($condicion_laboral_persona)==0){
                $cond_lab_persona="No posee";
            }
            else{
                $cond_lab_persona=$condicion_laboral_persona[0]['nombre_cond_laboral'];
            }

            $enfermedad="";
            if(count($enfermedades_persona)==0){
                $enfermedad="No posee";
            }
            else{
                $enf=$this->Consultar_Columna("enfermedades","id_enfermedad",$enfermedades_persona[0]['id_enfermedad']);
                $enfermedad=$enf[0]['nombre_enfermedad'];
            }

            $misiones="";
            if(count($misiones_persona)==0){
                $misiones="No aplica";
            }
            else{
                if($misiones_persona[0]['recibe_actualmente']==1){
                $mision=$this->Consultar_Columna("misiones","id_mision",$misiones_persona[0]['id_mision']);
                $misiones=$mision[0]['nombre_mision'];    
            }
                else{
                    $misiones="No aplica";
                }
            }





             $tabla_integrantes.="
                <thead>
                <tr style='color:red;'>
                  <th>#</th>
                  <th>Nombre y Apellido</th>
                  <th>Edad</th>
                  <th>Cedula</th>
                  <th>Fecha de Nacimiento</th>
                  <th>Grado Intrucciones</th>
                  <th>Estado Civil</th>
                </tr>
                <thead>
                  <tbody>";
                 $tabla_integrantes .= "<tr><td>" . $cant_integrantes . "</td><td>" . $persona[0]['primer_nombre'] . " " . $persona[0]['primer_apellido'] . "</td>";
                 $tabla_integrantes .= "<td>" . $edad . "</td><td>" . $persona[0]['cedula_persona'] . "</td><td>" . $persona[0]['fecha_nacimiento'] . "</td>";
                 $tabla_integrantes .= "<td>" . $persona[0]['nivel_educativo'] . "</td><td>" . $persona[0]['estado_civil'] . "</td></tr>";
                $tabla_integrantes.="
                 <tr style='color:red;'>
                   <td></td>
                   <th>Ocupacion u Oficio</th>
                   <th>Condicion Laboral</th>
                   <th>Enfermedad o Factor de Riesgo</th>
                   <th>Mision de la cual recibe beneficio</th>
                   <th colspan='2'>Documento que requiere</th>
                 </tr>
                 <tr>
                   <td>".$cant_integrantes."</td><td>".$ocup."</td><td>".$cond_lab_persona."</td>
               <td>".$enfermedad."</td><td>".$misiones."</td><td colspan='2'></td>";


                 $cant_integrantes++;
            }



            $datos = [
                "tipo_vivienda" => $tipo_vivienda,
                "vivienda" => $vivienda,
                "familia" => $familia,
                "techo" => $techo,
                "pared" => $pared,
                "piso" => $piso,
                "servicios" => $servicios,
                "gas" => $servicio_gas,
                "integrantes" => $integrantes,
                "jefe_familia" => $jefe_familia,
                "familiar_sexo_diverso" => $fam_sexo_diverso,
                "privado_libertad" => $privado_libertad,
                "trabajando" => $cant_trabajando,
                "proyectos" => $proyecto_socio,
                "menores_trabajando" => $cant_menor_17_trabajando,
                "sector_agricola" => $sector_agricola,
                "org_politica" => $org_politica,
                "electrodomesticos" => $electrodomesticos,
                "tabla_integrantes" => $tabla_integrantes
            ];

            echo json_encode($datos);
        }
    }

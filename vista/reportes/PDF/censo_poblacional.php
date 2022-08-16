<style>
  .datos {
    border-collapse: collapse !important;
    width: 100%;
  }

  .datos th,
  .datos td {
    border: 1px solid red !important;
  }
</style>
<title>Censo Poblacional</title> 
<!-- Contenido de la pagina -->
<input type="hidden" value="<?php echo $_GET['id']; ?>" id='fam'>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <script src="<?php echo constant('URL') ?>config/plugins/jquery/jquery.min.js"></script>
  <script>
    const BASE_URL = 'http://localhost/dashboard/www/CONCO%20V2/';
    $.ajax({
      type: "POST",
      url: BASE_URL + "Reportes/info_censo_poblacional",
      data: {
        "familia": document.getElementById("fam").value
      }
    }).done(function(result) {
      result = JSON.parse(result);

      cargar_tipo_vivienda(result['tipo_vivienda']);
      cargar_condicion_vivienda(result['vivienda']);
      cargar_condicion_ocupacion(result['familia']);
      cargar_tipo_techo(result['techo']);
      cargar_tipo_pared(result['pared']);
      cargar_tipo_piso(result['piso']);
      cargar_servicios(result['servicios']);
      cargar_servicio_gas(result['gas']);
      cargar_org_politica(result['org_politica']);
      cargar_sector_agricola(result['sector_agricola']);
      cargar_electrodomesticos(result['electrodomesticos']);
      document.getElementById("cantidad_habitaciones").innerHTML = result['vivienda'][0]['cantidad_habitaciones'];
      if(result['vivienda'][0]['animales_domesticos']==1){
        document.getElementById("animales").innerHTML=" <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -230px'>X</div>";
      }
      else{
        document.getElementById("no_animales").innerHTML="<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -230px'>X</div>";
      }

      if(result['vivienda'][0]['insectos_roedores']==1){
        document.getElementById("plagas").innerHTML="<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -170px'>X</div>";
      }
      else{
        document.getElementById("no_plagas").innerHTML="<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -170px'>X</div>";
      }

      document.getElementById("nombre").innerHTML=result['jefe_familia']['primer_nombre']+" "+result['jefe_familia']['primer_apellido'];

      document.getElementById("cedula").innerHTML=result['jefe_familia']['cedula_persona'];
      document.getElementById("sexo").innerHTML=result['jefe_familia']['genero'];
      var edad=new Date().getFullYear() - new Date(result['jefe_familia']['fecha_nacimiento']).getFullYear();
      document.getElementById("edad").innerHTML=edad;
      document.getElementById("fecha").innerHTML=result['jefe_familia']['fecha_nacimiento'];
      document.getElementById("estado_civil").innerHTML=result['jefe_familia']['estado_civil'];
      document.getElementById("nivel").innerHTML=result['jefe_familia']['nivel_educativo'];
      document.getElementById("ocupacion").innerHTML=result['jefe_familia']['ocupacion'];
      document.getElementById("condicion").innerHTML=result['jefe_familia']['condicion_laboral']['nombre_cond_laboral'];
      if(result['jefe_familia']['condicion_laboral']!='No posee'){
        console.log(result['jefe_familia']['condicion_laboral']['sector_laboral']);
      if(result['jefe_familia']['condicion_laboral']['sector_laboral']==1){
        document.getElementById("formal").innerHTML="X";
        result['jefe_familia']['condicion_laboral']['pertenece']==1?document.getElementById("formal_informal").innerHTML="X":document.getElementById("formal_publico").innerHTML='X';
      }
      }
      result['jefe_familia']['afrodescencencia']==1?document.getElementById("si_afro").innerHTML="X":document.getElementById("no_afro").innerHTML="X";
      if(result['jefe_familia']['comunidad_indigena']==0){
        document.getElementById("no_indigena").innerHTML="X";
      }
      else{
        document.getElementById("si_indigena").innerHTML="X";
        console.log(result['jefe_familia']['comunidad_indigena']);
        document.getElementById("comunidad").innerHTML=result['jefe_familia']['comunidad_indigena'];

      }

      if(result['integrantes'].length<=4){
        document.getElementById("nuclear").innerHTML='X';
      }
      else{
        if(result['integrantes'].length==5){
        document.getElementById("extensa").innerHTML='X';
      }
      else{
        document.getElementById("ampliada").innerHTML='X';
      }
      }
      document.getElementById("cant_trabajan").innerHTML=result['trabajando'];
      document.getElementById("ing_mensual").innerHTML=result['familia'][0]['ingreso_mensual_aprox'];
      result['familiar_sexo_diverso']==1?document.getElementById("si_sexo_diverso").innerHTML="X":document.getElementById("no_sexo_diverso").innerHTML="X";
      result['privado_libertad']==1?document.getElementById("si_privado_libertad").innerHTML="X":document.getElementById("no_privado_libertad").innerHTML="X";
      if(result['proyectos']==0){
        document.getElementById("trabajo_proyecto").innerHTML="No";
      }
      else{
        document.getElementById("trabajo_proyecto").innerHTML="Si";
        document.getElementById("estado_proyecto").innerHTML=result['proyectos']['estado_proyecto'];
        document.getElementById("area_proyecto").innerHTML=result['proyectos']['area_proyecto'];
        document.getElementById("cantidad_menores_trabajando").innerHTML=result['menores_trabajando'];
      }

      document.getElementById("tabla_integrantes").innerHTML=result['tabla_integrantes'];

      window.blur();
      window.print();
     
    });

    function cargar_electrodomesticos(array){
      console.log(array);
      var tiene_pc=0;
      for(var i=0;i<array.length;i++){
        switch(array[i]['nombre'].toLowerCase()){
           case "nevera":
             document.getElementById("nevera").innerHTML="X";
             break;
          case "cocina":
            document.getElementById("cocina").innerHTML="X";
            break; 
          case "television":
            document.getElementById("tv").innerHTML="X";
            break;
          case "televisor":
            document.getElementById("tv").innerHTML="X";
            break;
          case "radio":
            document.getElementById("radio").innerHTML="X";
            break;
          case "computador":
            document.getElementById("si_pc").innerHTML="X";
            tiene_pc++;
            break;
          case "computadora":
            document.getElementById("si_pc").innerHTML="X";
            tiene_pc++;
            break;
        }
      }

      if(tiene_pc==0){
        document.getElementById("no_pc").innerHTML="X";
      }
    }

    function cargar_org_politica(org){
      if(org==0){
        document.getElementById("no_org_politica").innerHTML="X";
      }
      else{
        document.getElementById("si_org_politica").innerHTML="X";  
        switch(org['nombre_org']){
          case "Consejo Comunal":
            document.getElementById("num_org_politica").innerHTML="1";
            break;
          case "Comuna":
            document.getElementById("num_org_politica").innerHTML="2";
            break;
          case "Colectivos":
            document.getElementById("num_org_politica").innerHTML="3";
            break;
          case "UBCH":
            document.getElementById("num_org_politica").innerHTML="4";
            break;
          case "Frente Francisco de Miranda":
            document.getElementById("num_org_politica").innerHTML="5";
            break;
          default:
          document.getElementById("num_org_politica").innerHTML="6";
          document.getElementById("org_politica_especifica").innerHTML=org['nombre_org'];
            break;    
        }     
        console.log(org); 

      }
    }

    function cargar_sector_agricola(sector){
      if(sector!=0){
        document.getElementById("area_produccion").innerHTML=sector['area_produccion'];
        document.getElementById("anios_experiencia").innerHTML=sector['anios_experiencia'];
        document.getElementById("rubro_principal").innerHTML=sector['rubro_principal'];
        sector['registro_INTI']==0?document.getElementById("inti").innerHTML="No":document.getElementById("inti").innerHTML="Si";
        sector['constancia_productor']==0?document.getElementById("constancia_productor").innerHTML="No":document.getElementById("constancia_productor").innerHTML="Si";
        sector['senial_hierro']==0?document.getElementById("hierro").innerHTML="No":document.getElementById("hierro").innerHTML="Si";
        document.getElementById("financiado").innerHTML=sector["financiado"];
        sector['agua_riego']==0?document.getElementById("agua_riego").innerHTML="No":document.getElementById("agua_riego").innerHTML="Si";
        sector['produccion_actual']==0?document.getElementById("produccion_actual").innerHTML="No":document.getElementById("produccion_actual").innerHTML="Si";
        document.getElementById("nombre_org_agricola").innerHTML=sector['org_agricola'];
        
      }
    }

    function cargar_servicio_gas(array) {

for (var i = 0; i < array.length; i++) {
  switch (array[i]['tipo_bombona']) {
    case "10 Kg":
      document.getElementById("10_kg").innerHTML=" <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -130px'>X</div>";
      break;
    case "18 Kg":
      document.getElementById("18_kg").innerHTML=" <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -290px'>X</div>";
      break;
    case "43 Kg":
      document.getElementById("43_kg").innerHTML="  <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -270px'>X</div>";
      break;
  }

  switch (array[i]['dias_duracion']) {
    case 7:
      document.getElementById("7_dias").innerHTML="<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -220px'>X</div>";
      break;
    case 15:
      document.getElementById("15_dias").innerHTML="<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -200px'>X</div>";
      break;
    case 30:
      document.getElementById("30_dias").innerHTML="<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -180px'>X</div>";
      break;
  }

  switch (array[i]['servicio']) {
    case "PDV Comunal":
      document.getElementById("pdv_comunal").innerHTML="<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -160px'>X</div>";
      break;

    default:
    document.getElementById("otro_gas").innerHTML=" <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -150px'>X</div>";
    document.getElementById("gas_especifico").innerHTML="<u>"+array[i]['servicio']+"</u>";
      break;

  }

}

}

    function cargar_servicios(array) {

      for (var i = 0; i < array.length; i++) {
        switch (array[i]['agua_consumo']) {
          case "Acueducto":
            document.getElementById("acueducto").innerHTML=" <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -80px'>X</div>";
            break;
          case "Cisterna":
            document.getElementById("cisterna").innerHTML=" <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -80px'>X</div>";
            break;
          case "Pipa Publica":
            document.getElementById("pipa_publica").innerHTML="  <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -80px'>X</div>";
            break;
        }

        switch (array[i]['residuos_solidos']) {
          case "Aseo Urbano":
            document.getElementById("aseo_urbano").innerHTML="<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -260px'>X</div>";
            break;
          case "Quema":
            document.getElementById("quema").innerHTML="<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -260px'>X</div>";
            break;
          case "Aire Libre":
            document.getElementById("aire_libre").innerHTML="<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -260px'>X</div>";
            break;
        }

        switch (array[i]['aguas_negras']) {
          case "Cloacas":
            document.getElementById("cloacas").innerHTML="<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -260px'>X</div>";
            break;
          case "Letrina":
            document.getElementById("letrina").innerHTML=" <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -260px'>X</div>";
            break;
          case "Alcantarilla":
            document.getElementById("alcantarilla").innerHTML="<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -260px'>X</div>";
            break;

          case "Pozo Septico":
            document.getElementById("pozo").innerHTML="<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -250px'>X</div>";
            break;

          default:
          document.getElementById("otro_residuo").innerHTML=" <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -250px'>X</div>";
            break;

        }

      }

    }

    function cargar_tipo_piso(array) {

      for (var i = 0; i < array.length; i++) {
        switch (array[i]['id_tipo_piso']) {
          case "Cemento":
            document.getElementById("cemento").innerHTML = "<div style='border-style:solid;height: 20px;width:20px;position: relative;left: 10px'>X</div>";
            break;
          case "Tierra":
            document.getElementById("tierra").innerHTML = "<div style='border-style:solid;height: 20px;width:20px;position: relative;left: 10px'>X</div>";
            break;
          case "Tablas":
            document.getElementById("tablas").innerHTML = "<div style='border-style:solid;height: 20px;width:20px;position: relative;left: 10px'>X</div>";
            break;
          case "Cerámicas":
            document.getElementById("ceramica").innerHTML = " <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 10px'>X</div>";
            break;
          default:
            document.getElementById("otro_piso").innerHTML = " <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 10px'>X</div>";
            break;
        }

      }

    }

    function cargar_tipo_pared(array) {

      for (var i = 0; i < array.length; i++) {
        switch (array[i]['id_tipo_pared']) {
          case "Bloque, ladrillo o adobe frisado":
            document.getElementById("bloque_frisado").innerHTML = " <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -70px'>X</div>";
            break;
          case "Bloque, ladrillo o adobe sin frisar":
            document.getElementById("bloque_sin_frisar").innerHTML = " <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -70px'>X</div>";
            break;
          case "Concreto":
            document.getElementById("concreto").innerHTML = " <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 128px'>X</div>";
            break;
          case "Laminas Policluro de vinilo PVC":
            document.getElementById("lamin_PVC").innerHTML = "   <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 128px'>X</div>";
            break;
          case "Tapia o bahareque":
            document.getElementById("tapia").innerHTML = " <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 128px'>X</div>";
            break;
          case "Troncos o piedras":
            document.getElementById("troncos").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
            break;
          case "Zinc, cartón, tablas o similar":
            document.getElementById("zinc").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";

            break;
        }

      }

    }

    function cargar_tipo_techo(array) {

      for (var i = 0; i < array.length; i++) {
        switch (array[i]['id_tipo_techo']) {
          case "Platabanda":
            document.getElementById("platabanda").innerHTML = " <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -110px'>X</div>";
            break;
          case "Láminas asfálticas":
            document.getElementById("laminas_asfalticas").innerHTML = " <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -160px'>X</div>";
            break;
          case "Tela":
            document.getElementById("tela").innerHTML = "  <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -110px'>X</div>";
            break;
          case "Asbesto y similares":
            document.getElementById("asbesto").innerHTML = "<div style='border-style:solid;height: 20px;width:20px;position: relative;left: -160px'>X</div>";
            break;
          case "Láminas de policloruro de vinilo PVC":
            document.getElementById("laminas_pvc").innerHTML = " <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 58px'>X</div>";
            break;
          case "Láminas metálicas (zinc , aluminio,similares)":
            document.getElementById("laminas_metalicas").innerHTML = " <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 58px'>X</div>";
            break;
          case "Latón, tablas o similares":
            document.getElementById("laton_similares").innerHTML = " <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 58px'>X</div>";

            break;
        }

      }

    }

    function cargar_condicion_ocupacion(array) {
      console.log(array);
      switch (array[0]['condicion_ocupacion']) {
        case "Alquilada":
          document.getElementById("alquilada").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          break;
        case "Prestada":
          document.getElementById("prestada").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          break;
        case "Propia pagada":
          document.getElementById("propia_pagada").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          break;
        case "Adjudicada":
          document.getElementById("propia_pagandose").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          break;
        case "Invadida":
          document.getElementById("invadida").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          break;
        default:
          document.getElementById("otro_cond_ocupacion").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          document.getElementById("especifico_cond_ocupacion").innerHTML = "<u>" + array[0]["condicion_ocupacion"] + "</u>";
          break;
      }
    }

    function cargar_condicion_vivienda(array) {
      console.log(array);
      switch (array[0]['condicion']) {
        case "Buena":
          document.getElementById("buena").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          break;
        case "Mala":
          document.getElementById("mala").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          break;
        case "Regular":
          document.getElementById("regular").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          break;
      }
    }


    function cargar_tipo_vivienda(array) {
      console.log(array);
      switch (array[0]['nombre_tipo_vivienda']) {
        case "Casa":
          document.getElementById("casa").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          break;
        case "Casa de vecindad":
          document.getElementById("casa_vecindad").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          break;
        case "Rancho":
          document.getElementById("rancho").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          break;
        case "Refugio":
          document.getElementById("refugio").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          break;
        default:
          document.getElementById("otra").innerHTML = "<div style='border-style:solid;height: 20px;width:20px'>X</div>";
          document.getElementById("especifico_tipo_casa").innerHTML = "<u>" + array[0]["nombre_tipo_vivienda"] + "</u>";
          break;
      }
    }
    /* window.blur();
             window.print();
             window.close(); */
  </script>
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <!-- card-body -->
      <div class="card-body">
        <center>
          <div id='censo_nucleo_familiar' style='width:90%; '>
            <table style='width:100%;color:red !important;font-size:13px'>
              <tr>
                <td style='text-align:left'>
                  <img style='width:200px' src="
                                        <?php echo constant('URL'); ?>config/img/web/cintillo_vzla.png">
                </td>
                <td>Vicepresidencia para el <b>Area Social, Sistema Nacional de Misiones y Grandes Misiones</b>
                </td>
                <td>Campaña Nacional Erradicación de la Pobreza Estado Lara</td>
              </tr>
            </table>
            <div style='width:100%;background: red;color:white'>
              <center>
                <b>INSTRUMENTO DE DIAGNOSTICO DE MISIONES <br>I-.Ubicación geográfica </b>
              </center>
            </div>
            <table style='width:100%;color:red !important;font-size:13px'>
              <tr>
                <td>Nº Codificación:_____________</td>
                <td>Vivienda Nº:_____________</td>
                <td>Hogar Nº:_____________</td>
                <td>Fecha:_____________</td>
              </tr>
              <tr>
                <td colspan='2'>
                  <br>Estado: <b>LARA</b>
                </td>
                <td colspan='2'>
                  <br>Parroquia: <b>Guerrera Ana Soto</b>
                </td>
              </tr>
              <tr>
                <td colspan='2'>
                  <br>Sector o Barrio: <b>III</b>
                </td>
                <td>
                  <br>Calle: <b>
                    <span id='calle_censo'></span>
                  </b>
                </td>
                <td>
                  <br>Nombre o Nº Casa: <b>
                    <span id='nro_casa_censo'></span>
                </td>
              </tr>
              <tr>
                <td colspan='2'>
                  <br>Consejo Comunal: <b>Prados de Occidente Sector III</b>
                </td>
                <td>
                  <br>Comuna:___________
                </td>
              </tr>
              <tr>
                <td>
                  <br> Tipo de población
                </td>
                <td>
                  <br>Urbana
                </td>
                <td>
                  <br>Rural
                </td>
              </tr>
            </table>
            <div style='width:100%;background: red;color:white'>
              <center>
                <b>II. Condiciones de la vivienda</b>
              </center>
            </div>
            <table style='width:100%;color:red !important;font-size:13px;height: 100px;'>
              <tr style='color:red'>
                <td> 1- Tipo de vivienda <br>
                  <table>
                    <tr style='color:red'>
                      <td>Casa de vecindad</td>
                      <td>
                        <span id='casa_vecindad'>
                          <div style='border-style:solid;height: 20px;width:20px'></div>
                        </span>
                      </td>
                      <td></td>
                      <td>Rancho</td>
                      <td>
                        <span id='rancho'>
                          <div style='border-style:solid;height: 20px;width:20px'></div>
                        </span>
                      </td>
                    </tr>
                    <tr style='color:red'>
                      <td>Casa</td>
                      <td>
                        <span id='casa'>
                          <div style='border-style:solid;height: 20px;width:20px'></div>
                        </span>
                      </td>
                      <td></td>
                      <td>Refugio</td>
                      <td>
                        <span id='refugio'>
                          <div style='border-style:solid;height: 20px;width:20px'></div>
                        </span>
                      </td>
                    </tr>
                    <tr style='color:red'>
                      <td>Otra</td>
                      <td>
                        <span id='otra'>
                          <div style='border-style:solid;height: 20px;width:20px'></div>
                        </span>
                      </td>
                      <td></td>
                      <td>Especifique</td>
                      <td>
                        <span id='especifico_tipo_casa'>______________</span>
                      </td>
                    </tr>
                  </table>
                </td>
                <td> 2-.Condiciones de la vivienda <br>
                  <table>
                    <tr style='color:red'>
                      <td>Buena</td>
                      <td>
                        <span id='buena'>
                          <div style='border-style:solid;height: 20px;width:20px'></div>
                        </span>
                      </td>
                    </tr>
                    <tr style='color:red'>
                      <td>Mala</td>
                      <td>
                        <span id='mala'>
                          <div style='border-style:solid;height: 20px;width:20px'></div>
                        </span>
                      </td>
                    </tr>
                    <tr style='color:red'>
                      <td>Regular</td>
                      <td>
                        <span id='regular'>
                          <div style='border-style:solid;height: 20px;width:20px'></div>
                        </span>
                      </td>
                    </tr>
                  </table>
                </td>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3- Condición de ocupación <br>
                  <table>
                    <tr style='color:red'>
                      <td style="width: 20px;">Propia pagada</td>
                      <td>
                        <span id='propia_pagada'>
                          <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 32px;'></div>
                        </span>
                      </td>
                      <td></td>
                      <td>Alquilada</td>
                      <td>
                        <span id='alquilada'>
                          <div style='border-style:solid;height: 20px;width:20px'></div>
                        </span>
                      </td>
                      <td>Prestada</td>
                      <td>
                        <span id='prestada'>
                          <div style='border-style:solid;height: 20px;width:20px'></div>
                        </span>
                      </td>
                    </tr>
                    <tr style='color:red'>
                      <td></td>
                      <td style="position: relative;left: -50px;">Propia pagándose</td>
                      <td>
                        <span id='propia_pagandose'>
                          <div style='position: relative;left: -40px;border-style:solid;height: 20px;width:20px'></div>
                        </span>
                      </td>
                      <td>Adjudicada</td>
                      <td>
                        <span id='adjudicada'>
                          <div style='border-style:solid;height: 20px;width:20px'></div>
                        </span>
                      </td>
                      <td>Invadida</td>
                      <td>
                        <span id='invadida'>
                          <div style='border-style:solid;height: 20px;width:20px'></div>
                        </span>
                      </td>
                    </tr>
                    <tr style='color:red'>
                      <td>Otro</td>
                      <td>
                        <span id='otro_cond_ocupacion'>
                          <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 32px;'></div>
                        </span>
                      </td>
                      <td></td>
                      <td>Especifique</td>
                      <td>
                        <span id='especifico_cond_ocupacion'>______________</span>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td style="position: relative;left: 300px;">4. Materiales Predominantes de la Vivienda </td>
                <table>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative;left: 100px;"> 4.1 Techo </td>
                    <td style="position: relative;left: 200px"> 4.2 Paredes </td>
                    <td style="position: relative;left: 450px;"> 4.3 Piso </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative;left: 20px;"> Platabanda </td>
                    <td>
                      <span id='platabanda'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -80px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: -130px;"> Laminas Asfalticas </td>
                    <td>
                      <span id='laminas_asfalticas'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -160px'></div>
                      </span>
                    </td>
                    <td style="position: relative;left: -100px;"> Bloque Ladrillo o Adobe Frizado </td>
                    <td>
                      <span id='bloque_frisado'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -70px'></div>
                      </span>
                    </td>
                    <td style="position: relative;left: 0px;"> Cemento </td>
                    <td>
                      <span id='cemento'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 10px'></div>
                      </span>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative;left: 20px;"> Tela </td>
                    <td>
                      <span id='tela'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -80px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: -130px;"> Asbesto y Similares </td>
                    <td>
                      <span id='asbesto'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -160px'></div>
                      </span>
                    </td>
                    <td style="position: relative;left: -100px;"> Bloque Ladrillo o Adobe sin Frisar </td>
                    <td>
                      <span id='bloque_sin_frisar'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -70px'></div>
                      </span>
                    </td>
                    <td style="position: relative;left: 0px;"> Tierra </td>
                    <td>
                      <span id='tierra'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 10px'></div>
                      </span>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative;left:20px;"> Laminas Metalicas (zinc, aluminio ,similares) </td>
                    <td>
                      <span id='laminas_metalicas'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 58px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: 160px;"> Concreto </td>
                    <td>
                      <span id='concreto'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 128px'></div>
                      </span>
                    </td>
                    <td style="position: relative;left: -100px;"></td>
                    <td></td>
                    <td style="position: relative;left: 0px;"> Tablas </td>
                    <td>
                      <span id='tablas'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 10px'></div>
                      </span>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative;left:20px;"> Laminas Policluro de Vinilo (pcv) </td>
                    <td>
                      <span id='laminas_pvc'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 58px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: 60px;"> Laminas Policluro de Vinilo (pcv) </td>
                    <td>
                      <span id='lamin_PVC'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 128px'></div>
                      </span>
                    </td>
                    <td style="position: relative;left: -100px;"></td>
                    <td></td>
                    <td style="position: relative;left: 0px;"> Ceramica o Similares </td>
                    <td>
                      <span id='ceramica'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 10px'></div>
                      </span>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative;left:20px;"> Otras Laton o Similares </td>
                    <td>
                      <span id='laton_similares'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 58px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: 60px;"> Tapia o Bahareque </td>
                    <td>
                      <span id='tapia'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 128px'></div>
                      </span>
                    </td>
                    <td style="position: relative;left: -100px;"></td>
                    <td></td>
                    <td style="position: relative;left: 0px;"> Otros </td>
                    <td>
                      <span id='otro_piso'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 10px'></div>
                      </span>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative;left:20px;"></td>
                    <td></td>
                    <td>
                    <td style="position: relative;left: 60px;"> Troncos o Piedras </td>
                    <td>
                      <span id='troncos'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 128px'></div>
                      </span>
                    </td>
                    <td style="position: relative;left: -100px;"></td>
                    <td></td>
                    <td style="position: relative;left: 0px;"></td>
                    <td></td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative;left:20px;"></td>
                    <td></td>
                    <td>
                    <td style="position: relative;left: 60px;"> Otras (zinc,carton,tablas) </td>
                    <td>
                      <span id='zinc'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: 128px'></div>
                      </span>
                    </td>
                    <td style="position: relative;left: -100px;"></td>
                    <td></td>
                    <td style="position: relative;left: 0px;"></td>
                    <td></td>
                  </tr>
                </table>
              </tr>
              <tr>
                <div style="position: relative;left: 50px;">
                  <td style="">
                    <p style="position: relative;color:red;font-size: 15px;">5.Servicios con los que cuenta la vivienda &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 6. Presencia de Vectores &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 7. Indicar Cantidad de Habitaciones </p>
                  </td>
                  <td>
                    <table style="width: 1000px;">
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative; left: -40px;"> Agua Consumo </td>
                        <td style="position: relative;left: 10px;"> Residuos Solidos </td>
                        <td style="position: relative;left: 50px;"> Aguas Servidas </td>
                        <td style="position: relative;left: 100px;"> Animales Domesticos </td>
                        <td style="position: relative;left: 120px;"> Insectos y <br> Roedores </td>
                      </tr>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative;left: -60px;"> Acueducto </td>
                        <td>
                          <span id='acueducto'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -80px'></div>
                          </span>
                        </td>
                        <td>
                        <td style="position: relative;left: -220px;"> Aseo Urbano </td>
                        <td>
                          <span id='aseo_urbano'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -260px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -260px;"> Cloacas </td>
                        <td>
                          <span id='cloacas'>
                          <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -260px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -250px;"> Pozo Septico </td>
                        <td>
                          <span id='pozo'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -250px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -230px;"> Si </td>
                        <td>
                          <span id='animales'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -230px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -180px;"> Si </td>
                        <td>
                          <span id='plagas'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -170px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -80px;">
                          <h3 id='cantidad_habitaciones'></h3>
                        </td>
                      </tr>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative;left: -60px;"> Cisterna </td>
                        <td>
                          <span id='cisterna'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -80px'></div>
                          </span>
                        </td>
                        <td>
                        <td style="position: relative;left: -220px;"> Quema </td>
                        <td>
                          <span id='quema'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -260px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -260px;"> Letrina </td>
                        <td>
                          <span id='letrina'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -260px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -250px;"> Ninguno </td>
                        <td>
                          <span id='otro_residuo'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -250px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -230px;"> No </td>
                        <td>
                          <span id='no_animales'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -230px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -180px;"> No </td>
                        <td>
                          <span id='no_plagas'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -170px'></div>
                          </span>
                        </td>
                      </tr>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative;left: -60px;"> Pipa Publica </td>
                        <td>
                          <span id='pipa_publica'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -80px'></div>
                          </span>
                        </td>
                        <td>
                        <td style="position: relative;left: -220px;"> Aire Libre </td>
                        <td>
                          <span id='aire_libre'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -260px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -260px;"> Alcantarillas </td>
                        <td>
                          <span id='alcantarilla'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -260px'></div>
                          </span>
                        </td>
                      </tr>
                    </table>
                  </td>
                </div>
              </tr>
              <tr>
                <div style="position: relative;left: 60px;">
                  <td style="">
                    <p style="position: relative;color:red;font-size: 15px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 8. Gas Domestico &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p>
                  </td>
                  <td>
                    <table style="width: 100%;">
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative; left: -40px;"> Tipo Bombona </td>
                        <td style="position: relative;left: 150px;"> Cuanto Tiempo le dura </td>
                        <td style="position: relative;left: 300px;"> Tipo de Servicio </td>
                      </tr>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative;left: -80px;"> 10kg </td>
                        <td>
                          <span id='10_kg'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -130px'></div>
                          </span>
                        </td>
                        <td>
                        <td style="position: relative;left: -290px;"> 18kg </td>
                        <td>
                          <span id='18_kg'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -290px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -270px;"> 43kg </td>
                        <td>
                          <span id='43_kg'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -270px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -220px;"> 7d </td>
                        <td>
                          <span id='7_dias'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -220px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -200px;"> 15d </td>
                        <td>
                          <span id='15_dias'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -200px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -180px;"> 30d </td>
                        <td>
                          <span id='30_dias'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -180px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -160px;"> PDV Comunal </td>
                        <td>
                          <span id='pdv_comunal'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -160px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -150px;"> Otro </td>
                        <td>
                          <span id='otro_gas'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -150px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -150px;" id="gas_especifico"> _________</td>
                      </tr>
                    </table>
                  </td>
                </div>
              </tr>
              <tr>
                <div style="position: relative;left: 60px;">
                  <td style="">
                    <p style="position: relative;left: -200px; color:red;font-size: 15px;"> 9.Medios de Transporte que utiliza &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="publico">Publico</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="privado">Privado</span>
                    </p>
                  </td>
                  <td>
                    <table>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative; left: -380px;"> Tipo de Transporte: <span id="transporte"></span>
                        </td>
                      </tr>
                    </table>
                  </td>
                </div>
              </tr>
              <tr>
                <br>
                <br>
                <div style='width:100%;background: red;color:white;margin-top: -100px;'>
                  <center> III. Jefe (a) del Hogar </center>
                </div>
                <div style="position: relative;left: 60px;">
                  <td>
                    <table>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative; left: -30px;"> Nombre y Apellido </td>
                        <td style="position: relative; left: -50px;"> Cedula </td>
                        <td style="position: relative; left: -130px;"> Sexo </td>
                        <td style="position: relative; left: -200px;"> Edad </td>
                        <td style="position: relative; left: -160px;"> Fecha de Nacimiento </td>
                        <td style="position: relative; left: -160px;"> Estado Civil </td>
                        <td style="position: relative; left: -130px;"> Nivel Educativo </td>
                        <td style="position: relative; left: -120px;"> Ocupacion u Oficio </td>
                      </tr>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative; left: -30px;">
                          <span id="nombre"></span>
                          <br>
                        </td>
                        <td style="position: relative; left: -50px;">
                          <span id="cedula"></span>
                          <br>
                        </td>
                        <td style="position: relative; left: -125px;">
                          <span id="sexo">M</span>
                          <br>
                        </td>
                        <td style="position: relative; left: -200px;">
                          <span id="edad"></span>
                          <br>
                        </td>
                        <td style="position: relative; left: -160px;">
                          <span id="fecha"></span>
                          <br>
                        </td>
                        <td style="position: relative; left: -170px;">
                          <span id="estado_civil"></span>
                          <br>
                        </td>
                        <td style="position: relative; left: -135px;">
                          <span id="nivel">educacion</span>
                          <br>
                        </td>
                        <td style="position: relative; left: -120px;">
                          <span id="ocupacion"></span>
                          <br>
                        </td>
                      </tr>
                      <tr style="color: red;font-size: 13px;">
                        <br>
                        <td style="position: relative; left: -40px;"> ¿Cual es la condicion laboral del jefe del hogar? </td>
                        <td style="position: relative; left: 80px;"> si trabaja a que sector empleador pertenece: </td>
                        <td style="position: relative; left: 200px;"> si pertenece al sector formal señale: </td>
                      </tr>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative; left: 0px;">
                          <span id="condicion">hola</span>
                        </td>
                        <td style="position: relative;left: 30px;"> Formal </td>
                        <td>
                          <span>
                            <div id="formal" style='border-style:solid;height: 20px;width:20px;position: relative;left: -60px'></div>
                          </span>
                        </td>
                        <td>
                        <td style="position: relative;left: -150px;"> Publico </td>
                        <td>
                          <span >
                            <div id='publico' style='border-style:solid;height: 20px;width:20px;position: relative;left: -150px'></div>
                          </span>
                        </td>
                        <td>
                        <td style="position: relative;left: -220px;"> Informal </td>
                        <td>
                          <span>
                            <div id='formal_informal' style='border-style:solid;height: 20px;width:20px;position: relative;left: -230px'></div>
                          </span>
                        </td>
                        <td>
                        <td style="position: relative;left: -200px;"> Publico </td>
                        <td>
                          <span>
                            <div id='formal_publico' style='border-style:solid;height: 20px;width:20px;position: relative;left: -190px'></div>
                          </span>
                        </td>
                        <td>
                      </tr>
                    </table>
                  </td>
                </div>
              </tr>
              <tr>
                <br>
                <div style='width:100%;background: red;color:white'>
                  <center> IV. Caracterizacion del Nucleo Familiar </center>
                </div>
              </tr>
              <tr>
                <table>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 10px;"> 1. Seleccione el tipo de Familia </td>
                    <td style="position: relative;left: 20px;"> 2.¿La Familia es Afrodescendiente? </td>
                    <td style="position: relative;left: 20px;"> 3.¿Pertenece a alguna comunidad indigena? </td>
                    <td style="position: relative;left: 80px;"> 4.¿Tiene algun familiar de sexo diverso? </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative;left: 30px;"> Nuclear </td>
                    <td>
                      <span>
                        <div id='nuclear' style='border-style:solid;height: 20px;width:20px;position: relative;left: -40px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: -280px;"> Si </td>
                    <td>
                      <span>
                        <div id='si_afro' style='border-style:solid;height: 20px;width:20px;position: relative;left: -380px'></div>
                      </span>
                    </td>
                    <td style="position: relative;left: -280px;"> Si </td>
                    <td>
                      <span >
                        <div id='si_indigena' style='border-style:solid;height: 20px;width:20px;position: relative;left: -270px'></div>
                      </span>
                    </td>
                    <td style="position: relative;left: -150px;"> Si </td>
                    <td>
                      <span >
                        <div id='si_sexo_diverso' style='border-style:solid;height: 20px;width:20px;position: relative;left: -140px'></div>
                      </span>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative;left: 30px;"> Extensa </td>
                    <td>
                      <span >
                        <div id='extensa' style='border-style:solid;height: 20px;width:20px;position: relative;left: -40px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: -280px;"> No </td>
                    <td>
                      <span >
                        <div id='no_afro' style='border-style:solid;height: 20px;width:20px;position: relative;left: -380px'></div>
                      </span>
                    </td>
                    <td style="position: relative;left: -280px;"> No </td>
                    <td>
                      <span >
                        <div id='no_indigena' style='border-style:solid;height: 20px;width:20px;position: relative;left: -270px'></div>
                      </span>
                    </td>
                    <td style="position: relative;left: -150px;"> No </td>
                    <td>
                      <span >
                        <div id='no_sexo_diverso' style='border-style:solid;height: 20px;width:20px;position: relative;left: -140px'></div>
                      </span>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative;left: 30px;"> Ampliada </td>
                    <td>
                      <span >
                        <div id='ampliada' style='border-style:solid;height: 20px;width:20px;position: relative;left: -40px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: -120px"> Indique Cual: <span id="comunidad"></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <br>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 10px;"> 5. ¿Alguna persona del grupo familiar se encuentra privada de libertad? </td>
                    <td style="position: relative;left: 200px;"> 6.¿Existen integrantes del hogar que no pecnotan en el mismo? </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative;left: 30px;"> Si </td>
                    <td>
                      <span >
                        <div id='si_privado_libertad' style='border-style:solid;height: 20px;width:20px;position: relative;left: -130px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: -400px;"> Parentesco: </td>
                    <td style="position: relative;left: -250px;"> Si </td>
                    <td>
                      <span id='platabanda'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -260px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: -280px;"> Quien: </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative;left: 30px;"> No </td>
                    <td>
                      <span >
                        <div id='no_privado_libertad' style='border-style:solid;height: 20px;width:20px;position: relative;left: -130px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: -130px;"> No </td>
                    <td>
                      <span id='platabanda'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -230px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: -230px;"> Periodicidad: </td>
                  </tr>
                </table>
              </tr>
              <tr>
                <br>
                <div style='width:100%;background: red;color:white'>
                  <center> V. Productividad </center>
                </div>
              </tr>
              <tr>
                <table>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 0px;"> N° Personas que Trabajan </td>
                    <td style="position: relative; left: 0px;"> Ingreso Mensual Familiar </td>
                    <td style="position: relative; left: 0px;"> Alguno(a) ha participado en proyecto sociotecnologico </td>
                    <td style="position: relative; left: 0px;"> Estado Actual del Proyecto </td>
                    <td style="position: relative; left: 0px;"> Area del Proyecto </td>
                    <td style="position: relative; left: 0px;"> Tiene pensado una idea socioproductiva </td>
                  </tr>
                  <tr>
                    <td>
                      <span id='cant_trabajan'></span>
                      <hr>
                    </td>
                    <td>
                      <span id='ing_mensual'></span>
                      <hr>
                    </td>
                    <td>
                      <span id='trabajo_proyecto'></span>
                      <hr>
                    </td>
                    <td>
                    <span id='estado_proyecto'></span>
                      <hr>
                    </td>
                    <td>
                    <span id='area_proyecto'></span>
                      <hr>
                    </td>
                    <td><br>
                      <hr>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 0px;">
                      <span id=""></span>
                    </td>
                    <td style="position: relative; left: 0px;">
                      <span id=""></span>
                    </td>
                    <td style="position: relative; left: 0px;">
                      <span id=""></span>
                    </td>
                    <td style="position: relative; left: 0px;">
                      <span id=""></span>
                    </td>
                    <td style="position: relative; left: 0px;">
                      <span id=""></span>
                    </td>
                    <td style="position: relative; left: 0px;">
                      <span id=""></span>
                    </td>
                    <td style="position: relative; left: 0px;">
                      <span id=""></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <hr>
                    </td>
                    <td>
                      <hr>
                    </td>
                    <td>
                      <hr>
                    </td>
                    <td>
                      <hr>
                    </td>
                    <td>
                      <hr>
                    </td>
                    <td>
                      <hr>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 0px;"> Areas del Proyecto </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 20px;"> 1.Construccion y Mantenimiento </td>
                    <td style="position: relative; left: 40px;"> 3. Alimentacion </td>
                    <td style="position: relative; left: 60px;"> 5. Textil o Artesanal </td>
                    <td style="position: relative; left: 80px;"> 7. Cultural </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 20px;"> 2.Transporte </td>
                    <td style="position: relative; left: 40px;"> 4. Comunicacion </td>
                    <td style="position: relative; left: 60px;"> 6. Agricola </td>
                    <td style="position: relative; left: 80px;"> 8.Educativo </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 0px;" colspan="4">
                      <br>
                      <b>En este Hogar</b>¿Cuantas Personas entre 15 y 65 se Encuentran desemplados que puedan trabajar?
                    </td>
                  </tr>
                  <tr>
                    <td style="position: relative; left: 0px;">
                      <span id="cantidad"></span>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 0px;" colspan="4">
                      <b>¿Cuantos niños y niñas y Adolescentes menores de 17 años trabajan?</b>
                    </td>
                  </tr>
                  <tr>
                    <td style="position: relative; left: 0px;">
                      <span id="cantidad_menores_trabajando"></span>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 0px;" colspan="4"> Indique cual o cuales son las habilidades u oficios que destacan dentro de su grupo familiar </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 20px;"> 1.Transporte </td>
                    <td style="position: relative; left: 40px;"> 3. Alimentacion </td>
                    <td style="position: relative; left: 60px;"> 5. Comunicacion </td>
                    <td style="position: relative; left: 80px;" colspan="2"> 7. Textil o Artesanal </td>
                    <td style="position: relative; left: 80px;" colspan="2"> 9. Construccion Y Mantenimiento </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 20px;"> 2.Cultural </td>
                    <td style="position: relative; left: 40px;"> 4. Turistico </td>
                    <td style="position: relative; left: 60px;"> 6. Educativo </td>
                    <td style="position: relative; left: 80px;"> 8.Agricola </td>
                    <td style="position: relative; left: 150px;"> 10.Otro </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 0px;" colspan="4">
                      <b>¿En su vivienda se encuentra, se cuenta con un espacio prara la siembra de alimentos?</b>
                    </td>
                    <td>
                    <td style="position: relative;left: -90px;"> Si </td>
                    <td>
                      <span id='platabanda'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -200px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: -200px;"> No </td>
                    <td>
                      <span id='platabanda'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -150px'></div>
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 0px;" colspan="4">
                      <b>¿le gustaria participar en el programa de agricultura domestica?</b>
                    </td>
                    <td>
                    <td style="position: relative;left: -90px;"> Si </td>
                    <td>
                      <span id='platabanda'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -200px'></div>
                      </span>
                    </td>
                    <td>
                    <td style="position: relative;left: -200px;"> No </td>
                    <td>
                      <span id='platabanda'>
                        <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -150px'></div>
                      </span>
                    </td>
                    <td></td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 0px;" colspan="8">
                      <center>
                        <b>En caso de que algun mienbro de la familia sea productor agricola, completar el siguiente cuadro</b>
                      </center>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <table>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative;left: 0px;"> Area de Produccion </td>
                        <td style="position: relative;left: 0px;"> Años de Experiencia </td>
                        <td style="position: relative;left: 0px;"> Rubro Principal </td>
                        <td style="position: relative;left: 0px;"> Tiene Registri INTI </td>
                        <td style="position: relative;left: 0px;"> Tiene constancia de productor </td>
                        <td style="position: relative;left: 0px;"> Tiene señal de hierro </td>
                        <td style="position: relative;left: 0px;"> Ha sido Financiado </td>
                        <td style="position: relative;left: 0px;"> Cuenta con Agua de Riego </td>
                        <td style="position: relative;left: 0px;"> Tiene produccion de alimentos Actual </td>
                      </tr>
                      <tr style="font-size: 13px;">
                        <td id='area_produccion' style="position: relative;left: 0px;"></td>
                        <td id='anios_experiencia' style="position: relative;left: 0px;"></td>
                        <td id='rubro_principal' style="position: relative;left: 0px;"></td>
                        <td id='inti' style="position: relative;left: 0px;"></td>
                        <td id='constancia_productor' style="position: relative;left: 0px;"></td>
                        <td id='hierro' style="position: relative;left: 0px;"></td>
                        <td id='financiado' style="position: relative;left: 0px;"></td>
                        <td id='agua_riego' style="position: relative;left: 0px;"></td>
                        <td id='produccion_actual' style="position: relative;left: 0px;"></td>
                      </tr>
                    </table>
                  </tr>
                  <tr>
                    <td>
                      
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <table>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative;left: 0px;">
                          <span></span>
                        </td>
                        <td style="position: relative;left: 0px;">
                          <span></span>
                        </td>
                        <td style="position: relative;left: 0px;">
                          <span></span>
                        </td>
                        <td style="position: relative;left: 0px;">
                          <span></span>
                        </td>
                        <td style="position: relative;left: 0px;">
                          <span></span>
                        </td>
                        <td style="position: relative;left: 0px;">
                          <span></span>
                        </td>
                        <td style="position: relative;left: 0px;">
                          <span></span>
                        </td>
                        <td style="position: relative;left: 0px;">
                          <span></span>
                        </td>
                        <td style="position: relative;left: 0px;">
                          <span></span>
                        </td>
                      </tr>
                    </table>
                  </tr>
                  <tr>
                    <td>
                      <hr>
                    </td>
                  </tr>
                  <tr style="color: red;font-size: 13px;">
                    <td style="position: relative; left: 0px;" colspan="4">
                      <table>
                        <tr>
                          <td>
                            <b style="color: red;font-size: 13px;">Pertenece a alguna organizacion productiva. Indique el nombre</b>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <span id='nombre_org_agricola'></span>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <div style='width:100%;background: red;color:white'>
                      <center> VI. Alimentacion </center>
                    </div>
                  </tr>
                  <tr>
                    <table>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative; left: 0px;"> 1. Generalmente ¿con que frecuencia en su comunidad realizan jornadas de alimentos ? <br> (pdval,mercal entre otros) </td>
                        <td style="position: relative; left: 0px;"> 2. Cuantas comidas son consumidas al dia en el hogar </td>
                        <td style="position: relative; left: 0px;"> 3. Tiene acceso a la casa de alimentacion </td>
                        <td style="position: relative; left: 0px;"> 4. Posee la familia los siguientes articulos para el procesamiento de alimentos </td>
                      </tr>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative;left: 0px;"> Semanal </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -200px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -180px;"> Mensual </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -250px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -400px;"> Si </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -380px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -220px;"> Nevera </td>
                        <td>
                          <span >
                            <div id='nevera' style='border-style:solid;height: 20px;width:20px;position: relative;left: -200px'></div>
                          </span>
                        </td>
                      </tr>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative;left: 0px;"> Quincenal </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -200px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -180px;"> Ocacional </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -250px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -400px;"> No </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -380px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -220px;"> Cocina </td>
                        <td>
                          <span >
                            <div id='cocina' style='border-style:solid;height: 20px;width:20px;position: relative;left: -200px'></div>
                          </span>
                        </td>
                      </tr>
                    </table>
                  </tr>
                  <tr>
                    <div style='width:100%;background: red;color:white'>
                      <center> VII. Politica y Organizacion Comunal </center>
                    </div>
                  </tr>
                  <tr>
                    <table>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative; left: 0px;"> 1.¿todos los mienbros del hogar mayores de 18 años esta inscritos en el registro nacional electoral? </td>
                        <td></td>
                        <td style="position: relative; left: 100px;"> 2.¿todos los miembros del hogar resgistrados votaron en las ultimas elecciones? </td>
                        <td></td>
                        <td style="position: relative; left: 120px;"> 3.¿usted o alguno de los miembros del hogar participa actualmente de manera activa en alguna organizacion del poder popular? </td>
                      </tr>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative;left: 0px;"> Si </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -180px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -160px;"> No </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -310px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -180px;"> Si </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -400px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -380px;"> No </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -360px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -250px;"> Si </td>
                        <td>
                          <span >
                            <div id='no_org_politica' style='border-style:solid;height: 20px;width:20px;position: relative;left: -80px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -160px;"> No </td>
                        <td>
                          <span >
                            <div id='si_org_politica' style='border-style:solid;height: 20px;width:20px;position: relative;left: -250px'></div>
                          </span>
                        </td>
                      </tr>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative; left: 0px;"> Mencione cuantos: </td>
                        <td style="position: relative; left: 0px;"></td>
                        <td style="position: relative; left: 50px;"> Mencione cuantos: </td>
                        <td style="position: relative; left: 0px;"></td>
                        <td style="position: relative; left: 150px;"> Indique cual: <br> Coloque N°: <span id='num_org_politica' style='color:black'></span></td>
                        <td style="position: relative; left: 0px;"></td>
                      </tr>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative; left: 0px;"> Opciones pregunta 3: </td>
                        <td style="position: relative; left: 0px;" colspan="2"> 1.Consejo Comunal </td>
                        <td style="position: relative; left: 0px;"> 2.Comuna </td>
                        <td style="position: relative; left: 60px;"> 3.Colectivos </td>
                        <td style="position: relative; left: 0px;"> 4.UBCHE </td>
                      </tr>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative; left: 200px;"> 5.Frente Francisco de Miranda </td>
                        <td style="position: relative; left: 300px;"> 6.Otros </td>
                        <td style="position: relative; left: 400px;"> Especifique: <span style='color:black' id='org_politica_especifica'></span></td>
                        <td style="position: relative; left: 0px;"></td>
                      </tr>
                    </table>
                  </tr>
                  <tr>
                    <div style='width:100%;background: red;color:white'>
                      <center> VIII. Cultural y Deporte </center>
                    </div>
                  </tr>
                  <tr>
                    <table>
                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative; left: 0px;"> ¿Cual de las siguientes areas preferirian desarrollar a los habitantes de su hogar? </td>
                        <td style="position: relative; left: 0px;"> ¿Tiene la familia acceso a los siguientes medios masivos de comunicacion? </td>
                        <td style="position: relative; left: 0px;"> ¿Tiene la familia acceso al uso de computadoras y equipos informaticos? </td>
                        <td style="position: relative; left: 0px;"> ¿le gustaria formar parte del movimiento paz y la vida? </td>
                        <td style="position: relative; left: 0px;" colspan="4"> ¿Le gustaria participar en espacios para la defensa y derechos humanos de la mujer? </td>
                      </tr>

                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative;left: 0px;"> Culturales </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -100px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -200px;"> Televisión </td>
                        <td>
                          <span >
                            <div id='tv' style='border-style:solid;height: 20px;width:20px;position: relative;left: -300px'></div>
                          </span>
                        </td>

                        <td style="position: relative;left: -300px;"> Si </td>
                        <td>
                          <span >
                            <div id='si_pc' style='border-style:solid;height: 20px;width:20px;position: relative;left: -300px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -200px;"> Si </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -200px'></div>
                          </span>
                        </td>

                        <td style="position: relative;left: -150px;"> Si </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -140px'></div>
                          </span>
                        </td>

                      </tr>

                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative;left: 0px;"> Deportivas </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -100px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -200px;"> Radio </td>
                        <td>
                          <span >
                            <div id='radio' style='border-style:solid;height: 20px;width:20px;position: relative;left: -300px'></div>
                          </span>
                        </td>

                        <td style="position: relative;left: -300px;">No</td>
                        <td>
                          <span >
                            <div id='no_pc' style='border-style:solid;height: 20px;width:20px;position: relative;left: -300px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -200px;">No</td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -200px'></div>
                          </span>
                        </td>

                        <td style="position: relative;left: -150px;">No</td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -140px'></div>
                          </span>
                        </td>

                      </tr>

                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative;left: 0px;"> Recreativas </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -100px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -200px;"> Prensa </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -300px'></div>
                          </span>
                        </td>



                      </tr>

                      <tr style="color: red;font-size: 13px;">
                        <td style="position: relative;left: 0px;"> Otras </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -100px'></div>
                          </span>
                        </td>
                        <td style="position: relative;left: -200px;"> Cine </td>
                        <td>
                          <span id='platabanda'>
                            <div style='border-style:solid;height: 20px;width:20px;position: relative;left: -300px'></div>
                          </span>
                        </td>



                      </tr>
                    </table>
                  <tr>
                    <div style='width:100%;background: red;color:white'>
                      <center> IX. Datos de los residentes habituales del hogar </center>
                    </div>
                  </tr>
                  <tr>
                    <table class="datos" id='tabla_integrantes'>
                    </table>

                  </tr>
              </tr>
            </table>
            </tr>
            </table>
          </div>
        </center>
      </div>
    </div>
    <!-- /.card-body -->
  </section>
  <!-- /.content -->
</div>
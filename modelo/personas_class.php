<?php

class Personas_Class extends Modelo 
{ 
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.

    private $SQL;           #nombre de la sentencia SQL que se ejecutara en el modelo
    private $tipo;          #tipo de peticion que usaremos 1/0
    private $PDO;           #sentecia sql iniciada con prepare
    private $sentencia;     #sentencia sql que se ejecutara
    private $datos;         #datos a ejecutar para enviar a la bd

    public  $resultado;     #resultado de consultas de la bd

    public function __construct(){parent::__construct();}

    // SETTER estaablece los datos a usar en el modelo (tipo void no retornan un valor)
    public function _SQL_(string $SQL): void        {$this->SQL = $SQL;}
    public function _Tipo_(int $tipo): void         {$this->tipo = $tipo;}
    public function _Datos_(array $datos): void     {$this->datos = $datos;}
    public function _Estado_(array $estado): void   {$this->estado = $estado;}

    public function Administrar()
    {
        $this->sentencia = $this->{$this->SQL}(); #funcion anonima en espera de asignar nombre
        try {
            switch ($this->tipo) {
                case '0':           #tipo 0 trae consultas de la bd retorna a un array con los datos 
                    $this->conexion->beginTransaction(); # Inicia una transacción
                    $this->PDO = $this->conexion->prepare($this->sentencia);
                    $this->PDO->execute();
                    $this->conexion->commit(); #Consigna una transacción
                    $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
                    $this->resultado = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
                    return $this->resultado;
                    break;
                case '1':       #tipo 1 ejecuta un INSERT , UPDATE, DELETE  retorna a true (si no hay falla)
                    $this->conexion->beginTransaction();
                    $this->PDO = $this->conexion->prepare($this->sentencia);
                    $this->PDO->execute($this->datos);
                    $this->conexion->commit();
                    return true;
                    break;
                default:        # mensaje error si la peticion fue incorrecta
                    die('[Error 400] => "La Peticion es Incorrecta, solo se permite peticion de tipo 0/1."');
                    break;
            }
        } catch (PDOException $e) { #capturamos el error y se envia la respuesta(ubicacion MODELO)
            return $this->Capturar_Error($e, "Personas"); 
        }
    }

    // ===============================================================================

    #sentecias sql en espera de ser llamadas retornan string
    private function SQL_01():string
    {
        return 'INSERT INTO vacuna_covid ( cedula_persona, dosis, fecha_vacuna, estado) VALUES (:cedula_persona, :dosis, :fecha_vacuna, :estado)';
    }

    private function SQL_02():string
    {
        return 'INSERT INTO personas (cedula_persona,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,nacionalidad,jefe_familia,propietario_vivienda,afrodescendencia,sexualidad,fecha_nacimiento,telefono,correo,estado_civil,privado_libertad,genero,whatsapp,miliciano,antiguedad_comunidad,jefe_calle,nivel_educativo,contrasenia,rol_inicio,preguntas_seguridad,user_locked,digital_sign,public_key,private_key,estado) VALUES (:cedula_persona,:primer_nombre,:segundo_nombre,:primer_apellido,:segundo_apellido,:nacionalidad,:jefe_familia,:propietario_vivienda,:afrodescendencia,:sexualidad,:fecha_nacimiento,:telefono,:correo,:estado_civil,:privado_libertad,:genero,:whatsapp,:miliciano,:antiguedad_comunidad,:jefe_calle,:nivel_educativo,:contrasenia,:rol_inicio,:preguntas_seguridad,:user_locked,:digital_sign,:public_key,:private_key,:estado)';
    }

    private function SQL_03():string
    {
        return 'INSERT INTO transporte ( cedula_propietario, descripcion_transporte, estado ) VALUES ( :cedula_propietario, :descripcion_transporte, :estado )';
    }

    private function SQL_04():string
    {
        return 'INSERT INTO ocupacion_persona ( cedula_persona, id_ocupacion, estado ) VALUES ( :cedula_persona, :id_ocupacion, :estado )';
    }

    private function SQL_05():string
    {
        return 'INSERT INTO permisos_usuario_modulo( cedula_usuario, id_modulo, registrar, consultar, modificar, eliminar) VALUES ( :cedula_usuario, :id_modulo, :registrar, :consultar, :modificar, :eliminar)';
    }

    private function SQL_06():string
    {
        return 'INSERT INTO carnets ( cedula_persona, serial_carnet, codigo_carnet, tipo_carnet ) VALUES ( :cedula_persona, :serial_carnet, :codigo_carnet, :tipo_carnet )';
    }

    private function SQL_07():string
    {
        return 'INSERT INTO persona_proyecto ( cedula_persona, id_proyecto, estado ) VALUES ( :cedula_persona, :id_proyecto, :estado )';
    }

    private function SQL_08():string
    {
        return 'INSERT INTO comunidad_indigena_personas ( id_comunidad_indigena,  cedula_persona, estado ) VALUES ( :id_comunidad_indigena, :cedula_persona, :estado)';
    }

    private function SQL_09():string
    {
        return 'INSERT INTO org_politica_persona ( cedula_persona, id_org_politica, estado ) VALUES ( :cedula_persona, :id_org_politica, :estado )';
    }

    
    private function SQL_10():string
    {
        return 'INSERT INTO persona_bonos ( cedula_persona, id_bono) VALUES ( :cedula_persona, :id_bono )';
    }

    private function SQL_11():string
    {
        return 'INSERT INTO proyecto ( nombre_proyecto, area_proyecto, estado_proyecto,  estado ) VALUES ( :nombre_proyecto, :area_proyecto, :estado_proyecto,  :estado )';
    }

    private function SQL_12():string
    {
        return 'INSERT INTO persona_misiones( id_mision, cedula_persona, recibe_actualmente,  fecha, estado) VALUES ( :id_mision, :cedula_persona, :recibe_actualmente,  :fecha, :estado  )';
    }

    private function SQL_13():string
    {
        return 'INSERT INTO condicion_laboral ( cedula_persona, nombre_cond_laboral, sector_laboral, pertenece, estado ) VALUES ( :cedula_persona, :nombre_cond_laboral, :sector_laboral, :pertenece, :estado )';
    }

    private function SQL_14():string
    {
        return "SELECT * FROM personas WHERE estado=1 ORDER BY primer_nombre ASC";
    }

    private function SQL_15():string
    {
        return "UPDATE personas  SET primer_nombre =:primer_nombre, segundo_nombre  =:segundo_nombre, primer_apellido =:primer_apellido, segundo_apellido =:segundo_apellido, nacionalidad  =:nacionalidad, jefe_familia =:jefe_familia, propietario_vivienda =:propietario_vivienda, afrodescendencia =:afrodescendencia, sexualidad =:sexualidad, fecha_nacimiento =:fecha_nacimiento, telefono =:telefono, correo =:correo, estado_civil =:estado_civil, privado_libertad =:privado_libertad, genero =:genero, whatsapp =:whatsapp, miliciano =:miliciano, antiguedad_comunidad =:antiguedad_comunidad, jefe_calle =:jefe_calle, nivel_educativo =:nivel_educativo WHERE cedula_persona =:cedula_persona";
    }

    private function SQL_16():string
    {
        return "UPDATE condicion_laboral  SET cedula_persona =:cedula_persona, nombre_cond_laboral   =:nombre_cond_laboral, sector_laboral =:sector_laboral, pertenece =:pertenece WHERE id_cond_laboral =:id_cond_laboral";
    }

    private function SQL_17():string
    {
        return 'DELETE FROM personas WHERE cedula_persona = :cedula_persona';
    }

    private function SQL_18():string
    {
        return 'DELETE FROM personas WHERE cedula_persona = :cedula_persona';
    }

    private function SQL_19():string
    {
     return "SELECT * FROM personas WHERE cedula_persona=$this->cedula AND estado=1";
    }
    
    private function SQL_20():string
    {
     return "SELECT * FROM carnets WHERE serial_carnet='$this->serial' AND tipo_carnet='$this->tipo'";
    }

    private function SQL_21():string
    {
     return "SELECT * FROM carnets WHERE codigo_carnet='$this->codigo' AND tipo_carnet='$this->tipo'";
    }

    private function SQL_22():string
    {
     return "SELECT * FROM transporte WHERE estado=1";
    }

    private function SQL_23():string
    {
     return "SELECT * FROM comunidad_indigena WHERE estado=1";
    }

    private function SQL_24():string
    {
     return "SELECT * FROM org_politica WHERE estado=1";
    }

    private function SQL_25():string
    {
     return "SELECT * FROM centros_votacion WHERE estado=1";
    }

    private function SQL_26():string
    {
     return "SELECT * FROM parroquias WHERE estado=1";
    }

    private function SQL_27():string
    {
     return "SELECT * FROM bonos WHERE estado=1";
    }

    private function SQL_28():string
    {
     return "SELECT * FROM misiones WHERE estado=1";
    }

    private function SQL_29():string
    {
     return "SELECT * FROM enfermedades WHERE estado=1";
    }

    private function SQL_30():string
    {
     return "SELECT * FROM discapacidad WHERE estado=1";
    }

    private function SQL_31():string
    {
     return "SELECT * FROM ocupacion WHERE estado=1";
    }

    private function SQL_32():string
    {
     return "SELECT * FROM condicion_laboral WHERE estado=1";
    }

    private function SQL_33():string
    {
     return "SELECT * FROM proyecto WHERE estado=1";
    }

    private function SQL_34():string
    {
     return "SELECT O.nombre_ocupacion, O.id_ocupacion FROM ocupacion O, ocupacion_persona OP WHERE OP.cedula_persona = $this->cedula AND O.id_ocupacion = OP.id_ocupacion AND  O.estado=1";
    }

    private function SQL_35():string
    {
     return "SELECT * FROM condicion_laboral WHERE cedula_persona = $this->cedula AND estado=1";
    }

    private function SQL_36():string
    {
     return "SELECT * FROM transporte WHERE cedula_propietario = $this->cedula AND estado=1";
    }

    private function SQL_37():string
    {
     return "SELECT B.nombre_bono, PB.id_persona_bono FROM bonos B, persona_bonos PB WHERE PB.cedula_persona = $this->cedula AND PB.id_bono=B.id_bono AND B.estado=1";
    }

    private function SQL_38():string
    {
     return "SELECT M.nombre_mision , PM.* FROM misiones M, persona_misiones PM WHERE PM.cedula_persona = $this->cedula AND PM.id_mision=M.id_mision AND M.estado=1";
    }

    private function SQL_39():string
    {
     return "SELECT P.*, PP.id_persona_proyecto  FROM proyecto P, persona_proyecto PP WHERE PP.cedula_persona = $this->cedula AND PP.id_proyecto=P.id_proyecto AND P.estado=1";
    }

    private function SQL_40():string
    {
     return "SELECT CI.nombre_comunidad  FROM comunidad_indigena CI, comunidad_indigena_personas CIP WHERE CIP.cedula_persona = $this->cedula AND CIP.id_comunidad_indigena=CI.id_comunidad_indigena AND CI.estado=1";
    }

    private function SQL_41():string
    {
     return "SELECT *  FROM org_politica O, org_politica_persona OP WHERE OP.cedula_persona = $this->cedula AND OP.id_org_politica=O.id_org_politica AND O.estado=1";
    }

    // ===============================================================================
    public function Consultar_Vacuna()
    {
 
        $tabla            = "SELECT DISTINCT v.cedula_persona, p.primer_nombre, p.primer_apellido FROM vacuna_covid v, personas p WHERE v.cedula_persona = p.cedula_persona AND p.estado =1 AND v.estado = 1";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
        }
    }

    public function Buscar_Usuario($cedula)
    {

        $tabla            = "SELECT * FROM personas WHERE cedula_persona=$cedula";
        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Usuario");
        }
    }

    public function Registrar_Vacuna($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO vacuna_covid (
                cedula_persona,
                dosis,
                fecha_vacuna,
                estado
                ) VALUES (
                    :cedula_persona,
                    :dosis,
                    :fecha_vacuna,
                    :estado
                )');

            $datos->execute([
                'cedula_persona' => $data['cedula_persona'],
                'dosis' => $data['dosis'],
                'fecha_vacuna' => $data['fecha_vacuna'],
                'estado' => $data['estado'],
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e,"Personas");
        }
    }
    public function Registrar($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO personas (
                cedula_persona,
                primer_nombre,
                segundo_nombre,
                primer_apellido,
                segundo_apellido,
                nacionalidad,
                jefe_familia,
                propietario_vivienda,
                afrodescendencia,
                sexualidad,
                fecha_nacimiento,
                telefono,
                correo,
                estado_civil,
                privado_libertad,
                genero,
                whatsapp,
                miliciano,
                antiguedad_comunidad,
                jefe_calle,
                nivel_educativo,
                contrasenia,
                rol_inicio,
                preguntas_seguridad,
                user_locked,
                digital_sign,
                public_key,
                private_key,
                estado
                ) VALUES (
                :cedula_persona,
                :primer_nombre,
                :segundo_nombre,
                :primer_apellido,
                :segundo_apellido,
                :nacionalidad,
                :jefe_familia,
                :propietario_vivienda,
                :afrodescendencia,
                :sexualidad,
                :fecha_nacimiento,
                :telefono,
                :correo,
                :estado_civil,
                :privado_libertad,
                :genero,
                :whatsapp,
                :miliciano,
                :antiguedad_comunidad,
                :jefe_calle,
                :nivel_educativo,
                :contrasenia,
                :rol_inicio,
                :preguntas_seguridad,
                :user_locked,
                :digital_sign,
                :public_key,
                :private_key,
                :estado
                )');

            $datos->execute([
                'cedula_persona'        =>       $data['cedula_persona'],
                'primer_nombre'         =>       $data['primer_nombre'],
                'segundo_nombre'        =>       $data['segundo_nombre'],
                'primer_apellido'       =>       $data['primer_apellido'],
                'segundo_apellido'      =>       $data['segundo_apellido'],
                'nacionalidad'          =>       $data['nacionalidad'],
                'jefe_familia'          =>       $data['jefe_familia'],
                'propietario_vivienda'  =>       $data['propietario_vivienda'],
                'afrodescendencia'      =>       $data['afrodescendencia'],
                'sexualidad'            =>       $data['sexualidad'],
                'fecha_nacimiento'      =>       $data['fecha_nacimiento'],
                'telefono'              =>       $data['telefono'],
                'correo'                =>       $data['correo'],
                'estado_civil'          =>       $data['estado_civil'],
                'privado_libertad'      =>       $data['privado_libertad'],
                'genero'                =>       $data['genero'],
                'whatsapp'              =>       $data['whatsapp'],
                'miliciano'             =>       $data['miliciano'],
                'antiguedad_comunidad'  =>       $data['antiguedad_comunidad'],
                'jefe_calle'            =>       $data['jefe_calle'],
                'nivel_educativo'       =>       $data['nivel_educativo'],
                'contrasenia'           =>       $data['contrasenia'],
                'rol_inicio'            =>       $data['rol_inicio'],
                'preguntas_seguridad'   =>       $data['preguntas_seguridad'],
                'user_locked'           =>       $data['user_locked'],
                'digital_sign'          =>       $data['firma_digital'],
                'public_key'            =>       $data['user_rsa_keys']['publicKey'],
                'private_key'           =>       $data['user_rsa_keys']['privateKey'],
                'estado'                =>       $data['estado']
            ]);

            return true;

        } catch (PDOException $e) {
            return $e;
        }
    }


     public function Registrar_transporte($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO transporte (
                cedula_propietario,
                descripcion_transporte,
                estado            
                ) VALUES (
                    :cedula_propietario,
                    :descripcion_transporte,
                    :estado
                )');

            $datos->execute([
                'cedula_propietario'      => $data['cedula_propietario'],
                'descripcion_transporte'   => $data['descripcion_transporte'], 
                'estado'   => 1,
            ]);

            return true;

        } catch (PDOException $e) {
            return $e;
        }
    }


    public function Registrar_persona_ocupacion($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO ocupacion_persona (
                cedula_persona,
                id_ocupacion,
                estado            
                ) VALUES (
                    :cedula_persona,
                    :id_ocupacion,
                    :estado
                )');

            $datos->execute([
                'cedula_persona'      => $data['cedula_persona'],
                'id_ocupacion'   => $data['id_ocupacion'], 
                'estado'   => 1,
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e,"Personas");
        }
    }

        public function  registrar_permisos($data)
    {    
         
         $ejecucion=false;

         if($data['rol_inicio']=="Super Usuario"){


          
          for($i=1;$i<17;$i++){
                         try{
                    $datos=$this->conexion->prepare('INSERT INTO permisos_usuario_modulo(
                        cedula_usuario,
                        id_modulo,
                        registrar,
                        consultar,
                        modificar,
                        eliminar) VALUES (
                        :cedula_usuario,
                        :id_modulo,
                        :registrar,
                        :consultar,
                        :modificar,
                        :eliminar)');

                $datos->execute([
                'cedula_usuario'      => $data['cedula_persona'],
                'id_modulo'           =>$i,
                'registrar'           =>1,
                'consultar'           =>1,
                'modificar'           =>1,
                'eliminar'            =>1
            ]);

                $ejecucion=true;
                }
                catch (PDOException $e) {
            $this->error = 'Ha surgido un error y no se puede cargar los datos. Detalle: ' . $e->getMessage();
            $ejecucion=$e->getMessage();
        }
          }

         }

         else{

            if($data['rol_inicio']=='Administrador'){

            for($i=1;$i<17;$i++){
                if($i!=1 && $i!=16 ){
                      $permiso=1;
                }
                else{
                    $permiso=0;
                }
                try{
                    $datos=$this->conexion->prepare('INSERT INTO permisos_usuario_modulo(
                        cedula_usuario,
                        id_modulo,
                        registrar,
                        consultar,
                        modificar,
                        eliminar) VALUES (
                        :cedula_usuario,
                        :id_modulo,
                        :registrar,
                        :consultar,
                        :modificar,
                        :eliminar)');

                $datos->execute([
                'cedula_usuario'      => $data['cedula_persona'],
                'id_modulo'           =>$i,
                'registrar'           =>$permiso,
                'consultar'           =>$permiso,
                'modificar'           =>$permiso,
                'eliminar'            =>0
            ]);

                $ejecucion=true;
                }
                catch (PDOException $e) {
            $this->error = 'Ha surgido un error y no se puede cargar los datos. Detalle: ' . $e->getMessage();
            $ejecucion=$e->getMessage();
        }
               }
           }
           else{
            for($i=1;$i<17;$i++){
                if($i==2 || $i==9 || $i==12 || $i==3){
                      $permiso=1;
                }
                else{
                    $permiso=0;
                }
                try{
                    $datos=$this->conexion->prepare('INSERT INTO permisos_usuario_modulo(
                        cedula_usuario,
                        id_modulo,
                        registrar,
                        consultar,
                        modificar,
                        eliminar) VALUES (
                        :cedula_usuario,
                        :id_modulo,
                        :registrar,
                        :consultar,
                        :modificar,
                        :eliminar)');

                $datos->execute([
                'cedula_usuario'      => $data['cedula_persona'],
                'id_modulo'           =>$i,
                'registrar'           =>$permiso,
                'consultar'           =>$permiso,
                'modificar'           =>0,
                'eliminar'            =>0
            ]);

                $ejecucion=true;
                }
                catch (PDOException $e) {
            $this->error = 'Ha surgido un error y no se puede cargar los datos. Detalle: ' . $e->getMessage();
            $ejecucion=$e->getMessage();
        }
               }
           }
         }


         return $ejecucion;
          
    }




    public function registrar_carnet($data){

        try {
            $datos = $this->conexion->prepare('INSERT INTO carnets (
                cedula_persona,
                serial_carnet,
                codigo_carnet,
                tipo_carnet        
                ) VALUES (
                :cedula_persona,
                :serial_carnet,
                :codigo_carnet,
                :tipo_carnet
                )');

            $datos->execute([
                'cedula_persona'      => $data['cedula_persona'],
                'serial_carnet'   => $data['serial_carnet'],
                'codigo_carnet'   => $data['codigo_carnet'],
                'tipo_carnet'      => $data['tipo_carnet']
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e,"Personas");
        }
    }


 public function Registrar_persona_proyecto($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO persona_proyecto (
                cedula_persona,
                id_proyecto,
                estado            
                ) VALUES (
                    :cedula_persona,
                    :id_proyecto,
                    :estado
                )');

            $datos->execute([
                'cedula_persona'      => $data['cedula_persona'],
                'id_proyecto'   => $data['id_proyecto'], 
                'estado'   => 1,
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e,"Personas");
        }
    }


        public function Registrar_persona_comunidad($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO comunidad_indigena_personas (
                id_comunidad_indigena,
                 cedula_persona,
                estado            
                ) VALUES (
                 :id_comunidad_indigena,
                 :cedula_persona,
                    :estado
                )');

            $datos->execute([
                'cedula_persona'      => $data['cedula_persona'],
                'id_comunidad_indigena'   => $data['id_comunidad_indigena'], 
                'estado'   => 1,
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e,"Personas");
        }
    }

       public function Registrar_persona_organizacion($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO org_politica_persona (
                cedula_persona,
                id_org_politica,
                estado            
                ) VALUES (
                :cedula_persona,
                 :id_org_politica,
                    :estado
                )');

            $datos->execute([
                'cedula_persona'      => $data['cedula_persona'],
                'id_org_politica'   => $data['id_org_politica'], 
                'estado'   => 1,
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e,"Personas");
        }
    }

        public function Registrar_persona_bono($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO persona_bonos (
                cedula_persona,
                id_bono         
                ) VALUES (
                :cedula_persona,
                :id_bono
                )');

            $datos->execute([
                'cedula_persona'      => $data['cedula_persona'],
                'id_bono'   => $data['id_bono']
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e,"Personas");
        }
    }


            public function Registrar_proyecto($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO proyecto (
                nombre_proyecto,
                area_proyecto,
                estado_proyecto, 
                estado         
                ) VALUES (
                :nombre_proyecto,
                :area_proyecto,
                :estado_proyecto, 
                :estado
                )');

            $datos->execute([
                'nombre_proyecto'    =>  $data['nombre_proyecto'],
                'area_proyecto'      =>  $data['area_proyecto'],
                'estado_proyecto'    =>  $data['estado_proyecto'],
                'estado'             =>  1
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e,"Personas");
        }
    }


                public function Registrar_persona_mision($data)
    {

        try {
            if($data['fecha'] != '0000-00-00'){  
            $datos = $this->conexion->prepare('INSERT INTO persona_misiones(
                id_mision,
                cedula_persona,
                recibe_actualmente, 
                fecha,
                estado         
                ) VALUES (
                :id_mision,
                :cedula_persona,
                :recibe_actualmente, 
                :fecha,
                :estado 
                )');
            }
            else {
                $datos = $this->conexion->prepare('INSERT INTO persona_misiones(
                    id_mision,
                    cedula_persona,
                    recibe_actualmente, 
                    estado         
                    ) VALUES (
                    :id_mision,
                    :cedula_persona,
                    :recibe_actualmente, 
                    :estado 
                    )');
            }

            if($data['fecha'] != '0000-00-00'){  
            $datos->execute([
                'id_mision'              =>$data['id_mision'],
                'cedula_persona'         =>$data['cedula_persona'],
                'recibe_actualmente'    =>$data['recibe_actualmente'],
                'fecha'                  =>$data['fecha'],
                'estado'              =>  1
            ]);
            }
            else{
                $datos->execute([
                    'id_mision'              =>$data['id_mision'],
                    'cedula_persona'         =>$data['cedula_persona'],
                    'recibe_actualmente'    =>$data['recibe_actualmente'],
                    'estado'              =>  1
                ]);
            }

            return true;

        } catch (PDOException $e) {
            return $e;
        }
    }
   
   
   public function Registrar_cond_laboral($data){
    try {
            $datos = $this->conexion->prepare('INSERT INTO condicion_laboral (
                cedula_persona,
                nombre_cond_laboral,
                sector_laboral,
                pertenece,
                estado            
                ) VALUES (
                :cedula_persona,
                :nombre_cond_laboral,
                :sector_laboral,
                :pertenece,
                :estado
                )');

            $datos->execute([
                'cedula_persona'       =>  $data['cedula_persona'],
                'nombre_cond_laboral'  => $data['nombre_cond_laboral'],
                'sector_laboral'       => $data['sector_laboral'],
                'pertenece'            => $data['pertenece'],
                'estado'   => 1,
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e,"Personas");
        }
   }

    public function Consultar()
    {
 
        $tabla            = "SELECT * FROM personas WHERE estado=1 ORDER BY primer_nombre ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
        }
    }

    public function Actualizar($data)
    {

        try {
            $query = $this->conexion->prepare("UPDATE personas  SET
                primer_nombre           =:primer_nombre,
                segundo_nombre          =:segundo_nombre,
                primer_apellido         =:primer_apellido,
                segundo_apellido        =:segundo_apellido,
                nacionalidad            =:nacionalidad,
                jefe_familia            =:jefe_familia,
                propietario_vivienda    =:propietario_vivienda,
                afrodescendencia        =:afrodescendencia,
                sexualidad              =:sexualidad,
                fecha_nacimiento        =:fecha_nacimiento,
                telefono                =:telefono,
                correo                  =:correo,
                estado_civil            =:estado_civil,
                privado_libertad        =:privado_libertad,
                genero                  =:genero,
                whatsapp                =:whatsapp,
                miliciano               =:miliciano,
                antiguedad_comunidad    =:antiguedad_comunidad,
                jefe_calle              =:jefe_calle,
                nivel_educativo         =:nivel_educativo

                WHERE cedula_persona =:cedula_persona"
            );

            $query->execute([
                'cedula_persona'            =>$data['cedula_persona'], 
                'primer_nombre'             =>$data['primer_nombre'],
                'segundo_nombre'            =>$data['segundo_nombre'],
                'primer_apellido'           =>$data['primer_apellido'],
                'segundo_apellido'          =>$data['segundo_apellido'],
                'nacionalidad'              =>$data['nacionalidad'],
                'jefe_familia'              =>$data['jefe_familia'],
                'propietario_vivienda'      =>$data['propietario_vivienda'],
                'afrodescendencia'          =>$data['afrodescendencia'],
                'sexualidad'                =>$data['sexualidad'],
                'fecha_nacimiento'          =>$data['fecha_nacimiento'],
                'telefono'                  =>$data['telefono'],
                'correo'                    =>$data['correo'],
                'estado_civil'              =>$data['estado_civil'],
                'privado_libertad'          =>$data['privado_libertad'],
                'genero'                    =>$data['genero'],
                'whatsapp'                  =>$data['whatsapp'],
                'miliciano'                 =>$data['miliciano'],
                'antiguedad_comunidad'      =>$data['antiguedad_comunidad'],
                'jefe_calle'                =>$data['jefe_calle'],
                'nivel_educativo'           =>$data['nivel_educativo']

            ]);

            return true;

        } catch (PDOException $e) {
            return $e;
        }
    }

    public function Actualizar_cond_laboral($data)
    {

        try {
            $query = $this->conexion->prepare("UPDATE condicion_laboral  SET
                cedula_persona           =:cedula_persona,
                nombre_cond_laboral      =:nombre_cond_laboral,
                sector_laboral           =:sector_laboral,
                pertenece                =:pertenece

                WHERE id_cond_laboral    =:id_cond_laboral"
            );

            $query->execute([
                'cedula_persona'            =>$data['cedula_persona'], 
                'nombre_cond_laboral'       =>$data['nombre_cond_laboral'],
                'sector_laboral'            =>$data['sector_laboral'],
                'pertenece'                 =>$data['pertenece'],
                "id_cond_laboral"           =>$data['id_cond_laboral']

            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e,"Personas");
        }
    }

    public function Eliminar($param)
    {
        try {

            $query = $this->conexion->prepare('DELETE FROM personas WHERE cedula_persona = :cedula_persona');
            $query->execute(['cedula_persona' => $param]);

            return true;

        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
        }
    }
    //=======================================================================

   

     public function Buscar_Persona($cedula)
     {

         $tabla            = "SELECT * FROM personas WHERE cedula_persona=$cedula AND estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }


          public function get_serial_carnet($serial,$tipo)
     {

         $tabla            = "SELECT * FROM carnets WHERE serial_carnet='$serial' AND tipo_carnet='$tipo'";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }

         public function get_codigo_carnet($codigo,$tipo)
     {

         $tabla            = "SELECT * FROM carnets WHERE codigo_carnet='$codigo' AND tipo_carnet='$tipo'";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }

      public function get_transportes()
     {

         $tabla            = "SELECT Distinct descripcion_transporte FROM transporte WHERE estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }

     public function get_comunidades()
     {

         $tabla            = "SELECT * FROM comunidad_indigena WHERE estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }

public function get_organizaciones()
     {

         $tabla            = "SELECT * FROM org_politica WHERE estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }


     public function get_centros()
     {

         $tabla            = "SELECT * FROM centros_votacion WHERE estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }

 public function get_parroquias()
     {

         $tabla            = "SELECT * FROM parroquias WHERE estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }


      public function get_bonos()
     {

         $tabla            = "SELECT * FROM bonos WHERE estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }

     public function get_misiones()
     {

         $tabla            = "SELECT * FROM misiones WHERE estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }


      public function get_enfermedades()
     {

         $tabla            = "SELECT * FROM enfermedades WHERE estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }


     public function get_discapacidad()
     {

         $tabla            = "SELECT * FROM discapacidad WHERE estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }


     public function get_ocupaciones()
     {

         $tabla            = "SELECT * FROM ocupacion WHERE estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }

     public function get_condiciones()
     {

         $tabla            = "SELECT * FROM condicion_laboral WHERE estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             $resp=[];
             foreach($respuestaArreglo as $ra) {
                if (count($resp) == 0) {
                    $resp[] = $ra;
                }
                else{
                    $existe = false;
                    foreach($resp as $r) {
                       if($r['nombre_cond_laboral'] == $ra['nombre_cond_laboral']){
                        $existe=true;
                       }
                    }

                    if(!$existe){
                        $resp[] = $ra;
                    }
                }
             }
             return $resp;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }

     public function get_proyectos()
     {

         $tabla            = "SELECT * FROM proyecto WHERE estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }



       public function get_ocupacion_persona($cedula)
     {

         $tabla            = "SELECT O.nombre_ocupacion, O.id_ocupacion FROM ocupacion O, ocupacion_persona OP WHERE OP.cedula_persona = $cedula AND O.id_ocupacion = OP.id_ocupacion AND  O.estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }


      public function get_cond_laboral_persona($cedula)
     {

         $tabla            = "SELECT * FROM condicion_laboral WHERE cedula_persona = $cedula AND estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }



      public function get_transporte_persona($cedula)
     {

         $tabla            = "SELECT * FROM transporte WHERE cedula_propietario = $cedula AND estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }



      public function get_bonos_persona($cedula)
     {

         $tabla            = "SELECT B.nombre_bono, PB.id_persona_bono FROM bonos B, persona_bonos PB WHERE PB.cedula_persona = $cedula AND PB.id_bono=B.id_bono AND B.estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }

     public function get_misiones_persona($cedula)
     {

         $tabla            = "SELECT M.nombre_mision , PM.* FROM misiones M, persona_misiones PM WHERE PM.cedula_persona = $cedula AND PM.id_mision=M.id_mision AND M.estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }


     public function get_proyectos_persona($cedula)
     {

         $tabla            = "SELECT P.*, PP.id_persona_proyecto  FROM proyecto P, persona_proyecto PP WHERE PP.cedula_persona = $cedula AND PP.id_proyecto=P.id_proyecto AND P.estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }

      public function get_comunidad_indigena_persona($cedula)
     {

         $tabla            = "SELECT CI.nombre_comunidad  FROM comunidad_indigena CI, comunidad_indigena_personas CIP WHERE CIP.cedula_persona = $cedula AND CIP.id_comunidad_indigena=CI.id_comunidad_indigena AND CI.estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }


      public function get_org_politica_persona($cedula)
     {

         $tabla            = "SELECT *  FROM org_politica O, org_politica_persona OP WHERE OP.cedula_persona = $cedula AND OP.id_org_politica=O.id_org_politica AND O.estado=1";
         $respuestaArreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuestaArreglo;
         } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Personas");
         }
     }

     public function Locked_Login($user,$accion){
        $intentos=$user['user_locked'];
        $respuesta="";
        if($intentos!="locked"){
            $intentos=intval($intentos);
            if($intentos<2){
                $intentos++;
            }
            else{
                $intentos="locked";
            }
            $accion==0?$intentos=$intentos:$intentos=0;
            try {
                $query = $this->conexion->prepare("UPDATE personas  SET
                    user_locked              =:user_locked

                    WHERE cedula_persona    =:cedula_persona"
                );
    
                $query->execute([
                    'cedula_persona'            =>$user['cedula_persona'], 
                    'user_locked'               =>$intentos
    
                ]);
    
                $respuesta=$intentos;
    
            } catch (PDOException $e) {
                $respuesta=$this->Capturar_Error($e,"Usuario");
            }
        }
        else{
            $respuesta="locked";
        }

        return $respuesta;
    }
}
?>
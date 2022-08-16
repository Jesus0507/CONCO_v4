<?php

class Seguridad_Class extends Modelo
{

    public function __construct()
    {
        parent::__construct();
    } 


    public function get_permisos_rol($rol) 
    {

        $tabla = "SELECT * FROM roles_permisos_modulo WHERE rol=:rol";

        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute([
                   "rol"=>$rol
            ]);
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }


    public function consultar_personas_seguridad() 
    {

        $tabla = "SELECT * FROM personas order by primer_nombre";

        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }


    public function get_permisos($cedula) 
    {

        $tabla = "SELECT  PUM.* , M.nombre FROM permisos_usuario_modulo PUM , modulos M WHERE PUM.cedula_usuario = $cedula AND M.id_modulo = PUM.id_modulo";

        $respuestaArreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuestaArreglo;
        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }
    
    


        public function change_permiso($data)
    {    
    	$campo=$data['campo'];

        $sql     = 'UPDATE roles_permisos_modulo SET '.$campo.' = :permiso WHERE rol = :rol AND id_modulo = :id_modulo'; 
        $arreglo = '';

        try {

            $datos = $this->conexion->prepare($sql);

            $datos->execute([
                'permiso'     => $data['permiso'],
                'rol'     => $data['rol'],
                'id_modulo' => $data['modulo']
             ]);

            return true;

        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }



      public function change_roles($data)
    {    

        $sql     = 'UPDATE personas SET rol_inicio=:rol_inicio ,contrasenia = :contrasenia WHERE cedula_persona = :cedula_usuario'; 
        $arreglo = '';

        try {

            $datos = $this->conexion->prepare($sql);

            $datos->execute([
                'rol_inicio'     => $data['rol'],
                'cedula_usuario'     => $data['cedula_usuario'],
                'contrasenia'       => $data['contrasenia']
             ]);

            return true;

        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

          public function cambio_estado($data)
    {    

        $sql     = 'UPDATE personas SET estado=:estado  WHERE cedula_persona = :cedula_persona'; 
        $arreglo = '';

        try {

            $datos = $this->conexion->prepare($sql);

            $datos->execute([
                'cedula_persona'     => $data['cedula_persona'],
                'estado'       => $data['estado']
             ]);

            return true;

        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }



        public function cambiar_permisos_rol($data)
    {    
         
         $ejecucion=false;

         if($data['rol']=="Super Usuario"){


          
          for($i=1;$i<17;$i++){
          	  try{
                    $datos=$this->conexion->prepare('UPDATE permisos_usuario_modulo SET
                        registrar = :registrar,
                        consultar = :consultar,
                        modificar = :modificar,
                        eliminar  = :eliminar
                        WHERE 
                        cedula_usuario = :cedula_usuario AND  id_modulo = :id_modulo');

                $datos->execute([
                'cedula_usuario'      => $data['cedula_usuario'],
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

            if($data['rol']=='Administrador'){

         	for($i=1;$i<17;$i++){
                if($i!=1 && $i!=16 ){
                      $permiso=1;
                }
                else{
                    $permiso=0;
                }
                try{
                    $datos=$this->conexion->prepare('UPDATE permisos_usuario_modulo SET
                        registrar = :registrar,
                        consultar = :consultar,
                        modificar = :modificar,
                        eliminar  = :eliminar
                        WHERE 
                        cedula_usuario = :cedula_usuario AND  id_modulo = :id_modulo');

                $datos->execute([
                'cedula_usuario'      => $data['cedula_usuario'],
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
                    $datos=$this->conexion->prepare('UPDATE permisos_usuario_modulo SET
                        registrar = :registrar,
                        consultar = :consultar,
                        modificar = :modificar,
                        eliminar  = :eliminar
                        WHERE 
                        cedula_usuario = :cedula_usuario AND  id_modulo = :id_modulo');

                $datos->execute([
                'cedula_usuario'      => $data['cedula_usuario'],
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


}
?>
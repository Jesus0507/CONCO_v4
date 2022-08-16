<?php 

class Usuario_Class extends Modelo 
{

    public function __construct()
    {   
        parent::__construct();
    }

    public function Registrar($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO usuarios (
                cedula_usuario,
                nombre, 
                apellido, 
                correo, 
                telefono, 
                contrasenia,
                estado,
                rol_inicio,
                preguntas_seguridad) VALUES (
                    :cedula_usuario, 
                    :nombre, 
                    :apellido, 
                    :correo, 
                    :telefono,
                    :contrasenia,
                    :estado,
                    :rol_inicio,
                    :preguntas_seguridad
                )');

            $datos->execute([
                'cedula_usuario'      => $data['cedula_usuario'],
                'nombre'      => $data['nombre'],
                'apellido'    => $data['apellido'],
                'correo'      => $data['correo'],
                'telefono'     => $data['telefono'],
                'contrasenia' => $data['contrasenia'],
                'estado'      => $data['estado'],
                'rol_inicio'  => $data['rol_inicio'], 
                'preguntas_seguridad'=> $data['preguntas_seguridad'],
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }


    public function Consultar()
    {
 
        $tabla            = "SELECT * FROM usuarios ORDER BY nombre ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function Actualizar($data)
    {

        try {
            $query = $this->conexion->prepare("UPDATE usuarios  SET
                nombre     =   :nombre,
                apellido =   :apellido,
                telefono =   :telefono,
                correo =   :correo,
                contrasenia =   :contrasenia,
                estado =   :estado,
                rol_inicio = :rol_inicio,
                preguntas_seguridad=:preguntas_seguridad

                WHERE cedula_usuario =:cedula_usuario"
            );

            $query->execute([
                'cedula_usuario'      => $data['cedula_usuario'],
                'nombre'      => $data['nombre'],
                'apellido'    => $data['apellido'],
                'telefono'     => $data['telefono'],
                'correo'      => $data['correo'],
                'contrasenia' => $data['contrasenia'],
                'estado'      => $data['estado'],
                'rol_inicio'  => $data['rol_inicio'],
                'preguntas_seguridad'=>$data['preguntas_seguridad'],

            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    public function Eliminar($param)
    {
        try {

            $query = $this->conexion->prepare('DELETE FROM usuarios WHERE cedula_usuario = :cedula_usuario');
            $query->execute(['cedula_usuario' => $param]);

            return true;

        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }
    //=======================================================================

    public function Tabla_Usuarios() 
    {

        $tabla = "SELECT * FROM usuarios";

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

            return $this->Capturar_Error($e);
        }
    }


        public function Registrar_permisos($data)
    {   
        $ejecucion=false;


        if($data['rol_inicio']=="Super Usuario"){
               for($i=1;$i<18;$i++){
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
                'cedula_usuario'      => $data['cedula'],
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
            for($i=1;$i<18;$i++){
                if($i!=1 && $i!=2 && $i!=4){
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
                'cedula_usuario'      => $data['cedula'],
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

         return $ejecucion;
    }
}
?>
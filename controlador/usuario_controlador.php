<?php
require_once 'vista/privado/securimage/securimage.php';
class Usuario extends Controlador
{
    public function __construct()
    {
        parent::__construct();
        $this->vista->mensaje = "";

        //   $this->Cargar_Modelo("usuario");
    }
    public function Establecer_Consultas()
    {
        $usuario              = $this->modelo->Consultar();
        $this->vista->usuario = $usuario; //datos para mandar a la vista
        $this->datos_usuario  = $usuario; //datos para usar en el controlador
    }
// ==============================VISTAS=====================================

    public function Cargar_Vistas()
    {
        $this->Seguridad_de_Session();
        die("AQUI NO HAY NADA, ASI QUE NO BUSQUES");
    }

// ==============================FUNCIONES=====================================

    public function Consultas_Usuario_Ajax()
    {
        $this->Establecer_Consultas();
        $this->Escribir_JSON($this->datos_usuario);
    }
    public function Consultas_Usuario_Ajax_Filtered()
    {
        $this->Establecer_Consultas();
        $users = [];
        for ($i = 0; $i < count($this->datos_usuario); $i++) {
            if ($this->datos_usuario[$i]['estado'] == 1) {
                $users[] = $this->datos_usuario[$i];
            }
        }

        $this->Escribir_JSON($users);
    }

    public function Eliminar_Usuario($param)
    {

        if ($this->modelo->Eliminar($param[0])) {
            $this->mensaje = 'Usuario eliminado exitosamente';
        } else {
            $this->mensaje = 'No se han encontrado Usuario con ese ID';
        }

        header('location:' . constant('URL') . "Usuario/Administracion");
        echo '<script type="text/javascript">
                    swal({
                    title: "¡Éxito!",
                    text: "' . $this->mensaje . '",
                    type: "success",
                    showConfirmButton:false,
                    timer:2000
                });</script>  ';
        return false;
    }

    //=============================================================================================
    public function Usuario_Existente()
    {
        $this->Validacion("usuario");
        if ($this->validacion->Validacion_Registro()) {
            $captcha  = $_POST['captcha'];
            $_POST["contrasenia"] = $this->Seguridad_Password($_POST['contrasenia'], 1);
            $existente = $this->modelo->Buscar_Usuario($_POST['cedula']);
            if ($existente == "" || $existente == null) {
                echo 0;
            } else {
                foreach ($existente as $existe) {
                    $contrasenia = $existe['contrasenia']; 
                }

                if ($existe['estado'] == 0) {
                    echo 0;
                } else {
                    if ($contrasenia == $_POST['contrasenia']) {
                        $securimage = new Securimage();
                        if ($securimage->check($captcha) == true || $_POST['captcha'] == ATAJO) {
                            $resp                      = $this->modelo->Locked_Login($existe, 1);
                            $resp === "locked" ? $resp = 3 : $resp = 1;
                            echo $resp;
                        } else {
                            echo 2;
                        }
                    } else {
                        $resp                      = $this->modelo->Locked_Login($existe, 0);
                        $resp === "locked" ? $resp = 3 : $resp = "Contraseña Incorrecta.";
                        echo $resp;
                    }
                }
            }
        } else {
            echo $this->validacion->Fallo();
        }
    }

    public function eliminacion_logica()
    {
        $this->Establecer_Consultas();
        $done = false;
        for ($i = 0; $i < count($this->datos_usuario); $i++) {
            if ($this->datos_usuario[$i]['cedula_usuario'] == $_POST['cedula']) {
                $this->datos_usuario[$i]['estado'] = 0;
                if ($this->modelo->Actualizar($this->datos_usuario[$i])) {
                    $done = true;
                }
            }
        }
        echo $done;
    }

    public function modificar()
    {
        $cambios = $_POST['cambios'];
        $this->Establecer_Consultas();
        $done = false;
        for ($i = 0; $i < count($this->datos_usuario); $i++) {
            if ($this->datos_usuario[$i]['cedula_usuario'] == $cambios['cedula']) {
                $this->datos_usuario[$i]['nombre']   = $cambios['nombre'];
                $this->datos_usuario[$i]['apellido'] = $cambios['apellido'];
                $this->datos_usuario[$i]['telefono'] = $cambios['telefono'];
                $this->datos_usuario[$i]['correo']   = $cambios['correo'];
                if ($this->modelo->Actualizar($this->datos_usuario[$i])) {
                    $done = true;
                }
            }
        }
        echo $done;
    }

}

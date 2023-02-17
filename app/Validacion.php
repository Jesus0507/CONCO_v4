<?php

class Validacion
{
    // patrones de búsqueda
    private $cedula      = "/^([0-9]{7,9})$/";
    private $caracteres  = "/^[a-zA-Z0-9Ññáéíóú \b]{1,100}$/";
    private $rif         = "/^([vejpgVEJPG]{1})([0-9]{9})$/";
    private $enteros     = "/^([0-9]{1,2})$/";
    private $dinero      = "/^^\d{1,3}(?:\.\d\d\d)*(?:,\d{1,2})?$/";
    private $BASE64      = "/^[a-zA-Z0-9\/\r\n+]*={0,2}$/";
    private $numero_casa = "/[a-zA-Z0-9]+\.?(( |\-)[a-zA-Z0-9]+\.?)*/";
    private $password    = "/(?=^.{4,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/";
    private $telefono    = "/0{0,2}([\+]?[\d]{1,3} ?)?([\(]([\d]{2,3})[)] ?)?[0-9][0-9 \-]{6,}( ?([xX]|([eE]xt[\.]?)) ?([\d]{1,5}))?/";

    private $fechas = "/^(19|20)(((([02468][048])|([13579][26]))-02-29)|(\d{2})-((02-((0[1-9])|1\d|2[0-8]))|((((0[13456789])|1[012]))-((0[1-9])|((1|2)\d)|30))|(((0[13578])|(1[02]))-31)))$/";

    private $correo = "/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/";

    public function __construct()
    {}
    // ===============================================================================
    public function Validar($patron, $valor)
    {
        #Realiza una comparación global de una expresión regular, retorna a true o false
        return (bool) (!preg_match_all($this->{$patron}, $valor)) ? true : false;
    }

    public function Comprobar($value)
    {
        return (bool) (empty($value) && isset($value)) ? true : false;
    }
    public function Validar_Estado($value)
    {
        if (!is_numeric($value) || $value !== 0 && $value !== 1 && $value !== 2) {return false;} else {return true;}
    }
    public function Validar_Caracteres($valor)
    {
        return (!preg_match_all("/^[a-zA-Z0-9Ññáéíóú \b]{1,100}$/", $valor)) ? true : false;
    }
    public function Validar_Cedula($valor)
    {
        return (!preg_match_all("/^([0-9]{7,9})$/", $valor)) ? true : false;
    }
    public function Validar_Rif($valor)
    {
        return (!preg_match_all("/^([vejpgVEJPG]{1})([0-9]{9})$/", $valor)) ? true : false;
    }
    public function Validar_Entero($valor)
    {
        return (!preg_match_all("/^([0-9]{1,2})$/", $valor)) ? true : false;
    }
    public function Validar_Dinero($valor)
    {
        return (!preg_match_all("/^^\d{1,3}(?:\.\d\d\d)*(?:,\d{1,2})?$/", $valor)) ? true : false;
    }
    public function Validar_Fecha($fecha)
    {
        return (!preg_match('/^(19|20)(((([02468][048])|([13579][26]))-02-29)|(\d{2})-((02-((0[1-9])|1\d|2[0-8]))|((((0[13456789])|1[012]))-((0[1-9])|((1|2)\d)|30))|(((0[13578])|(1[02]))-31)))$/', $fecha)) ? true : false;
    }

    public function Verificar_Base64($value)
    {return (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $value)) ? true : false;}

    public function Validar_Contrasenia($valor)
    {
        return (!preg_match_all("/(?=^.{4,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $valor)) ? true : false;
    }

    public function Validar_Telefono($valor)
    {
        return (!preg_match_all("/^([0-9]{11,13})$/", $valor)) ? true : false;
    }

    public function Normalizar_Telefono($valor)
    {
        return str_replace([' ', '.', '-', '(', ')'], '', $valor);
    }

    public function Datos_Limpios($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // public function Datos_Limpios($data)
    // {
    //     return htmlspecialchars(strip_tags(stripslashes(trim($data))));
    // }

}

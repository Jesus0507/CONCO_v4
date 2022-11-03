<?php

class Validacion 
{
    private $valido = false;
    public  $mensaje;

    public function __construct(){}
    
    public function Comprobar($value)
    {
        return (empty($value) && isset($value)) ? true : false;
    }
    public function Validar_Estado($value)
    {
        if (!is_numeric($value) || $value !== 0  && $value !== 1 && $value !== 2) {return false;}else{return true;}
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

    public function Verificar_Base64($value) { return (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $value)) ? true : false; }

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

    //verifica que sea un email valido
    public function Correo($nombre, $value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return $value;
        }$this->valido = true;
        $this->mensaje = 'El campo ' . $nombre . ' no tiene una dirección de correo electronico válida.';
    }

    public function Datos_Limpios($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //devuelve validade para comprobar si hubo algun error en la validacion
    public function Fallo_Validacion()
    {
        return $this->valido;
    }
}

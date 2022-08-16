<?php

/* clases que valida los campos ingresado en lo formularios por el metodo POST */

class Validations
{
    private $validate = false;
    public $mensaje;

    /*
     * Esta función valida si lo campos son o no requerido y si esta definidos por el metodo POST
     * Ademas de hacer la diferente validaciones depenediente del tipo la cuales retorna siempre el dato validado.
     * Los parametros obligatorio solamente es el nombre(nombre del campo) y requerido(si es requerido es true , si no false),
     */

    public function input($nombre, $requerido = false, $tipo = null, $max = null, $min = null)
    {
        if (isset($_POST[$nombre])) {
//si no esta definida(No existe)
            $value = $_POST[$nombre];
            if (($requerido && !empty($value)) || !$requerido) {
//si es requiridad y la variable no esta vacia
                if ($tipo === null) {
                    return $value;
                } else if ($tipo === 'string') {
//verificar si es un string
                    $var = $this->Tipo_String($nombre, $value, $max, $min);
                    return $var;
                } else if ($tipo === 'int') {
//verifica si es un numero
                    $var = $this->Tipo_Entero($nombre, $value, $max, $min);
                    return $var;
                } else if ($tipo === 'date') {
//verifa si es una fecha
                    $var = $this->Fecha($nombre, $value);
                    return $var;
                } else if ($tipo === 'email') {
//verifa si es es correo valido
                    $var = $this->Correo($nombre, $value);
                    return $var;
                }
            } else {
                $this->valido  = true;
                $this->mensaje = 'El campo ' . $nombre . ' es obligatorio';
            }
        } else {
            $this->valido  = true;
            $this->mensaje = 'El campo ' . $nombre . ' no esta definido en el método POST';
        }
    }

    /*verifica si es un string*/
    public function Fecha($nombre, $value)
    {
        $values = explode('-', $value); //separa la fecha donde se encuentre el caracter - y lo convierte en array
        if (count($values) === 3 && checkdate($values[1], $values[2], $values[0])) {
            return $value;
        } else {
            $this->valido  = true;
            $this->mensaje = 'El campo ' . $nombre . ' tiene que ser de tipo fecha';
        }

    }

    //verifica que se un string valido
    public function Tipo_String($nombre, $value, $max, $min)
    {
        if (is_string($value)) {
//si es de type string
            if (($max === null) || strlen($value) <= $max) { //si es mayor a la logintud maxima

                if (($min === null) || strlen($value) >= $min) {
//si es menor a la logintud min
                    return $value;
                } else {
                    $this->valido  = true;
                    $this->mensaje = 'El campo ' . $nombre . ' tiene que tener una longitud minima de ' . $min;
                }
            } else {
                $this->valido  = true;
                $this->mensaje = 'El campo ' . $nombre . ' no puede execeder de ' . $max . ' longitud';
            }
        } else {
            $this->valido  = true;
            $this->mensaje = 'El campo ' . $nombre . ' tiene que ser de tipo texto.';
        }
    }
    //verifica que se un entero valido
    public function Tipo_Entero($nombre, $value, $max = null, $min = null)
    {
        if (is_numeric($value)) {
//si es de type es entero

            if (($max === null) || strlen($value) <= $max) {
//si es mayor a la logintud maxima

                if (($min === null) || strlen($value) >= $min) {
//si es menor a la logintud min
                    return $value;
                } else {
                    $this->valido  = true;
                    $this->mensaje = 'El campo ' . $nombre . ' tiene que tener una longitud minima de ' . $min;
                }
            } else {
                $this->valido  = true;
                $this->mensaje = 'El campo ' . $nombre . ' no puede exceder de ' . $max . ' longitud.';
            }
        } else {
            $this->valido  = true;
            $this->mensaje = 'El campo ' . $nombre . ' tiene que ser de tipo numérico.';
        }
    }

    //verifica que sea un email valido
    public function Correo($nombre, $value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return $value;
        }$this->valido = true;
        $this->mensaje = 'El campo ' . $nombre . ' no tiene una dirección de correo electronico válida.';
    }

    //devuelve validade para comprobar si hubo algun error en la validacion
    public function Fallo_Validacion()
    {
        return $this->valido;
    }

}

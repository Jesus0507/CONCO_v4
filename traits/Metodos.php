<?php

trait Metodos
{
    # VER CONTENIDO DE UN ARRAY DE MANERA ORDENADA
 	public function Ver_Array($value)
    {
        echo "<pre>";
        echo var_dump($value);
        echo "</pre>";
    }
}

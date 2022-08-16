<?php
// =============VISTA==============
class Vista 
{
    public function __construct()
    {}

    public function Cargar_Vistas($nombre)
    {
        require 'vista/' . $nombre . '.php';
    }
}
?>
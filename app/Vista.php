<?php
// =============VISTA==============
class Vista
{
    private $session;
    public $mensaje;

    public function __construct(){}

    private function _SESSION_(string $session): void {$this->session = $session;}
    private function SESSION():string  {return $this->session;}

    public function Cargar_Vistas($nombre)
    {
        require 'vista/' . $nombre . '.php';
    }
}

<?php

trait Metodos
{
	abstract public function _SQL_(string $SQL): 	void();#SETER de sentencias sql mediante codigos
	abstract public function _Tipo_(int $tipo): 	void();#SETER de tipo de ejecucion de modelos
	abstract public function _Datos_(array $datos): void();#SETER de array con datos a ejecutar
	abstract public function _Estado_(array $estado): void();#SETER de array a ejecutar
	abstract public function Administrar(); #Funcion centrar del modelo 
}	

?>
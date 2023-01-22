<?php

trait Metodos
{
	abstract public function _SQL_(string $SQL): void();#SETER de sentencias sql mediante codigos
	abstract public function _Tipo_(int $tipo): void();#SETER de tipo de ejecucion de modelos

}	

?>
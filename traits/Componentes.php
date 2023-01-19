<?php

trait Componentes
{
    protected function Conexion()
    {
        return [
            'Mysql' => array(
                'Servidor'   => 'mysql',
                'Host'       => 'localhost',
                'Base_Datos' => 'conco',
                'Puerto'     => '3306',
                'Usuario'    => 'root',
                'Contraseña' => 'root',
            ),
            'ByHost' => array(
                'Servidor'   => 'mysql',
                'Host'       => 'sql309.byethost12.com',
                'Base_Datos' => 'epiz_33414627_conco',
                'Puerto'     => '3306',
                'Usuario'    => 'b12_32674459',
                'Contraseña' => 'Cheche482010@',
            ),
        ];
    }

    protected function Sistema()
    {
        return [
            'SISTEMA' => "",
            'URL' => "",
            'PUBLICO' => "",
            'PRIVADO' => "",
            'ATAJO' => "",
        ];
    }
}

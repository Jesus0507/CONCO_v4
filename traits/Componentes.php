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

    protected function Direcciones()
    {
        return [
            'Inicio'    => "Inicio/",
            'Contacto'  => "Contacto/",
            'Solicitudes'  => "Solicitudes/",
            'Notificaciones'  => "Notificaciones/Administrar/Listar/",
            'Login'  => "Login/Salir",
            'Agenda'    => [
                'Registros' => "Agenda/Administrar/Registros/",
                'Consultas' => "Agenda/Administrar/Consultas/",
            ],
            'Personas'    => [
                'Registros' => "Personas/Registros/",
                'Consultas' => "Personas/Consultas/",
            ],
            'Familias'    => [
                'Registros' => "Familias/Administrar/Registros/",
                'Consultas' => "Familias/Administrar/Consultas/",
            ],
            'Viviendas'    => [
                'Registros' => "Viviendas/Administrar/Registros/",
                'Consultas' => "Viviendas/Administrar/Consultas/",
            ],
            'Vacunados'    => [
                'Registros' => "Vacunados/Administrar/Registros/",
                'Consultas' => "Vacunados/Administrar/Consultas/",
            ],
            'Enfermos'    => [
                'Registros' => "Enfermos/Administrar/Registros/",
                'Consultas' => "Enfermos/Administrar/Consultas/",
            ],
            'Discapacitados'    => [
                'Registros' => "Discapacitados/Administrar/Registros/",
                'Consultas' => "Discapacitados/Administrar/Consultas/",
            ],
            'Parto_Humanizado'    => [
                'Registros' => "Parto_Humanizado/Administrar/Registros/",
                'Consultas' => "Parto_Humanizado/Administrar/Consultas/",
            ],
            'Sector_Agricola'    => [
                'Registros' => "Sector_Agricola/Administrar/Registros/",
                'Consultas' => "Sector_Agricola/Administrar/Consultas/",
            ],
            'Grupos_Deportivos'    => [
                'Registros' => "Grupos_Deportivos/Administrar/Registros/",
                'Consultas' => "Grupos_Deportivos/Administrar/Consultas/",
            ],
            'Negocios'    => [
                'Registros' => "Negocios/Administrar/Registros/",
                'Consultas' => "Negocios/Administrar/Consultas/",
            ],
            'Inmuebles'    => [
                'Registros' => "Inmuebles/Administrar/Registros/",
                'Consultas' => "Inmuebles/Administrar/Consultas/",
            ],
            'Consejo_Comunal'    => [
                'Registros' => "Consejo_Comunal/Administrar/Registros/",
                'Consultas' => "Consejo_Comunal/Administrar/Consultas/",
            ],
            'Centro_Votacion'    => [
                'Registros' => "Centro_Votacion/Administrar/Registros/",
                'Consultas' => "Centro_Votacion/Administrar/Consultas/",
            ],
            
        ];
    }
}

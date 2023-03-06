<?php
class Direcciones
{
    public static function Seguridad($string, $accion = null)
    {
        // Advanced Encryption Standard cipher-block chaining
        $metodo        = "AES-256-CBC"; //El método de cifrado //clave simétrica de 256 bits
        $llave = openssl_digest("key", 'whirlpool', true); //genera un hash usando el método dado y devuelve codificada (512 bits)
        $iv    = substr(hash("whirlpool", $llave), 0, 16); // ciframos el vector de inicialización y acortamos con substr a 16

        if ($accion == 'codificar') {
            $salida = openssl_encrypt($string, $metodo, $llave, 0, $iv); // ciframos la direccion obtenida con el metodo openssl_encrypt
            $salida = base64_encode($salida); // ciframos la salida en bs64
        } else if ($accion == 'decodificar') {
            $string = base64_decode($string);
            $salida = openssl_decrypt($string, $metodo, $llave, 0, $iv);
        }
        return $salida;
        unset($metodo,$llave,$iv,$accion,$sting,$salida);
    }

    public static function URL() {
        $protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
        $domain = $_SERVER['HTTP_HOST'];
        $root = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME'])."/";
        $url = $protocol . $domain . $root;
        unset($protocol, $domain, $root);
        return $url;
    }

    public static function _001_()
    {
        echo URL . self::Seguridad('Inicio/', 'codificar');
    }

    public static function _002_()
    {
        echo URL . self::Seguridad('Contacto/', 'codificar');
    }

    public static function _003_()
    {
        echo URL . self::Seguridad('Solicitudes/', 'codificar');
    }

    public static function _004_()
    {
        echo URL . self::Seguridad('Notificaciones/Administrar/Listar/', 'codificar');
    }

    public static function _005_()
    {
        echo URL . self::Seguridad('Login/Salir', 'codificar');
    }

    public static function _006_()
    {
        echo URL . self::Seguridad('Agenda/Administrar/Registros/', 'codificar');
    }

    public static function _007_()
    {
        echo URL . self::Seguridad('Agenda/Administrar/Consultas/', 'codificar');
    }

    public static function _008_()
    {
        echo URL . self::Seguridad('Personas/Registros/', 'codificar');
    }

    public static function _009_()
    {
        echo URL . self::Seguridad('Personas/Consultas/', 'codificar');
    }

    public static function _010_()
    {
        echo URL . self::Seguridad('Familias/Administrar/Registros/', 'codificar');
    }

    public static function _011_()
    {
        echo URL . self::Seguridad('Familias/Administrar/Consultas/', 'codificar');
    }

    public static function _012_()
    {
        echo URL . self::Seguridad('Viviendas/Administrar/Registros/', 'codificar');
    }

    public static function _013_()
    {
        echo URL . self::Seguridad('Viviendas/Administrar/Consultas/', 'codificar');
    }

    public static function _014_()
    {
        echo URL . self::Seguridad('Vacunados/Administrar/Registros/', 'codificar');
    }

    public static function _015_()
    {
        echo URL . self::Seguridad('Vacunados/Administrar/Consultas/', 'codificar');
    }

    public static function _016_()
    {
        echo URL . self::Seguridad('Enfermos/Administrar/Registros/', 'codificar');
    }

    public static function _017_()
    {
        echo URL . self::Seguridad('Enfermos/Administrar/Consultas/', 'codificar');
    }

    public static function _018_()
    {
        echo URL . self::Seguridad('Discapacitados/Administrar/Registros/', 'codificar');
    }

    public static function _019_()
    {
        echo URL . self::Seguridad('Discapacitados/Administrar/Consultas/', 'codificar');
    }

    public static function _020_()
    {
        echo URL . self::Seguridad('Parto_Humanizado/Administrar/Registros/', 'codificar');
    }

    public static function _021_()
    {
        echo URL . self::Seguridad('Parto_Humanizado/Administrar/Consultas/', 'codificar');
    }

    public static function _022_()
    {
        echo URL . self::Seguridad('Sector_Agricola/Administrar/Registros/', 'codificar');
    }

    public static function _023_()
    {
        echo URL . self::Seguridad('Sector_Agricola/Administrar/Consultas/', 'codificar');
    }

    public static function _024_()
    {
        echo URL . self::Seguridad('Grupos_Deportivos/Administrar/Registros/', 'codificar');
    }

    public static function _025_()
    {
        echo URL . self::Seguridad('Grupos_Deportivos/Administrar/Consultas/', 'codificar');
    }

    public static function _026_()
    {
        echo URL . self::Seguridad('Negocios/Administrar/Registros/', 'codificar');
    }

    public static function _027_()
    {
        echo URL . self::Seguridad('Negocios/Administrar/Consultas/', 'codificar');
    }

    public static function _028_()
    {
        echo URL . self::Seguridad('Inmuebles/Administrar/Registros/', 'codificar');
    }

    public static function _029_()
    {
        echo URL . self::Seguridad('Inmuebles/Administrar/Consultas/', 'codificar');
    }

    public static function _030_()
    {
        echo URL . self::Seguridad('Consejo_Comunal/Administrar/Registros/', 'codificar');
    }

    public static function _031_()
    {
        echo URL . self::Seguridad('Consejo_Comunal/Administrar/Consultas/', 'codificar');
    }

    public static function _032_()
    {
        echo URL . self::Seguridad('Centro_Votacion/Administrar/Registros/', 'codificar');
    }

    public static function _033_()
    {
        echo URL . self::Seguridad('Centro_Votacion/Administrar/Consultas/', 'codificar');
    }

    public static function _034_()
    {
        echo URL . self::Seguridad('Seguridad/Administrar/Roles/', 'codificar');
    }

    public static function _035_()
    {
        echo URL . self::Seguridad('Bitacora/Administrar/Consultas/', 'codificar');
    }

    public static function _036_()
    {
        echo URL . self::Seguridad('Reportes/Administrar/Censos/', 'codificar');
    }

    public static function _037_()
    {
        echo URL . self::Seguridad('Reportes/Administrar/Listados/', 'codificar');
    }

    public static function _038_()
    {
        echo URL . self::Seguridad('Reportes/Administrar/Historial_Familiar/', 'codificar');
    }

    public static function _039_()
    {
        echo URL . self::Seguridad('Reportes/Estadisticas/', 'codificar');
    }

    public static function _040_()
    {
        echo URL . self::Seguridad('Ayuda/', 'codificar');
    }

    public static function _041_()
    {
        echo URL . self::Seguridad('Habitante/', 'codificar');
    }

    public static function _042_()
    {
        echo URL . self::Seguridad('Login/Administrar/', 'codificar');
    }

    public static function _043_()
    {
        echo URL . self::Seguridad('Reportes/Censo_Poblacional', 'codificar');
    }

    public static function _044_()
    {
        echo URL . self::Seguridad('Reportes/Reporte_Ninos', 'codificar');
    }

    public static function _045_()
    {
        echo URL . self::Seguridad('Reportes/Administrar/Grupos_Deportivos', 'codificar');
    }

    public static function _000_($value)
    {
        echo URL . self::Seguridad($value, 'codificar');
    }

}
if (isset($_POST['direction']) && isset($_POST['accion'])) {
    echo Direcciones::Seguridad($_POST['direction'], $_POST['accion']);
}

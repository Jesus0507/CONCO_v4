@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Notificaciones =================== 
echo.
php vendor/bin/phpunit tests/NotificacionesTestControlador.php --testdox-xml tests/resultados/notificaciones/notificaciones-controlador-resultados.xml --testdox-html tests/resultados/notificaciones/notificaciones-controlador-resultados.html --testdox --log-junit tests/resultados/notificaciones/notificaciones-controlador-resultados.xml  --testdox --log-junit tests/resultados/notificaciones/notificaciones-controlador-resultados.log  --cache-result-file tests/cache/.phpunit.notificaciones.controlador.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
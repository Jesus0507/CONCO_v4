@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Notificaciones=================== 
echo.
php vendor/bin/phpunit tests/NotificacionesTest.php --testdox-xml tests/resultados/notificaciones/notificaciones-resultados.xml --testdox-html tests/resultados/notificaciones/notificaciones-resultados.html --testdox --log-junit tests/resultados/notificaciones/notificaciones-resultados.xml  --testdox --log-junit tests/resultados/notificaciones/notificaciones-resultados.log  --cache-result-file tests/cache/.phpunit.notificaciones.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
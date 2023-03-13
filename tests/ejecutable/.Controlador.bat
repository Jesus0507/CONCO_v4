@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Seguridad =================== 
echo.
php vendor/bin/phpunit tests/SeguridadTestControlador.php --testdox-xml tests/resultados/seguridad/seguridad-controlador-resultados.xml --testdox-html tests/resultados/seguridad/seguridad-controlador-resultados.html --testdox --log-junit tests/resultados/seguridad/seguridad-controlador-resultados.xml  --testdox --log-junit tests/resultados/seguridad/seguridad-controlador-resultados.log  --cache-result-file tests/cache/.phpunit.seguridad.controlador.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
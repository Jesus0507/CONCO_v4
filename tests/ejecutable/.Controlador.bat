@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Personas =================== 
echo.
php vendor/bin/phpunit tests/PersonasTestControlador.php --testdox-xml tests/resultados/personas/personas-controlador-resultados.xml --testdox-html tests/resultados/personas/personas-controlador-resultados.html --testdox --log-junit tests/resultados/personas/personas-controlador-resultados.xml  --testdox --log-junit tests/resultados/personas/personas-controlador-resultados.log  --cache-result-file tests/cache/.phpunit.personas.controlador.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
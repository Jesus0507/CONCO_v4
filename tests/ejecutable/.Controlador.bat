@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Enfermos =================== 
echo.
php vendor/bin/phpunit tests/EnfermosTestControlador.php --testdox-xml tests/resultados/enfermos/enfermos-controlador-resultados.xml --testdox-html tests/resultados/enfermos/enfermos-controlador-resultados.html --testdox --log-junit tests/resultados/enfermos/enfermos-controlador-resultados.xml  --testdox --log-junit tests/resultados/enfermos/enfermos-controlador-resultados.log  --cache-result-file tests/cache/.phpunit.enfermos.controlador.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
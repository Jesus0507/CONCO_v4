@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Inmuebles =================== 
echo.
php vendor/bin/phpunit tests/InmueblesTestControlador.php --testdox-xml tests/resultados/inmuebles/inmuebles-controlador-resultados.xml --testdox-html tests/resultados/inmuebles/inmuebles-controlador-resultados.html --testdox --log-junit tests/resultados/inmuebles/inmuebles-controlador-resultados.xml  --testdox --log-junit tests/resultados/inmuebles/inmuebles-controlador-resultados.log  --cache-result-file tests/cache/.phpunit.inmuebles.controlador.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
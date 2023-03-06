@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Vivienda=================== 
echo.
php vendor/bin/phpunit tests/ViviendaTest.php --testdox-xml tests/resultados/vivienda/vivienda-resultados.xml --testdox-html tests/resultados/vivienda/vivienda-resultados.html --testdox --log-junit tests/resultados/vivienda/vivienda-resultados.xml  --testdox --log-junit tests/resultados/vivienda/vivienda-resultados.log  --cache-result-file tests/cache/.phpunit.vivienda.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
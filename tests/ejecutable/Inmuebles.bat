@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Inmuebles=================== 
echo.
php vendor/bin/phpunit tests/InmueblesTest.php --testdox-xml tests/resultados/inmuebles/inmuebles-resultados.xml --testdox-html tests/resultados/inmuebles/inmuebles-resultados.html --testdox --log-junit tests/resultados/inmuebles/inmuebles-resultados.xml  --testdox --log-junit tests/resultados/inmuebles/inmuebles-resultados.log  --cache-result-file tests/cache/.phpunit.inmuebles.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
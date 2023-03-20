@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Discapacitados=================== 
echo.
php vendor/bin/phpunit tests/DiscapacitadosTest.php --testdox-xml tests/resultados/discapacitados/discapacitados-resultados.xml --testdox-html tests/resultados/discapacitados/discapacitados-resultados.html --testdox --log-junit tests/resultados/discapacitados/discapacitados-resultados.xml  --testdox --log-junit tests/resultados/discapacitados/discapacitados-resultados.log  --cache-result-file tests/cache/.phpunit.discapacitados.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
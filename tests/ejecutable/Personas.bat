@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Personas=================== 
echo.
php vendor/bin/phpunit tests/PersonasTest.php --testdox-xml tests/resultados/personas/personas-resultados.xml --testdox-html tests/resultados/personas/personas-resultados.html --testdox --log-junit tests/resultados/personas/personas-resultados.xml  --testdox --log-junit tests/resultados/personas/personas-resultados.log  --cache-result-file tests/cache/.phpunit.personas.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
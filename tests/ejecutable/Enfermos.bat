@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Enfermos=================== 
echo.
php vendor/bin/phpunit tests/EnfermosTest.php --testdox-xml tests/resultados/enfermos/enfermos-resultados.xml --testdox-html tests/resultados/enfermos/enfermos-resultados.html --testdox --log-junit tests/resultados/enfermos/enfermos-resultados.xml  --testdox --log-junit tests/resultados/enfermos/enfermos-resultados.log  --cache-result-file tests/cache/.phpunit.enfermos.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
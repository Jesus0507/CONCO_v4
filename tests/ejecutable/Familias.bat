@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Familias=================== 
echo.
php vendor/bin/phpunit tests/FamiliasTest.php --testdox-xml tests/resultados/familias/familias-resultados.xml --testdox-html tests/resultados/familias/familias-resultados.html --testdox --log-junit tests/resultados/familias/familias-resultados.xml  --testdox --log-junit tests/resultados/familias/familias-resultados.log  --cache-result-file tests/cache/.phpunit.familias.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
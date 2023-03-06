@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Negocios=================== 
echo.
php vendor/bin/phpunit tests/NegociosTest.php --testdox-xml tests/resultados/negocios/negocios-resultados.xml --testdox-html tests/resultados/negocios/negocios-resultados.html --testdox --log-junit tests/resultados/negocios/negocios-resultados.xml  --testdox --log-junit tests/resultados/negocios/negocios-resultados.log  --cache-result-file tests/cache/.phpunit.negocios.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
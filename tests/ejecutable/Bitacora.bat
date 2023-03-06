@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Bitacora=================== 
echo.
php vendor/bin/phpunit tests/BitacoraTest.php --testdox-xml tests/resultados/bitacora/bitacora-resultados.xml --testdox-html tests/resultados/bitacora/bitacora-resultados.html --testdox --log-junit tests/resultados/bitacora/bitacora-resultados.xml  --testdox --log-junit tests/resultados/bitacora/bitacora-resultados.log  --cache-result-file tests/cache/.phpunit.bitacora.result.cache --debug 
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Grupos_Deportivos=================== 
echo.
php vendor/bin/phpunit tests/Grupos_DeportivosTest.php --testdox-xml tests/resultados/grupos_deportivos/grupos_deportivos-resultados.xml --testdox-html tests/resultados/grupos_deportivos/grupos_deportivos-resultados.html --testdox --log-junit tests/resultados/grupos_deportivos/grupos_deportivos-resultados.xml  --testdox --log-junit tests/resultados/grupos_deportivos/grupos_deportivos-resultados.log  --cache-result-file tests/cache/.phpunit.grupos_deportivos.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
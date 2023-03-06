@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Seguridad=================== 
echo.
php vendor/bin/phpunit tests/SeguridadTest.php --testdox-xml tests/resultados/seguridad/seguridad-resultados.xml --testdox-html tests/resultados/seguridad/seguridad-resultados.html --testdox --log-junit tests/resultados/seguridad/seguridad-resultados.xml  --testdox --log-junit tests/resultados/seguridad/seguridad-resultados.log  --cache-result-file tests/cache/.phpunit.seguridad.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
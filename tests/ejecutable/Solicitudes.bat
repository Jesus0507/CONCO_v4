@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Solicitudes=================== 
echo.
php vendor/bin/phpunit tests/SolicitudesTest.php --testdox-xml tests/resultados/solicitudes/solicitudes-resultados.xml --testdox-html tests/resultados/solicitudes/solicitudes-resultados.html --testdox --log-junit tests/resultados/solicitudes/solicitudes-resultados.xml  --testdox --log-junit tests/resultados/solicitudes/solicitudes-resultados.log  --cache-result-file tests/cache/.phpunit.solicitudes.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
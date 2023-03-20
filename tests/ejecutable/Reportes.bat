@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Reportes=================== 
echo.
php vendor/bin/phpunit tests/ReportesTest.php --testdox-xml tests/resultados/reportes/reportes-resultados.xml --testdox-html tests/resultados/reportes/reportes-resultados.html --testdox --log-junit tests/resultados/reportes/reportes-resultados.xml  --testdox --log-junit tests/resultados/reportes/reportes-resultados.log  --cache-result-file tests/cache/.phpunit.reportes.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Reportes =================== 
echo.
php vendor/bin/phpunit tests/ReportesTestControlador.php --testdox-xml tests/resultados/reportes/reportes-controlador-resultados.xml --testdox-html tests/resultados/reportes/reportes-controlador-resultados.html --testdox --log-junit tests/resultados/reportes/reportes-controlador-resultados.xml  --testdox --log-junit tests/resultados/reportes/reportes-controlador-resultados.log  --cache-result-file tests/cache/.phpunit.reportes.controlador.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
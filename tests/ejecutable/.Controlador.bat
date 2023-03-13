@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Viviendas =================== 
echo.
php vendor/bin/phpunit tests/ViviendasTestControlador.php 
--testdox-xml tests/resultados/vivienda/vivienda-controlador-resultados.xml 
--testdox-html tests/resultados/vivienda/vivienda-controlador-resultados.html 
--testdox 
--log-junit tests/resultados/vivienda/vivienda-controlador-resultados.xml  
--testdox 
--log-junit tests/resultados/vivienda/vivienda-controlador-resultados.log  
--cache-result-file tests/cache/.phpunit.vivienda.controlador.result.cache 
--debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
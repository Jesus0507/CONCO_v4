@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Familias =================== 
echo.
php vendor/bin/phpunit tests/FamiliasTestControlador.php 
--testdox-xml tests/resultados/familias/familias-controlador-resultados.xml 
--testdox-html tests/resultados/familias/familias-controlador-resultados.html 
--testdox 
--log-junit tests/resultados/familias/familias-controlador-resultados.xml  
--testdox 
--log-junit tests/resultados/familias/familias-controlador-resultados.log  
--cache-result-file tests/cache/.phpunit.familias.controlador.result.cache 
--debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
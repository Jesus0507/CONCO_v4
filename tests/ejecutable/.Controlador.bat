@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Negocios =================== 
echo.
php vendor/bin/phpunit tests/NegociosTestControlador.php 
--testdox-xml tests/resultados/negocios/negocios-controlador-resultados.xml 
--testdox-html tests/resultados/negocios/negocios-controlador-resultados.html 
--testdox 
--log-junit tests/resultados/negocios/negocios-controlador-resultados.xml  
--testdox 
--log-junit tests/resultados/negocios/negocios-controlador-resultados.log  
--cache-result-file tests/cache/.phpunit.negocios.controlador.result.cache 
--debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlado Bitacora=================== 
echo.
php vendor/bin/phpunit tests/BitacoraTestControlador.php 
--testdox-xml tests/resultados/bitacora/bitacora-controlador-resultados.xml 
--testdox-html tests/resultados/bitacora/bitacora-controlador-resultados.html 
--testdox 
--log-junit tests/resultados/bitacora/bitacora-controlador-resultados.xml  
--testdox 
--log-junit tests/resultados/bitacora/bitacora-controlador-resultados.log  
--cache-result-file tests/cache/.phpunit.bitacora.controlador.resultcache 
--debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
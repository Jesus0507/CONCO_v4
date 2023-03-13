@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Grupos_Deportivos =================== 
echo.
php vendor/bin/phpunit tests/Grupos_DeportivosTestControlador.php 
--testdox-xml tests/resultados/grupos_deportivos/grupos_deportivos-controlador-resultados.xml 
--testdox-html tests/resultados/grupos_deportivos/grupos_deportivos-controlador-resultados.html 
--testdox 
--log-junit tests/resultados/grupos_deportivos/grupos_deportivos-controlador-resultados.xml  
--testdox 
--log-junit tests/resultados/grupos_deportivos/grupos_deportivos-controlador-resultados.log  
--cache-result-file tests/cache/.phpunit.grupos_deportivos.controlador.result.cache 
--debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
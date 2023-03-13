@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlado Consejo Comunal =================== 
echo.
php vendor/bin/phpunit tests/Consejo_ComunalTestControlador.php 
--testdox-xml tests/resultados/consejo_comunal/consejo_comunal-controlador-resultados.xml 
--testdox-html tests/resultados/consejo_comunal/consejo_comunal-controlador-resultados.html 
--testdox 
--log-junit tests/resultados/consejo_comunal/consejo_comunal-controlador-resultados.xml  
--testdox 
--log-junit tests/resultados/consejo_comunal/consejo_comunal-controlador-resultados.log  
--cache-result-file tests/cache/.phpunit.consejo_comunal.controlador.result.cache 
--debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
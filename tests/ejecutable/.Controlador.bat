@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlado Centro Votacion=================== 
echo.
php vendor/bin/phpunit tests/Centro_VotacionTestControlador.php 
--testdox-xml tests/resultados/centro_votacion/centro_votacion-controlador-resultados.xml 
--testdox-html tests/resultados/centro_votacion/centro_votacion-controlador-resultados.html 
--testdox 
--log-junit tests/resultados/centro_votacion/centro_votacion-controlador-resultados.xml  
--testdox 
--log-junit tests/resultados/centro_votacion/centro_votacion-controlador-resultados.log  
--cache-result-file tests/cache/.phpunit.centro_votacion.controlador.resultcache 
--debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
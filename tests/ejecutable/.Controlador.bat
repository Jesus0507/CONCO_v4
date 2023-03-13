@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Habitante =================== 
echo.
php vendor/bin/phpunit tests/HabitanteTestControlador.php 
--testdox-xml tests/resultados/habitante/habitante-controlador-resultados.xml 
--testdox-html tests/resultados/habitante/habitante-controlador-resultados.html 
--testdox 
--log-junit tests/resultados/habitante/habitante-controlador-resultados.xml  
--testdox 
--log-junit tests/resultados/habitante/habitante-controlador-resultados.log  
--cache-result-file tests/cache/.phpunit.habitante.controlador.result.cache 
--debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
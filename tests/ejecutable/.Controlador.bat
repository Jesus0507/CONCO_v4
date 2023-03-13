@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Solicitudes =================== 
echo.
php vendor/bin/phpunit tests/SolicitudesTestControlador.php 
--testdox-xml tests/resultados/solicitudes/solicitudes-controlador-resultados.xml 
--testdox-html tests/resultados/solicitudes/solicitudes-controlador-resultados.html 
--testdox 
--log-junit tests/resultados/solicitudes/solicitudes-controlador-resultados.xml  
--testdox 
--log-junit tests/resultados/solicitudes/solicitudes-controlador-resultados.log  
--cache-result-file tests/cache/.phpunit.solicitudes.controlador.result.cache 
--debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Discapacitados =================== 
echo.
php vendor/bin/phpunit tests/DiscapacitadosTestControlador.php --testdox-xml tests/resultados/discapacitados/discapacitados-controlador-resultados.xml --testdox-html tests/resultados/discapacitados/discapacitados-controlador-resultados.html --testdox --log-junit tests/resultados/discapacitados/discapacitados-controlador-resultados.xml  --testdox --log-junit tests/resultados/discapacitados/discapacitados-controlador-resultados.log  --cache-result-file tests/cache/.phpunit.discapacitados.controlador.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
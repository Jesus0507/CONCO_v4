@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Vacunados =================== 
echo.
php vendor/bin/phpunit tests/VacunadosTestControlador.php --testdox-xml tests/resultados/vacunados/vacunados-controlador-resultados.xml --testdox-html tests/resultados/vacunados/vacunados-controlador-resultados.html --testdox --log-junit tests/resultados/vacunados/vacunados-controlador-resultados.xml  --testdox --log-junit tests/resultados/vacunados/vacunados-controlador-resultados.log  --cache-result-file tests/cache/.phpunit.vacunados.controlador.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
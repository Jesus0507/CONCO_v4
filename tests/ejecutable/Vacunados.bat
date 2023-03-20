@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Vacunados=================== 
echo.
php vendor/bin/phpunit tests/VacunadosTest.php --testdox-xml tests/resultados/vacunados/vacunados-resultados.xml --testdox-html tests/resultados/vacunados/vacunados-resultados.html --testdox --log-junit tests/resultados/vacunados/vacunados-resultados.xml  --testdox --log-junit tests/resultados/vacunados/vacunados-resultados.log  --cache-result-file tests/cache/.phpunit.vacunados.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
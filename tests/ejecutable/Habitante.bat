@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Habitante=================== 
echo.
php vendor/bin/phpunit tests/HabitanteTest.php --testdox-xml tests/resultados/habitante/habitante-resultados.xml --testdox-html tests/resultados/habitante/habitante-resultados.html --testdox --log-junit tests/resultados/habitante/habitante-resultados.xml  --testdox --log-junit tests/resultados/habitante/habitante-resultados.log  --cache-result-file tests/cache/.phpunit.habitante.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
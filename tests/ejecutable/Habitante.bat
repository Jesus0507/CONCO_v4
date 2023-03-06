@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Habitante=================== 
echo.
php vendor/bin/phpunit tests/HabitanteTest.php --testdox-xml tests/resultados/Habitante/Habitante-resultados.xml --testdox-html tests/resultados/Habitante/Habitante-resultados.html --testdox --log-junit tests/resultados/Habitante/Habitante-resultados.xml  --testdox --log-junit tests/resultados/Habitante/Habitante-resultados.log  --cache-result-file tests/cache/.phpunit.habitante.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
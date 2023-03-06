@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Agenda=================== 
echo.
php vendor/bin/phpunit tests/AgendaTest.php --testdox-xml tests/resultados/agenda/agenda-resultados.xml --testdox-html tests/resultados/agenda/agenda-resultados.html --testdox --log-junit tests/resultados/agenda/agenda-resultados.xml  --testdox --log-junit tests/resultados/agenda/agenda-resultados.log  --cache-result-file tests/cache/.phpunit.agenda.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
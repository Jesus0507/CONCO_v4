@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlado Agenda=================== 
echo.
php vendor/bin/phpunit tests/AgendaTestControlador.php --testdox-xml tests/resultados/agenda/agenda-controlador-resultados.xml --testdox-html tests/resultados/agenda/agenda-controlador-resultados.html --testdox --log-junit tests/resultados/agenda/agenda-controlador-resultados.xml  --testdox --log-junit tests/resultados/agenda/agenda-controlador-resultados.log  --cache-result-file tests/cache/.phpunit.agenda.controlador.resultcache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
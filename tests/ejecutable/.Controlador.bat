@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador rto_Humanizado =================== 
echo.
php vendor/bin/phpunit tests/Parto_HumanizadoTestControlador.php --testdox-xml tests/resultados/parto_humanizado/parto_humanizado-controlador-resultados.xml --testdox-html tests/resultados/parto_humanizado/parto_humanizado-controlador-resultados.html --testdox --log-junit tests/resultados/parto_humanizado/parto_humanizado-controlador-resultados.xml  --testdox --log-junit tests/resultados/parto_humanizado/parto_humanizado-controlador-resultados.log  --cache-result-file tests/cache/.phpunit.parto_humanizado.controlador.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
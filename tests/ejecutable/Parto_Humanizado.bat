@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Parto_Humanizado=================== 
echo.
php vendor/bin/phpunit tests/Parto_HumanizadoTest.php --testdox-xml tests/resultados/parto_humanizado/parto_humanizado-resultados.xml --testdox-html tests/resultados/parto_humanizado/parto_humanizado-resultados.html --testdox --log-junit tests/resultados/parto_humanizado/parto_humanizado-resultados.xml  --testdox --log-junit tests/resultados/parto_humanizado/parto_humanizado-resultados.log  --cache-result-file tests/cache/.phpunit.parto_humanizado.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
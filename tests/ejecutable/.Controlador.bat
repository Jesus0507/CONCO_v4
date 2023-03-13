@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Secton Agricola =================== 
echo.
php vendor/bin/phpunit tests/Sector_AgricolaTestControlador.php --testdox-xml tests/resultados/sector_agricola/sector_agricola-controlador-resultados.xml --testdox-html tests/resultados/sector_agricola/sector_agricola-controlador-resultados.html --testdox --log-junit tests/resultados/sector_agricola/sector_agricola-controlador-resultados.xml  --testdox --log-junit tests/resultados/sector_agricola/sector_agricola-controlador-resultados.log  --cache-result-file tests/cache/.phpunit.sector_agricola.controlador.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
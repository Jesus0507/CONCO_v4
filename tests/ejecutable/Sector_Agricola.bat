@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Sector_Agricola=================== 
echo.
php vendor/bin/phpunit tests/Sector_AgricolaTest.php --testdox-xml tests/resultados/sector_agricola/sector_agricola-resultados.xml --testdox-html tests/resultados/sector_agricola/sector_agricola-resultados.html --testdox --log-junit tests/resultados/sector_agricola/sector_agricola-resultados.xml  --testdox --log-junit tests/resultados/sector_agricola/sector_agricola-resultados.log  --cache-result-file tests/cache/.phpunit.sector_agricola.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
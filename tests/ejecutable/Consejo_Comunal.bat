@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Consejo_Comunal=================== 
echo.
php vendor/bin/phpunit tests/Consejo_ComunalTest.php --testdox-xml tests/resultados/consejo_comunal/consejo_comunal-resultados.xml --testdox-html tests/resultados/consejo_comunal/consejo_comunal-resultados.html --testdox --log-junit tests/resultados/consejo_comunal/consejo_comunal-resultados.xml  --testdox --log-junit tests/resultados/consejo_comunal/consejo_comunal-resultados.log  --cache-result-file tests/cache/.phpunit.consejo_comunal.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
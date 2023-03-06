@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Centro_Votacion=================== 
echo.
php vendor/bin/phpunit tests/Centro_VotacionTest.php --testdox-xml tests/resultados/centro_votacion/centro_votacion-resultados.xml --testdox-html tests/resultados/centro_votacion/centro_votacion-resultados.html --testdox --log-junit tests/resultados/centro_votacion/centro_votacion-resultados.xml  --testdox --log-junit tests/resultados/centro_votacion/centro_votacion-resultados.log  --cache-result-file tests/cache/.phpunit.centro_votacion.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
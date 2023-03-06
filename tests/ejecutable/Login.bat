@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del modulo Login=================== 
echo.
php vendor/bin/phpunit tests/LoginTest.php --testdox-xml tests/resultados/login/login-resultados.xml --testdox-html tests/resultados/login/login-resultados.html --testdox --log-junit tests/resultados/login/login-resultados.xml  --testdox --log-junit tests/resultados/login/login-resultados.log  --cache-result-file tests/cache/.phpunit.login.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
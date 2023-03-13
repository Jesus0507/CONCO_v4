@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
echo.
echo ===================Pruebas del Controlador Login =================== 
echo.
php vendor/bin/phpunit tests/LoginTestControlador.php --testdox-xml tests/resultados/login/login-controlador-resultados.xml --testdox-html tests/resultados/login/login-controlador-resultados.html --testdox --log-junit tests/resultados/login/login-controlador-resultados.xml  --testdox --log-junit tests/resultados/login/login-controlador-resultados.log  --cache-result-file tests/cache/.phpunit.login.controlador.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================
echo.
pause
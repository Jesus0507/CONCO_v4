@echo off
cd /
cd C:\xampp\htdocs\dashboard\www\CONCO_v4
:inicio
echo =================== Pruebas de Modulos PhpUnit ===================
echo.
echo Prueba de modulos
echo Selecciona un modulo:
echo 1. Agenda
echo 2. Bitacora
echo 3. Centro de Votacion
echo 4. Consejo Comunal
echo 5. Discapacitados
echo 6. Patologias
echo 7. Familias
echo 8. Grupos Deportivos
echo 9. Habitante
echo 10. Inmuebles
echo 11. Login
echo 12. Negocios
echo 13. Notificaciones 
echo 14. Parto Humanizado
echo 15. Personas
echo 16. Reportes
echo 17. Sector Agricola
echo 18. Seguridad
echo 19. Solicitudes
echo 20. Vacunados
echo 21. Viviendas
echo 22. Ejecutar Todas Las Pruebas
echo.
set /p opcion=Ingrese el numero de modulo:
echo.
if %opcion%==1 (

echo ===================Pruebas del modulo Agenda=================== 
echo.
php vendor/bin/phpunit tests/AgendaTest.php --testdox-xml tests/resultados/agenda/agenda-resultados.xml --testdox-html tests/resultados/agenda/agenda-resultados.html --testdox --log-junit tests/resultados/agenda/agenda-resultados.xml  --testdox --log-junit tests/resultados/agenda/agenda-resultados.log  --cache-result-file tests/cache/.phpunit.agenda.result.cache --debug -v
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==2 (

echo ===================Pruebas del modulo Bitacora=================== 
echo.
php vendor/bin/phpunit tests/BitacoraTest.php --testdox-xml tests/resultados/bitacora/bitacora-resultados.xml --testdox-html tests/resultados/bitacora/bitacora-resultados.html --testdox --log-junit tests/resultados/bitacora/bitacora-resultados.xml  --testdox --log-junit tests/resultados/bitacora/bitacora-resultados.log  --cache-result-file tests/cache/.phpunit.bitacora.result.cache --debug 
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==3 (

echo ===================Pruebas del modulo Centro_Votacion=================== 
echo.
php vendor/bin/phpunit tests/Centro_VotacionTest.php --testdox-xml tests/resultados/centro_votacion/centro_votacion-resultados.xml --testdox-html tests/resultados/centro_votacion/centro_votacion-resultados.html --testdox --log-junit tests/resultados/centro_votacion/centro_votacion-resultados.xml  --testdox --log-junit tests/resultados/centro_votacion/centro_votacion-resultados.log  --cache-result-file tests/cache/.phpunit.centro_votacion.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==4 (

echo ===================Pruebas del modulo Consejo_Comunal=================== 
echo.
php vendor/bin/phpunit tests/Consejo_ComunalTest.php --testdox-xml tests/resultados/consejo_comunal/consejo_comunal-resultados.xml --testdox-html tests/resultados/consejo_comunal/consejo_comunal-resultados.html --testdox --log-junit tests/resultados/consejo_comunal/consejo_comunal-resultados.xml  --testdox --log-junit tests/resultados/consejo_comunal/consejo_comunal-resultados.log  --cache-result-file tests/cache/.phpunit.consejo_comunal.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==5 (

echo ===================Pruebas del modulo Discapacitados=================== 
echo.
php vendor/bin/phpunit tests/DiscapacitadosTest.php --testdox-xml tests/resultados/discapacitados/discapacitados-resultados.xml --testdox-html tests/resultados/discapacitados/discapacitados-resultados.html --testdox --log-junit tests/resultados/discapacitados/discapacitados-resultados.xml  --testdox --log-junit tests/resultados/discapacitados/discapacitados-resultados.log  --cache-result-file tests/cache/.phpunit.discapacitados.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==6 (

echo ===================Pruebas del modulo Enfermos=================== 
echo.
php vendor/bin/phpunit tests/EnfermosTest.php --testdox-xml tests/resultados/enfermos/enfermos-resultados.xml --testdox-html tests/resultados/enfermos/enfermos-resultados.html --testdox --log-junit tests/resultados/enfermos/enfermos-resultados.xml  --testdox --log-junit tests/resultados/enfermos/enfermos-resultados.log  --cache-result-file tests/cache/.phpunit.enfermos.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==7 (

echo ===================Pruebas del modulo Familias=================== 
echo.
php vendor/bin/phpunit tests/FamiliasTest.php --testdox-xml tests/resultados/familias/familias-resultados.xml --testdox-html tests/resultados/familias/familias-resultados.html --testdox --log-junit tests/resultados/familias/familias-resultados.xml  --testdox --log-junit tests/resultados/familias/familias-resultados.log  --cache-result-file tests/cache/.phpunit.familias.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==8 (

echo ===================Pruebas del modulo Grupos_Deportivos=================== 
echo.
php vendor/bin/phpunit tests/Grupos_DeportivosTest.php --testdox-xml tests/resultados/grupos_deportivos/grupos_deportivos-resultados.xml --testdox-html tests/resultados/grupos_deportivos/grupos_deportivos-resultados.html --testdox --log-junit tests/resultados/grupos_deportivos/grupos_deportivos-resultados.xml  --testdox --log-junit tests/resultados/grupos_deportivos/grupos_deportivos-resultados.log  --cache-result-file tests/cache/.phpunit.grupos_deportivos.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==9 (

echo ===================Pruebas del modulo Habitante=================== 
echo.
php vendor/bin/phpunit tests/HabitanteTest.php --testdox-xml tests/resultados/habitante/habitante-resultados.xml --testdox-html tests/resultados/habitante/habitante-resultados.html --testdox --log-junit tests/resultados/habitante/habitante-resultados.xml  --testdox --log-junit tests/resultados/habitante/habitante-resultados.log  --cache-result-file tests/cache/.phpunit.habitante.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==10 (

echo ===================Pruebas del modulo Inmuebles=================== 
echo.
php vendor/bin/phpunit tests/InmueblesTest.php --testdox-xml tests/resultados/inmuebles/inmuebles-resultados.xml --testdox-html tests/resultados/inmuebles/inmuebles-resultados.html --testdox --log-junit tests/resultados/inmuebles/inmuebles-resultados.xml  --testdox --log-junit tests/resultados/inmuebles/inmuebles-resultados.log  --cache-result-file tests/cache/.phpunit.inmuebles.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==11 (

echo ===================Pruebas del modulo Login=================== 
echo.
php vendor/bin/phpunit tests/LoginTest.php --testdox-xml tests/resultados/login/login-resultados.xml --testdox-html tests/resultados/login/login-resultados.html --testdox --log-junit tests/resultados/login/login-resultados.xml  --testdox --log-junit tests/resultados/login/login-resultados.log  --cache-result-file tests/cache/.phpunit.login.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==12 (

echo ===================Pruebas del modulo Negocios=================== 
echo.
php vendor/bin/phpunit tests/NegociosTest.php --testdox-xml tests/resultados/negocios/negocios-resultados.xml --testdox-html tests/resultados/negocios/negocios-resultados.html --testdox --log-junit tests/resultados/negocios/negocios-resultados.xml  --testdox --log-junit tests/resultados/negocios/negocios-resultados.log  --cache-result-file tests/cache/.phpunit.negocios.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==13 (

echo ===================Pruebas del modulo Notificaciones=================== 
echo.
php vendor/bin/phpunit tests/NotificacionesTest.php --testdox-xml tests/resultados/notificaciones/notificaciones-resultados.xml --testdox-html tests/resultados/notificaciones/notificaciones-resultados.html --testdox --log-junit tests/resultados/notificaciones/notificaciones-resultados.xml  --testdox --log-junit tests/resultados/notificaciones/notificaciones-resultados.log  --cache-result-file tests/cache/.phpunit.notificaciones.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==14 (

echo ===================Pruebas del modulo Parto_Humanizado=================== 
echo.
php vendor/bin/phpunit tests/Parto_HumanizadoTest.php --testdox-xml tests/resultados/parto_humanizado/parto_humanizado-resultados.xml --testdox-html tests/resultados/parto_humanizado/parto_humanizado-resultados.html --testdox --log-junit tests/resultados/parto_humanizado/parto_humanizado-resultados.xml  --testdox --log-junit tests/resultados/parto_humanizado/parto_humanizado-resultados.log  --cache-result-file tests/cache/.phpunit.parto_humanizado.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==15 (

echo ===================Pruebas del modulo Personas=================== 
echo.
php vendor/bin/phpunit tests/PersonasTest.php --testdox-xml tests/resultados/personas/personas-resultados.xml --testdox-html tests/resultados/personas/personas-resultados.html --testdox --log-junit tests/resultados/personas/personas-resultados.xml  --testdox --log-junit tests/resultados/personas/personas-resultados.log  --cache-result-file tests/cache/.phpunit.personas.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==16 (

echo ===================Pruebas del modulo Reportes=================== 
echo.
php vendor/bin/phpunit tests/ReportesTest.php --testdox-xml tests/resultados/reportes/reportes-resultados.xml --testdox-html tests/resultados/reportes/reportes-resultados.html --testdox --log-junit tests/resultados/reportes/reportes-resultados.xml  --testdox --log-junit tests/resultados/reportes/reportes-resultados.log  --cache-result-file tests/cache/.phpunit.reportes.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==17 (

echo ===================Pruebas del modulo Sector_Agricola=================== 
echo.
php vendor/bin/phpunit tests/Sector_AgricolaTest.php --testdox-xml tests/resultados/sector_agricola/sector_agricola-resultados.xml --testdox-html tests/resultados/sector_agricola/sector_agricola-resultados.html --testdox --log-junit tests/resultados/sector_agricola/sector_agricola-resultados.xml  --testdox --log-junit tests/resultados/sector_agricola/sector_agricola-resultados.log  --cache-result-file tests/cache/.phpunit.sector_agricola.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==18 (

echo ===================Pruebas del modulo Seguridad=================== 
echo.
php vendor/bin/phpunit tests/SeguridadTest.php --testdox-xml tests/resultados/seguridad/seguridad-resultados.xml --testdox-html tests/resultados/seguridad/seguridad-resultados.html --testdox --log-junit tests/resultados/seguridad/seguridad-resultados.xml  --testdox --log-junit tests/resultados/seguridad/seguridad-resultados.log  --cache-result-file tests/cache/.phpunit.seguridad.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==19 (

echo ===================Pruebas del modulo Solicitudes=================== 
echo.
php vendor/bin/phpunit tests/SolicitudesTest.php --testdox-xml tests/resultados/solicitudes/solicitudes-resultados.xml --testdox-html tests/resultados/solicitudes/solicitudes-resultados.html --testdox --log-junit tests/resultados/solicitudes/solicitudes-resultados.xml  --testdox --log-junit tests/resultados/solicitudes/solicitudes-resultados.log  --cache-result-file tests/cache/.phpunit.solicitudes.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==20 (

echo ===================Pruebas del modulo Vacunados=================== 
echo.
php vendor/bin/phpunit tests/VacunadosTest.php --testdox-xml tests/resultados/vacunados/vacunados-resultados.xml --testdox-html tests/resultados/vacunados/vacunados-resultados.html --testdox --log-junit tests/resultados/vacunados/vacunados-resultados.xml  --testdox --log-junit tests/resultados/vacunados/vacunados-resultados.log  --cache-result-file tests/cache/.phpunit.vacunados.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

) else if %opcion%==21 (
  
echo ===================Pruebas del modulo Vivienda=================== 
echo.
php vendor/bin/phpunit tests/ViviendasTest.php --testdox-xml tests/resultados/vivienda/vivienda-resultados.xml --testdox-html tests/resultados/vivienda/vivienda-resultados.html --testdox --log-junit tests/resultados/vivienda/vivienda-resultados.xml  --testdox --log-junit tests/resultados/vivienda/vivienda-resultados.log  --cache-result-file tests/cache/.phpunit.vivienda.result.cache --debug
echo.
echo ======================Fin de las Pruebas======================

)else if %opcion%==22 (
echo Ejecutando Modulo U...
comando_U
) else (
echo Opcion no válida
set /p continuar=Presione cualquier tecla para continuar...
cls
goto inicio
)
echo.
set /p continuar=Desea probar otro modulo? (S/N)
if /I "%continuar%"=="S" (
cls
goto inicio
) else (
echo Programa finalizado.
pause
)
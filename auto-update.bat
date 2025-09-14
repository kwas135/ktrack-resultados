@echo off
REM Cambia la ruta a tu carpeta del repo
cd /d C:\xampp\htdocs\api\resultados\ktrack-resultados

echo Ejecutando exportar.php...
php exportar.php

echo Agregando todos los cambios a git...
git add .

echo Commit automático...
git commit -m "Auto-update resultados %date% %time%" 2>nul

echo Push al repo...
git push

echo Tarea completada.
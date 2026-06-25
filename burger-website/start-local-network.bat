@echo off
title Burger Kebab MAN - Server Jaringan Lokal
color 0A

echo.
echo  ============================================
echo    BURGER KEBAB MAN - Server Jaringan Lokal
echo  ============================================
echo.

:: Get current IP address
for /f "tokens=2 delims=:" %%i in ('ipconfig ^| findstr /i "IPv4"') do (
    set IP=%%i
    goto :done
)
:done
:: Trim spaces
set IP=%IP: =%

echo  [INFO] IP Address Anda: %IP%
echo  [INFO] Akses dari perangkat lain: http://%IP%:8000
echo  [INFO] Akses dari komputer ini  : http://localhost:8000
echo.
echo  [INFO] Pastikan perangkat lain terhubung ke WiFi yang sama!
echo.
echo  ============================================
echo  Tekan CTRL+C untuk menghentikan server
echo  ============================================
echo.

:: Clear config cache
php artisan config:clear
php artisan cache:clear

:: Start server accessible from all network interfaces
php artisan serve --host=0.0.0.0 --port=8000

pause

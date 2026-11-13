@echo off
cd /d "%~dp0"

rem Pakai PHP yang dipilih di Laragon, supaya tidak tertimpa PHP lain di PATH (misal XAMPP).
set "LARAGON=C:\laragon"
for /f "tokens=2 delims==" %%V in ('findstr /b "Version=php-" "%LARAGON%\usr\laragon.ini" 2^>nul') do set "PHPDIR=%LARAGON%\bin\php\%%V"
if defined PHPDIR if exist "%PHPDIR%\php.exe" set "PATH=%PHPDIR%;%LARAGON%\bin\composer;%PATH%"

php -r "exit(version_compare(PHP_VERSION, '8.4.1', '<') ? 1 : 0);"
if errorlevel 1 (
    echo PHP terlalu lama. Butuh PHP 8.4.1 atau lebih baru. Versi sekarang:
    php -v
    echo Pilih versi PHP baru lewat klik kanan Laragon ^> PHP ^> Version.
    goto gagal
)

echo [1/4] Install dependency Laravel 13 (composer install)...
call composer install --no-interaction
if errorlevel 1 goto gagal

if not exist .env copy .env.example .env >nul
findstr /r "^APP_KEY=base64:" .env >nul || php artisan key:generate --no-interaction

echo.
echo [2/4] Migrasi database db_kendaraan (dibuat otomatis jika belum ada)...
php artisan migrate --no-interaction
if errorlevel 1 (
    echo MySQL belum jalan? Klik Start All di Laragon, lalu jalankan setup.bat lagi.
    goto gagal
)

echo.
echo [3/4] Setup selesai.
echo.
echo [4/4] Menjalankan server di http://127.0.0.1:8000/vehicles
echo Tekan Ctrl+C untuk berhenti.
start "" http://127.0.0.1:8000/vehicles
php artisan serve
exit /b 0

:gagal
echo.
echo Setup gagal. Baca pesan error di atas, lalu cek bagian Masalah umum di README.md.
pause
exit /b 1

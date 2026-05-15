@echo off
title Memulai E-Library...
echo ======================================================
echo           MEMBERSIHKAN & MEMULAI E-LIBRARY
echo ======================================================
echo.
echo 1. Menghubungkan folder gambar...
php artisan storage:link >nul 2>&1

echo 2. Menyiapkan database dan data awal...
echo (Pastikan XAMPP / MySQL sudah aktif)
php artisan migrate:fresh --seed --force

echo.
echo 3. Membersihkan cache aplikasi...
php artisan optimize:clear >nul 2>&1

echo.
echo 4. Membuka aplikasi di browser...
start http://127.0.0.1:8000/library

echo.
echo 5. Menjalankan server (JANGAN TUTUP JENDELA INI)...
php artisan serve
pause

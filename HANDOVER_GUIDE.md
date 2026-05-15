# Panduan Cepat E-Library (Untuk Client)

Selamat! Ini adalah folder lengkap aplikasi Perpustakaan Digital Anda. Karena folder ini sudah lengkap (termasuk folder `vendor` dan pengaturan awal), Anda hanya perlu melakukan langkah sangat sederhana berikut:

## 🛠️ Langkah Menjalankan Aplikasi

1.  **Aktifkan Database**
    Buka **XAMPP Control Panel** dan klik **Start** pada **Apache** dan **MySQL**.

2.  **Buat Database di Browser**
    *   Buka browser dan ketik: `localhost/phpmyadmin`
    *   Klik **New** (Baru), ketik nama database: `perpustakaan_pinjam_putri`
    *   Klik **Create** (Buat).

3.  **Klik Dua Kali File "JALANKAN_APLIKASI.bat"**
    Di dalam folder ini, cari file bernama `JALANKAN_APLIKASI.bat` dan klik dua kali.
    *   Jendela hitam akan muncul.
    *   Tunggu sampai browser otomatis terbuka ke halaman aplikasi.
    *   **PENTING**: Jangan tutup jendela hitam tersebut selama Anda menggunakan aplikasi.

---

## 🔐 Cara Masuk (Login)

### 🛠️ Sebagai Admin (Untuk Kelola Buku)
Buka: `http://127.0.0.1:8000/admin`
*   **Email**: `admin@perpustakaan.com`
*   **Password**: `password`

### 👤 Sebagai Member (Untuk Pinjam Buku)
Buka: `http://127.0.0.1:8000/login`
*   **Email**: `putri@perpustakaan.com`
*   **Password**: `password`
*(Atau Anda bisa daftar akun baru di halaman utama)*

---

## 💡 Tips
*   Jika gambar tidak muncul, pastikan Anda sudah menjalankan file `.bat` tadi minimal satu kali.
*   Jika ingin mematikan aplikasi, cukup tutup jendela hitam (terminal) yang berjalan tadi.

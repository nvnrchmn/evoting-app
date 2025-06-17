# 🗳️ E-Voting App - Laravel 12

Aplikasi **E-Voting Berbasis Web** menggunakan Laravel 12. Proyek ini ditujukan untuk pelaksanaan pemilihan ketua dan wakil secara digital dengan sistem **multi-role**, **enkripsi suara (RSA)**, serta fitur **pengunduhan bukti voting** dan **grafik hasil suara**.

---

## 🚀 Fitur Utama

-   ✅ **Autentikasi Multi-Role (Admin & User)**
-   ✅ **Voting system kandidat ketua & wakil**
-   ✅ **Enkripsi suara dengan RSA Public Key Encryption**
-   ✅ **Unduh bukti voting dalam bentuk PDF (berisi timestamp)**
-   ✅ **Dashboard Admin & User dengan grafik hasil voting**
-   ✅ **Notifikasi hasil voting dan status pemilihan**
-   ✅ **Manajemen kandidat & pemilihan (oleh admin)**

---

## 🧱 Teknologi yang Digunakan

-   Laravel 12
-   PHP 8.2+
-   MySQL / MariaDB
-   [DomPDF](https://github.com/barryvdh/laravel-dompdf) untuk PDF export
-   Chart.js untuk grafik visual
-   RSA Public/Private Key Encryption (manual OpenSSL)

---

## 📦 Instalasi & Setup

1. **Clone repositori**

    ```bash
    git clone https://github.com/username/evoting-app.git
    cd evoting-app
    ```

2. **Install dependency**

    ```bash
    composer install
    npm install && npm run dev
    ```

3. **Copy file `.env` & konfigurasi**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Atur koneksi database di `.env`**

5. **Migrasi & seed database**

    ```bash
    php artisan migrate --seed
    ```

6. **Generate kunci RSA untuk enkripsi**

    ```bash
    php artisan rsa:generate
    ```

    > Ini akan menghasilkan `storage/app/keys/public.pem` dan `private.pem`

7. **Jalankan aplikasi**
    ```bash
    php artisan serve
    ```

---

## 🔑 Akun Dummy (Seeder)

| Role  | Email             | Password |
| ----- | ----------------- | -------- |
| Admin | admin@example.com | password |
| User  | user@example.com  | password |

---

## 📝 Struktur Folder Penting

-   `app/Http/Controllers/` — Logic controller utama
-   `resources/views/` — Blade template (admin/user/voting)
-   `database/seeders/` — Data dummy untuk kandidat dan user
-   `storage/app/keys/` — RSA public/private key
-   `routes/web.php` — Routing web Laravel

---

## 📄 Cara Menggunakan

### Sebagai User:

-   Login sebagai user
-   Pilih kandidat dan vote
-   Sistem akan mengenkripsi suara menggunakan RSA
-   Setelah voting, kamu bisa mengunduh **bukti voting (PDF)**

### Sebagai Admin:

-   Kelola kandidat dan data voting
-   Lihat hasil voting dalam bentuk **grafik batang**
-   Kelola status voting (open/close)

---

## 🔒 Keamanan Suara

Aplikasi ini menggunakan **RSA Public Key Encryption** untuk mengenkripsi suara:

-   **Public key** digunakan untuk mengenkripsi saat user voting
-   **Private key** hanya dimiliki server untuk dekripsi saat validasi

---

## 📊 Grafik Hasil Voting

Dashboard Admin & User menampilkan grafik batang berdasarkan suara yang masuk, dalam bentuk **persentase (%)**, lengkap dengan nama pasangan.

---

## ✍️ Kontribusi

Pull request dan masukan sangat terbuka!

1. Fork project
2. Buat branch fitur
3. Commit dan push
4. Ajukan PR

---

## 📃 Lisensi

Proyek ini berlisensi **MIT License**. Silakan digunakan untuk keperluan akademik maupun produksi dengan kredit yang sesuai.

---

## 🙋 Kontak

Dikembangkan oleh [Nova Nurachman]  
📧 Email: nv.nrchmn@gmail.com  
📍 Proyek untuk tugas Web Programming II

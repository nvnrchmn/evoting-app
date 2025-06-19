# 🗳️ E-Voting App - Laravel 10

Aplikasi **E-Voting Berbasis Web** yang dibangun menggunakan Laravel 10. Aplikasi ini dirancang untuk memfasilitasi proses pemilihan ketua dan wakil secara digital, dengan fitur **multi-role**, **enkripsi suara (RSA)**, serta **pengunduhan bukti voting** dan **grafik hasil suara**.

---

## 🚀 Fitur Utama

-   ✅ Autentikasi & otorisasi **multi-role** (Admin & User)
-   ✅ Proses voting ketua & wakil berbasis web
-   ✅ **RSA Public Key Encryption** untuk enkripsi suara
-   ✅ **Download bukti voting (PDF)** disertai waktu voting
-   ✅ **Dashboard** dengan grafik suara (Chart.js)
-   ✅ Manajemen kandidat, voting, dan grup pemilih oleh Admin
-   ✅ Filter pemilih berdasarkan grup tertentu
-   ✅ Responsive design (mobile & desktop)

---

## 🧱 Teknologi yang Digunakan

-   Laravel 10
-   PHP 8.2+
-   MySQL / MariaDB
-   [DomPDF](https://github.com/barryvdh/laravel-dompdf)
-   Chart.js
-   OpenSSL (RSA Key Pair)
-   Blade Component (x-\*) Layout

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

3. **Salin file `.env` dan generate key**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Atur koneksi database** di `.env` sesuai konfigurasi lokal

5. **Migrasi & seed database**

    ```bash
    php artisan migrate --seed
    ```

6. **Generate kunci RSA untuk enkripsi suara**

    ```bash
    php artisan rsa:generate
    ```

    > Akan menghasilkan `storage/app/keys/public.pem` dan `private.pem`

7. **Jalankan aplikasi**
    ```bash
    php artisan serve
    ```

---

## 🔐 Akun Dummy (Seeder)

| Role  | Email             | Password |
| ----- | ----------------- | -------- |
| Admin | admin@example.com | password |

---

## 📄 Struktur Direktori Penting

-   `app/Http/Controllers/` — Kontroler utama (Admin, Voter, Voting)
-   `resources/views/` — Blade templates (UI Admin & User)
-   `routes/web.php` — Routing web Laravel
-   `storage/app/keys/` — RSA Public & Private Key
-   `database/seeders/` — Seeder data awal (kandidat, grup, user)
-   `app/Helpers/RSAHelper.php` — Utility helper untuk enkripsi suara

---

## 👥 Alur Penggunaan

### 👤 Sebagai User:

1. Login sebagai user terdaftar.
2. Lihat daftar pemilihan yang tersedia (hanya `open`).
3. Lakukan voting untuk pasangan kandidat.
4. Suara dienkripsi menggunakan RSA Public Key.
5. Unduh bukti voting (PDF) sebagai tanda partisipasi.

### 🛠️ Sebagai Admin:

1. Login sebagai admin.
2. Kelola daftar kandidat, voting, dan grup.
3. Atur status voting (open/closed).
4. Lihat hasil voting secara real-time dalam grafik.

---

## 🔒 Keamanan Suara

Setiap suara dienkripsi menggunakan **RSA Public Key Encryption**:

-   🔐 **Public Key** digunakan saat user melakukan voting.
-   🔓 **Private Key** digunakan server untuk membaca hasil vote.

Dengan metode ini, integritas dan kerahasiaan suara pengguna tetap terjamin.

---

## 📊 Visualisasi Hasil Voting

Dashboard menyajikan:

-   Grafik batang (bar chart) dengan Chart.js
-   Persentase suara tiap kandidat
-   Statistik total pemilih aktif per voting

---

## 💡 Kontribusi

Kontribusi sangat diterima!

1. Fork repositori
2. Buat branch baru untuk fitur atau perbaikan
3. Commit & push
4. Ajukan pull request

---

## 📃 Lisensi

Aplikasi ini berada di bawah lisensi **MIT License**.  
Silakan digunakan untuk keperluan pembelajaran, pengembangan, atau produksi dengan memberikan atribusi yang sesuai.

---

## 🙋 Tentang Developer

Dikembangkan oleh **Nova Nurachman**  
📧 Email: nv.nrchmn@gmail.com  
🎓 Proyek ini disusun sebagai bagian dari **Tugas Akhir Web Programming II**

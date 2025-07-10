### Panduan Instalasi dan Menjalankan Proyek

Teknologi yang Digunakan

    PHP 8.2+

    Laravel 12

    MySQL

    Composer

### Prasyarat

    Git

    PHP 8.2 atau lebih tinggi

    Composer

    Database Server seperti MySQL

### Instalasi Lokal

Clone repository ini:
    
    git clone https://github.com/meimuktiwardana/idgrow.git
    cd idgrow

    
Install dependensi Composer:

    composer install

Ubah file environment:

.env.example menjadi .env

Konfigurasi file .env:
Buka file .env dan sesuaikan konfigurasi database Anda.

    Bash DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=idgrow
    DB_USERNAME=root
    DB_PASSWORD=

Generate application key:

    php artisan key:generate

Jalankan migrasi dan seeder database:
Perintah ini akan membuat semua tabel yang dibutuhkan dan mengisinya dengan beberapa data awal (contoh: user admin).

    php artisan migrate --seed

Jalankan server development:

    php artisan serve

Aplikasi sekarang berjalan di http://127.0.0.1:8000.

### Dokumentasi API (Postman)

Dokumentasi lengkap untuk semua endpoint, termasuk contoh request dan response, telah dipublikasikan melalui Postman.

    Link Dokumentasi: https://documenter.getpostman.com/view/10467257/2sB34eKi57

### Otentikasi

Semua endpoint selain /api/login memerlukan otentikasi.

Lakukan request POST ke endpoint /api/login dengan email dan password.

Gunakan data dari seeder untuk login awal:

    Email: admin@admin.com
    Password: password

Anda akan menerima Bearer Token di dalam response.

Gunakan token ini di Authorization Header untuk setiap request ke endpoint yang dilindungi.

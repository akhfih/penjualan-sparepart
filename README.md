# PHP MVC CRUD Penjualan Sparepart

Website Create, Read, Update, Delete (CRUD) penjualan sparepart berbasis PHP dan MySQL

## Informasi singkat

- Website ini dibuat dengan PHP menggunakan arsitektur MVC yang sederhana.<br>

## Instalasi atau Cara menggunakan

- Proses download

1. Pastikan Anda sudah menginstall [XAMPP](https://www.apachefriends.org/download.html) dan [Composer](https://getcomposer.org/) di komputer Anda
2. Download semua file di repository ini
3. Ekstrak file jika hasil download berupa file `.zip`
4. Proses pengaturan
5. Start _Apache_ dan _MySQL_ di XAMPP Control Panel
6. Buka `localhost/phpmyadmin` di browser
7. Buat database baru dengan nama `db_sparepart`
8. Klik tulisan _Import_ di bagian atas
9. Di bagian _File to import:_ pilih file `db_sparepart.sql` yang ada di folder `penjualan-sparepart/`
10. Kalau sudah, klik tombol _Import_ di bagian paling bawah
11. Buka folder `penjualan-sparepart/` di _Command Prompt_
12. Ketik `composer update` untuk men-download hal yang dibutuhkan website
13. Pindah ke folder public dengan mengetik `cd public` di _Command Prompt_
14. Jalankan server PHP dengan mengetik `php -S localhost:8080`
15. Akses website dari Web Browser ke alamat localhost:8080

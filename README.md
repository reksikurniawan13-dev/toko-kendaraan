# Toko Kendaraan (Laravel 13 + Laragon)

Project part 1 aplikasi jual beli kendaraan, disesuaikan dari video "laravel prroject pt1" (Leo van Sandie) yang aslinya toko bunga dengan XAMPP. Isinya: tabel `vehicles`, `VehicleController` resource, route resource `vehicles`, dan halaman `/vehicles` dengan Tailwind CDN.

Folder `vendor` tidak disertakan (ukurannya puluhan MB). Folder itu dibuat otomatis oleh `composer install` di langkah setup.

## Kebutuhan

- Laragon (sudah termasuk Apache, MySQL, PHP, Composer, HeidiSQL)
- PHP 8.4.1 atau lebih baru (dependency di `composer.lock` mensyaratkan `>= 8.4.1`)
- Internet saat pertama kali `composer install`

`setup.bat` otomatis memakai PHP yang dipilih di Laragon (klik kanan Laragon > PHP > Version), walaupun `php` di PATH menunjuk ke versi lain seperti XAMPP. Jika versi PHP di Laragon masih di bawah 8.4.1:

1. Unduh PHP 8.4/8.5 versi **Thread Safe x64** (zip) dari https://windows.php.net/download
2. Ekstrak ke `C:\laragon\bin\php\` (misal `C:\laragon\bin\php\php-8.4.x-Win32-vs17-x64`)
3. Klik kanan Laragon > PHP > Version, pilih versi baru

## Cara menjalankan

1. Ekstrak zip ke `C:\laragon\www\` sehingga menjadi `C:\laragon\www\toko-kendaraan`.
2. Buka Laragon, klik **Start All** (MySQL harus jalan).
3. Klik dua kali `setup.bat` di folder project.

   Script memilih PHP Laragon, menjalankan `composer install`, membuat `APP_KEY` jika belum ada, menjalankan `php artisan migrate` (database `db_kendaraan` dibuat otomatis), lalu menjalankan `php artisan serve` dan membuka http://127.0.0.1:8000/vehicles di browser. Tekan Ctrl+C di jendela itu untuk menghentikan server.

Jalankan `setup.bat` lagi kapan pun untuk menyalakan server. Langkah yang sudah selesai dilewati otomatis.

Alternatif lewat virtual host Laragon: klik **Stop** lalu **Start All** agar Laragon membuat `toko-kendaraan.test`, lalu buka http://toko-kendaraan.test/vehicles

Hasilnya: judul "Tabel Kendaraan Jaya Motor", tombol biru "+ Tambah Kendaraan", dan header tabel abu-abu. Isi tabel masih kosong; pengisian data ada di part berikutnya.

## Cek database

Klik **Database** di Laragon (membuka HeidiSQL), koneksi `root` tanpa password. Database `db_kendaraan` berisi tabel `vehicles` dengan kolom:

| Kolom | Tipe | Keterangan |
| --- | --- | --- |
| `nama_kendaraan` | string | Contoh: Avanza 1.3 G |
| `merk` | string | Contoh: Toyota |
| `jenis` | string | Mobil atau Motor |
| `tahun` | year | Tahun produksi |
| `harga` | bigInteger | Rupiah; `integer` biasa maksimal sekitar Rp2,1 miliar |
| `stok` | integer | Jumlah unit |
| `deskripsi` | text | Kondisi, warna, kilometer, dan lainnya |

## File yang dibuat di part 1

| File | Isi |
| --- | --- |
| `.env` | APP_NAME "Jaya Motor", MySQL Laragon (`db_kendaraan`, user `root`, tanpa password) |
| `app/Models/Vehicle.php` | Model kendaraan |
| `database/migrations/2026_11_07_010000_create_vehicles_table.php` | Struktur tabel `vehicles` |
| `app/Http/Controllers/VehicleController.php` | Controller resource, `index()` sudah diisi |
| `routes/web.php` | `Route::resource('vehicles', VehicleController::class)` |
| `resources/views/vehicles/index.blade.php` | Halaman tabel kendaraan |

Ganti nama toko lewat `APP_NAME` di `.env`.

## Kalau mau membangun dari nol (mengikuti video)

1. Klik kanan Laragon > Quick app > Laravel, beri nama `toko-kendaraan`.
2. Ubah `.env`: `DB_CONNECTION=mysql`, hapus `#` di baris `DB_HOST` sampai `DB_PASSWORD`, isi `DB_DATABASE=db_kendaraan`.
3. Jalankan perintah berikut di Terminal Laragon, lalu salin isi file dari tabel di atas:

   ```
   php artisan make:model Vehicle -m
   php artisan migrate
   php artisan make:controller VehicleController --resource
   ```

4. Buat folder `resources/views/vehicles` dan file `index.blade.php` di dalamnya.

## Masalah umum

| Gejala | Solusi |
| --- | --- |
| `'composer' is not recognized` atau `'php' is not recognized` | Jalankan dari Terminal Laragon, atau aktifkan Menu > Tools > Path > Add Laragon to Path |
| `Your Composer dependencies require a PHP version ">= 8.4.1"` | `php` di PATH versi lama (misal XAMPP). Pakai `setup.bat`, atau ganti versi PHP Laragon (lihat bagian Kebutuhan) |
| `SQLSTATE[HY000] [2002]` saat migrate | MySQL belum jalan; klik Start All di Laragon |
| `toko-kendaraan.test` tidak bisa dibuka | Stop lalu Start All; pastikan Auto virtual hosts aktif di Preferences |
| `Target class [VehicleController] does not exist.` | Cek baris `use App\Http\Controllers\VehicleController;` di `routes/web.php` |
| `View [vehicles.index] not found.` | Cek folder `resources/views/vehicles` dan nama file `index.blade.php` |
| Styling tidak muncul | Tailwind CDN butuh internet |

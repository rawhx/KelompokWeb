
## Installasi

buat database dengan nama : `kelompokweb`

Clone repository dari GitHub menggunakan perintah berikut:
```bash
  git clone https://github.com/rawhx/KelompokWeb.git
```
Perintah ini akan membuat salinan dari repository. Setelah selesai, pindah ke direktori project:
```bash
  cd KelompokWeb
```
Salin file .env.example menjadi .env agar konfigurasi environment dapat digunakan:
```bash
  cp .env.example .env
```
Setelah berada di direktori project, install semua dependency menggunakan perintah:
```bash
  composer install
```
Setelah semua terinstal, buat key project
```bash
  php artisan key:generate
```
Migrasi database project
```bash
  php artisan migrate:fresh
```
Jalankan project
```bash
  php artisan ser
```
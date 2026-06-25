# Bid-Down Backend Setup

## Database

Project ini memakai MySQL Laragon.

Konfigurasi `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biddown
DB_USERNAME=root
DB_PASSWORD=
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Jika database belum ada:

```powershell
mysql -uroot -e "CREATE DATABASE IF NOT EXISTS biddown CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

Jalankan migrasi dan seed:

```powershell
php artisan migrate --seed
```

Reset database dari awal:

```powershell
php artisan migrate:fresh --seed
```

## Akun Demo

Client:

```text
Email: client@biddown.test
Password: password
```

Freelancer:

```text
Email: freelancer@biddown.test
Password: password
```

Freelancer kedua:

```text
Email: maya@biddown.test
Password: password
```

## Fitur Backend

- Register client dan freelancer
- Login berdasarkan role
- Posting proyek oleh client
- Eksplorasi proyek terbuka oleh freelancer
- Kirim bid oleh freelancer
- Validasi bid harus lebih rendah dari bid terendah saat ini
- Update profil freelancer
- Data demo untuk user, project, bid, dan portfolio

## Menjalankan Aplikasi

```powershell
php artisan serve
```

Buka:

```text
http://127.0.0.1:8000
```

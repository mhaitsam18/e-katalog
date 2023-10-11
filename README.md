# E-Katalog

## Inisialisasi Development

1. Clone repo ini
2. Ubah nama folder `e-katalog-unpad` jadi `e-katalog`
3. Masuk ke folder `e-katalog` di terminal
4. Install CI dan library lainnya dengan command

```
composer install
```

6. Buat database dengan nama `e-katalog`
7. Import database dari file sql di folder `migrations`
8. Migrasi database dengan command

```
php public/index.php migrate
```

9. Seeding database dengan command

```
php public/index.php seeder
```

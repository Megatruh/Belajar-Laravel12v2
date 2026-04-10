<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Progres

### Video 1: Setup Breeze

- [x] Instalasi Breeze
	- `composer require laravel/breeze --dev`
	- `php artisan breeze:install`
- [x] Migrasi database
	- `php artisan migrate`
- [x] Instal dependency frontend
	- `npm install`
	- `npm run dev`
- [x] Update Tailwind
	- `npx @tailwindcss/upgrade`
- [x] Update `vite.config.js`
	- `import { defineConfig } from "vite";`
	- `import tailwindcss from "@tailwindcss/vite";`
	- `export default defineConfig({ plugins: [tailwindcss()], });`
- [x] Hapus `postcss.config.js`

### Video 2: Setup SMTP Gmail

- [x] Buat akun Google dummy
- [x] Setting 2FA / A2F
- [x] Generate password baru untuk aplikasi
- [x] Edit file `.env` bagian `MAIL`

### Video 3: Register Username & Login dengan Email atau Username

- [x] Tambah kolom `username` di migration users
	- `database/migrations/0001_01_01_000000_create_users_table.php`
- [x] Izinkan `username` untuk mass assignment pada model User
	- `app/Models/User.php`
- [x] Update proses registrasi agar menyimpan `username`
	- `app/Http/Controllers/Auth/RegisteredUserController.php`
	- Validasi `username`: required, alpha_num, min 4, unique
	- Validasi email diperketat dengan `email:dns`
- [x] Update form register untuk input `username`
	- `resources/views/auth/register.blade.php`
- [x] Ubah autentikasi login agar menerima email atau username (`user_cred`)
	- `app/Http/Requests/Auth/LoginRequest.php`
	- Deteksi otomatis credential type (email/username) pada `prepareForValidation()`
	- `Auth::attempt()` dinamis berdasarkan credential type
- [x] Update form login dari `email` menjadi `user_cred`
	- `resources/views/auth/login.blade.php`
- [x] Tambah dukungan update `username` pada halaman Edit Profile
	- `app/Http/Requests/ProfileUpdateRequest.php`
	- Validasi `username` saat update profile: required, alpha_num, min 4, max 50, unique (ignore current user)
	- `resources/views/profile/partials/update-profile-information-form.blade.php`
	- Tambah field `username` pada form edit profile

### Video 4: Integrasi Project Lama + Flowbite

- [x] Merge hasil belajar dari project Laravel 12 sebelumnya ke project saat ini (Breeze)
	- Menyesuaikan struktur lama agar kompatibel dengan starter kit Breeze
	- Migrasi bagian fitur/tampilan yang sudah pernah dibuat sebelumnya
- [x] Instalasi Flowbite UI
	- Menambahkan package Flowbite untuk komponen UI berbasis Tailwind
	- Menyesuaikan konfigurasi frontend agar komponen bisa digunakan di Blade
- [x] Instalasi Flowbite Typography
	- Menambahkan dukungan typography untuk styling konten (artikel/post)
	- Menyesuaikan class dan tampilan agar lebih konsisten dengan layout project

### Video 5: Setup Navbar

- [x] Refactor komponen link navbar ke custom component `x-my-nav-link`
	- Update link menu desktop & mobile: Home, Blog, About, Contact
	- File: `resources/views/components/navbar.blade.php`
- [x] Tambah kondisi autentikasi pada navbar (`Auth::check()`)
	- User login: tampil dropdown profile + nama user
	- Guest: tampil link Login dan Register
- [x] Integrasi menu akun pada desktop
	- Menu: `Your profile`, `Settings`, dan tombol `Log out` (POST + CSRF)
- [x] Integrasi menu akun pada mobile
	- User login: tampil nama, email, profile/settings/sign out
	- Guest: tampil Login/Register
- [x] Ganti avatar profile desktop ke aset lokal
	- Gunakan `asset('IMG/Profile/farhan.jpg')`
	- Tambah file baru: `public/IMG/Profile/farhan.jpg`

### Video 6: Setup Controller (Progress)

- [x] Generate controller resource untuk dashboard post
	- File baru: `app/Http/Controllers/PostDashboardController.php`
	- Method `index()` menyiapkan data post terbaru: `Posts::latest()->get()`
- [x] Pindahkan route dashboard dari closure ke controller
	- Update `routes/web.php`
	- Dari: `Route::get('/dashboard', fn () => view('dashboard'))`
	- Menjadi: `Route::get('/dashboard', [PostDashboardController::class, 'index'])`
	- Middleware tetap: `auth` dan `verified`
- [x] Kirim data post ke view dashboard
	- View `dashboard` menerima variable `posts`
	- Tampilan awal menampilkan output data `{{ $posts }}` sebagai progress integrasi
- [x] Tambah greeting user login di dashboard (popup 3 detik)
	- Update `resources/views/dashboard.blade.php`
	- Menggunakan Alpine (`x-data`, `x-show`, `x-transition`, `setTimeout`)
	- Posisi popup dibuat center horizontal (`left-1/2 -translate-x-1/2`)
- [x] Integrasi behavior navbar hide/show on scroll ke layout Breeze
	- Tambah logic scroll di `resources/js/app.js`
	- Target elemen dengan id `navbar`
	- Scroll turun: navbar sembunyi (`translateY(-100%)`), scroll naik: muncul lagi (`translateY(0)`)
- [x] Sesuaikan layout agar kompatibel dengan navbar fixed
	- Update `resources/views/layouts/navigation.blade.php` (navbar fixed + transition)
	- Update `resources/views/layouts/app.blade.php` (tambah spacer `h-16`)
- [x] Penyesuaian tampilan guest/auth screen
	- Update `resources/views/layouts/guest.blade.php` (background dan spacing logo/card)
	- Update `resources/views/components/application-logo.blade.php` (class logo default)

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# 📘 stafbook

**stafbook** is a Laravel 12-based staff management system that uses:

- ✅ **Laravel Breeze** (Blade scaffolding)
- 🎨 **Bootstrap 5** for responsive UI
- 🔁 **Axios** for asynchronous HTTP communication
- 🧩 **jQuery** for DOM interaction and dynamic UI

This project is currently under development and serves as a test case for dynamic staff management functionality.

---

## 📦 Tech Stack

| Component        | Version / Stack     |
|------------------|----------------------|
| Laravel          | 12.x (PHP 8.2+)      |
| Laravel Breeze   | Blade UI Scaffold    |
| Frontend         | jQuery, Axios        |
| CSS Framework    | Bootstrap 5          |
| Authentication   | Laravel Breeze       |
| Database         | MySQL                |

---

## 🚀 Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/mfathin/stafbook.git
cd stafbook
```

### 2. Install Dependencies

#### Install PHP/Laravel packages

```bash
composer install
```

> If Composer is not installed:
> ```bash
> # Ubuntu/Debian
> sudo apt install composer
>
> # macOS (with Homebrew)
> brew install composer
> ```

#### Install JavaScript dependencies

```bash
npm install
```

> If Node.js and npm are not installed:
> ```bash
> sudo apt install nodejs npm
> ```

---

### 3. Copy Environment File

```bash
cp .env.example .env
```

Edit `.env` and configure your database settings and `APP_URL`.

---

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

### 5. Run Migrations

```bash
php artisan migrate
```

> You can also run seeders if provided.

---

### 6. Compile Frontend Assets

#### For Development

```bash
npm run dev
```

#### For Production

```bash
npm run build
```

---

## 🧪 Running the Application

Start the Laravel development server:

```bash
php artisan serve
```

Visit the app at:

```
http://127.0.0.1:8000
```

---

## 🔐 Authentication

This project uses Laravel Breeze for built-in authentication routes:

- `/login`
- `/register`
- `/dashboard` (protected)

Example route protection in `web.php`:

```php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stafbook', [StafbookController::class, 'index'])->name('stafbook.index');
});
```

---

## 🔁 Axios & jQuery Usage

### Axios Setup (`resources/js/app.js`)

```js
import axios from 'axios';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
```

### jQuery Example

```js
$('#save-button').click(function () {
    const name = $('#name-input').val();

    axios.post('/stafbook/save', { name })
        .then(res => alert('Saved'))
        .catch(err => console.log(err));
});
```

---

## 🎨 Bootstrap 5

Make sure your Blade layout includes:

```html
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
```

Used for responsive layout, modals, tables, buttons, etc.

---

## 📌 Roadmap / TODO

- [ ] Staff CRUD (Create, Read, Update, Delete)
- [ ] Modal-based add/edit interface
- [ ] Dynamic jQuery interactions
- [ ] Role-based access control
- [ ] Unit testing
- [ ] Form validation

---

## 🔗 Repository

📎 GitHub: [https://github.com/mfathin/stafbook](https://github.com/mfathin/stafbook)

---

## 🙏 Credits

Developed by [@mfathin](https://github.com/mfathin)
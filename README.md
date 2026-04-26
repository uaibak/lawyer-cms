# Lawyer CMS

A lightweight, production-ready Laravel CMS for lawyer and law-firm websites. It uses reusable Blade section components, stores section payloads as JSON in MySQL, and ships with a simple custom admin panel that works well on local machines and shared hosting.

## Stack

- Laravel
- PHP 8.2+
- MySQL
- Blade templates
- Bootstrap 5 via CDN
- File/session/cache drivers only

## Core Features

- Custom admin login using Laravel sessions
- Pages CRUD with SEO fields and automatic slug generation
- Reusable section builder per page
- JSON-backed section content stored in the database
- Blade partial rendering by section type
- Seeded admin user and sample homepage
- Shared-hosting-friendly setup with no Redis, queues, WebSockets, or Node build requirement

## Section Types

Blade section partials live in [resources/views/sections](/Users/uaibak/Work Stuff/lawyer-cms/resources/views/sections).

- `hero`
- `text`
- `services`
- `testimonials`
- `contact`
- `cta`

Each page is rendered by looping sections and including the matching Blade file.

## Local Development

1. Install dependencies:

```bash
composer install
```

2. Create your environment file:

```bash
cp .env.example .env
php artisan key:generate
```

3. Configure MySQL credentials in `.env`.

4. Run migrations and seed data:

```bash
php artisan migrate --seed
```

5. Start the app:

```bash
php artisan serve
```

Open:

- Frontend: `http://127.0.0.1:8000`
- Admin: `http://127.0.0.1:8000/admin/login`

Default admin credentials:

- Email: `admin@lawyercms.test`
- Password: `password123`

## Content Model

### `pages`

- `id`
- `title`
- `slug`
- `meta_title`
- `meta_description`
- `timestamps`

### `sections`

- `id`
- `page_id`
- `type`
- `sort_order`
- `content` (JSON in `LONGTEXT`)
- `timestamps`

## Deployment to cPanel / Shared Hosting

1. Upload the project files by FTP.
2. Point the domain document root to the `public` directory when cPanel allows it.
3. If `public` cannot be used directly, copy the contents of `public` into `public_html` and update `index.php` paths to reference the Laravel app directory.
4. Create the MySQL database and user from cPanel.
5. Update `.env` with production database credentials and `APP_URL`.
6. Import the database schema by running migrations locally and uploading a dump, or run migrations through any hosting control panel terminal if available.
7. Set writable permissions for `storage` and `bootstrap/cache`.
8. Ensure Apache `mod_rewrite` is enabled and `.htaccess` files are preserved.

## Notes

- File uploads can be stored with Laravel storage and referenced from section JSON when needed.
- Run `php artisan storage:link` on hosts that support symlinks, or use direct public storage patterns if your host blocks symlinks.
- Clear caches after deployment changes with `php artisan optimize:clear` when shell access is available.

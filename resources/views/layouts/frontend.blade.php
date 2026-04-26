<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page->meta_title ?: $page->title }} | {{ config('app.name') }}</title>
    <meta name="description" content="{{ $page->meta_description }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f6f2ec; color: #1f2937; }
        .site-header { background: #14213d; }
        .site-header a, .site-header .navbar-brand { color: #fff; }
        .section-band:nth-child(even) { background: #fff; }
        .section-band:nth-child(odd) { background: #f8fafc; }
        .hero-shell { background: linear-gradient(135deg, #14213d 0%, #1d3557 100%); color: #fff; }
        .section-title { color: #14213d; }
        .footer-shell { background: #111827; color: #d1d5db; }
    </style>
</head>
<body>
    <header class="site-header shadow-sm">
        <nav class="navbar navbar-expand-lg">
            <div class="container py-2">
                <a class="navbar-brand fw-semibold" href="{{ route('home') }}">{{ config('app.name') }}</a>
                <div class="ms-auto d-flex gap-3">
                    <a class="text-decoration-none" href="{{ route('home') }}">Home</a>
                    <a class="text-decoration-none" href="{{ route('pages.show', 'contact') }}">Contact</a>
                    <a class="text-decoration-none" href="{{ route('admin.login') }}">Admin</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer-shell py-4">
        <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
            <div>{{ config('app.name') }}</div>
            <div>Built with Laravel, Blade, MySQL, and Bootstrap 5.</div>
        </div>
    </footer>
</body>
</html>

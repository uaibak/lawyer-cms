<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f3f4f6; }
        .admin-shell { min-height: 100vh; }
        .admin-nav { background: #111827; }
        pre { white-space: pre-wrap; word-break: break-word; }
    </style>
</head>
<body>
    <div class="admin-shell">
        <nav class="navbar navbar-dark admin-nav shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-semibold" href="{{ route('admin.pages.index') }}">{{ config('app.name') }} Admin</a>
                @auth
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @endauth
            </div>
        </nav>

        <div class="container py-4">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>

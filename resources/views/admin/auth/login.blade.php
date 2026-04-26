@extends('layouts.admin')

@section('title', 'Login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-lg-5">
                    <h1 class="h3 mb-4">Admin Login</h1>
                    <form method="POST" action="{{ route('admin.login.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check mb-4">
                            <input id="remember" type="checkbox" name="remember" value="1" class="form-check-input">
                            <label for="remember" class="form-check-label">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Sign in</button>
                    </form>
                    <p class="small text-secondary mt-4 mb-0">Default seed login: <strong>admin@lawyercms.test</strong> / <strong>password123</strong></p>
                </div>
            </div>
        </div>
    </div>
@endsection

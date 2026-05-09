<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card bg-dark border-warning-subtle">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="text-brand fw-bold">Admin Login</h2>
                            <p class="text-muted">Portfolio Management</p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label text-warning">Email</label>
                                <input id="email" type="email" class="form-control bg-black text-white border-secondary @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label text-warning">Password</label>
                                <input id="password" type="password" class="form-control bg-black text-white border-secondary @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-3 form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label for="remember_me" class="form-check-label text-muted">Remember me</label>
                            </div>

                            <div class="d-grid gap-2">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-muted text-decoration-none small mb-2">Forgot your password?</a>
                                @endif
                                <button type="submit" class="btn btn-brand">
                                    Log in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

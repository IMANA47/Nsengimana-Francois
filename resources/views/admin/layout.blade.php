<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }} - Portfolio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-dark sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand text-brand fw-bold" href="{{ route('dashboard') }}">
                <i class="bi bi-gear me-2"></i>Admin Panel
            </a>
            <div class="d-flex gap-2 flex-wrap">
                <a class="btn btn-brand btn-sm" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2 me-1"></i>Dashboard
                </a>
                <a class="btn btn-outline-light btn-sm" href="{{ url('admin/projects') }}">
                    <i class="bi bi-folder me-1"></i>Projects
                </a>
                <a class="btn btn-outline-light btn-sm" href="{{ url('admin/certificates') }}">
                    <i class="bi bi-award me-1"></i>Certificates
                </a>
                <a class="btn btn-outline-light btn-sm" href="{{ url('admin/testimonials') }}">
                    <i class="bi bi-chat-quote me-1"></i>Testimonials
                </a>
                <a class="btn btn-outline-light btn-sm" href="{{ route('messages.index') }}">
                    <i class="bi bi-envelope me-1"></i>Messages
                </a>
                <a class="btn btn-outline-light btn-sm" href="{{ route('home') }}">
                    <i class="bi bi-eye me-1"></i>Site
                </a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

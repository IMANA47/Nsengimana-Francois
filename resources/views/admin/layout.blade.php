<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-dark text-white p-4">
    <div class="container">
        <div class="d-flex gap-2 flex-wrap mb-4">
            <a class="btn btn-warning btn-sm" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="btn btn-outline-light btn-sm" href="{{ url('admin/projects') }}">Projects</a>
            <a class="btn btn-outline-light btn-sm" href="{{ url('admin/certificates') }}">Certificates</a>
            <a class="btn btn-outline-light btn-sm" href="{{ url('admin/testimonials') }}">Testimonials</a>
            <a class="btn btn-outline-light btn-sm" href="{{ route('messages.index') }}">Messages</a>
            <a class="btn btn-outline-light btn-sm" href="{{ route('home') }}">Site</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>

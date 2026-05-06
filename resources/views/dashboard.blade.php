@extends('admin.layout', ['title' => 'Admin Dashboard'])

@section('content')
        <h1 class="mb-3">Dashboard Admin</h1>
        <div class="d-flex gap-2 flex-wrap">
            <a class="btn btn-warning" href="{{ url('admin/projects') }}">Gerer Projects</a>
            <a class="btn btn-warning" href="{{ url('admin/certificates') }}">Gerer Certificates</a>
            <a class="btn btn-warning" href="{{ url('admin/testimonials') }}">Gerer Testimonials</a>
            <a class="btn btn-outline-light" href="{{ route('messages.index') }}">Messages Contact</a>
            <a class="btn btn-outline-light" href="{{ route('home') }}">Voir le site</a>
        </div>
@endsection

@extends('admin.layout', ['title' => 'Admin Testimonials'])

@section('content')
<h1>Admin - Testimonials</h1>
<form method="POST" action="{{ url('admin/testimonials') }}" class="row g-2 mb-4">@csrf
<div class="col-md-4"><input class="form-control" name="client_name" placeholder="Client" value="{{ old('client_name') }}" required></div>
<div class="col-md-4"><input class="form-control" name="client_role" placeholder="Role" value="{{ old('client_role') }}"></div>
<div class="col-md-4"><input class="form-control" type="number" min="1" max="5" name="rating" value="{{ old('rating', 5) }}"></div>
<div class="col-12"><textarea class="form-control" name="content" placeholder="Temoignage" required>{{ old('content') }}</textarea></div>
<div class="col-12"><button class="btn btn-warning">Ajouter</button></div></form>
<table class="table table-dark"><tr><th>Client</th><th>Rating</th><th>Actions</th></tr>@foreach($testimonials as $testimonial)<tr><td>{{ $testimonial->client_name }}</td><td>{{ $testimonial->rating }}</td><td><a href="{{ url('admin/testimonials/'.$testimonial->id.'/edit') }}" class="btn btn-sm btn-outline-warning">Edit</a><form method="POST" action="{{ url('admin/testimonials/'.$testimonial->id) }}" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>@endforeach</table>
{{ $testimonials->links() }}
@endsection

@extends('admin.layout', ['title' => 'Edit Testimonial'])

@section('content')
<h1>Edit testimonial</h1>
<form method="POST" action="{{ url('admin/testimonials/'.$testimonial->id) }}" class="row g-2">@csrf @method('PUT')
<div class="col-md-4"><input class="form-control" name="client_name" value="{{ $testimonial->client_name }}" required></div>
<div class="col-md-4"><input class="form-control" name="client_role" value="{{ $testimonial->client_role }}"></div>
<div class="col-md-4"><input class="form-control" type="number" min="1" max="5" name="rating" value="{{ $testimonial->rating }}"></div>
<div class="col-12"><textarea class="form-control" name="content" required>{{ $testimonial->content }}</textarea></div>
<div class="col-12"><button class="btn btn-warning">Save</button></div></form>
@endsection

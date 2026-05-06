@extends('admin.layout', ['title' => 'Edit Certificate'])

@section('content')
<h1>Edit certificate</h1>
<form method="POST" action="{{ url('admin/certificates/'.$certificate->id) }}" enctype="multipart/form-data" class="row g-2">@csrf @method('PUT')
<div class="col-md-6"><input class="form-control" name="name" value="{{ $certificate->name }}" required></div>
<div class="col-md-6"><input class="form-control" name="organization" value="{{ $certificate->organization }}" required></div>
<div class="col-md-6"><input type="date" class="form-control" name="issued_at" value="{{ $certificate->issued_at }}"></div>
<div class="col-md-6"><input class="form-control" name="verification_url" value="{{ $certificate->verification_url }}"></div>
<div class="col-12"><button class="btn btn-warning">Save</button></div></form>
@endsection

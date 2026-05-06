@extends('admin.layout', ['title' => 'Admin Certificates'])

@section('content')
<h1>Admin - Certificates</h1>
<form method="POST" action="{{ url('admin/certificates') }}" enctype="multipart/form-data" class="row g-2 mb-4">@csrf
<div class="col-md-4"><input class="form-control" name="name" placeholder="Nom" value="{{ old('name') }}" required></div>
<div class="col-md-4"><input class="form-control" name="organization" placeholder="Organisation" value="{{ old('organization') }}" required></div>
<div class="col-md-4"><input type="date" class="form-control" name="issued_at" value="{{ old('issued_at') }}"></div>
<div class="col-md-6"><input class="form-control" name="verification_url" placeholder="Verification URL" value="{{ old('verification_url') }}"></div>
<div class="col-md-3"><input class="form-control" type="file" name="image"></div>
<div class="col-md-3"><input class="form-control" type="file" name="pdf"></div>
<div class="col-12"><button class="btn btn-warning">Ajouter</button></div></form>
<table class="table table-dark"><tr><th>Nom</th><th>Org</th><th>Actions</th></tr>@foreach($certificates as $certificate)<tr><td>{{ $certificate->name }}</td><td>{{ $certificate->organization }}</td><td><a href="{{ url('admin/certificates/'.$certificate->id.'/edit') }}" class="btn btn-sm btn-outline-warning">Edit</a><form method="POST" action="{{ url('admin/certificates/'.$certificate->id) }}" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>@endforeach</table>
{{ $certificates->links() }}
@endsection

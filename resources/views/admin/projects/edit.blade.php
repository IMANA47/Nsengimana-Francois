@extends('admin.layout', ['title' => 'Edit Project'])

@section('content')
    <h1>Edit project</h1>
    <form method="POST" action="{{ url('admin/projects/'.$project->id) }}" enctype="multipart/form-data" class="row g-2">
        @csrf @method('PUT')
        <div class="col-md-6"><input class="form-control" name="title" value="{{ $project->title }}" required></div>
        <div class="col-md-6"><input class="form-control" name="stack" value="{{ $project->stack }}" required></div>
        <div class="col-12"><textarea class="form-control" name="description" required>{{ $project->description }}</textarea></div>
        <div class="col-md-6"><input class="form-control" name="github_url" value="{{ $project->github_url }}"></div>
        <div class="col-md-6"><input class="form-control" name="demo_url" value="{{ $project->demo_url }}"></div>
        <div class="col-12"><button class="btn btn-warning">Save</button></div>
    </form>
@endsection

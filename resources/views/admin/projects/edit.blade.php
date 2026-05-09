@extends('admin.layout', ['title' => 'Edit Project'])

@section('content')
    <h1 class="mb-4">Edit project</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card bg-dark border-warning-subtle">
        <div class="card-body">
            <form method="POST" action="{{ url('admin/projects/'.$project->id) }}" enctype="multipart/form-data" class="row g-3">
                @csrf @method('PUT')
                <div class="col-md-6">
                    <label class="form-label text-warning">Titre *</label>
                    <input class="form-control bg-black text-white border-secondary" name="title" value="{{ $project->title }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">Stack *</label>
                    <input class="form-control bg-black text-white border-secondary" name="stack" value="{{ $project->stack }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label text-warning">Description *</label>
                    <textarea class="form-control bg-black text-white border-secondary" name="description" rows="3" required>{{ $project->description }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">GitHub URL</label>
                    <input class="form-control bg-black text-white border-secondary" name="github_url" value="{{ $project->github_url }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">Demo URL</label>
                    <input class="form-control bg-black text-white border-secondary" name="demo_url" value="{{ $project->demo_url }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">Image</label>
                    <input class="form-control bg-black text-white border-secondary" name="image" type="file" accept="image/*">
                    @if($project->image_path)
                        <small class="text-muted">Image actuelle: {{ $project->image_path }}</small>
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">Featured</label>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ $project->is_featured ? 'checked' : '' }}>
                        <label class="form-check-label">Mettre en avant</label>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-brand">Save</button>
                    <a href="{{ url('admin/projects') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

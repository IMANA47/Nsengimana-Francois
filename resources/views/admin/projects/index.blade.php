@extends('admin.layout', ['title' => 'Admin Projects'])

@section('content')
    <h1 class="mb-4">Admin - Projects</h1>
    
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

    <div class="card bg-dark border-warning-subtle mb-4">
        <div class="card-header">
            <h5 class="mb-0">Ajouter un projet</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('admin/projects') }}" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label text-warning">Titre *</label>
                    <input class="form-control bg-black text-white border-secondary" name="title" placeholder="Titre" value="{{ old('title') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">Stack *</label>
                    <input class="form-control bg-black text-white border-secondary" name="stack" placeholder="Ex: Laravel, Vue, MySQL" value="{{ old('stack') }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label text-warning">Description *</label>
                    <textarea class="form-control bg-black text-white border-secondary" name="description" placeholder="Description du projet" rows="3" required>{{ old('description') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">GitHub URL</label>
                    <input class="form-control bg-black text-white border-secondary" name="github_url" placeholder="https://github.com/..." value="{{ old('github_url') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">Demo URL</label>
                    <input class="form-control bg-black text-white border-secondary" name="demo_url" placeholder="https://..." value="{{ old('demo_url') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">Image</label>
                    <input class="form-control bg-black text-white border-secondary" name="image" type="file" accept="image/*">
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">Featured</label>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1">
                        <label class="form-check-label">Mettre en avant</label>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-brand">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-dark table-striped">
        <tr><th>Titre</th><th>Stack</th><th>Actions</th></tr>
        @foreach($projects as $project)
            <tr>
                <td>{{ $project->title }}</td>
                <td>{{ $project->stack }}</td>
                <td>
                    <a href="{{ url('admin/projects/'.$project->id.'/edit') }}" class="btn btn-sm btn-outline-warning">Edit</a>
                    <form method="POST" action="{{ url('admin/projects/'.$project->id) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $projects->links() }}
@endsection

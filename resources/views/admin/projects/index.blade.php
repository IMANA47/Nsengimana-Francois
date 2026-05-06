@extends('admin.layout', ['title' => 'Admin Projects'])

@section('content')
    <h1 class="mb-4">Admin - Projects</h1>
    <form method="POST" action="{{ url('admin/projects') }}" enctype="multipart/form-data" class="row g-2 mb-4">
        @csrf
        <div class="col-md-4"><input class="form-control" name="title" placeholder="Titre" value="{{ old('title') }}" required></div>
        <div class="col-md-4"><input class="form-control" name="stack" placeholder="Stack" value="{{ old('stack') }}" required></div>
        <div class="col-md-4"><input class="form-control" name="image" type="file"></div>
        <div class="col-12"><textarea class="form-control" name="description" placeholder="Description" required>{{ old('description') }}</textarea></div>
        <div class="col-md-6"><input class="form-control" name="github_url" placeholder="GitHub URL" value="{{ old('github_url') }}"></div>
        <div class="col-md-6"><input class="form-control" name="demo_url" placeholder="Demo URL" value="{{ old('demo_url') }}"></div>
        <div class="col-12"><button class="btn btn-warning">Ajouter</button></div>
    </form>
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

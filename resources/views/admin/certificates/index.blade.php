@extends('admin.layout', ['title' => 'Admin Certificates'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-brand"><i class="bi bi-award me-2"></i>Certificates</h1>
</div>

<div class="card bg-dark border-secondary mb-4">
    <div class="card-header">
        <h5 class="mb-0">Ajouter un certificat</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('admin/certificates') }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-4">
                <label class="form-label text-warning">Nom *</label>
                <input class="form-control" name="name" placeholder="Nom du certificat" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label text-warning">Organisation *</label>
                <input class="form-control" name="organization" placeholder="Organisation" value="{{ old('organization') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label text-warning">Date</label>
                <input type="date" class="form-control" name="issued_at" value="{{ old('issued_at') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label text-warning">URL de vérification</label>
                <input class="form-control" name="verification_url" placeholder="https://..." value="{{ old('verification_url') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-warning">Image</label>
                <input class="form-control" type="file" name="image" accept="image/*">
            </div>
            <div class="col-md-3">
                <label class="form-label text-warning">PDF</label>
                <input class="form-control" type="file" name="pdf" accept=".pdf">
            </div>
            <div class="col-12">
                <button class="btn btn-brand">
                    <i class="bi bi-plus-circle me-1"></i>Ajouter
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card bg-dark border-secondary">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Organisation</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($certificates as $certificate)
                        <tr>
                            <td>{{ $certificate->name }}</td>
                            <td>{{ $certificate->organization }}</td>
                            <td>{{ $certificate->issued_at ? (is_string($certificate->issued_at) ? \Carbon\Carbon::parse($certificate->issued_at)->format('d/m/Y') : $certificate->issued_at->format('d/m/Y')) : '-' }}</td>
                            <td>
                                <a href="{{ url('admin/certificates/'.$certificate->id.'/edit') }}" class="btn btn-sm btn-outline-light me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form method="POST" action="{{ url('admin/certificates/'.$certificate->id) }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $certificates->links() }}
    </div>
</div>
@endsection

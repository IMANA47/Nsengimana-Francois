@extends('admin.layout', ['title' => 'Admin Testimonials'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-brand"><i class="bi bi-chat-quote me-2"></i>Testimonials</h1>
</div>

<div class="card bg-dark border-secondary mb-4">
    <div class="card-header">
        <h5 class="mb-0">Ajouter un témoignage</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('admin/testimonials') }}" class="row g-3">
            @csrf
            <div class="col-md-4">
                <label class="form-label text-warning">Nom du client *</label>
                <input class="form-control" name="client_name" placeholder="Nom du client" value="{{ old('client_name') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label text-warning">Rôle</label>
                <input class="form-control" name="client_role" placeholder="Rôle/Poste" value="{{ old('client_role') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label text-warning">Note</label>
                <input class="form-control" type="number" min="1" max="5" name="rating" value="{{ old('rating', 5) }}">
            </div>
            <div class="col-12">
                <label class="form-label text-warning">Témoignage *</label>
                <textarea class="form-control" name="content" rows="4" placeholder="Témoignage du client" required>{{ old('content') }}</textarea>
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
                        <th>Client</th>
                        <th>Rôle</th>
                        <th>Note</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $testimonial)
                        <tr>
                            <td>{{ $testimonial->client_name }}</td>
                            <td>{{ $testimonial->client_role }}</td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $testimonial->rating)
                                        <i class="bi bi-star-fill text-brand"></i>
                                    @else
                                        <i class="bi bi-star text-muted"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                <a href="{{ url('admin/testimonials/'.$testimonial->id.'/edit') }}" class="btn btn-sm btn-outline-light me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form method="POST" action="{{ url('admin/testimonials/'.$testimonial->id) }}" class="d-inline">
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
        {{ $testimonials->links() }}
    </div>
</div>
@endsection

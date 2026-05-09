<section id="projects" class="section-block">
    <div class="container reveal">
        <div class="text-center mb-5">
            <h2 class="text-brand display-6 fw-bold">Projects</h2>
            <p class="text-white">Mes réalisations récentes</p>
        </div>
        <div class="row g-4">
            @foreach($projects as $project)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 bg-dark text-white border-secondary shadow-lg project-card">
                        @if($project->image_path)
                            <img src="{{ asset('storage/' . $project->image_path) }}" class="card-img-top project-image" alt="{{ $project->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span class="text-white fs-1">📁</span>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-white">{{ $project->title }}</h5>
                            <p class="small badge bg-brand text-dark mb-2">{{ $project->stack }}</p>
                            <p class="card-text text-white flex-grow-1">{{ \Illuminate\Support\Str::limit($project->description, 150) }}</p>
                            <div class="mt-3 d-flex gap-2 flex-wrap">
                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" class="btn btn-sm btn-outline-light flex-grow-1">
                                        <i class="bi bi-github"></i> GitHub
                                    </a>
                                @endif
                                @if($project->demo_url)
                                    <a href="{{ $project->demo_url }}" target="_blank" class="btn btn-sm btn-brand flex-grow-1">
                                        <i class="bi bi-eye"></i> Demo
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

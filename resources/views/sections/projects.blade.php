<section id="projects" class="section-block">
    <div class="container reveal">
        <div class="text-center mb-5">
            <h2 class="text-brand display-6 display-md-5 fw-bold">Projects</h2>
            <p class="text-white fs-5 fs-md-4">Mes réalisations récentes</p>
        </div>
        <div class="row g-4 g-md-5">
            @foreach($projects as $project)
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card h-100 bg-dark text-white border-secondary shadow-lg project-card">
                        <div class="project-image-container">
                            @if($project->image_path)
                                <img src="{{ asset('storage/' . $project->image_path) }}" class="card-img-top project-image" alt="{{ $project->title }}">
                            @else
                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center project-placeholder">
                                    <span class="text-white fs-1">📁</span>
                                </div>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title fw-bold text-white fs-5 mb-3">{{ $project->title }}</h5>
                            <p class="small badge bg-brand text-dark mb-3">{{ $project->stack }}</p>
                            <p class="card-text text-white flex-grow-1 mb-4">{{ \Illuminate\Support\Str::limit($project->description, 150) }}</p>
                            <div class="project-actions mt-auto d-flex gap-2 flex-wrap">
                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" class="btn btn-sm btn-outline-light flex-grow-1 flex-md-auto project-btn">
                                        <i class="bi bi-github me-1"></i> GitHub
                                    </a>
                                @endif
                                @if($project->demo_url)
                                    <a href="{{ $project->demo_url }}" target="_blank" class="btn btn-sm btn-brand flex-grow-1 flex-md-auto project-btn">
                                        <i class="bi bi-eye me-1"></i> Demo
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

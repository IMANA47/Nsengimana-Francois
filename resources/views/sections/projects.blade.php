<section id="projects" class="section-block bg-dark">
    <div class="container reveal">
        <h2 class="text-brand mb-4">Projects</h2>
        <div class="row g-4">
            @foreach($projects as $project)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 bg-black text-white border-warning-subtle">
                        <div class="card-body">
                            <h5>{{ $project->title }}</h5>
                            <p class="small text-warning">{{ $project->stack }}</p>
                            <p>{{ \Illuminate\Support\Str::limit($project->description, 120) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

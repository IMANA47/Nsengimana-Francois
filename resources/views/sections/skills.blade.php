<section id="skills" class="section-block">
    <div class="container reveal">
        <div class="text-center mb-5">
            <h2 class="text-brand display-6 fw-bold">Skills</h2>
            <p class="text-white">Mes compétences techniques</p>
        </div>
        <div class="row g-4">
            @foreach($skills as $category => $items)
                <div class="col-md-6">
                    <div class="card bg-dark border-secondary h-100">
                        <div class="card-body">
                            <h5 class="card-title text-brand mb-4">
                                <i class="bi bi-puzzle me-2"></i>{{ $category }}
                            </h5>
                            @foreach($items as $skill)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-white fw-bold">{{ $skill->name }}</span>
                                        <span class="text-brand fw-bold">{{ $skill->proficiency }}%</span>
                                    </div>
                                    <div class="progress" style="height: 10px; background-color: #333;">
                                        <div class="progress-bar bg-brand" style="width: {{ $skill->proficiency }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

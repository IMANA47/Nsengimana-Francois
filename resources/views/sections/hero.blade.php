<section id="home" class="section-block">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-8 reveal">
                <span class="badge bg-brand text-dark mb-3">Full Stack Developer</span>
                <h1 class="display-3 fw-bold mb-3">{{ $profile['name'] }}</h1>
                <p class="text-brand h3 mb-4">{{ $profile['title'] }}</p>
                <p class="lead text-white mb-4">{{ $profile['tagline'] }}</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a class="btn btn-brand" href="#contact">
                        <i class="bi bi-envelope me-2"></i>Me contacter
                    </a>
                    <a class="btn btn-outline-light" href="#projects">
                        <i class="bi bi-folder me-2"></i>Voir projets
                    </a>
                </div>
            </div>
            <div class="col-lg-4 reveal">
                <div class="text-center">
                    <div class="bg-brand rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 150px; height: 150px;">
                        <i class="bi bi-person-circle text-dark fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

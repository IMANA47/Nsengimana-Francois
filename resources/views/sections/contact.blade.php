<section id="contact" class="section-block">
    <div class="container reveal">
        <div class="text-center mb-5">
            <h2 class="text-brand display-6 fw-bold">Contact</h2>
            <p class="text-white">Travaillons ensemble</p>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <div class="row g-4 align-items-stretch">
            <div class="col-md-5">
                <div class="card bg-dark border-secondary mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-brand mb-4">
                            <i class="bi bi-envelope me-2"></i>Contactez-moi
                        </h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bi bi-envelope text-brand me-3 fs-5"></i>
                                <span class="text-white">{{ config('portfolio.profile.email') }}</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bi bi-geo-alt text-brand me-3 fs-5"></i>
                                <span class="text-white">Brazzaville, République du Congo</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bi bi-telephone text-brand me-3 fs-5"></i>
                                <span class="text-white">(+242) 06 948 51 54</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="card bg-dark border-secondary mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-brand mb-3">
                            <i class="bi bi-share me-2"></i>Réseaux sociaux
                        </h5>
                        <div class="d-flex flex-wrap gap-3 fs-4">
                            <a href="#" class="text-white hover-brand"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-white hover-brand"><i class="bi bi-github"></i></a>
                            <a href="#" class="text-white hover-brand"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-white hover-brand"><i class="bi bi-facebook"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="card bg-dark border-secondary">
                    <div class="card-body">
                        <h5 class="card-title text-brand mb-3">
                            <i class="bi bi-clock me-2"></i>Disponibilité
                        </h5>
                        <p class="card-text text-white small">
                            Je suis disponible pour contribuer à divers besoins numériques et techniques.<br>
                            Je réponds généralement sous 48 heures.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-7">
                <div class="card bg-dark border-secondary">
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label text-warning">Nom complet *</label>
                                <input id="name" name="name" class="form-control" placeholder="Votre nom" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label text-warning">Type de projet *</label>
                                <input id="subject" name="subject" class="form-control" placeholder="Type de projet" value="{{ old('subject') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="budget" class="form-label text-warning">Budget</label>
                                <input id="budget" name="budget" class="form-control" placeholder="Budget estimé" value="{{ old('budget') }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label text-warning">Email *</label>
                                <input id="email" type="email" name="email" class="form-control" placeholder="Votre email" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label text-warning">Message *</label>
                                <textarea id="message" name="message" class="form-control" rows="4" placeholder="Votre message" required>{{ old('message') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-brand w-100 fw-bold">
                                <i class="bi bi-send me-2"></i>Envoyer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
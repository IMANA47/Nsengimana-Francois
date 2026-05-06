<section id="contact" class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center mb-2" style="color:#1a2341;">CONTACT</h2>
        <p class="text-center text-muted mb-4">Travaillons ensemble<br>
            Chaque projet est unique. Je m’assure de comprendre vos besoins et de proposer des solutions claires, efficaces, sécurisées et adaptées, en collaborant là où je peux apporter le plus d’impact.
        </p>
        <!-- Toast de succès -->
        @if(session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
            <div id="contactSuccessToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toastEl = document.getElementById('contactSuccessToast');
                if (toastEl) {
                    var toast = new bootstrap.Toast(toastEl, {
                        delay: 4000
                    });
                    toast.show();
                }
            });
        </script>
        @endif
        <div class="row g-4 align-items-stretch">
            <!-- Colonne gauche -->
            <div class="col-md-5">
                <div class="mb-3 p-3 bg-light rounded shadow-sm">
                    <h5>Contactez-moi via :</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><span class="me-2"><i class="bi bi-envelope text-warning"></i></span> franknsengimana3@gmail.com</li>
                        <li class="mb-2"><span class="me-2"><i class="bi bi-geo-alt text-warning"></i></span> Brazzaville, République du Congo</li>
                        <li><span class="me-2"><i class="bi bi-telephone text-warning"></i></span> (+242) 06 948 51 54</li>
                    </ul>
                </div>
                <div class="mb-3 p-3 bg-light rounded shadow-sm">
                    <h5>Mes réseaux sociaux</h5>
                    <div class="d-flex flex-wrap gap-2 fs-4">
                        <a href="#" class="text-warning"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="text-warning"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="text-warning"><i class="bi bi-github"></i></a>
                        <a href="#" class="text-warning"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-warning"><i class="bi bi-telegram"></i></a>
                        <a href="#" class="text-warning"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-warning"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>
                <div class="p-3 border border-warning rounded">
                    <h5 class="text-warning">Disponibilité</h5>
                    <p class="mb-0 small">
                        Je suis disponible pour contribuer à divers besoins numériques et techniques, au-delà du simple développement.<br>
                        Je réponds généralement sous 48 heures (en cas d’indisponibilité exceptionnelle, le délai peut aller jusqu’à 72 heures).
                    </p>
                </div>
            </div>
            <!-- Colonne droite -->
            <div class="col-md-7">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('contact.store') }}" class="">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nom complet</label>
                        <input name="name" class="form-control" placeholder="Votre nom" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type projet</label>
                        <input name="subject" class="form-control" placeholder="Type de projet" value="{{ old('subject') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Budget</label>
                        <input name="budget" class="form-control" placeholder="Budget" value="{{ old('budget') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Votre email" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Votre message" required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn w-100 fw-bold" style="background:#fff700;color:#1a2341;">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>
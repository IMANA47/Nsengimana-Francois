<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $seo['description'] }}">
    <meta property="og:title" content="{{ $seo['title'] }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:type" content="website">
    <title>{{ $seo['title'] }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-warning-subtle sticky-top">
        <div class="container">
            <a class="navbar-brand text-brand fw-bold" href="#home">Portfolio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto">
                    @foreach($sections as $section)
                        @if($section['enabled'])
                            <li class="nav-item"><a class="nav-link" href="#{{ $section['key'] }}">{{ $section['title'] }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="section-block">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-8 reveal">
                    <h1 class="display-4 fw-bold">{{ $profile['name'] }}</h1>
                    <p class="text-brand h4">{{ $profile['title'] }}</p>
                    <p class="lead">{{ $profile['tagline'] }}</p>
                    <a class="btn btn-brand me-2" href="#contact">Me contacter</a>
                    <a class="btn btn-outline-light" href="#projects">Voir projets</a>
                </div>
            </div>
        </div>
    </section>

    @foreach($sections as $section)
        @include($section['view'])
    @endforeach

    <button class="btn btn-brand floating-chat" data-bs-toggle="offcanvas" data-bs-target="#chatbotPanel">Chat</button>
    <a class="btn btn-success floating-whatsapp" target="_blank" href="https://wa.me/{{ $profile['whatsapp'] }}?text=Bonjour%2C%20je%20suis%20interesse%20par%20vos%20services">WhatsApp</a>

    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="chatbotPanel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Assistant portfolio</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div id="chatMessages" class="small mb-3"></div>
            <div class="input-group">
                <input id="chatInput" class="form-control" placeholder="Pose ta question...">
                <button id="chatSend" class="btn btn-brand">Envoyer</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const answers = {
            "qui es-tu ?": "Je suis un software engineer full stack specialise Laravel.",
            "quelles sont tes competences ?": "Laravel, PHP, JS, API REST, architecture logicielle, Bootstrap.",
            "comment te contacter ?": "Tu peux utiliser le formulaire Contact ou WhatsApp.",
            "quels services proposes-tu ?": "Developpement web, APIs, maintenance applicative et accompagnement technique."
        };
        const list = document.getElementById("chatMessages");
        const input = document.getElementById("chatInput");
        const send = document.getElementById("chatSend");
        const add = (t, c = "text-warning") => {
            const p = document.createElement("p");
            p.className = c + " mb-2";
            p.textContent = t;
            list.appendChild(p);
        };
        send.addEventListener("click", () => {
            const q = (input.value || "").trim().toLowerCase();
            if (!q) return;
            add("Vous: " + q, "text-white");
            add("Bot: " + (answers[q] ?? "Je n'ai pas encore cette reponse, mais je peux etre connecte a une API IA plus tard."));
            input.value = "";
        });

        const reveals = document.querySelectorAll(".reveal");
        const io = new IntersectionObserver((entries) => {
            entries.forEach((e) => e.target.classList.toggle("show", e.isIntersecting));
        }, { threshold: 0.1 });
        reveals.forEach((el) => io.observe(el));
    </script>
</body>
</html>

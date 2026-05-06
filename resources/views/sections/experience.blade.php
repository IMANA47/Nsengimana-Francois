<section id="experience" class="section-block bg-dark">
    <div class="container reveal">
        <h2 class="text-brand mb-4">Experience</h2>
        @foreach($experiences as $experience)
            <div class="border-start border-warning ps-3 mb-3">
                <h5>{{ $experience->role }} - {{ $experience->company }}</h5>
                <p>{{ $experience->summary }}</p>
            </div>
        @endforeach
    </div>
</section>

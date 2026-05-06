<section id="testimonials" class="section-block bg-dark">
    <div class="container reveal">
        <h2 class="text-brand mb-4">Testimonials</h2>
        <div class="row g-3">
            @foreach($testimonials as $testimonial)
                <div class="col-md-6">
                    <blockquote class="border border-warning-subtle rounded p-3 h-100">
                        <p>"{{ $testimonial->content }}"</p>
                        <footer class="small">{{ $testimonial->client_name }} - {{ $testimonial->client_role }}</footer>
                    </blockquote>
                </div>
            @endforeach
        </div>
    </div>
</section>

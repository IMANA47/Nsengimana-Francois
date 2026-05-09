<section id="testimonials" class="section-block">
    <div class="container reveal">
        <div class="text-center mb-5">
            <h2 class="text-brand display-6 fw-bold">Testimonials</h2>
            <p class="text-white">Ce que mes clients disent</p>
        </div>
        <div class="row g-4">
            @foreach($testimonials as $testimonial)
                <div class="col-md-6">
                    <div class="card bg-dark border-secondary h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="bi bi-quote text-brand fs-2"></i>
                            </div>
                            <p class="card-text text-white fst-italic">"{{ $testimonial->content }}"</p>
                            <div class="mt-4">
                                <h6 class="fw-bold text-white">{{ $testimonial->client_name }}</h6>
                                <p class="small text-brand mb-0">{{ $testimonial->client_role }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

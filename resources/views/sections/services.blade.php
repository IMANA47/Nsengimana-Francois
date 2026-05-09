<section id="services" class="section-block">
    <div class="container reveal">
        <div class="text-center mb-5">
            <h2 class="text-brand display-6 fw-bold">Services</h2>
            <p class="text-white">Ce que je peux faire pour vous</p>
        </div>
        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-md-4">
                    <div class="card bg-dark border-secondary h-100 service-card">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-lightning-charge-fill text-brand fs-2"></i>
                            </div>
                            <h5 class="card-title fw-bold text-white">{{ $service->title }}</h5>
                            <p class="card-text text-white">{{ $service->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

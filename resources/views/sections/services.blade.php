<section id="services" class="section-block">
    <div class="container reveal">
        <h2 class="text-brand mb-4">Services</h2>
        <div class="row g-3">
            @foreach($services as $service)
                <div class="col-md-4">
                    <div class="p-3 border border-warning-subtle rounded h-100">
                        <h5>{{ $service->title }}</h5>
                        <p>{{ $service->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

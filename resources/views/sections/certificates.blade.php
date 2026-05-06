<section id="certificates" class="section-block">
    <div class="container reveal">
        <h2 class="text-brand mb-4">Certificates</h2>
        <div class="row g-3">
            @foreach($certificates as $certificate)
                <div class="col-md-4">
                    <div class="card bg-black text-white border-warning-subtle h-100">
                        <div class="card-body">
                            <h5>{{ $certificate->name }}</h5>
                            <p class="text-warning">{{ $certificate->organization }}</p>
                            @if($certificate->verification_url)
                                <a class="btn btn-sm btn-outline-light" href="{{ $certificate->verification_url }}" target="_blank">Verifier</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

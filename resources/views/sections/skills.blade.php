<section id="skills" class="section-block">
    <div class="container reveal">
        <h2 class="text-brand mb-4">Skills</h2>
        @foreach($skills as $category => $items)
            <h5>{{ $category }}</h5>
            @foreach($items as $skill)
                <div class="mb-2">{{ $skill->name }} ({{ $skill->proficiency }}%)</div>
                <div class="progress mb-3">
                    <div class="progress-bar bg-warning text-dark" style="width: {{ $skill->proficiency }}%"></div>
                </div>
            @endforeach
        @endforeach
    </div>
</section>

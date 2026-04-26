<div class="container py-5">
    <h2 class="section-title h1 mb-4">{{ $data['title'] ?? 'Testimonials' }}</h2>
    <div class="row g-4">
        @foreach (($data['items'] ?? []) as $item)
            <div class="col-md-6">
                <blockquote class="border-start border-4 border-warning bg-white p-4 shadow-sm h-100 mb-0">
                    <p class="fs-5 mb-3">"{{ $item['quote'] ?? '' }}"</p>
                    <footer class="text-secondary">{{ $item['name'] ?? '' }}</footer>
                </blockquote>
            </div>
        @endforeach
    </div>
</div>

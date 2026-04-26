<div class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="section-title h1 mb-2">{{ $data['title'] ?? 'Services' }}</h2>
            <p class="text-secondary mb-0">Focused support across the matters clients face most often.</p>
        </div>
    </div>
    <div class="row g-4">
        @foreach (($data['items'] ?? []) as $item)
            <div class="col-md-6 col-xl-4">
                <article class="h-100 border rounded-3 bg-white p-4 shadow-sm">
                    <h3 class="h4 mb-3">{{ $item['title'] ?? '' }}</h3>
                    <p class="mb-0 text-secondary">{{ $item['description'] ?? '' }}</p>
                </article>
            </div>
        @endforeach
    </div>
</div>

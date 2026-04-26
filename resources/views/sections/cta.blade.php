<div class="container py-5">
    <div class="rounded-3 bg-dark text-white p-5 text-center">
        <h2 class="display-6 fw-bold mb-3">{{ $data['heading'] ?? '' }}</h2>
        <p class="lead mb-4">{{ $data['text'] ?? '' }}</p>
        @if (! empty($data['button_text']) && ! empty($data['button_link']))
            <a href="{{ $data['button_link'] }}" class="btn btn-warning btn-lg">{{ $data['button_text'] }}</a>
        @endif
    </div>
</div>

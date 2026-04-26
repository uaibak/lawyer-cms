<div class="hero-shell py-5">
    <div class="container py-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <p class="text-uppercase small fw-semibold mb-3">Trusted Legal Representation</p>
                <h1 class="display-5 fw-bold mb-3">{{ $data['heading'] ?? '' }}</h1>
                <p class="lead mb-4">{{ $data['subheading'] ?? '' }}</p>
                @if (! empty($data['cta_text']) && ! empty($data['cta_link']))
                    <a href="{{ $data['cta_link'] }}" class="btn btn-warning btn-lg">{{ $data['cta_text'] }}</a>
                @endif
            </div>
        </div>
    </div>
</div>

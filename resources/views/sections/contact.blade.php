<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-6">
            <h2 class="section-title h1 mb-3">{{ $data['title'] ?? 'Contact' }}</h2>
            <p class="mb-0 text-secondary">Reach out to schedule a consultation or ask a question.</p>
        </div>
        <div class="col-lg-6">
            <div class="bg-white border rounded-3 shadow-sm p-4">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Phone</dt>
                    <dd class="col-sm-8">{{ $data['phone'] ?? '' }}</dd>
                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $data['email'] ?? '' }}</dd>
                    <dt class="col-sm-4">Address</dt>
                    <dd class="col-sm-8">{{ $data['address'] ?? '' }}</dd>
                    <dt class="col-sm-4">Hours</dt>
                    <dd class="col-sm-8 mb-0">{{ $data['hours'] ?? '' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>

@php
    $selectedType = old('type', $section->type ?: 'hero');
    $contentData = old('content_fields', $sectionData ?? []);
@endphp

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="mb-3">
                    <label for="type" class="form-label">Section Type</label>
                    <select id="type" name="type" class="form-select @error('type') is-invalid @enderror" data-section-type-select>
                        @foreach ($sectionTypes as $type)
                            <option value="{{ $type }}" @selected($selectedType === $type)>{{ $sectionLabels[$type] ?? ucfirst($type) }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label">Sort Order</label>
                    <input id="sort_order" type="number" min="1" name="sort_order" value="{{ old('sort_order', $section->sort_order ?: ($page->sections->max('sort_order') + 1 ?: 1)) }}" class="form-control @error('sort_order') is-invalid @enderror">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="form-label">Reference JSON</label>
                    @foreach ($sectionTypes as $type)
                        <pre class="small bg-light rounded-3 p-3 border mb-0 section-json-example @if ($selectedType !== $type) d-none @endif" data-json-example="{{ $type }}">{{ json_encode($sectionDefinitions[$type]['example'] ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="mb-3">
                    <h2 class="h5 mb-1">Section Content</h2>
                    <p class="text-secondary mb-0">This editor is generated from the section registry. Add or change a section schema in PHP, and the admin form follows along.</p>
                </div>

                @foreach ($sectionTypes as $type)
                    <div class="section-fields @if ($selectedType !== $type) d-none @endif" data-section-fields="{{ $type }}">
                        @include('admin.sections.partials.fields', [
                            'fields' => $sectionDefinitions[$type]['fields'] ?? [],
                            'contentData' => $contentData,
                            'inputRoot' => 'content_fields',
                            'errorRoot' => 'content_fields',
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.querySelector('[data-section-type-select]');

    if (!select) {
        return;
    }

    const syncPanelState = (panel, isVisible) => {
        panel.classList.toggle('d-none', !isVisible);

        panel.querySelectorAll('input, textarea, select').forEach((element) => {
            element.disabled = !isVisible;
        });
    };

    const syncVisibleSection = () => {
        const type = select.value;

        document.querySelectorAll('[data-section-fields]').forEach((panel) => {
            syncPanelState(panel, panel.dataset.sectionFields === type);
        });

        document.querySelectorAll('[data-json-example]').forEach((panel) => {
            panel.classList.toggle('d-none', panel.dataset.jsonExample !== type);
        });
    };

    select.addEventListener('change', syncVisibleSection);
    syncVisibleSection();
});
</script>

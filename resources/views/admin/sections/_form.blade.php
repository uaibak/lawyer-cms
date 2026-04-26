<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="mb-3">
                    <label for="type" class="form-label">Section Type</label>
                    <select id="type" name="type" class="form-select @error('type') is-invalid @enderror">
                        @foreach ($sectionTypes as $type)
                            <option value="{{ $type }}" @selected(old('type', $section->type ?: 'hero') === $type)>{{ ucfirst($type) }}</option>
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
                    <label class="form-label">Example JSON</label>
                    <pre class="small bg-light rounded-3 p-3 border">{{ $contentExample }}</pre>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <label for="content" class="form-label">Content JSON</label>
                <textarea id="content" name="content" rows="20" class="form-control font-monospace @error('content') is-invalid @enderror">{{ old('content', $section->content ?: $contentExample) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

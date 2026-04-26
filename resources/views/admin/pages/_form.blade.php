<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="title" class="form-label">Page Title</label>
                <input id="title" type="text" name="title" value="{{ old('title', $page->title) }}" class="form-control @error('title') is-invalid @enderror" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="slug" class="form-label">Slug</label>
                <input id="slug" type="text" name="slug" value="{{ old('slug', $page->slug) }}" class="form-control @error('slug') is-invalid @enderror" placeholder="auto-generated-from-title">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input id="meta_title" type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="form-control @error('meta_title') is-invalid @enderror">
                @error('meta_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea id="meta_description" name="meta_description" rows="4" class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $page->meta_description) }}</textarea>
                @error('meta_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

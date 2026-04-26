@extends('layouts.admin')

@section('title', 'Edit Page')

@section('content')
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Edit Page</h1>
            <p class="text-secondary mb-0">Manage SEO fields and build the page by arranging sections.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ $page->slug === 'home' ? route('home') : route('pages.show', $page->slug) }}" class="btn btn-outline-secondary">View Page</a>
            <a href="{{ route('admin.pages.sections.create', $page) }}" class="btn btn-dark">Add Section</a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.pages.update', $page) }}" class="vstack gap-4 mb-4">
        @csrf
        @method('PUT')
        @include('admin.pages._form')
        <div>
            <button type="submit" class="btn btn-dark">Save Page</button>
        </div>
    </form>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h2 class="h5 mb-0">Page Builder</h2>
        </div>
        <div class="card-body p-0">
            @if ($page->sections->isEmpty())
                <div class="p-4 text-secondary">No sections added yet.</div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order</th>
                                <th>Type</th>
                                <th>Content Preview</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($page->sections as $section)
                                <tr>
                                    <td>{{ $section->sort_order }}</td>
                                    <td class="text-capitalize">{{ $section->type }}</td>
                                    <td><pre class="small mb-0">{{ $section->content }}</pre></td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-2">
                                            <a href="{{ route('admin.sections.edit', [$page, $section]) }}" class="btn btn-outline-dark btn-sm">Edit</a>
                                            <form method="POST" action="{{ route('admin.sections.destroy', [$page, $section]) }}" onsubmit="return confirm('Delete this section?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

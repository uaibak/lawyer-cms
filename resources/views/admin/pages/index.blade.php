@extends('layouts.admin')

@section('title', 'Pages')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Pages</h1>
            <p class="text-secondary mb-0">Create and manage site pages and their reusable sections.</p>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-dark">New Page</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Sections</th>
                        <th>Updated</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $page)
                        <tr>
                            <td>{{ $page->title }}</td>
                            <td><code>{{ $page->slug }}</code></td>
                            <td>{{ $page->sections_count }}</td>
                            <td>{{ $page->updated_at->diffForHumans() }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ $page->slug === 'home' ? route('home') : route('pages.show', $page->slug) }}" class="btn btn-outline-secondary btn-sm">View</a>
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-outline-dark btn-sm">Edit</a>
                                    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" onsubmit="return confirm('Delete this page?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-secondary">No pages yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $pages->links() }}
    </div>
@endsection

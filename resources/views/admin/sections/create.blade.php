@extends('layouts.admin')

@section('title', 'Add Section')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Add Section</h1>
            <p class="text-secondary mb-0">Append a reusable Blade section to the <strong>{{ $page->title }}</strong> page.</p>
        </div>
        <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-outline-secondary">Back</a>
    </div>

    <form method="POST" action="{{ route('admin.pages.sections.store', $page) }}" class="vstack gap-4">
        @csrf
        @include('admin.sections._form')
        <div>
            <button type="submit" class="btn btn-dark">Add Section</button>
        </div>
    </form>
@endsection

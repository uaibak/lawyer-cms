@extends('layouts.admin')

@section('title', 'Edit Section')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Edit Section</h1>
            <p class="text-secondary mb-0">Update the section payload and display order for <strong>{{ $page->title }}</strong>.</p>
        </div>
        <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-outline-secondary">Back</a>
    </div>

    <form method="POST" action="{{ route('admin.sections.update', [$page, $section]) }}" class="vstack gap-4">
        @csrf
        @method('PUT')
        @include('admin.sections._form')
        <div>
            <button type="submit" class="btn btn-dark">Save Section</button>
        </div>
    </form>
@endsection

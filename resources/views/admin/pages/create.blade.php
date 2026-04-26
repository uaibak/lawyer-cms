@extends('layouts.admin')

@section('title', 'Create Page')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Create Page</h1>
            <p class="text-secondary mb-0">Set the page details first, then add reusable sections.</p>
        </div>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>

    <form method="POST" action="{{ route('admin.pages.store') }}" class="vstack gap-4">
        @csrf
        @include('admin.pages._form')
        <div>
            <button type="submit" class="btn btn-dark">Create Page</button>
        </div>
    </form>
@endsection

@extends('layouts.frontend')

@section('content')
    @foreach ($page->sections as $section)
        <section class="section-band">
            @includeIf('sections.' . $section->type, ['data' => $section->contentData()])
        </section>
    @endforeach
@endsection

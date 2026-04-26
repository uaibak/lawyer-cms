<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSectionRequest;
use App\Http\Requests\Admin\UpdateSectionRequest;
use App\Models\Page;
use App\Models\Section;
use App\Support\SectionContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SectionController extends Controller
{
    public function create(Page $page): View
    {
        return view('admin.sections.create', [
            'page' => $page,
            'section' => new Section(),
            'sectionTypes' => Section::TYPES,
            'contentExample' => SectionContent::example('hero'),
        ]);
    }

    public function store(StoreSectionRequest $request, Page $page): RedirectResponse
    {
        $page->sections()->create([
            'type' => $request->validated('type'),
            'sort_order' => $request->validated('sort_order'),
            'content' => SectionContent::sanitizeJson($request->validated('content')),
        ]);

        Cache::forget("pages.slug.{$page->slug}");

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Section added successfully.');
    }

    public function edit(Page $page, Section $section): View
    {
        abort_unless($section->page_id === $page->id, 404);

        return view('admin.sections.edit', [
            'page' => $page,
            'section' => $section,
            'sectionTypes' => Section::TYPES,
            'contentExample' => SectionContent::example($section->type),
        ]);
    }

    public function update(UpdateSectionRequest $request, Page $page, Section $section): RedirectResponse
    {
        abort_unless($section->page_id === $page->id, 404);

        $section->update([
            'type' => $request->validated('type'),
            'sort_order' => $request->validated('sort_order'),
            'content' => SectionContent::sanitizeJson($request->validated('content')),
        ]);

        Cache::forget("pages.slug.{$page->slug}");

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(Page $page, Section $section): RedirectResponse
    {
        abort_unless($section->page_id === $page->id, 404);

        $section->delete();
        Cache::forget("pages.slug.{$page->slug}");

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Section deleted successfully.');
    }
}

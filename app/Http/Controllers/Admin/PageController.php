<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePageRequest;
use App\Http\Requests\Admin\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        return view('admin.pages.index', [
            'pages' => Page::withCount('sections')->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.pages.create', [
            'page' => new Page(),
        ]);
    }

    public function store(StorePageRequest $request): RedirectResponse
    {
        $page = Page::create($request->validated());
        Cache::forget("pages.slug.{$page->slug}");

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Page created successfully.');
    }

    public function edit(Page $page): View
    {
        $page->load('sections');

        return view('admin.pages.edit', [
            'page' => $page,
        ]);
    }

    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $oldSlug = $page->slug;
        $page->update($request->validated());

        Cache::forget("pages.slug.{$oldSlug}");
        Cache::forget("pages.slug.{$page->slug}");

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $slug = $page->slug;
        $page->delete();

        Cache::forget("pages.slug.{$slug}");

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}

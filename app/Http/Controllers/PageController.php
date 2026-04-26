<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function home(): View
    {
        return $this->renderPage('home');
    }

    public function show(string $slug): View
    {
        return $this->renderPage($slug);
    }

    protected function renderPage(string $slug): View
    {
        $pageId = Cache::remember(
            "pages.slug.{$slug}",
            now()->addMinutes(15),
            fn () => Page::query()->where('slug', $slug)->valueOrFail('id')
        );

        $page = Page::with('sections')->findOrFail($pageId);

        return view('pages.show', [
            'page' => $page,
        ]);
    }
}

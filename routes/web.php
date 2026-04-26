<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');

Route::middleware('guest')->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

    Route::get('/', fn () => redirect()->route('admin.pages.index'))->name('dashboard');

    Route::resource('pages', AdminPageController::class)->except(['show']);

    Route::prefix('pages/{page}')->name('pages.')->group(function (): void {
        Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');
        Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
    });

    Route::get('/pages/{page}/sections/{section}/edit', [SectionController::class, 'edit'])->name('sections.edit');
    Route::put('/pages/{page}/sections/{section}', [SectionController::class, 'update'])->name('sections.update');
    Route::delete('/pages/{page}/sections/{section}', [SectionController::class, 'destroy'])->name('sections.destroy');
});

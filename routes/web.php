<?php

use App\Http\Controllers\AdminPostPreviewController;
use App\Http\Controllers\ContactInquiryController;
use App\Http\Controllers\PublicDestinationController;
use App\Http\Controllers\PublicPostController;
use App\Http\Controllers\PublicTravelPackageController;
use App\Http\Middleware\EnsureAdmin;
use App\Models\Destination;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\TravelPackage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome', [
        'settings' => SiteSetting::home(),
        'destinations' => Destination::query()
            ->where('is_published', true)
            ->latest()
            ->limit(3)
            ->get(),
        'packages' => TravelPackage::query()
            ->where('is_published', true)
            ->with('destination')
            ->latest()
            ->limit(3)
            ->get(),
        'posts' => Post::query()
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->limit(3)
            ->get(),
    ]);
})->name('home');

Route::get('/language/{locale}', function (string $locale) {
    abort_unless(array_key_exists($locale, config('app.supported_locales')), 404);

    session(['locale' => $locale]);

    if (auth()->check()) {
        auth()->user()->update(['preferred_locale' => $locale]);
    }

    return redirect(Str::startsWith(url()->previous(), url('/')) ? url()->previous() : route('home'));
})->name('language.switch');

Route::get('/posts', [PublicPostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PublicPostController::class, 'show'])->name('posts.show');
Route::get('/destinations', [PublicDestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{destination:slug}', [PublicDestinationController::class, 'show'])->name('destinations.show');
Route::get('/packages', [PublicTravelPackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{package:slug}', [PublicTravelPackageController::class, 'show'])->name('packages.show');
Route::get('/contact', [ContactInquiryController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactInquiryController::class, 'store'])->name('contact.store');

Route::middleware(['auth', EnsureAdmin::class])->prefix('admin-preview')->name('admin.preview.')->group(function () {
    Route::get('/posts/{post}', [AdminPostPreviewController::class, 'show'])->name('posts.show');
});

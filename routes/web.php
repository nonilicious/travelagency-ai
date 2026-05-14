<?php

use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\PublicDestinationController;
use App\Http\Controllers\PublicPostController;
use App\Http\Controllers\PublicTravelPackageController;
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'login'])->name('login.store');
    Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', CustomerDashboardController::class)->name('customer.dashboard');
    Route::get('/profile', [CustomerProfileController::class, 'edit'])->name('customer.profile.edit');
    Route::patch('/profile', [CustomerProfileController::class, 'update'])->name('customer.profile.update');
    Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');
});

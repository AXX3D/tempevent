<?php

use App\Http\Controllers\LandingPageController;
use App\Modules\Events\Http\Controllers\EventController;
use App\Modules\Feedback\Http\Controllers\EventRatingController;
use App\Modules\Registrations\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPageController::class)->name('home');

Route::prefix('events')->name('events.')->group(function (): void {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/manage', [EventController::class, 'manage'])->name('manage');
    Route::post('/{event:slug}/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('/{event:slug}/feedback', [EventRatingController::class, 'create'])->name('feedback.create');
    Route::post('/{event:slug}/feedback', [EventRatingController::class, 'store'])->name('feedback.store');
    Route::get('/{event:slug}', [EventController::class, 'show'])->name('show');
});

// Feature routes should be grouped by module as the application grows.
// Example: require base_path('routes/modules/events.php');

<?php

use Illuminate\Support\Facades\Route;



Route::prefix('event')->name('events.')->group(function () {

    Route::post('/register/{eventId}', [App\Http\Controllers\EventRegistrationController::class, 'register'])->name('register');

    Route::get('all', [App\Http\Controllers\EventRegistrationController::class, 'index'])->name('all');

    Route::get('{eventName}', [App\Http\Controllers\EventRegistrationController::class, 'show'])->name('show');
});
